<?php 
    use App\Propiedad;

    if($_SERVER['SCRIPT_NAME'] === '/BienesRaices/anuncios.php') {
        $propiedades = Propiedad::all();
    } else {
        $propiedades = Propiedad::get(3);
    }

    $limiteCaracteres = 100;
?>

<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
        <div class="anuncio">
            <div class="img-heigth">
                <img loading="lazy" src="/BienesRaices/imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio" class="img-altura">
            </div>
            
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo cortarTexto($propiedad->descripcion, $limiteCaracteres); ?></p> 
                <!-- /** substr($propiedad['descripcion'], 0, 50) . " ..."; forma de arreglo para el parrafo */ -->
                <p class="precio">$<?php echo number_format($propiedad->precio, 2, '.',','); ?> </p>
                <!-- number_format($propiedad['precio'], 2, '.',',') -->

                <ul class="iconos-caracteristicas">
                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad->wc; ?></p>
                    </li>

                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>

                    <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                            <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>

                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                        Ver Propiedad
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
