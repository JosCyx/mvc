<!--autor: jose luis sellan-->
<?php require_once HEADER;  ?>

<div class="container">
<h2> <?php echo "Buscar servicios"?></h2>
    <div class="row">
        <div class="col-sm-6">
            <form action="index.php?c=servicios&f=search" method="POST">
                <input type="text" name="b" id="busqueda"  placeholder="buscar..."/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>Buscar</button>
            </form>       
        </div>
        <div class="col-sm-6 d-flex flex-column align-items-end">
            <a href="index.php?c=servicios&f=view_new"> 
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-plus"></i> 
                   Nuevo</button>

            </a>
        </div>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
             <th>Nombre </th>
            <th>Descripcion </th>
            <th>Precio </th>
            <th>Acciones </th>
            </thead>
            <tbody class="tabladatos">
                <?php         
                foreach ($resultados as $fila) {
                  ?>
                <tr>
                    <td><?php echo $fila['nombre'];?></td>
                    <td><?php echo $fila['descripcion'];?></td>
                    <td><?php echo $fila['precio'];?></td>
                    <td>
                        <a class="btn btn-primary" 
                    href="index.php?c=servicios&f=view_edit&id=<?php echo  $fila['id']; ?>">
                    <i class="fas fa-marker"></i></a>
                    <a class="btn btn-danger" 
                   onclick="if(!confirm('Esta seguro de eliminar el servicio?'))return false;" 
                    href="index.php?c=servicios&f=delete&id=<?php echo  $fila['id']; ?>">
                    <i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php  }?>
            </tbody>
        </table>
    </div>

</div>
<?php  require_once FOOTER ?>