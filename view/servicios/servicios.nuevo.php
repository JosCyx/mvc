<!--autor: jose luis sellan-->
<?php require_once HEADER;
 ?>
<div class="container">
    <h2><?php echo $titulo?></h2>
    <div class="card card-body">
        <form action="index.php?c=servicios&f=new" method="POST" name="formServNuevo" id="formServNuevo">
            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre" required>
                </div>
            <div class="form-group col-sm-6">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripción" required>
            </div>

            <div class="form-group col-sm-6">
                <label for="precio">Precio</label>
                <input type="text" name="precio" id="precio" class="form-control" placeholder="precio" required>
            </div> 

            <div class="form-group mx-auto">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php?c=servicios&f=index" class="btn btn-primary">Cancelar</a>
            </div>
        </div>  
    </form>
</div>
</div>

<?php require_once FOOTER; ?>