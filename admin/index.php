<?php

//importar conexion
require '../includes/config/database.php';
    $db = conectarDB();

//escribir query
$query = "SELECT * FROM propiedades";


//consultar la DB
$resultadoConsulta = mysqli_query($db, $query);


//incluye un template
 include '../includes/templates/header.php'?>
<?php
//Mensaje condicional
$resultado = $_GET['resultado'] ?? null;
if( $resultado == '1'){
    ?>
    <h3 class="alerta-verde">Valor insertado correctamente</h3>
    <?php
}

?>


<main class="contenedor seccion">
    <h1>administrador</h1>

    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

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

        <tbody> <!-- mostrar resultados -->
            <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad['precio']; ?></td>
                <td>
                    <a href="#"class="boton-rojo-block">Eliminar</a>
                    <a href="#"class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</main>

<?php 
//cerrar la connexion
mysqli_close($db);

include '../includes/templates/footer.php'?>ç