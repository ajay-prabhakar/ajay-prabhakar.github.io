<?php

class MPCE_CFA_Mailer{
    private $mailPrepared;

    private $mail;
    private $subject;

    private $attachments;
    private $errors;
    private $from;
    private $to;

    public function __construct( $from, $to, $subj, $replyto = '', $attachments = array()){
        $this->from = $from;
        $this->to = $to;
        $this->replyto = $replyto;
        $this->subject = $subj;
        $this->attachments = $attachments;
    }

    public function prepareMail( $post ){
        $this->errors = array();
        $response = true;

        if( array_key_exists ( 'g-recaptcha-response', $post ) ) {
            $response = $this->responseReCAPTCHA($post['g-recaptcha-response']);
        }

         if ($response === true) {

            unset($post['g-recaptcha-response']);
            unset($post['cfa-submit']);
            unset($post['cfa_name']);
            unset($post['action']);
            unset($post['security']);
            unset($post['replyto']);
            unset($post['cfa_redirect']);
            unset($post['upload_name']);

             $templates = unserialize(stripslashes('a:0:{}'));
            if( isset($templates[ $post['cfa_id'] ]) ){
                $template =  trim($templates[ $post['cfa_id'] ]);
            } else {
                $template = false;
            }

             if( $template ){
                 $mail = $this->generateByTemplate( $post, $template);
             }  else {
                 unset($post['cfa_id']);
                 $mail = $this->generateByDefault($post);
             }

            if ( count($this->errors) === 0 ){
                $this->mailPrepared = true;
                $this->mail = $mail;

                return true;
            }
        }

        return false;
    }

    public function sendMailWithAttach(){
		
		$settings = unserialize(stripslashes('a:0:{}'));

		if(empty($this->attachments)){
			if($settings['mpce_cfa_mail_preference'] != 'smtp'){
				$headers = '';
				$headers .= "From: " . $this->from . "" . PHP_EOL;
				$headers .= "Reply-To: " . (!empty($this->replyto) ? $this->replyto : $this->from) . "" . PHP_EOL;
				$headers .= "Return-Path: " . $this->from . "" . PHP_EOL;
				$headers .= "Content-Type: text/html; charset=UTF-8" . PHP_EOL;
			}
		}else{ //if attachment exists
				
			$message = $this->mail;
			$boundary = md5(time());
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "From:".$this->from."\r\n";
			$headers .= "Reply-To: ". (!empty($this->replyto) ? $this->replyto : $this->from) ."" . "\r\n";
			$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
			
			//plain text 
			$body = "--$boundary\r\n";
			$body .= "Content-Type: text/html; charset=UTF-8\r\n";
			$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
			$body .= chunk_split(base64_encode($message));
			
			foreach($this->attachments as $attachment){
				
				$path = $attachment[tmp_name];
				$filename = $attachment[name];
				$size = $attachment[size];
				$type = $attachment[type];
				$error = $attachment[error];
				
				$valid_file = validate_file_type($filename, $ext);
				if($valid_file !== true){
					$this->errors[] = 'File type : '.$ext.' not allowed';
					continue;
				}
				
				//read from the uploaded file & base64_encode content for the mail
				$handle = fopen($path, "r");
				$content = fread($handle, $size);
				fclose($handle);
				$encoded_content = chunk_split(base64_encode($content));
			
				$body .= "--$boundary\r\n";
				$body .="Content-Type: $type; name=".$filename."\r\n";
				$body .="Content-Disposition: attachment; filename=".$filename."\r\n";
				$body .="Content-Transfer-Encoding: base64\r\n";
				$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
				$body .= $encoded_content;
			}
			
			$this->mail = $body;

		}
		
		// If there are no errors we send the email
		if(empty($this->errors)){
			
			if($settings['mpce_cfa_mail_preference'] != 'smtp'){

				//Send the email
				$sended = mail( $this->to, $this->subject, $this->mail, $headers);

				if ( $sended ) {
					return true;
				}
				
				$this->errors = 'Mail function returned false.';
			}else{

				$array['to'] = $this->to;
				$array['replyto'] = $this->replyto;
				$array['subject'] = $this->subject;
				$array['message'] = $this->mail;
				if(!empty($headers)){
					$array['headers'] = $headers;
				}
				
				$send = sme_smtp($array, $settings);
				
				if($send === TRUE){
					return true;
				}else{
					$this->errors = $send;
				}
			}
		}
		
		return false;
    }

    public function sendMail(){
        if( !$this->mailPrepared) return false;
		
		// The function will check if we have to attach files
        return $this->sendMailWithAttach();
    }

    public function generateByTemplate( $post, $template){
        $mail = $template;
        foreach( $post as $key => $value ){
            $replace = array();
            if(is_array($value)){
                foreach($value as $numb => $val){
                    $val =  $this->protectString($val);
                    $replace [$numb] = $val;
                }
                $replace = implode(',', $replace);
            } else{
                $replace = $this->protectString($value);
            }
            $mail = preg_replace( '/\[' . $key . '\]/', $replace, $mail);
        }
		
        $mail .= '<b>User IP </b>' . '<br />';
        $mail .= get_ip_addr();

        return $mail;
    }

    public function generateByDefault( $post ){
        $mail = "";
        foreach($post as $key=>$val){
            $mail .= "<p>";
            $replace = array();

            if(is_array($val)){
                foreach($val as $numb => $value){
                    $replace[$numb] = $this->protectString($value);
                }
                $replace = implode(',', $replace);
            } else{
                $replace =  $this->protectString($val);
            }
            $mail .= '<b>' . $this->protectString($key) . '</b>' . '<br />';
            $mail .= $replace;

            $mail .= "</p>";
        }
		
        $mail .= '<p><b>User IP </b>' . '<br />';
        $mail .= get_ip_addr().'</p>';

        return $mail;
    }

/*
 * return true if reCAPTCHA submit 'not robot'
 * */
    private function responseReCAPTCHA( $recaptcha ){
        $captcha = '';
        $settings = unserialize(stripslashes('a:0:{}'));

        if (isset($recaptcha)) {
            $captcha = $recaptcha;
        }
        if (!$captcha) {
            $this->errors[] = 'Please check the reCAPTCHA.';
            return false;
        }

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $settings['recaptch_secret_key']
            . "&response=" . $captcha
            . "&remoteip=" . $_SERVER['REMOTE_ADDR'];

        $args = array(
            'timeout'     => 15,
            'sslverify'   => false,
        );
        $response = curl_call( $url, $args );

        try {
            $json = json_decode( $response );
        } catch ( Exception $ex ) {
            $json = null;
        }

        $response = $json->success;

        if ($response !== true) {
            $this->errors[] = 'ReCAPTCHA Error';
        }

        return $response;
    }

    private function protectString($value){
        return htmlspecialchars(stripslashes(trim($value)));
    }

    /**
     * @return errors rised during prepareing mail
     */
    public function getErrors(){
        return implode(",",  (array)$this->errors);
    }

    public function set_html_content_type(){
        return "text/html";
    }

    public function set_message_from(){
        return $this->from;
    }

}

// Make a curl call
function curl_call($url, $post = array()){	
	
	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
		
	// Connection Time OUT
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	
	// You can timeout in one hour max
	curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
	
	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
	// UserAgent and Cookies
	curl_setopt($ch, CURLOPT_USERAGENT, 'Contact-Form');
	
	if(!empty($post)){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	}
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// Get response from the server.
	$resp = curl_exec($ch);
	$curl_err = curl_error($ch);
	curl_close($ch);
	
	if(empty($resp)){
		return false;
	}
	
	return $resp;
	
}

function sm_send_json( $response ) {
	@header( 'Content-Type: application/json; charset=UTF-8');
	echo json_encode( $response );
	die();
}


function mpce_cfa_contact_ajax(){
	
	global $settings;
	
    ob_start();
    $json = array('errors' => array(), 'success' => '');

    if(empty($_POST)){
		$json['success'] = false;
		$json['errors'] = array('Security error!');

		ob_clean();
		sm_send_json($json);
		die();
    }

    $settings = unserialize(stripslashes('a:0:{}'));
    $replacements = array(
        'blogname' => array(
            'search' => '%blog-name%',
            'replace' => 'Chromicle'
        ),
        'formname' => array(
            'search' => '%form-name%',
            'replace' => $_POST['cfa_name']
        ),
        'blogname_2' => array(
            'search' => '[blog-name]',
            'replace' => 'Chromicle'
        ),
        'formname_2' => array(
            'search' => '[form-name]',
            'replace' => $_POST['cfa_name']
        ),
    );

    $from = trim($settings['mpce_cfa_mail_sender']);
    $to = trim($settings['mpce_cfa_mail_recipient']);
    $subj = trim($settings['mpce_cfa_mail_subject']);

    foreach( $replacements as $key => $value ){
        $subj = str_replace( $value['search'], $value['replace'], $subj);
    }

    $to = ($to === '') ? '' : $to;
    $from = ($from === '') ? '' : $from;
	
	$formID = $_POST['cfa_id'];
	if(!empty($settings[$formID.'_recipient'])){
		$to = trim($settings[$formID.'_recipient']);
	}
	
	if(!empty($settings[$formID.'_sender'])){
		$from = trim($settings[$formID.'_sender']);
	}
	
	if(!empty($settings[$formID.'_subject'])){
		$subj = trim($settings[$formID.'_subject']);
		foreach( $replacements as $key => $value ){
			$subj = str_replace( $value['search'], $value['replace'], $subj);
		}
	}
	
	$replyto = '';
	if(!empty($_POST['replyto'])){
		$val = $_POST['replyto'];
		$replyto = $_POST[$val];
	}
	
	$attachments = array();
	if(!empty($_FILES)){
		$attachments = $_FILES;
		// Remove the fields which does not have an attachment selected
		foreach($attachments as $field_id => $file_details){
			if(empty($file_details['name'])){
				unset($attachments[$field_id]);
			}
		}
	}
	
    $mailer = new MPCE_CFA_Mailer( $from, $to, $subj, $replyto, $attachments );
    $mailer->prepareMail( $_POST );

    if(!$mailer->getErrors()) {
        $send = $mailer->sendMail();
    }

    if( $send ){
        $json['success'] = true;
    } else {
        $json['success'] = false;
        $json['errors'] = $mailer->getErrors();
    }
	
	if(!empty($_POST['cfa_redirect']) && $json['success'] == true){
		$json['redirect'] = $_POST['cfa_redirect'];
	}

    ob_clean();
    sm_send_json($json);
}

if(!empty($_POST)){
	mpce_cfa_contact_ajax();
}

// SMTP Mail Function
function sme_smtp($array, $settings){
	
	$array['to'] = trim($array['to']);
	$array['replyto'] = trim($array['replyto']);

	$smtpser = str_replace(array('tls://'), array(''), $settings['mpce_cfa_smtp_server']);
	
	$port = $settings['mpce_cfa_smtp_port'];
	
	// Open an SMTP connection
	$cp = @fsockopen($smtpser, $port);
	
	if(!$cp){
	
		return "Failed to even make a connection";
	
	}
	
	$res = get_lines($cp,256);echo $res.' -- 1<br />';
	
	if(substr($res,0,3) != "220"){
	
		return "Failed to connect";
		
	}
	
	// Say hello...
	fputs($cp, "EHLO localhost\r\n");
	
	$res = get_lines($cp,256);echo $res.' -- 2<br />';
	
	if(substr($res,0,3) != "250"){
		
		fputs($cp, "HELO localhost\r\n");
	
		$res = get_lines($cp,256);echo $res.' -- 2<br />';
		
		if(substr($res,0,3) != "250"){
		
			return "Failed to Introduce";
			
		}
		
	}
	
	if(substr($settings['mpce_cfa_smtp_server'], 0, 3) == 'tls'){
	
		// Say hello...
		fputs($cp, "STARTTLS\r\n");
	
		$res = get_lines($cp,256);echo $res.' -- 2<br />';
		
		if(substr($res,0,3) != "220"){
			return "STARTTLS not accepted from server!";
		}

		//Allow the best TLS version(s) we can
		$crypto_method = STREAM_CRYPTO_METHOD_TLS_CLIENT;

		//PHP 5.6.7 dropped inclusion of TLS 1.1 and 1.2 in STREAM_CRYPTO_METHOD_TLS_CLIENT
		//so add them back in manually if we can
		if(defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')){
			$crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
			$crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT;
		}

		stream_socket_enable_crypto($cp, true, $crypto_method);
	
		// Say hello...
		fputs($cp, "EHLO localhost\r\n");
		
		$res = get_lines($cp,256);echo $res.' -- 2<br />';
		
		if(substr($res,0,3) != "250"){
			
			fputs($cp, "HELO localhost\r\n");
		
			$res = get_lines($cp,256);echo $res.' -- 2<br />';
			
			if(substr($res,0,3) != "250"){
			
				return "Failed to Introduce";
				
			}
			
		}
		
	}
	
	// perform authentication
	fputs($cp, "auth login\r\n");
	
	$res = get_lines($cp,256);echo $res.' -- 3<br />';
	
	if(substr($res,0,3) != "334"){
	
		return "Failed to Initiate Authentication";
	
	}
	
	fputs($cp, base64_encode($settings['mpce_cfa_smtp_user'])."\r\n");
	
	$res = get_lines($cp,256);echo $res.' -- 4<br />';
	
	if(substr($res,0,3) != "334"){
	
		return "Failed to Provide Username for Authentication";
		
	}
	
	fputs($cp, base64_encode($settings['mpce_cfa_smtp_password'])."\r\n");
	
	$res=get_lines($cp,256);echo $res.' -- 5<br />';
	
	if(substr($res,0,3) != "235"){
	
		return "Failed to Authenticate";
	
	}
	
	///////////////////////////////////
	// Connection Established lets mail
	///////////////////////////////////
	
	// Mail from...
	fputs($cp, "MAIL FROM: <".$settings['mpce_cfa_smtp_user'].">\r\n");
	
	$res = get_lines($cp,256);echo $res.' -- 6<br />';
	
	if(substr($res,0,3) != "250"){
	
		return "MAIL FROM failed";
	
	}
	
	// Rcpt to...
	fputs($cp, "RCPT TO: <".$array['to'].">\r\n");
	
		$res=get_lines($cp,256);echo $res.' -- 7<br />';
	
	if(substr($res,0,3) != "250"){
	
		return "RCPT TO failed";
	
	}
	
	//Add the CC
	if(!empty($array['cc'])){
	
		$ccdata = '';	
		foreach($array['cc'] as $ck => $cv){
			// Rcpt to...
			fputs($cp, "RCPT TO: <".trim($cv).">\r\n");
			
				$res=get_lines($cp,256);echo $res.' -- 7<br />';
				$ccdata .= "Cc: <".trim($cv).">\r\n";	
			
			if(substr($res,0,3) != "250"){		
				return "RCPT CC failed";
			
			}
		}
	}
	
	if(!empty($array[$i]['bcc'])){
	
		foreach($array[$i]['bcc'] as $bcc){
		
			// Rcpt to...(BCC)
			fputs($cp, "RCPT TO: <".$bcc.">\r\n");
			
				$res=get_lines($cp,256);echo $res.' -- 8<br />';
			
			if(substr($res,0,3) != "250"){
			
				return "BCC failed";
			
			}
		
		}
		
	}
	
	// Data...
	fputs($cp, "DATA\r\n");
	
	$res=get_lines($cp,256);echo $res.' -- 9<br />';
	
	if(substr($res,0,3) != "354"){
	
		return "DATA failed";
		
	}
	
	
	if(isset($array['headers'])){
			
		$headers = $array['headers'];
	
	}else{
	
		$headers = 'From: '." <".$settings['mpce_cfa_smtp_user'].">\r\n".
				'Reply-To: '.(!empty($array['replyto']) ? $array['replyto'] : $settings['mpce_cfa_smtp_user'])."\r\n".
				'Content-Type: text/html; charset=UTF-8'."\r\n".
				'Return-Path: '.$settings['mpce_cfa_smtp_user']."\r\n";
	
	}
	
	// Send To:, From:, Subject:, other headers, blank line, message, and finish
	// with a period on its own line (for end of message)
	
	fputs($cp, "To: ".$array['to']."\r\n".(!empty($ccdata) ? $ccdata : "")."Subject: ".$array['subject']."\r\n$headers\r\n\r\n".$array['message']."\r\n.\r\n");
	
	$res = get_lines($cp,256);echo $res.' -- 10<br />';
	
	if(substr($res,0,3) != "250"){
	
		return "Message Body Failed. Error :".$res;
		
	}
	
	// ...And time to quit...
	fputs($cp,"QUIT\r\n");
	
	$res = get_lines($cp,256);echo $res.'<br />';
	
	if(substr($res,0,3) != "221"){
	
		return "QUIT failed";
	
	}
	echo "Email sent.";
	return true;
	
}

function get_lines($smtp_conn, $chars = 256){
	$data = '';
	while(is_resource($smtp_conn) && !feof($smtp_conn)){
		$str = fgets($smtp_conn, $chars);
		$data .= $str;
		if(!isset($str[3]) or (isset($str[3]) and $str[3] == ' ')){
			break;
		}
	}
	return $data;
}

// get IP Address of the User
function get_ip_addr(){
	
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
		$ip = $_SERVER['REMOTE_ADDR'];
    }
	
    return $ip;
}

function validate_file_type($filename, &$extn){
	
	global $settings;
	
	if(empty($settings['mpce_cfa_file_type'])){
		$valid_filetypes = 'txt,doc,pdf,docx,ppt,pptx,odt,xls,xlsx,zip,jpg,jpeg,png,gif';
	}else{
		$valid_filetypes = strtolower($settings['mpce_cfa_file_type']);
	}
	
	$info = pathinfo($filename);
	$extn = $info['extension'];
	$extn = strtolower($extn);
	// Maybe the admin has added (.)dot in the extensions list
	$dot_extn = '.'.$extn;

	$arr_valid_filetypes= explode(',',preg_replace('/\s+/', '', $valid_filetypes));
	if(!in_array($extn, $arr_valid_filetypes) && !in_array($dot_extn, $arr_valid_filetypes)){
		return false;
	}
	
	return true;
}
