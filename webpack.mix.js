let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

mix.js('src/Boot.js', 'public/js/fizzypopups-boot.js')
   .js('src/main.js', 'public/js/fizzypopups-admin.js').vue()
   .js('src/popup_manager.js', 'public/js/popup_manager.js')
   .sass('src/scss/common/popup.scss', 'public/css/popup.css')
   .sass('src/scss/admin/app.scss', 'public/css/fizzypopups-admin.css')
   .copy('src/images', 'public/images');
