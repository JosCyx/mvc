<?php require_once HEADER?>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['name']; ?>.</h1>
        <h3>Esta es la pantalla de control de la veterinaria.</h3>
        <h3>Acciones disponibles:</h3>
        <ul>
            <li><a href="index.php?c=Citas">Administrar citas.</a></li>
            <li><a href="index.php?c=Productos">Administrar productos.</a></li>
            <li><a href="index.php?c=Servicios">Administrar servicios.</a></li>
            <li><a href="index.php?c=Clientes">Administrar usuarios.</a></li>
        </ul>
        
    </div>
<?php require_once FOOTER?>