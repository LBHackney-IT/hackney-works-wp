# Hackney Works WP theme

WordPress theme for Hackney Works.

## Developing locally

You need a Wordpress website up and running. Clone this repo into the wp-content/themes folder.

Then, activate it through the WP admin dashboard.

To make changes to JS and SCSS files you'll need to start up the [Parcel](https://parceljs.org) bundler and Gulp:

```
npm i
npm run dev
```

It will watch for changes.

You can use moden JavaScript syntax and any imports supported by Parcel.

## Using it in production

Make sure that you run `npm run build` to create production JS and SCSS before deploying it to a live site.