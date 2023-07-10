<!--autor:Miño Figueroa Bryan-->
<?php require_once HEADER;?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Editar citas</h1>
                <form action="index.php?c=citas&f=edit" onsubmit="return validar();" method="POST" name="formcitasEdit" id="formcitasEdit">
                    <input type="hidden" name="id" value="<?php echo $citas['id']?>">
                    <div class="form-group">
                        <label for="duenio">Nombre del dueño</label>
                        <input type="text" class="form-control" name="duenio" id="duenio" placeholder="Nombre del dueño" value="<?php echo $citas['duenio']?>" >
                    </div>
                    <div class="form-group">
                        <label for="nmascotas">Nombre de la mascota</label>
                        <input type="text" class="form-control" name="nmascotas" id="nmascotas" placeholder="Nombre de la mascota" value="<?php echo $citas['nmascotas']?>" >
                    </div>
                    <div class="form-group">
                        <label for="nmascotas">edad</label>
                        <input type="text" class="form-control" name="edad" id="edad" placeholder="Edad" value="<?php echo $citas['edad']?>" >
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Celular</label>
                        <textarea class="form-control" name="celular" id="celular" rows="3" placeholder="Numero de celular"  ><?php echo $citas['celular']?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="text" class="form-control" name="fecha" id="fecha" placeholder="fecha " value="<?php echo $citas['fecha']?>">
                    </div>
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
        var letra = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;
        //si el campo nombre está vacio mostrar un mensaje que diga que ingrese datos con un alert
        function validar(){

            var valido = true;

            if ( duenio.value === "") {
                valido = false;
                mensaje("Nombre del dueño",  duenio);
            } else if (!letra.test( duenio.value)) { 
                valido = false;
                mensaje("Nombre solo debe contener letras",  duenio);
            } else if ( duenio.value.length > 40) {
                valido = false;
                mensaje("Nombre maximo 40 caracteres",  duenio);
            }

            return valido;
        }

        function mensaje(cadenaMensaje, elemento) {
                window.alert(cadenaMensaje);
                elemento.focus();
        }
    </script>

    <?php require_once FOOTER?>