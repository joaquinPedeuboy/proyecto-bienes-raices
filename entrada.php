<?php

    require 'includes/funciones.php';
    
    incluirTemplate('header');
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoracion de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.avif" type="image/avif">
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2024</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium ab voluptatem mollitia porro cumque praesentium necessitatibus similique recusandae, nam illum reiciendis dicta quibusdam tenetur deleniti accusamus ullam obcaecati velit. Architecto? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Saepe ut sit temporibus quo eligendi quos excepturi et in. Neque fugiat quaerat nisi perferendis mollitia quisquam suscipit culpa sequi, necessitatibus voluptas. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam, necessitatibus possimus cupiditate temporibus deserunt, expedita velit adipisci doloremque quae omnis unde earum dignissimos. Nam ab sed minus explicabo illum tempore.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae neque excepturi facere impedit architecto eos necessitatibus aspernatur sunt alias tempore consequatur fugiat, fuga, numquam reiciendis nihil maiores quibusdam ullam non. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi quibusdam aliquam incidunt aliquid iste fuga nesciunt, temporibus dolore veritatis ipsa pariatur cumque voluptatem soluta. Quia atque accusamus pariatur deserunt architecto?</p>
        </div>
    </main>



<?php
    incluirTemplate('footer');
?>