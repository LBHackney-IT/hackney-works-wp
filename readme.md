# Hackney Works WP theme

WordPress theme for Hackney Works.

It makes heavy use of custom post types and taxonomies, particularly:

- `courses`, which can belong to curriculum areas and providers.
- `intakes`, which belong to courses

## Developing locally

You need a Wordpress website up and running. Clone this repo into the `wp-content/themes` folder.

Then, activate it through the WP admin dashboard.

**It expects Advanced Custom Fields to be installed.**

You'll need to import a copy of the ACF config before you can use the theme as intended.

To make changes to JS and SCSS files you'll need to start up the [Parcel](https://parceljs.org) bundler and Gulp:

```
npm i
npm run dev
```

It will watch for changes.

You can use moden JavaScript syntax (including JSX) and any imports supported by Parcel.

### Editor blocks

The theme includes several custom blocks for the WP editor.

They're defined in `/src/js/blocks` and compiled into a second JS bundle that's included on the admin screens only.

## Using it in production

Make sure that you run `npm run build` to create production JS and SCSS before deploying it to a live site.

## Configuration

It's intended to be used with [ACF's Google Map field](https://www.advancedcustomfields.com/resources/google-map/). It needs a Google API key to be set. You can do it with a line like this in `wp-config.php`:

```
define("GOOGLE_API_KEY", "your_api_key_here");
```

It also calls an API for opportunity data:

```
define("API_HOST", "");
```

### Submitting applications

It looks for a JS environment variable `SUBMIT_APPLICATION_ENDPOINT` which is the API host applications will be posted to.

You can [provide this with a .env file](https://parceljs.org/env.html) if you like.

If you don't provide a value, it defaults to the Hackney Works staging site URL.