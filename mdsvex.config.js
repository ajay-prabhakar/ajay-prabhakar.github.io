import * as path from "path";
import { fileURLToPath } from "url";
import urls from "rehype-urls";
import slug from "rehype-slug";
import autoLinkHeadings from "rehype-autolink-headings";
import addClasses from "rehype-add-classes";
import { visit } from "unist-util-visit";
import { h } from "hastscript";
import rehypeSlug from "rehype-slug";
import remarkUnwrapImages from "remark-unwrap-images";
import remarkToc from "remark-toc";
import emoji from "remark-emoji";
import remarkGfm from "remark-gfm";
import remarkAbbr from "remark-abbr";
import rehypePrism from "rehype-prism-plus";
import rehypeCodeTitles from "rehype-code-titles";

const dirname = path.resolve(fileURLToPath(import.meta.url), "../");

/**
 * Modified from https://github.com/josestg/rehype-figure
 */
function figure() {
  function buildFigure({ properties }) {
    const figure = h("figure", null, [
      h("img", { ...properties }),
      properties.title ? h("figcaption", properties.title) : "",
    ]);
    return figure;
  }

  return function (tree) {
    visit(tree, { tagName: "p" }, (node, index) => {
      const images = node.children
        .filter((n) => n.tagName === "img")
        .map((img) => buildFigure(img));

      if (images.length === 0) return;

      tree.children[index] =
        images.length === 1
          ? images[0]
          : (tree.children[index] = h("div", null, images));
    });
  };
}

function processUrl(url, node) {
  if (node.tagName === "a") {
    node.properties.class = "text-link";

    if (!url.href.startsWith("/")) {
      // is external link
      node.properties.target = "_blank";
      node.properties.rel = "noopener";
    }
  }
}

export default {
  extensions: [".svelte.md", ".md"],
  layout: {
    work: path.join(dirname, "./src/routes/work/+page.svelte"),
  },
  smartypants: true,
  remarkPlugins: [emoji, remarkGfm, remarkAbbr, remarkUnwrapImages, remarkToc], // adds support for footnote-like abbreviations
  rehypePlugins: [
    figure, // convert images into <figure> elements
    [urls, processUrl], // adds rel and target to <a> elements
    slug, // adds slug to <h1>-<h6> elements
    autoLinkHeadings, // adds a <a> around slugged <h1>-<h6> elements
    rehypeSlug,
    addClasses,
    rehypePrism,
    rehypeCodeTitles,
  ],
};
