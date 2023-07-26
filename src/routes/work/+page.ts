import type { RequestHandler } from "@sveltejs/kit";
import pMap from "p-map";
import path from "path-browserify";
import type { LoadEvent } from '@sveltejs/kit';

export async function load({ params, url }: LoadEvent) {
  const modules = Object.entries(import.meta.glob("./*.svelte.md"));

  const projects = await pMap(modules, async ([filename, module]) => {

    const { metadata } = await module();
    return {
      ...metadata,
      slug: path.basename(filename, ".svelte.md"),
    };
  });

  projects.sort((a, b) => (new Date(a.created) > new Date(b.created) ? -1 : 1));
  console.log(projects, "ass");

  return {
    status: 200,
    body: { projects },
  };
}
