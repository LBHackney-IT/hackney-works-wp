const { task, src, dest, watch, parallel } = require("gulp")
const sass = require("gulp-sass")

sass.compiler = require("node-sass")

task("build", () => {
    return src("./src/scss/*.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(dest("./dist/css"))
});

task("default", () => {
    watch(["./src/scss/**/*.scss"], parallel("build"))
})