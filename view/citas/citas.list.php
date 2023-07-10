<!--autor:Miño Figueroa Bryan-->
<?php require_once HEADER?>
<div class="container">
<div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Listado de Citas</h1>
                <hr>
                <div>
                    <label for="b">Buscar por nombre del dueño:</label>
                    <input type="text" name="b" id="b" placeholder="Escriba su busqueda...">  <a href="index.php?c=citas&f=newcitas" class="btn btn-primary"> Agregar cita    . </a>
                </div>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del Dueño</th>
                            <th>fecha</th>
                        </tr>
                    </thead>
                    <tbody class="JSON">
                        <?php foreach($rescitas as $citas){ ?>
                        <tr>
                            <td><?php echo $citas['id'] ?></td>
                            <td><?php echo $citas['duenio'] ?></td>
                            <td><?php echo $citas['fecha'] ?></td>
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
                resultados += '<td>' + citas[i].fecha + '</td>';

                resultados += '</tr>';
            }
            tbody.innerHTML = resultados;
        }
    </script>

<?php require_once FOOTER ?>