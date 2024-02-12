import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue" ;
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
   build: {
        outDir: 'public/builds',
       manifest: true,
	   rollupOptions: {
      // Exclure certains dossiers de la transpilation
     // exclude: ['node_modules/**'],
		  // input: '/var/www/html/CFPT_SJ/node_modules',
    },
	 
    }
});
