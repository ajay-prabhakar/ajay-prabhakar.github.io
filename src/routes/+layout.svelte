<script lang="ts">
  import { getStores } from "$app/stores";
  import { updateFragmentLinkTarget } from "$lib/link";
  import { onMount } from "svelte";
  import Nav from "../components/Nav.svelte";
  import Analytics from "../components/Analytics.svelte";

  // import "../app.css";

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
        // Rewrite <a> elements with a # to respect <base href="/">
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


<div class="container" bind:this={element}>
  <Analytics/>

  <div class="navbar" bind:this={element}>
    <Nav />
  </div>

  <main>
    <slot />
  </main>

  <footer class="footer">
    <p>
      Created by <a href="#" style="color: var(--color-primary-400)">Ajay</a>
      with
      <a href="https://kit.svelte.dev/" style="color: var(--color-primary-400);"
        >Svelte ❤️</a
      >
    </p>
  </footer>
</div>

<style>
  .container {
    max-width: 60em;
    margin: 0 auto;
  }
  main {
    position: relative;
  }

  .footer {
    padding: 10px;
    text-align: center;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
  }

  .navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #000000;
  }
</style>
