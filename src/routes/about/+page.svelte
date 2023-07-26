<svelte:head>
  <title>About</title>
</svelte:head>

<article class="article">
  <h1>About</h1>
  <div class="profile-card">
    <img
      class="portrait"
      src={"/potrait.png"}
      alt="Merilynn's portrait"
      style="width: 250px; height: 250px"
    />
    <div class="title">
      <h2>Ajay Prabhakar</h2>
      <div class="tagline">SDE 1 | IOS & Flutter Developer | UI & UX 🎨</div>
    </div>

    <p>Hi, I'm Ajay Prabhakar!! I am a mobile developer</p>

    <!-- <p>In my free time I like to:</p>
    <ul class="list">
      <li>Draw! 🖍</li>
      <li>Play roguelikes (it's a kind of video game)</li>
      <li>Learn new web tech</li>
      <li>Study japanese <sup lang="jp">(はじめまして)</sup></li>
      <li>Watch anime, read manga and visual novels</li>
      <li>Get the little worlds I have in my head out into cohesive writing</li>
      <li>Participate in various open source projects</li>
    </ul> -->

    <h3>Contact</h3>

    <p>
      If you want to get in touch you can send me a message at:
      <a href="mailto:ajayprabhakar369@gmail.com">
        <em>ajayprabhakar369@gmail.com</em>
      </a>
    </p>
  </div>
</article>

<style>
  .portrait {
    border-radius: 100%;
    float: left;
    margin-right: 2em;
    margin-bottom: 1em;
  }
  .title h2 {
    margin-bottom: 0;
  }
  .tagline {
    color: var(--color-text-300);
    margin-bottom: var(--line-space);
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
