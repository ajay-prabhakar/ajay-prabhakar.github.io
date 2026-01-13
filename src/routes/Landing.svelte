<script lang="ts">
  import Icon from "../components/Icon.svelte";
  import Logo from "../components/Logo.svelte";
  import { mdiFileDocument, mdiGithub, mdiLinkedin, mdiOpenInNew, mdiTwitter } from "@mdi/js";
  import { onMount } from "svelte";
  import { fade, fly } from "svelte/transition";

  let visible = false;
  onMount(() => {
    visible = true;
  });
</script>

<section class="landing">
  {#if visible}
    <div class="intro" in:fly={{ y: 30, duration: 600, delay: 100 }}>
      <span class="greeting">Hi, I'm</span>
      <h1 class="name">
        Ajay<br />Prabhakar<span class="cursor">_</span>
      </h1>
    </div>

    <div class="role-badge" in:fly={{ y: 20, duration: 500, delay: 300 }}>
      <span class="badge-icon">📱</span>
      <span>SDE 2 @ <a href="https://navi.com" target="_blank" rel="noopener">Navi</a></span>
    </div>

    <p class="description" in:fly={{ y: 20, duration: 500, delay: 400 }}>
      I craft <span class="highlight">mobile experiences</span> and care deeply about
      <span class="highlight">UI design</span>.
    </p>
    
    <p class="description secondary" in:fly={{ y: 20, duration: 500, delay: 500 }}>
      Currently working on iOS at the <strong>UPI & Payments</strong> team and building 
      applications powered by <strong>LLM Models</strong>.
    </p>

    <hr class="divider" in:fade={{ duration: 400, delay: 600 }} />

    <div class="links" in:fly={{ y: 20, duration: 500, delay: 700 }}>
      <a
        href="https://github.com/ajay-prabhakar"
        title="GitHub profile"
        target="_blank"
        rel="noopener"
        class="link-card"
      >
        <Icon title="GitHub Icon" path={mdiGithub} size="1.4em" />
        <span>GitHub</span>
        <Icon path={mdiOpenInNew} size="0.9em" />
      </a>

      <a
        href="https://www.linkedin.com/in/chromicle/"
        title="LinkedIn Profile"
        target="_blank"
        rel="noopener"
        class="link-card"
      >
        <Icon title="LinkedIn Icon" path={mdiLinkedin} size="1.4em" />
        <span>LinkedIn</span>
        <Icon path={mdiOpenInNew} size="0.9em" />
      </a>

      <a
        href="https://twitter.com/chromicle_3"
        title="Twitter Profile"
        target="_blank"
        rel="noopener"
        class="link-card"
      >
        <Icon title="Twitter Icon" path={mdiTwitter} size="1.4em" />
        <span>Twitter</span>
        <Icon path={mdiOpenInNew} size="0.9em" />
      </a>

      <a
        href="/resume.pdf"
        title="Resume"
        target="_blank"
        rel="noopener"
        class="link-card resume"
      >
        <Icon title="Resume Icon" path={mdiFileDocument} size="1.4em" />
        <span>Resume</span>
        <Icon path={mdiOpenInNew} size="0.9em" />
      </a>
    </div>
  {/if}
</section>

<style>
  .landing {
    grid-area: landing;
    min-height: 70vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .intro {
    margin-bottom: 1.5rem;
  }

  .greeting {
    display: block;
    font-size: 1.1rem;
    color: var(--color-primary-400);
    font-weight: 500;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
    font-family: var(--mono-font);
  }

  .name {
    font-size: clamp(2.5rem, 8vw, 4rem);
    font-weight: 700;
    line-height: 1.05;
    margin-bottom: 0;
    background: linear-gradient(135deg, #ffffff 0%, #a0a0a0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .cursor {
    display: inline-block;
    color: var(--color-primary-400);
    -webkit-text-fill-color: var(--color-primary-400);
    animation: blink 1s step-end infinite;
  }

  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
  }

  .role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    background: var(--color-background-200);
    border: 1px solid var(--border-subtle);
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
    width: fit-content;
  }

  .role-badge a {
    color: var(--color-primary-400);
    text-decoration: none;
    font-weight: 600;
  }

  .role-badge a:hover {
    text-decoration: underline;
  }

  .badge-icon {
    font-size: 1rem;
  }

  .description {
    color: var(--color-text-300);
    font-size: 1.15rem;
    line-height: 1.7;
    margin-bottom: 1rem;
    max-width: 400px;
  }

  .description.secondary {
    font-size: 1rem;
    color: var(--color-text-200);
    margin-bottom: 0;
  }

  .description strong {
    color: var(--color-text-400);
    font-weight: 500;
  }

  .highlight {
    color: var(--color-primary-400);
    font-weight: 500;
  }

  .divider {
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--color-primary-400), transparent);
    border: none;
    margin: 2rem 0;
    border-radius: 2px;
  }

  .links {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem;
    max-width: 320px;
  }

  .link-card {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: var(--color-background-200);
    border: 1px solid var(--border-subtle);
    border-radius: 0.75rem;
    text-decoration: none;
    color: var(--color-text-400);
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s var(--standard-curve);
  }

  .link-card:hover {
    background: var(--color-background-100);
    border-color: var(--color-primary-400);
    transform: translateY(-2px);
    box-shadow: var(--glow-accent);
  }

  .link-card span {
    flex: 1;
  }

  .link-card.resume {
    background: linear-gradient(135deg, var(--color-primary-400) 0%, #00cc6a 100%);
    border-color: transparent;
    color: #0a0a0a;
  }

  .link-card.resume:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 255, 136, 0.3);
  }

  @media screen and (max-width: 45em) {
    .landing {
      min-height: auto;
      padding-top: 2rem;
      padding-bottom: 3rem;
    }

    .links {
      max-width: 100%;
    }
  }
</style>
