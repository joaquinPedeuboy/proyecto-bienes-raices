<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
//error_reporting(E_ALL); // reporta los errores

    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image; // Forma antigua de intervention Image 2.7
    // use Intervention\Imag as Image;


    estadoAutenticado();

    $db = conectarDB();

    $propiedad = new Propiedad;

    // Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    //Ejecutar el codigo despues de enviar el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Crea una nueva instancia
        $propiedad = new Propiedad($_POST['propiedad']);

        /** SUBIDA DE ARCHIVOS */

        //Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        // Setear la imagen
        // Realiza un resize a la imagen con intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad-> setImagen($nombreImagen);
        }


        // Validar
        $errores = $propiedad->validar();

        //revisar que el arreglo de errores este vacio
        if(empty($errores)) {

            // Crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }

            // Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guarda en la base de datos
            $resultado = $propiedad->guardar();

            // Mensaje de exito
            if($resultado) {
                // Redireccion al usuario
                header('Location: /BienesRaices/admin?Resultado=1');
            }
        }

    }
    
    incluirTemplate('header');
?>


    <main class="contenedor">
        <h1>Crear Propiedad</h1>

        <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/BienesRaices/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formularios_propiedades.php' ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>

<!-- 
                        VERSION NUEVA DE INTERVENTION IMAGE
                        
    use Intervention\Image\ImageManager as Image;
        use Intervention\Image\Drivers\Gd\Driver;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Crea una nueva instancia
        $propiedad = new Propiedad($_POST);
    
        // Generar un nombre unico
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
    
        // Setear la imagen
    
        / Realiza un resize a la imagen con intervention version 3.4
    
    
    if($_FILES['imagen']['tmp_name']){
        $manager = new Image(Driver::class);
        $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);  
        $propiedad->setImagen($nombreImagen);
    
    }
    
    //Validar
        $errores = $propiedad->validar();
    
    
    if( empty($errores))
    {
    // Crear Carpeta para subir imagenes
    
        if(!is_dir(CARPETAS_IMAGENES)){
            mkdir(CARPETAS_IMAGENES);
        }
        
        // Guarda la imagen en el servidor
        $image->save(CARPETAS_IMAGENES . $nombreImagen);
    
        // Guarda en la base de datod
    
    $resultado = $propiedad->guardar();
    
    //Mensaje de Exito
    if($resultado){
    // echo "Se inserto data";
    
    // Redirecionar al usuario
    
    header('Location: /admin?resultado=1');
    
    }
    
    }
    
    
    } -->

