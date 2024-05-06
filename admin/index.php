<?php

    //Muestra mensaje condicional
    $resultado = $_GET['Resultado'] ?? null;

    //Incluye un template
    require '../includes/funciones.php';
    
    incluirTemplate('header');
?>


    <main class="contenedor">
        <h1>Administrador de Bienes Raices</h1>
        <?php if( intval($resultado) === 1) : ?>
            <p class="alerta exito">Anuncio creado correctamente</p>
        <?php endif; ?>

        <a href="/BienesRaices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>


        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Casa en la playa</td>
                    <td><img src="../imagenes/2e84d6ec37514238e2d489f2a978b978.jpg" class="imagen-tabla"></td>
                    <td>$123456</td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

<?php
    incluirTemplate('footer');
?>