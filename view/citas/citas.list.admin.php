<!--autor:Miño Figueroa Bryan-->

<?php require_once HEADER?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Listado de Citas</h1>
                <hr>
                <div>
                    <label for="b">Buscar por nombre del dueño:</label>
                    <input type="text" name="b" id="b" placeholder="Escriba su busqueda...">  <a href="index.php?c=citas&f=newcitas" class="btn btn-primary"> Agregar cita</a>
                </div>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del Dueño</th>
                            <th>Nombre de la mascota</th>
                            <th>Edad</th>
                            <th>celular</th>
                            <th>fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="JSON">
                        <?php foreach($rescitas as $citas){ ?>
                        <tr>
                            <td><?php echo $citas['id'] ?></td>
                            <td><?php echo $citas['duenio'] ?></td>
                            <td><?php echo $citas['nmascotas'] ?></td>
                            <td><?php echo $citas['edad'] ?></td>
                            <td><?php echo $citas['celular'] ?></td>
                            <td><?php echo $citas['fecha'] ?></td>
                            <td>
                                <a href="index.php?c=citas&f=editcitas&id=<?php echo $citas['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a onclick="if(!confirm('¿Esta seguro de eliminar: <?php echo $citas['duenio'] ?>?'))return false;" 
                                href="index.php?c=citas&f=deletecitas&id=<?php echo $citas['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var txtBuscar = document.querySelector("#b");
        txtBuscar.addEventListener('keyup', cargarcitas);

        function cargarcitas() {
            var bus = txtBuscar.value;
            var url = "index.php?c=citas&f=searchAjax&b=" + bus;
            console.log(url);
            var xmlh = new XMLHttpRequest();
            xmlh.open("GET", url, true);
            console.log(xmlh);
            xmlh.send();
            xmlh.onreadystatechange = function () {
                if (xmlh.readyState === 4 && xmlh.status === 200) {
                    var respuesta = xmlh.responseText;
                    console.log(respuesta);
                    actualizar(respuesta);
                }
            };
        }

        function actualizar(respuesta) {
            var tbody = document.querySelector('.JSON');
            var citas = JSON.parse(respuesta);
            console.log(citas);
            resultados = '';
            //mostrar todos los resultados del JSON tazas en la tabla
            for (var i = 0; i < citas.length; i++) {
                resultados += '<tr>';
                resultados += '<td>' + citas[i].id + '</td>';
                resultados += '<td>' + citas[i].duenio + '</td>';
                resultados += '<td>' + citas[i].nmascotas + '</td>';
                resultados += '<td>' + citas[i].edad + '</td>';
                resultados += '<td>' + citas[i].celular + '</td>';
                resultados += '<td>' + citas[i].fecha + '</td>';
                resultados += '<td>';
                resultados += '<a href="index.php?c=citas&f=editcitas&id=' + citas[i].id + '" class="btn btn-primary"><i class="fas fa-edit"></i></a> <a href="index.php?type=citas&function=deletecitas&id=' + citas[i].id + '" class="btn btn-danger" onclick="return confirm(\'¿Está seguro de eliminar la taza ' + citas[i].duenio + '?\')"><i class="fas fa-trash-alt"></i></a>';
                resultados += '</td>';
                resultados += '</tr>';
            }
            tbody.innerHTML = resultados;
        }
    </script>


<?php require_once FOOTER?>
