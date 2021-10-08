<?php
    //Importar la conexion
    
    require 'includes/config/database.php';
    $db = conectarDB();

    //consultar
    $query = "SELECT * FROM propiedades LIMIT ${limite}";

    //obtener resultado
    $resultado = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while($propiedad =  mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">

            <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>

            <p><?php echo $propiedad['descripcion']; ?></p>

            <p class="precio">$<?php echo $propiedad['precio']; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="bathroom's">
                    <p><?php echo $propiedad['wc']; ?></p>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="bedroom's">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="parking's">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                See Property 
            </a>
        </div> <!--Contenido-anuncio-->
    </div><!--anuncio-->
    <?php endwhile; ?>
</div><!--Contenedor-anuncio-->

<?php

    //cerrar la conexion
        mysqli_close($db);
?>