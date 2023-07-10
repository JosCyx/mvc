<!--autor: Moreno Bravo Jose-->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo "Productos"?></h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=productos&f=search" method="POST">
                <input type="text" name="b" id="busqueda"  placeholder="Nombre o codigo"/>
                
            </form>       
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <th>Codigo</th>
            <th>Nombre </th>
            <th>Descripcion </th>
            <th>Valor </th>
            <th>Comprar</th>
            </thead>
            <tbody class="JSON">
                <?php         
                foreach ($resultados as $fila) {
                  ?>
                <tr>
                    <td><?php echo $fila['codigo'];?></td>
                    <td><?php echo $fila['nombre'];?></td>
                    <td><?php echo $fila['descripcion'];?></td>
                    <td><?php echo $fila['valor'];?></td>
                    <td><a class="btn btn-primary"> + Comprar</a></td>
                </tr>
                <?php  }?>
            </tbody>
        </table>
    </div>

</div>
<script>
        var buscar = document.getElementById("busqueda");
        buscar.addEventListener('keyup', buscarProducto);

        function buscarProducto() {
            var busq = buscar.value;
            var url = "index.php?c=Productos&f=searchAjax&b=" + busq;
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
            var producto = JSON.parse(respuesta);
            console.log(producto);
            resultados = '';
            
            for (var i = 0; i < producto.length; i++) {
                resultados += '<tr>';
                resultados += '<td>' + producto[i].codigo + '</td>';
                resultados += '<td>' + producto[i].nombre + '</td>';
                resultados += '<td>' + producto[i].descripcion + '</td>';
                resultados += '<td>' + producto[i].valor + '</td>';
                resultados += '<td><a class="btn btn-primary"> + Comprar</a></td>'
                resultados += '</tr>';
            }
            tbody.innerHTML = resultados;
        }
    </script>

<?php  require_once FOOTER ?>