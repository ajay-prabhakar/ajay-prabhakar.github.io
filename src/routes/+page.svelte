<script context="module" lang="ts">
  import type { Load } from "@sveltejs/kit";

  export const load: Load = async function ({ fetch }) {
    const url = "/work.json";
    const res = await fetch(url);

    if (res.ok) {
      const data = await res.json();
      return {
        props: { projects: data.projects },
      };
    } else {
      return {
        status: 500,
        error: new Error(`Could not fetch ${url}`),
      };
    }
  };
</script>

<script lang="ts">
  // import Landing from "./_landing.svelte"
  // import Work from "./_work.svelte"
  // import type { Project } from "$lib/works"
  import { BASE_URL } from "$lib/url";
  import Meta from "../components/Meta.svelte";
  import GithubProjects from "./GithubProjects.svelte";
  import Landing from "./Landing.svelte";

  // export let projects: Project[]
</script>

<svelte:head>
  <title>Ajay Prabhakar</title>
</svelte:head>

<Meta
  title="Ajay Prabhakar"
  description="Ajay Prabhakar is a full-stack engineer in Nuclei."
  image={new URL("/embed.png", BASE_URL).href}
  isRoot={true}
/>

<div class="container">
  <Landing />
  <GithubProjects />
</div>

<style lang="postcss">
  .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-areas: "landing work";
    column-gap: calc(2 * var(--line-space));

    @media screen and (min-width: 45em) and (max-width: 60em) {
      grid-template-columns: 4fr 5fr;
    }

    @media screen and (max-width: 45em) {
      grid-template-columns: 1fr;
      grid-template-areas:
        "landing"
        "work";
    }
  }
</style>
