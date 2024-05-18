<?php 
    //Importar base de datos
    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //Obtener resultados
    $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="anuncio">
            <div class="img-heigth">
                <img loading="lazy" src="/BienesRaices/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio" class="img-altura">
            </div>
            
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad['titulo']; ?></h3>
                <p><?php echo substr($propiedad['descripcion'], 0, 50) . " ..."; ?></p>
                <p class="precio">$<?php echo number_format($propiedad['precio'], 2, '.',','); ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                    </li>

                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                    </li>

                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>

                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                        Ver Propiedad
                </a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php
    //Cerrar la conexion
    mysqli_close($db);
?>