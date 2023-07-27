<script lang="ts">
  import { friendlyDate } from "$lib/dateTime";
  import Breadcrumbs from "../../../components/Breadcrumbs.svelte";
  import Links from "./Links.svelte";

  type DateStyle = Intl.DateTimeFormatOptions["dateStyle"];

  export function formatDate(
    date: string,
    dateStyle: DateStyle = "medium",
    locales = "en"
  ) {
    const formatter = new Intl.DateTimeFormat(locales, { dateStyle });
    return formatter.format(new Date(date));
  }

  export let data;
</script>

<!-- SEO -->
<svelte:head>
  <title>{data.meta.title}</title>
  <meta property="og:type" content="article" />
  <meta property="og:title" content={data.meta.title} />
</svelte:head>

<article>
  <!-- Title -->
  <Breadcrumbs />
  <h1>{data.meta.title}</h1>
  <div class="project-info">
    <time datetime={data.meta.date}>{friendlyDate(data.meta.date)}</time>
  </div>

  <Links repo={data.meta.repo} url={data.meta.url}></Links>

  <!-- Post -->
  <div class="prose">
    <svelte:component this={data.content}/>
  </div>
</article>

<style lang="postcss">
  article {
    max-inline-size: var(--size-content-3);
    margin-inline: auto;
  }

  .tags {
    display: flex;
    gap: var(--size-3);
    margin-top: var(--size-7);
  }

  .tags > * {
    padding: var(--size-2) var(--size-3);
    border-radius: var(--radius-round);
  }

  h1 {
    margin: calc(0.5 * var(--line-space)) 0;
  }

  .project-info {
    color: var(--color-text-300);
    line-height: 1;
    margin-bottom: var(--line-space);
  }
</style>
