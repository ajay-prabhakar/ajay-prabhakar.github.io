<script lang="ts">
  import Icon from "../components/Icon.svelte";
  import Logo from "../components/Logo.svelte";
  import { mdiFileDocument, mdiGithub, mdiLinkedin, mdiOpenInNew, mdiTwitter } from "@mdi/js";
</script>

<section class="landing">
  <h1>
    Hi, I'm <br /> Ajay Prabhakar
  </h1>
  <p class="description">
    I'm a SDE at Nuclei. I care about Mobile Development and UI
    Things.
  </p>
  <p class="description">
    Currently, I’m focusing on iOS and Flutter Development at Nuclei and building applications powered by LLM Models.
  </p>
  <hr class="bold" />
  <div class="links">
    <a
      href="https://github.com/ajay-prabhakar"
      title="GitHub profile"
      target="_blank"
      rel="noopener"
    >
      <Icon title="GitHub Icon" path={mdiGithub} size="1.5em" />
      <span>GitHub</span>
      <Icon path={mdiOpenInNew} />
    </a>

    <a
      href="https://www.linkedin.com/in/chromicle/"
      title="LinkedIn Profile"
      target="_blank"
      rel="noopener"
    >
      <Icon title="LinkedIn Icon" path={mdiLinkedin} size="1.5em" />
      <span>LinkedIn</span>
      <Icon path={mdiOpenInNew} />
    </a>

    <a
      href="https://twitter.com/chromicle_3"
      title="Twitter Profile"
      target="_blank"
      rel="noopener"
    >
      <Icon title="Twitter Icon" path={mdiTwitter} size="1.5em" />
      <span>Twitter</span>
      <Icon path={mdiOpenInNew} />
    </a>

    <a
      href="/resume.pdf"
      title="Resume"
      target="_blank"
      rel="noopener"
    >
      <Icon title="Resume Icon" path={mdiFileDocument} size="1.5em" />
      <span>Resume</span>
      <Icon path={mdiOpenInNew} />
    </a>
  </div>
</section>

<style>
  .landing {
    grid-area: landing;
  }

  .description {
    color: #c4c4c4; /* Lighter gray color for dark mode */
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }

  h1 :global(.svg-icon) {
    top: 0.15em; /* visual balance */
  }

  hr {
    width: 4em;
    margin: calc(1.5 * var(--line-space)) 0;
  }

  /* Use CSS Grid for arranging the links */
  .links {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1em;
    margin-bottom: var(--line-space);
  }

  .links a {
    display: flex;
    align-items: center;
    text-decoration: none;
  }

  .links a:hover {
    text-decoration: underline;
  }

  .links span {
    padding-left: 0.75em;
    padding-right: 0.6em;
  }
</style>
