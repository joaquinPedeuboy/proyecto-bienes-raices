<?php

require '../../includes/app.php';

use App\Vendedor;

estadoAutenticado();

$vendedor = new Vendedor;

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de enviar el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    // Validar que no haya campos vacios
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor">
        <h1>Registar Vendedor/a</h1>

        <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/BienesRaices/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formularios_vendedores.php' ?>

            <input type="submit" value="Registar Vendedor" class="boton boton-verde">
        </form>
    </main>


<?php
incluirTemplate('footer');
?>

