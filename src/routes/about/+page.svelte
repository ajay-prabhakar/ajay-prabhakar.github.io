<script lang="ts">
  import { browser } from "$app/environment";

  // @ts-ignore
  import portrait from "../../portrait.jpg?w=160&webp&meta";
  import { rot } from "./cipher";
  import { selectable } from "./selectable";

  const email = rot("uryyb@shehqrna.pbz", -13);
</script>

<svelte:head>
  <title>About</title>
</svelte:head>

<article class="article">
  <h1>About</h1>
  <div class="profile-card">
    <img
      class="portrait"
      src={portrait.src}
      alt="Merilynn's portrait"
      style="width: {portrait.width}px; height: {portrait.height}px"
    />
    <div class="title">
      <h2>Merilynn Bandy</h2>
      <div class="tagline">Full Stack Engineer, Designer</div>
    </div>

    <p>
      Hi, I'm Merilynn! As a day job I'm a full-stack engineer. I like design,
      implementation and user experience. I like to be meticulous with
      everything I make. My pronouns are she/her.
    </p>

    <p>
      I grew up in the relatively small Örebro, Sweden. It has a big medieval
      castle, but otherwise is a pretty calm and normal Swedish set piece. I
      went to high school for computer science and picked up an interest for web
      development there. It's been a passion since then.
    </p>

    <p>
      At the end of 2020 I left the safe and calm life I was leading for
      something completely unknown. I moved to the US! Now I live and work here
      along with 4 roommates. It doesn't quite feel like my normal yet, but
      having every day be an adventure is fun too!
    </p>

    <p>In my free time I like to:</p>
    <ul class="list">
      <li>Draw! 🖍</li>
      <li>Play roguelikes (it's a kind of video game)</li>
      <li>Learn new web tech</li>
      <li>Study japanese <sup lang="jp">(はじめまして)</sup></li>
      <li>Watch anime, read manga and visual novels</li>
      <li>Get the little worlds I have in my head out into cohesive writing</li>
      <li>Participate in various open source projects</li>
    </ul>

    <h3>Contact</h3>

    <p>
      If you want to get in touch you can send me a message at:

      <span use:selectable>{email}</span>
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
