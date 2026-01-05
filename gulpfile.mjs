import { src, dest, watch, parallel, series } from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';
import sourcemaps from 'gulp-sourcemaps';
import concat from 'gulp-concat';
import terser from 'gulp-terser';
import sharp from 'sharp';
import path from 'path';
import fs from 'fs';

const sass = gulpSass(dartSass);

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*.{jpg,jpeg,png}'
};

export function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'));
}

export function javascript() {
    return src(paths.js)
        .pipe(sourcemaps.init())
        .pipe(concat('bundle.min.js'))
        .pipe(terser())
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/js'));
}

export async function procesarImagenes() {
    const outputDir = './public/build/img';
    if (!fs.existsSync(outputDir)) {
        fs.mkdirSync(outputDir, { recursive: true });
    }

    // Buscamos todas las imágenes en src/img
    const images = await fs.promises.readdir('./src/img');

    for (const image of images) {
        const ext = path.extname(image).toLowerCase();
        if (['.jpg', '.jpeg', '.png'].includes(ext)) {
            const inputPath = path.join('./src/img', image);
            const baseName = path.basename(image, ext);

            // 1. Generar JPG optimizado
            await sharp(inputPath)
                .jpeg({ quality: 80 })
                .toFile(path.join(outputDir, `${baseName}.jpg`));

            // 2. Generar WebP
            await sharp(inputPath)
                .webp({ quality: 80 })
                .toFile(path.join(outputDir, `${baseName}.webp`));
        }
    }
}

export function copySvg() {
    return src('src/img/**/*.svg').pipe(dest('public/build/img'));
}

export function dev() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch('src/img/**/*', parallel(procesarImagenes, copySvg));
}

export default series(
    parallel(css, javascript, copySvg),
    procesarImagenes,
    dev
);