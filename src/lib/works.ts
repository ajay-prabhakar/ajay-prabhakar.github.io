export type Categories =
  | "sveltekit"
  | "svelte"
  | "Web Development"
  | "Open Source"
  | "Mobile App"
  | "Productivity";

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
