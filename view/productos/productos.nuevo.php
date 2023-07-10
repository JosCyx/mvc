<!--autor: Moreno Bravo Jose-->
<?php require_once HEADER; ?>

<div class="container">
<h2> <?php echo $titulo?></h2>
    <div class="card card-body">
       
        <form action="index.php?c=productos&f=new" method="POST" name="formProdNuevo" id="formProdNuevo">
            <div class="form-row">
            <div class="form-group col-sm-6">
                    <label for="codigo">Codigo</label>
                    <input type="number" name="codigo" id="codigo" class="form-control" placeholder="00000" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="VitaC" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Vitamina de ejemplo" required>
                </div> 

                <div class="form-group col-sm-6">
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" id="valor" class="form-control" placeholder="25.00" required>
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
                    <button type="submit" class="btn btn-primary">Guardar</button>

                    <a href="index.php?c=productos&f=index" class="btn btn-primary">
                        Cancelar</a>
                </div>
            </div>  
        </form>


    </div>
</div>


<?php require_once FOOTER; ?>
