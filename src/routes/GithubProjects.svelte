<script lang="ts">
	import { friendlyDate } from "$lib/dateTime"
	import { mdiGithub } from "@mdi/js"
	import type { Project } from "$lib/works"
  import Icon from "../components/Icon.svelte";

let projects: Project[];

// Dummy data objects
const dummyProject1: Project = {
  title: "Sample Project 1",
  slug: "sample-project-1",
  description: "This is the description for Sample Project 1.",
  date: "2023-07-28",
  categories: ["Web Development", "Open Source"],
  published: true,
  url: "https://www.example.com/sample-project-1",
  repo: "https://github.com/example/sample-project-1"
};

const dummyProject2: Project = {
  title: "Sample Project 2",
  slug: "sample-project-2",
  description: "This is the description for Sample Project 2.",
  date: "2023-07-28",
  categories: ["Mobile App", "Productivity"],
  published: false,
  url: "https://www.example.com/sample-project-2",
  repo: "https://github.com/example/sample-project-2"
};

// Assign the dummy data objects to the 'projects' array
projects = [dummyProject1, dummyProject2];
</script>

<section class="work">
	<h2>
		<a href="/work" sveltekit:prefetch>Work</a>
	</h2>
	{#each projects as project}
		<article class="project">
			<h3>
				<a href="/work/{project.slug}" sveltekit:prefetch>
					{project.title}
				</a>
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
				<time datetime={project.created}>
					{friendlyDate(project.created)}
				</time>
				·
				<span>{project.categories}</span>
			</div>
			<p>{project.description}</p>
			<p>
				<a class="text-link" href="/work/{project.slug}" sveltekit:prefetch>
					Read more
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
      background: var(--color-background-300);
      border-color: var(--color-background-300);
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
  }
</style>

