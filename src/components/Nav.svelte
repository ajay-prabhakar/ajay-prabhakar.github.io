<script lang="ts">
  import { page, navigating } from "$app/stores";
  import { derived } from "svelte/store";
  import Logo from "./Logo.svelte";

  const compass = (pattern: RegExp) =>
    derived([navigating, page], ([$navigating, $page]) => ({
      isCurrent: !$navigating && pattern.test($page.url.pathname),
      navigatingTo: $navigating && pattern.test($navigating.to.pathname),
    }));

  const home = compass(/^\/$/);
  const work = compass(/^\/work/);
  const blog = compass(/^\/blog/);
  const about = compass(/^\/about/);
</script>

<nav role="navigation">
  <a
    href="/"
    title="home"
    class="logo"
    aria-current={$home.isCurrent ? "page" : undefined}
    sveltekit:prefetch
  >
    <Logo size="1.5em" color="var(--color-primary-400)" />
  </a>
  
  <div class="nav-right">
    <ul>
      <li>
        <a
          href="/work"
          class="nav-link"
          aria-current={$work.isCurrent ? "page" : undefined}
          class:navigating-to={$work.navigatingTo}
          sveltekit:prefetch
        >
          Work
        </a>
      </li>
      <li>
        <a
          href="https://medium.com/@chromicle"
          class="nav-link"
          aria-current={$blog.isCurrent ? "page" : undefined}
          class:navigating-to={$blog.navigatingTo}
          sveltekit:prefetch
          target="_blank"
          rel="noopener noreferrer"
        >
          Blog
        </a>
      </li>
      <li>
        <a
          href="/about"
          class="nav-link"
          aria-current={$about.isCurrent ? "page" : undefined}
          class:navigating-to={$about.navigatingTo}
          sveltekit:prefetch
        >
          About
        </a>
      </li>
    </ul>
  </div>
</nav>

<style lang="postcss">
  nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: calc(1.5 * var(--line-space)) 0;
  }

  .logo {
    transition: transform 0.2s var(--bounce-curve);
  }

  .logo:hover {
    transform: scale(1.1);
  }

  .logo :global(.svg-icon) {
    display: flex;
    vertical-align: middle;
    align-items: center;
  }

  .nav-right {
    display: flex;
    align-items: center;
  }

  ul {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0;
    background: var(--color-background-200);
    padding: 0.35rem;
    border-radius: 0.75rem;
    border: 1px solid var(--border-subtle);
  }

  li {
    display: block;
    position: relative;
    margin-left: 0;
    padding: 0;
  }

  .nav-link {
    display: block;
    padding: 0.5rem 1rem;
    position: relative;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--color-text-300);
    border-radius: 0.5rem;
    transition: all 0.2s var(--standard-curve);
  }

  .nav-link:hover {
    color: var(--color-text-400);
    background: var(--color-background-100);
  }

  .nav-link[aria-current="page"] {
    color: var(--color-primary-400);
    background: rgba(0, 255, 136, 0.1);
  }

  .nav-link.navigating-to {
    color: var(--color-primary-400);
    
    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }
    animation: pulse 1s infinite;
  }

  @media screen and (max-width: 30em) {
    ul {
      gap: 0.25rem;
      padding: 0.25rem;
    }

    .nav-link {
      padding: 0.4rem 0.75rem;
      font-size: 0.85rem;
    }
  }
</style>
