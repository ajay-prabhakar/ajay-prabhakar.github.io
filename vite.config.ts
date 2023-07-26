import { sveltekit } from '@sveltejs/kit/vite';
import { defineConfig } from 'vite';

export default defineConfig({
	plugins: [sveltekit()],
	  assetsInclude: ['**/*.md'],

	  resolve: {
    alias: {
      path: "path-browserify",
    },
  },
});
