<?php
//controlador y funcion predefinida
define("CONTROLADOR_PRINCIPAL","index");

define("FUNCION_PRINCIPAL", "index");
define("AUTH_CONTROLLER","Auth");
define("HOME_CONTROLLER","Home");
define("ID_USER","id_user");
define("ID_ROLE","role");
define("NAME_USER","name");

//ruta de templates
define("HEADER", 'view/templates/header.php');
define("FOOTER", 'view/templates/footer.php');

// ruta de vistas modulo clientes
define("VHOME","view/home/home");
define("VAUTH","view/auth/auth.");
define("VCLIENTES", "view/clientes/clientes.");
define("VPRODUCTO","view/productos/productos.");
define("VSERVICIOS", "view/servicios/servicios.");
define("VCITAS", "view/citas/citas.");
define("VINFO", "view/info/info.");


// conexion bb
define("DBNAME","mvc");
define("DBUSER","root");
define("DBPASSWORD","");

?>