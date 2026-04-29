import { defineConfig } from 'vite'
import path from 'path'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  base: '/wp-content/themes/wp-starter-theme/dist', // change to path to your theme
  build: {
    outDir: path.resolve(__dirname, 'themes/wp-starter-theme/dist'), // change to path to your theme
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'src/entry.js'),
      },
      output: {
        entryFileNames: '[name].js',
        assetFileNames: '[name][extname]',
      },
    },
  },
  plugins: [tailwindcss()],
  server: false,
})
