<?php

require '../../includes/app.php';

use App\Vendedor;

estadoAutenticado();

// Validar que sea un ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /BienesRaices/admin');
}

// Obtener el arreglo del vendedor de la BD
$vendedor = Vendedor::find($id);

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Ejecutar el codigo despues de enviar el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores
    $args = $_POST['vendedor'];
    // Sincronizar objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }

}

incluirTemplate('header');

?>

<main class="contenedor">
        <h1>Actualizar Vendedor/a</h1>

        <a href="/BienesRaices/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formularios_vendedores.php' ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>


<?php
incluirTemplate('footer');
?>

