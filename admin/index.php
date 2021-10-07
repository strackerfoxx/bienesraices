<?php

//importar conexion
require '../includes/config/database.php';
    $db = conectarDB();

//escribir query
$query = "SELECT * FROM propiedades";


//consultar la DB
$resultadoConsulta = mysqli_query($db, $query);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id){
        //eliminar imagen

        $query ="SELECT imagen FROM propiedades WHERE id = ${id}";
        
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $propiedad['imagen']);

        // eliminar propiedad
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header('Location: /admin?resultado=3');
        }
    }

}

//incluye un template
 include '../includes/templates/header.php'?>
<?php
//Mensaje condicional
$resultado = $_GET['resultado'] ?? null;
if( $resultado == '1'){
    echo "<h3 class='alerta-verde'>Valor Creado Correctamente</h3>";
} else if( $resultado == '2'){
    echo "<h3 class='alerta-verde'>Valor Actualizado Correctamente</h3>";
} else if( $resultado == '3'){
    echo "<h3 class='alerta-verde'>Valor Eliminado Correctamente</h3>";
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
                    <form method="POST" class="w-100">

                    <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>" />

                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="propiedades/actualizar.php?id=<?php echo $propiedad['id'];?>
                    "class="boton-amarillo-block">Actualizar</a>
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