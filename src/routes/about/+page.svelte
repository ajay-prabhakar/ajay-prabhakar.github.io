<script lang="ts">
  import { onMount } from "svelte";
  import { fly, fade } from "svelte/transition";
  import { mdiEmail, mdiMapMarker, mdiBriefcase } from "@mdi/js";
  import Icon from "../../components/Icon.svelte";

  let visible = false;
  onMount(() => {
    visible = true;
  });
</script>

<svelte:head>
  <title>About | Ajay Prabhakar</title>
</svelte:head>

{#if visible}
<article class="about-page">
  <header class="hero" in:fly={{ y: 30, duration: 600, delay: 100 }}>
    <div class="hero-content">
      <img
        class="portrait"
        src="/potrait.png"
        alt="Ajay Prabhakar"
      />
      <div class="hero-text">
        <h1>About Me</h1>
        <p class="tagline">SDE 2 at Navi · iOS Developer · UI Enthusiast</p>
        <div class="quick-info">
          <span class="info-item">
            <Icon path={mdiMapMarker} size="1em" />
            Bangalore, India
          </span>
          <span class="info-item">
            <Icon path={mdiBriefcase} size="1em" />
            <a href="https://navi.com" target="_blank" rel="noopener">Navi</a>
          </span>
        </div>
      </div>
    </div>
  </header>

  <section class="intro-section" in:fly={{ y: 20, duration: 500, delay: 200 }}>
    <p class="intro">
      Hi there! I'm Ajay Prabhakar, a passionate mobile developer with expertise in 
      <span class="highlight">iOS</span>, <span class="highlight">Flutter</span>, and 
      <span class="highlight">PWA apps</span>.
    </p>
    <p>
      Currently, I work as an SDE 2 at <a href="https://navi.com" target="_blank" rel="noopener">Navi</a>, 
      where I work on iOS at the UPI & Payments team and build applications powered by LLM Models.
      I believe in creating impactful, user-friendly experiences and enjoy exploring the latest in 
      mobile technology and design.
    </p>
  </section>

  <section class="journey-section" in:fly={{ y: 20, duration: 500, delay: 300 }}>
    <h2>
      <span class="section-number">01</span>
      My Journey
    </h2>
    <div class="timeline">
      <div class="timeline-item">
        <div class="timeline-marker"></div>
        <div class="timeline-content">
          <h3>The Beginning</h3>
          <p>
            My journey in tech started at <strong>Amrita University</strong> in Kerala, 
            where I first dipped my toes into Android development with Java.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker"></div>
        <div class="timeline-content">
          <h3>Google Summer of Code</h3>
          <p>
            In my third year, I participated in <strong>Google Summer of Code</strong>, 
            contributing to open-source projects and discovering the power of community in tech.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker"></div>
        <div class="timeline-content">
          <h3>Flutter & Design</h3>
          <p>
            Later, I ventured into Flutter, where I developed a deep appreciation for 
            UI/UX design using tools like <em>Adobe XD</em> and <em>Figma</em>.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker"></div>
        <div class="timeline-content">
          <h3>Nuclei</h3>
          <p>
            Led the iOS Core SDK development for 14+ Indian banks, serving 210k+ users, 
            and mentored a team of developers while optimizing performance and SDK footprint.
          </p>
        </div>
      </div>
      <div class="timeline-item">
        <div class="timeline-marker active"></div>
        <div class="timeline-content">
          <h3>Present Day</h3>
          <p>
            Now at <a href="https://navi.com" target="_blank" rel="noopener">Navi</a>, 
            I'm excited to bring these experiences into building products that make a difference.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="interests-section" in:fly={{ y: 20, duration: 500, delay: 400 }}>
    <h2>
      <span class="section-number">02</span>
      Beyond Code
    </h2>
    <p>
      Outside of development, I'm an avid traveler and have explored most of South India 
      along with parts of the North. I'm also a bit of a food enthusiast—Bangalore's 
      diverse cuisine is one of my favorite things to explore.
    </p>
    <div class="interests-grid">
      <div class="interest-card">
        <span class="interest-icon">🎨</span>
        <span>UI & Design Trends</span>
      </div>
      <div class="interest-card">
        <span class="interest-icon">🌐</span>
        <span>Web Technologies</span>
      </div>
      <div class="interest-card">
        <span class="interest-icon">🌍</span>
        <span>Open Source</span>
      </div>
      <div class="interest-card">
        <span class="interest-icon">📷</span>
        <span>Photography</span>
      </div>
    </div>
  </section>

  <section class="contact-section" in:fly={{ y: 20, duration: 500, delay: 500 }}>
    <h2>
      <span class="section-number">03</span>
      Let's Connect
    </h2>
    <p>Have a project idea or just want to chat? I'd love to hear from you.</p>
    <a href="mailto:ajayprabhakar369@gmail.com" class="contact-button">
      <Icon path={mdiEmail} size="1.2em" />
      <span>ajayprabhakar369@gmail.com</span>
    </a>
  </section>
</article>
{/if}

<style>
  .about-page {
    max-width: 700px;
    padding-bottom: 4rem;
  }

  .hero {
    margin-bottom: 3rem;
  }

  .hero-content {
    display: flex;
    gap: 2rem;
    align-items: center;
  }

  .portrait {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--color-primary-400);
    box-shadow: 0 0 30px rgba(0, 255, 136, 0.2);
    flex-shrink: 0;
  }

  .hero-text h1 {
    margin-bottom: 0.5rem;
    font-size: 2.5rem;
  }

  .tagline {
    color: var(--color-text-300);
    font-size: 1.1rem;
    margin-bottom: 1rem;
  }

  .quick-info {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
  }

  .info-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--color-text-300);
    font-size: 0.9rem;
  }

  .info-item a {
    color: var(--color-primary-400);
    text-decoration: none;
  }

  .info-item a:hover {
    text-decoration: underline;
  }

  .intro-section {
    margin-bottom: 3rem;
  }

  .intro {
    font-size: 1.2rem;
    line-height: 1.8;
    color: var(--color-text-400);
  }

  .intro-section p {
    color: var(--color-text-300);
    line-height: 1.8;
  }

  .intro-section a {
    color: var(--color-primary-400);
    text-decoration: none;
  }

  .intro-section a:hover {
    text-decoration: underline;
  }

  .highlight {
    color: var(--color-primary-400);
    font-weight: 500;
  }

  h2 {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }

  .section-number {
    font-family: var(--mono-font);
    font-size: 0.9rem;
    color: var(--color-primary-400);
    background: rgba(0, 255, 136, 0.1);
    padding: 0.3rem 0.6rem;
    border-radius: 0.5rem;
  }

  .journey-section {
    margin-bottom: 3rem;
  }

  .timeline {
    position: relative;
    padding-left: 2rem;
  }

  .timeline::before {
    content: '';
    position: absolute;
    left: 6px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--color-background-100);
  }

  .timeline-item {
    position: relative;
    padding-bottom: 1.5rem;
  }

  .timeline-item:last-child {
    padding-bottom: 0;
  }

  .timeline-marker {
    position: absolute;
    left: -2rem;
    top: 0.4rem;
    width: 14px;
    height: 14px;
    background: var(--color-background-200);
    border: 2px solid var(--color-text-200);
    border-radius: 50%;
    z-index: 1;
  }

  .timeline-marker.active {
    background: var(--color-primary-400);
    border-color: var(--color-primary-400);
    box-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
  }

  .timeline-content h3 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    color: var(--color-text-400);
  }

  .timeline-content p {
    color: var(--color-text-300);
    margin-bottom: 0;
    line-height: 1.7;
  }

  .timeline-content a {
    color: var(--color-primary-400);
    text-decoration: none;
  }

  .timeline-content a:hover {
    text-decoration: underline;
  }

  .interests-section {
    margin-bottom: 3rem;
  }

  .interests-section > p {
    color: var(--color-text-300);
    margin-bottom: 1.5rem;
  }

  .interests-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
  }

  .interest-card {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    background: var(--color-background-200);
    border: 1px solid var(--border-subtle);
    border-radius: 0.75rem;
    font-size: 0.95rem;
    color: var(--color-text-400);
    transition: all 0.2s ease;
  }

  .interest-card:hover {
    border-color: var(--color-primary-400);
    transform: translateY(-2px);
  }

  .interest-icon {
    font-size: 1.25rem;
  }

  .contact-section p {
    color: var(--color-text-300);
    margin-bottom: 1.5rem;
  }

  .contact-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, var(--color-primary-400) 0%, #00cc6a 100%);
    color: #0a0a0a;
    font-weight: 600;
    text-decoration: none;
    border-radius: 0.75rem;
    transition: all 0.2s ease;
  }

  .contact-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 255, 136, 0.3);
  }

  @media (max-width: 35rem) {
    .hero-content {
      flex-direction: column;
      text-align: center;
    }

    .quick-info {
      justify-content: center;
    }

    .interests-grid {
      grid-template-columns: 1fr;
    }

    .timeline {
      padding-left: 1.5rem;
    }

    .timeline-marker {
      left: -1.5rem;
    }
  }
</style>
