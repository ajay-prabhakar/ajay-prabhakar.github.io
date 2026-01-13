<script lang="ts">
  import { getStores } from "$app/stores";
  import { updateFragmentLinkTarget } from "$lib/link";
  import { onMount } from "svelte";
  import Nav from "../components/Nav.svelte";
  import Analytics from "../components/Analytics.svelte";

  import "../styles/reset.postcss";
  import "../styles/global.postcss";
  import "../styles/theme.postcss";
  import "../styles/code.postcss";
  import Loading from "./Loading.svelte";

  const { page } = getStores();
  let element: HTMLElement;

  onMount(() => {
    page.subscribe(() => {
      if (element) {
        updateFragmentLinkTarget(window.location.href, element);
      }
    });

    navigator.serviceWorker
      .getRegistration()
      .then((registration) => registration?.unregister());
  });
</script>

<svelte:window
  on:hashchange={() => updateFragmentLinkTarget(window.location.href, element)}
/>

<Loading />

<div class="page-wrapper">
  <div class="container" bind:this={element}>
    <Analytics/>

    <header class="navbar">
      <Nav />
    </header>

    <main>
      <slot />
    </main>
  </div>

  <footer class="footer">
    <div class="footer-content">
      <p class="footer-text">
        Crafted with care by 
        <a href="/about" class="footer-link">Ajay</a>
        <span class="separator">·</span>
        Built with
        <a href="https://kit.svelte.dev/" target="_blank" rel="noopener" class="footer-link">
          SvelteKit
        </a>
        <span class="heart">♥</span>
      </p>
      <p class="copyright">© 2026 Ajay Prabhakar</p>
    </div>
  </footer>
</div>

<style>
  .page-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  .container {
    max-width: 60em;
    margin: 0 auto;
    flex: 1;
    width: 100%;
  }

  main {
    position: relative;
  }

  .navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background: linear-gradient(to bottom, var(--color-background-400) 0%, var(--color-background-400) 80%, transparent 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
  }

  .footer {
    margin-top: auto;
    padding: 1.5rem 0 1rem;
    border-top: 1px solid var(--border-subtle);
  }

  .footer-content {
    max-width: 60em;
    margin: 0 auto;
    padding: 0 calc(2 * var(--line-space));
    text-align: center;
  }

  .footer-text {
    color: var(--color-text-300);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
  }

  .footer-link {
    color: var(--color-primary-400);
    text-decoration: none;
    font-weight: 500;
    transition: opacity 0.2s ease;
  }

  .footer-link:hover {
    opacity: 0.8;
    text-decoration: underline;
  }

  .separator {
    margin: 0 0.5rem;
    color: var(--color-text-200);
  }

  .heart {
    color: #e94560;
    margin-left: 0.25rem;
  }

  .copyright {
    color: var(--color-text-200);
    font-size: 0.8rem;
    margin-bottom: 0;
  }

  @media screen and (max-width: 45em) {
    .footer-content {
      padding: 0 var(--line-space);
    }
  }
</style>
