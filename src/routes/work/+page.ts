import type { Project } from "$lib/works.js";

export async function load({ fetch }) {
  const response = await fetch('api/projects');
  const posts: Project[] = await response.json();

  return { posts };
}
