<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $entrada->titulo ?></h1>


    <picture>
        <source srcset="build/img/<?php echo $entrada->imagen; ?>.webp" type="image/webp">
        <source srcset="build/img/<?php echo $entrada->imagen; ?>.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/<?php echo $entrada->imagen; ?>.jpg" alt="Texto Entrada Blog">
    </picture>

    <p class="informacion-meta">Escrito el: <span><?php echo $entrada->fecha; ?></span> por:
        <span><?php echo $entrada->autor; ?></span>
    </p>


    <div class="resumen-propiedad">
        <p><?php echo $entrada->contenido; ?></p>
        <p><?php echo $entrada->loremAleatorio; ?></p>
    </div>
</main>