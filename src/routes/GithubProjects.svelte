<script lang="ts">
  import { friendlyDate } from "$lib/dateTime";
  import { mdiGithub } from "@mdi/js";
  import type { Project } from "$lib/works";
  import Icon from "../components/Icon.svelte";

  let projects: Project[];

  // Dummy data objects
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

  const dummyProject2: Project = {
    title: "Sample Project 2",
    slug: "sample-project-2",
    description: "This is the description for Sample Project 2.",
    date: "2023-07-28",
    categories: ["Mobile App", "Productivity"],
    published: false,
    url: "https://www.example.com/sample-project-2",
    repo: "https://github.com/example/sample-project-2",
  };

  // Assign the dummy data objects to the 'projects' array
  projects = [dummyProject1];
</script>

<section class="work">
  <h2>
    <a href="/work" sveltekit:prefetch>Work</a>
  </h2>
  {#each projects as project}
    <article class="project">
      <h3>
        {project.title}

        {#if project.repo}
          <a
            class="repo-link"
            href={project.repo}
            title="GitHub repository"
            target="_blank"
            rel="noopener"
          >
            <Icon path={mdiGithub} />
          </a>
        {/if}
      </h3>
      <div class="article-info">
        {#each project.categories as item}
          <span>{item}, </span>
        {/each}
      </div>
      <p>{project.description}</p>
      <p>
        <a
          class="text-link"
          href={project.repo}
          title="GitHub repository"
          target="_blank"
          rel="noopener"
        >
          Github Link
        </a>
      </p>
    </article>
  {/each}
</section>

<style lang="postcss">
  .work {
    grid-area: work;
  }

  .project {
    border: 1px solid var(--color-text-100);
    padding: calc(var(--line-space) - 1px);
    margin-bottom: var(--line-space);
    border-radius: 1em;
    overflow: hidden; /* prevent margin collapse */

    @media (prefers-color-scheme: dark) {
      background: #222222;
      border-color: #333333;
    }
  }

  h3 {
    margin-bottom: 0;
  }

  .repo-link .svg-icon {
    top: 0.125em; /* visual balance */
  }

  .article-info {
    color: var(--color-text-300);
    margin-bottom: calc(var(--line-space) * 0.5);
  }

  p {
    margin-bottom: calc(var(--line-space) * 0.5);
  }

  .project > :last-child {
    margin-bottom: 0;
  }
</style>
