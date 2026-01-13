import { error } from "@sveltejs/kit";

export async function load({ params }) {
  try {
    const post = await import(`../../../projects/${params.slug}.md`);

    return {
      content: post.default,
      meta: post.metadata,
    };
  } catch (e) {
    throw error(404, `Could not find ${params.slug}`);
  }
}

export function entries() {
  return [
    { slug: "aasan" },
    { slug: "amrita-resource" },
    { slug: "biblingo" },
    { slug: "cms-android" },
    { slug: "code-forces" },
    { slug: "color-check" },
    { slug: "cometchar" },
    { slug: "lorax" },
    { slug: "save-the-earth" },
    { slug: "shopapp" },
    { slug: "temple-app" },
  ];
}

export const prerender = true;
