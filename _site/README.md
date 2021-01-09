# chromicle.github.io

My personal Website :flashlight: + blog :cherries:

This site was built using [Jekyll](https://jekyllrb.com/), a static site generator that allows you to create layouts for pages, menus, and the like using HTML, CSS, Javascript, and [Liquid](https://shopify.github.io/liquid/), then use those layouts to convert plain-text files into beautifully formatted web pages. The goal of this readme is to explain how to make some basic modifications to the site (for example, adding projects or team members). For a more comprehensive guide to using Jekyll, try the official documentation (linked above).

The site uses a modified version of the Hydejack Jekyll theme. Scroll down for the original theme documentation, which explains how to create new tags, change the background image and color on pages, etc.

# Modifying the site

To make and test changes to the site, you'll want to host and view it locally first, instead of directly modifying the live/online version. Using the command prompt, navigate to the directory where the site stored, then enter the following command:

```
bundle exec jekyll serve --baseurl ''
```

Then navigate to localhost:4000 in your browser to view the site. Note that the site is NOT being hosted online. For now, the files are being stored locally on your computer; you're just viewing them with your browser.

Once the site is being locally hosted, you should be able to save any changes you make to its code, wait for a few seconds for Jekyll to "regenerate" your site, then view your changes by refreshing the site in your browser. (If you change the config.yml file, you may need to stop serving the site and restart it.)
