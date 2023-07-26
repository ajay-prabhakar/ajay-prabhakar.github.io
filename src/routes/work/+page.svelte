<script lang="ts">
  import { friendlyDate } from "$lib/dateTime";

	export let data
</script>

<svelte:head>
  <title>Work</title>
</svelte:head>

<article class="article">
  <h1>Work</h1>
  <ul class="list">
    {#each data.posts as project}
      <li>
        <a href="/work/{project.slug}" class="text-link">
          {project.title}
        </a>
        <span class="quiet">- {friendlyDate(project.date, true)}</span>
      </li>
    {/each}
  </ul>
</article>

<style>
  .quiet {
    color: var(--color-text-300);
  }
</style>
