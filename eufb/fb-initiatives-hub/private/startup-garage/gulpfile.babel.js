import gulp from 'gulp';
import sass from 'gulp-sass';
import babel from 'gulp-babel';
import rename from 'gulp-rename';
import cssmin from 'gulp-cssmin';
import uglify from 'gulp-uglify-es';
import sourcemaps from 'gulp-sourcemaps';
import source from 'vinyl-source-stream';
import buffer from 'vinyl-buffer';
import rollup from 'rollup-stream';
import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import json from 'rollup-plugin-json';
import {argv} from 'yargs';
import gulpif from 'gulp-if';
import imagemin from 'gulp-imagemin';
import imageminJpegoptim from 'imagemin-jpegoptim';
import rimraf from 'rimraf';

const CONFIG = {
    dest: '../../themes/facebook_initiatives_startupgarage/assets/',
    bundles: [{
        entry: './src/scripts/index.js',
        output: 'js/main.js'
    }],
    srcs: {
        scripts: './src/**/*.{js,json}',
        styles: './src/styles/**/*.scss',
        assets: ['./src/static/**/*']
    }
};

gulp.task('clean', () => {
    rimraf(CONFIG.dest + 'images/', ()=>{});
});

gulp.task('scripts', () => {
    return Promise.all(CONFIG.bundles.map((bundle) => {
        return rollup({
            input: bundle.entry,
            format: 'iife',
            sourcemap: true,
            output: CONFIG.dest,
            plugins: [
                commonjs(),
                json(),
                resolve({jsnext: true, main: true})
            ]
        })
            .on('error', e => console.error(`${e.stack}`))
            .pipe(source(bundle.entry, './src'))
            .pipe(buffer())
            .pipe(sourcemaps.init({loadMaps: true}))
            .pipe(babel({presets: ['env']}))
            .pipe(rename(bundle.output))
            .pipe(gulpif(argv.production, uglify()))
            .pipe(sourcemaps.write('.'))
            .pipe(gulp.dest(CONFIG.dest));
    }));
});

gulp.task('styles', () => {
    return gulp.src(CONFIG.srcs.styles)
        .pipe(sass().on('error', sass.logError))
        .pipe(gulpif(argv.production, cssmin()))
        .pipe(gulp.dest(CONFIG.dest + '/css/'));
});

gulp.task('assets', () => {
    return gulp.src(CONFIG.srcs.assets)
        .pipe(
            gulpif(argv.production,
                imagemin([
                    imagemin.gifsicle(),
                    imageminJpegoptim({max:80}),
                    imagemin.optipng(),
                    imagemin.svgo()
                ])
            )
        )
        .pipe(gulp.dest(CONFIG.dest));
});

gulp.task('watch', ['default'], () => {
    Object.keys(CONFIG.srcs).map((key) => {
        return gulp.watch(CONFIG.srcs[key], [key]);
    });
});

gulp.task('default', [
    'assets',
    'styles',
    'scripts'
]);
