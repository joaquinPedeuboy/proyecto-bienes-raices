<?php

    use APP\Propiedad;

    require '../../includes/app.php';
    
    estadoAutenticado();

    // Validar id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header('Location: /BienesRaices/admin');
    }

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = [];

    //Ejecutar el codigo despues de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";


        $titulo = mysqli_real_escape_string($db, $_POST['titulo'] );
        $precio = mysqli_real_escape_string($db, $_POST['precio'] );
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion'] );
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones'] );
        $wc = mysqli_real_escape_string($db, $_POST['wc'] );
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento'] );
        $vendedores_id = mysqli_real_escape_string($db, $_POST['vendedor'] );
        $creado = date('Y/m/d');

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];


        //Validaciones
        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio) {
            $errores[] = "El precio es obligatorio";
        }

        if(strlen( $descripcion) < 50) {
            $errores[] = "La descripcion es obligatoria";
        }

        if(!$habitaciones) {
            $errores[] = "El numero de habitaciones es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El numero de baños es obligatorio";
        }

        if(!$estacionamiento) {
            $errores[] = "El numero de estacionamiento es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El numero de baños es obligatorio";
        }

        if(!$vendedores_id) {
            $errores[] = "Elije un vendedor";
        }


        // Validar por tamaño (1 mb maximo)
        $medida = 1000*1000;

        if($imagen['size'] > $medida) {
            $errores[]= "La imagen es muy pesada";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        //revisar que el arreglo de errores este vacio
        if(empty($errores)) {


            /** SUBIDA DE ARCHIVOS */
            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            
            }

            $nombreImagen = '';

            if($imagen['name']) {
                //Eliminar la imagen previa 
                unlink($carpetaImagenes . $propiedadd['imagen']);

                //Generar un nombre unico
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

                //Subir la imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

            }else {
                $nombreImagen = $propiedad['imagen'];
            }

            

            //Insertar en la base de datos
            $query = " UPDATE propiedades SET 
                titulo = '${titulo}', 
                precio = '${precio}',
                imagen = '${nombreImagen}',
                descripcion = '${descripcion}', 
                habitaciones = ${habitaciones}, 
                wc = ${wc}, 
                estacionamiento = ${estacionamiento},
                vendedores_id = ${vendedores_id}
                WHERE id = ${id} ";

            $resultado = mysqli_query($db, $query);

            if($resultado) {
                // Redireccion al usuario
                header('Location: /BienesRaices/admin?Resultado=2');
            }
        }

    }

    
    incluirTemplate('header');
?>


    <main class="contenedor">
        <h1>Actualizar Propiedad</h1>

        <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formularios_propiedades.php' ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>