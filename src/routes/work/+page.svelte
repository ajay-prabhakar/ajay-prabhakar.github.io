<script lang="ts">
  import { friendlyDate } from "$lib/dateTime";
  import { onMount } from "svelte";
  import { fly } from "svelte/transition";
  import { mdiOpenInNew } from "@mdi/js";
  import Icon from "../../components/Icon.svelte";

  export let data;

  let visible = false;
  onMount(() => {
    visible = true;
  });
</script>

<svelte:head>
  <title>Work | Ajay Prabhakar</title>
</svelte:head>

{#if visible}
<article class="work-page">
  <header in:fly={{ y: 30, duration: 600, delay: 100 }}>
    <h1>My Work</h1>
    <p class="subtitle">A collection of projects I've worked on over the years.</p>
  </header>

  <div class="projects-list">
    {#each data.posts as project, i}
      <a 
        href="/work/{project.slug}" 
        class="project-item"
        in:fly={{ y: 20, duration: 400, delay: 200 + (i * 50) }}
      >
        <div class="project-info">
          <h3>{project.title}</h3>
          <span class="date">{friendlyDate(project.date, true)}</span>
        </div>
        <Icon path={mdiOpenInNew} size="1em" />
      </a>
    {/each}
  </div>
</article>
{/if}

<style>
  .work-page {
    max-width: 700px;
    padding-bottom: 4rem;
  }

  header {
    margin-bottom: 2.5rem;
  }

  h1 {
    margin-bottom: 0.5rem;
  }

  .subtitle {
    color: var(--color-text-300);
    font-size: 1.1rem;
    margin-bottom: 0;
  }

  .projects-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .project-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.25rem 1.5rem;
    background: var(--color-background-200);
    border: 1px solid var(--border-subtle);
    border-radius: 0.75rem;
    text-decoration: none;
    color: var(--color-text-400);
    transition: all 0.2s var(--standard-curve);
  }

  .project-item:hover {
    border-color: var(--color-primary-400);
    transform: translateX(4px);
    background: var(--color-background-100);
  }

  .project-item:hover h3 {
    color: var(--color-primary-400);
  }

  .project-info {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
  }

  h3 {
    font-size: 1.1rem;
    font-weight: 500;
    margin-bottom: 0;
    transition: color 0.2s ease;
  }

  .date {
    color: var(--color-text-300);
    font-size: 0.85rem;
  }

  .project-item :global(.svg-icon) {
    color: var(--color-text-200);
    transition: color 0.2s ease;
  }

  .project-item:hover :global(.svg-icon) {
    color: var(--color-primary-400);
  }
</style>
