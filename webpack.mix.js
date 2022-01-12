const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .css("resources/css/reset.css", "public/css")
    .css("resources/css/style.css", "public/css")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .browserSync({
        files: [
            "resources/views/*.blade.php",
            "resources/js/**/*.vue",
            "public/**/*.*",
        ],
        proxy: {
            target: "http://localhost:8000/",
        },
    });
