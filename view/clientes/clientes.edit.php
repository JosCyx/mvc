<!-- autor:LOOR LALAMA JANEOR OSCAR-->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo $titulo?></h2>
    <div class="card card-body">
    
        <form action="index.php?c=clientes&f=edit" method="POST" name="formProdNuevo" id="formProdNuevo">
        
        <input type="hidden" name="id" id="id" value="<?php echo $clien['id']; ?>"/>
            <div class="form-row">
               <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $clien['nombre']; ?>" class="form-control" placeholder="nombre" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="rol">Rol</label>
                    <input type="text" name="rol" id="rol" value="<?php echo $clien['rol']; ?>" class="form-control" placeholder="rol" required>
                </div> 

                <div class="form-group col-sm-6">
                    <label for="correo">Correo</label>
                    <input type="text" name="correo" id="correo" value="<?php echo $clien['correo_electronico']; ?>" class="form-control" placeholder="correo_electronico" required>
                </div>          

                <div class="form-group col-sm-6">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" id="telefono" value="<?php echo $clien['telefono']; ?>" class="form-control" placeholder="telefono" required>
                </div>  

                <div class="form-group mx-auto">
                    <button type="submit" class="btn btn-primary"
                     onclick="if (!confirm('Esta seguro de modificar el cliente?')) return false;" >Guardar</button>
                    <a href="index.php?c=clientes&f=index" class="btn btn-primary">Cancelar</a>
                </div>
                    
            </div>  
        </form>
    </div>
</div>

<!-- incluimos  pie de pagina -->
<?php require_once FOOTER; ?>
