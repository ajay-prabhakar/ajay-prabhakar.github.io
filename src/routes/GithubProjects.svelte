<script lang="ts">
  import { friendlyDate } from "$lib/dateTime";
  import { mdiGithub, mdiOpenInNew, mdiStar } from "@mdi/js";
  import type { Project } from "$lib/works";
  import Icon from "../components/Icon.svelte";
  import { onMount } from "svelte";
  import { fly, fade } from "svelte/transition";

  let projects: Project[];
  let visible = false;

  onMount(() => {
    visible = true;
  });

  const dummyProject1: Project = {
    title: "awesome flutter UI",
    slug: "sample-project-1",
    description:
      "10+ flutter(android, ios) UI design examples ⚡ - login, books, profile, food order, movie streaming, walkthrough, widgets.",
    date: "2023-07-28",
    categories: ["Flutter", "UI/UX", "Dart", "Open Source"],
    published: true,
    url: "https://github.com/ajay-prabhakar/awesome-flutter-ui",
    repo: "https://github.com/ajay-prabhakar/awesome-flutter-ui",
  };

  projects = [dummyProject1];
</script>

<section class="work">
  {#if visible}
    <div class="section-header" in:fly={{ y: 20, duration: 500, delay: 200 }}>
      <h2>
        <a href="/work" sveltekit:prefetch>Featured Work</a>
      </h2>
      <a href="/work" class="view-all" sveltekit:prefetch>
        View all
        <Icon path={mdiOpenInNew} size="0.9em" />
      </a>
    </div>
    
    {#each projects as project, i}
      <article 
        class="project" 
        in:fly={{ y: 30, duration: 500, delay: 300 + (i * 100) }}
      >
        <div class="project-header">
          <div class="project-icon">
            <Icon path={mdiGithub} size="1.5em" />
          </div>
          <div class="project-meta">
            <h3>{project.title}</h3>
            <div class="tags">
              {#each project.categories.slice(0, 3) as tag}
                <span class="tag">{tag}</span>
              {/each}
            </div>
          </div>
        </div>
        
        <p class="project-description">{project.description}</p>
        
        <a
          class="project-link"
          href={project.repo}
          title="View on GitHub"
          target="_blank"
          rel="noopener"
        >
          <span>View Repository</span>
          <Icon path={mdiOpenInNew} size="0.9em" />
        </a>
      </article>
    {/each}
  {/if}
</section>

<style lang="postcss">
  .work {
    grid-area: work;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }

  .section-header h2 {
    margin-bottom: 0;
    font-size: 1.5rem;
  }

  .section-header h2 a {
    text-decoration: none;
    color: var(--color-text-400);
    transition: color 0.2s ease;
  }

  .section-header h2 a:hover {
    color: var(--color-primary-400);
  }

  .view-all {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: var(--color-text-300);
    font-size: 0.85rem;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .view-all:hover {
    color: var(--color-primary-400);
  }

  .project {
    background: var(--color-background-200);
    border: 1px solid var(--border-subtle);
    padding: 1.5rem;
    border-radius: 1rem;
    margin-bottom: 1rem;
    transition: all 0.3s var(--standard-curve);
    position: relative;
    overflow: hidden;
  }

  .project::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--color-primary-400), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .project:hover {
    border-color: var(--color-primary-400);
    transform: translateY(-4px);
    box-shadow: var(--glow-accent);
  }

  .project:hover::before {
    opacity: 1;
  }

  .project-header {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
  }

  .project-icon {
    width: 48px;
    height: 48px;
    background: var(--color-background-100);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-400);
    flex-shrink: 0;
  }

  .project-meta {
    flex: 1;
    min-width: 0;
  }

  .project-meta h3 {
    margin-bottom: 0.4rem;
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--color-text-400);
  }

  .tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
  }

  .tag {
    font-size: 0.7rem;
    padding: 0.2rem 0.6rem;
    background: var(--color-background-100);
    border-radius: 1rem;
    color: var(--color-text-300);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }

  .project-description {
    color: var(--color-text-300);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1rem;
  }

  .project-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-primary-400);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: gap 0.2s ease;
  }

  .project-link:hover {
    gap: 0.7rem;
    text-decoration: underline;
  }

  @media screen and (max-width: 45em) {
    .section-header {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;
    }
  }
</style>
