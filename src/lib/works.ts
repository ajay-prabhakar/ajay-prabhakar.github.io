export type Categories = "sveltekit" | "svelte";

export interface Project {
  title: string;
  slug: string;
  description: string;
  date: string;
  categories: Categories[];
  published: boolean;
  url: string;
  repo: string;
}
