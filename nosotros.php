<?php

    require 'includes/app.php';
    
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.avif" type="image/avif">
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor sequi veniam eos, accusantium reprehenderit quis autem eligendi veritatis sapiente odit. Quos similique aut labore neque non exercitationem nostrum velit nemo. Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quis voluptate aliquam velit illo architecto eum maiores tempora rem, libero, praesentium quod perspiciatis, tenetur mollitia possimus in odio ab. Est?</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis fugit nemo id illo eius dignissimos voluptatibus debitis corporis unde quod laudantium commodi, et harum assumenda reiciendis veniam saepe adipisci distinctio. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorem repudiandae possimus quia consectetur necessitatibus quo perspiciatis ea obcaecati aspernatur accusantium? Mollitia quia id, corporis similique maiores illo corrupti dicta qui!</p>
            </div>
        </div>
    </main>

    <section class="contenedor">
        <h1>Mas Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit modi necessitatibus voluptatem labore, maiores temporibus odio cumque. Quam laudantium repellendus inventore cupiditate sequi corrupti odio temporibus optio, officiis voluptates fugit!</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit modi necessitatibus voluptatem labore, maiores temporibus odio cumque. Quam laudantium repellendus inventore cupiditate sequi corrupti odio temporibus optio, officiis voluptates fugit!</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit modi necessitatibus voluptatem labore, maiores temporibus odio cumque. Quam laudantium repellendus inventore cupiditate sequi corrupti odio temporibus optio, officiis voluptates fugit!</p>
            </div>
        </div>
    </section>


<?php
    incluirTemplate('footer');
?>