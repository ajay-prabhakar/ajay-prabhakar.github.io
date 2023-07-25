<script lang="ts">
  import { getStores } from "$app/stores";
  import { updateFragmentLinkTarget } from "$lib/link";
  import { onMount } from "svelte";
  import Nav from "../components/Nav.svelte";
  
  // import "../app.css";

  import "../styles/reset.postcss";
  import "../styles/global.postcss";
  import "../styles/theme.postcss";
  import "../styles/code.postcss";

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

<div class="container" bind:this={element}>
  <Nav />
  <main>
    <slot />
  </main>
</div>

<style>
  .container {
    max-width: 60em;
    margin: 0 auto;
  }
  main {
    position: relative;
  }
</style>
