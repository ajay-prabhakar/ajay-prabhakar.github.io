<svelte:head>
  <title>About</title>
</svelte:head>

<article class="">
  <h1>About Me</h1>
  <div class="profile-card">
    <img
      class="portrait"
      src={"/potrait.png"}
      alt="Merilynn's portrait"
      style="width: 250px; height: 250px"
    />
    <div class="title">
      <h2>Ajay Prabhakar</h2>
      <div class="tagline">SDE 1 | iOS & Flutter Developer | UI & UX Enthusiast 🎨</div>
    </div>

    <p class="intro">
      Hi there! I'm Ajay Prabhakar, a passionate mobile developer with expertise in iOS, Flutter, and PWA apps. 
      Currently, I work as an SDE 1 at Nuclei, where I lead the IOS team of Core SDK, crafting solutions that power merchant products for banks with active userbase of 210k users per day.
      <br/>I believe in creating impactful, user-friendly experiences and enjoy exploring the latest in mobile technology and design.
    </p>

    <section class="experience">
      <h3>My Journey</h3>
      <p>
        My journey in tech started at <strong>Amrita University</strong> in Kerala, where I first dipped my toes into Android development with Java.
        In my third year, I had the opportunity to participate in <strong>Google Summer of Code</strong>, contributing to open-source projects and discovering 
        the power of community in tech. Later, I ventured into Flutter, where I developed a deep appreciation for UI/UX design using tools like 
        <em>Adobe XD</em> and <em>Figma</em>.
      </p>
      <p>
        Working with startups as a Flutter developer taught me the fast-paced, innovative spirit of the startup ecosystem. 
        Now, at Nuclei, I’m excited to bring these experiences into building products that make a difference.
      </p>
    </section>

    <section class="interests">
      <h3>When I’m Not Coding</h3>
      <p>
        Outside of development, I’m an avid traveler and have explored most of South India along with parts of the North.
        I’m also a bit of a food enthusiast—Bangalore’s diverse cuisine is one of my favorite things to explore. 
      </p>
      <p>Other hobbies include:</p>
      <ul class="list">
        <li>Exploring UI and design trends 🎨</li>
        <li>Playing around with new web technologies</li>
        <li>Contributing to open-source projects 🌍</li>
        <li>Experimenting with photography 📷</li>
      </ul>
    </section>

    <h3>Let’s Connect</h3>
    <p>
      Have a project idea or just want to chat? Feel free to reach out:
      <a href="mailto:ajayprabhakar369@gmail.com"><em>ajayprabhakar369@gmail.com</em></a>
    </p>
  </div>
</article>

<style>
  .portrait {
    border-radius: 100%;
    float: left;
    margin-right: 2em;
    margin-bottom: 1em;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  }
  .title h2 {
    margin-bottom: 0;
  }
  .tagline {
    color: var(--color-text-300);
    margin-bottom: var(--line-space);
    font-weight: bold;
  }
  .intro {
    font-size: 1.1em;
    line-height: 1.6em;
  }
  .experience h3,
  .interests h3 {
    margin-top: 1.5em;
    color: var(--color-accent);
    border-bottom: 2px solid var(--color-accent);
    padding-bottom: 0.5em;
  }
  .list {
    margin-left: 1.5em;
  }

  @media (max-width: 30rem) {
    .portrait {
      display: block;
      float: none;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: calc(0.5 * var(--line-space));
    }
    .title {
      text-align: center;
    }
  }
</style>
