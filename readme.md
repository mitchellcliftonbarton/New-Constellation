# Cold Rice LLC | WordPress Starter Theme

## Setup

- Clone the repository
- Change `/themes/wp-starter-theme` to your theme name
- Change info in `style.css` to your own
- Change 'name' in `package.json` to your own
- Change info in `vite.config.js` (base, outDir)

## Development

```
# Install dependencies
npm install

# Watch assets
npm run dev

# Build assets
npm run build
```

Vite outputs bundles to `themes/wp-starter-theme/dist`

### Symlink

Then, to actually install the theme, you can symlink the theme into the local development site:

```
ln -s /path/to/repository/themes/wp-starter-theme /path/to/local-wp/wp-content/themes/
```
