<!--autor: Moreno Bravo Jose-->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo $titulo?></h2>
    <div class="card card-body">
    
        <form action="index.php?c=productos&f=edit" method="POST" name="formProdNuevo" id="formProdNuevo">
        
        <input type="hidden" name="id" id="id" value="<?php echo $prod['id']; ?>"/>
            <div class="form-row">
               <div class="form-group col-sm-6">
                    <label for="codigo">Codigo</label>
                    <input type="text" name="codigo" id="codigo" value="<?php echo $prod['codigo']; ?>" class="form-control" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $prod['nombre']; ?>" class="form-control" required>
                </div> 

                <div class="form-group col-sm-6">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php echo $prod['descripcion']; ?>" class="form-control" required>
                </div>          

                <div class="form-group col-sm-6">
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" id="valor" value="<?php echo $prod['valor']; ?>" class="form-control" required>
                </div>  

                <div class="form-group col-sm-6">
                    <label for="valor">Disponibilidad</label>

                    <select id="disp" name="disp" required>
                        <option value="">seleccione</option>
                        <option value="agotado">Agotado</option>
                        <option value="disponible">Disponible</option>
                    </select><br>
                </div>

                <div class="form-group mx-auto">
                    <button type="submit" class="btn btn-primary"
                     onclick="if (!confirm('Esta seguro de modificar el cliente?')) return false;" >Guardar</button>
                    <a href="index.php?c=productos&f=index" class="btn btn-primary">Cancelar</a>
                </div>
                    
            </div>  
        </form>
    </div>
</div>

<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>
