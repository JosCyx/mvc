<!--autor:Miño Figueroa Bryan-->
<?php require_once HEADER?>
<body>
    <!-- Formulario de insertar nuevos datos con la función insert de citassDao -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Añada una cita  </h1>
                <form action="index.php?c=citas&f=create" onsubmit="return validar();" method="POST" name="formcitasNew" id="formcitasNew">
                    <div class="form-group">
                        <div>
                            <label for="duenio">Nombre del dueño</label>
                            <input type="text" class="form-control" name="duenio" id="duenio" placeholder="Nombre del paciente" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div>
                            <label for="nmascotas">Nombre de la mascota</label>
                            <input type="text" class="form-control" name="nmascotas" id="nmascotas" placeholder="Nombre del la mascota" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div>
                            <label for="edad">Edad</label>
                            <input type="text" class="form-control" name="edad" id="edad" placeholder="edad" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div>
                            <label for="celular">celular</label>
                            <input type="text" class="form-control" name="celular" id="celular" placeholder="celular" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div>
                            <label for="fecha">Fecha</label>
                            <input type="text" class="form-control" name="fecha" id="fecha" placeholder="fecha" >
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group mx-auto">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="index.php?c=citas&f=index" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var duenio = document.getElementById('duenio');
        var nmascotas = document.getElementById('nmascotas');
        var letra = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;
        var celularreg = /^[0-9]{10}$/g; // para validar datos que deban tener 10 numeros
        //si el campo nombre está vacio mostrar un mensaje que diga que ingrese datos con un alert
        function validar(){

            var valido = true;

            if ( duenio.value === "") {
                valido = false;
                mensaje("Nombre es requerido",  duenio);
            } else if (!letra.test( duenio.value)) { 
                valido = false;
                mensaje("Nombre solo debe contener letras",  duenio);
            } else if ( duenio.value.length > 100) {
                valido = false;
                mensaje("Nombre maximo 100 caracteres",  duenio);
            }

            if ( nmascotas.value === "") {
                valido = false;
                mensaje("Nombre es requerido",  nmascotas);
            } else if (!letra.test( nmascotas.value)) { 
                valido = false;
                mensaje("Nombre solo debe contener letras",  nmascotas);
            } else if ( duenio.value.length > 40) {
                valido = false;
                mensaje("Nombre maximo 40 caracteres",  nmascotas);
            }


            return valido;
        }
        function mensaje(cadenaMensaje, elemento) {
                window.alert(cadenaMensaje);
                elemento.focus();
        }
    </script>

<?php require_once FOOTER?>
