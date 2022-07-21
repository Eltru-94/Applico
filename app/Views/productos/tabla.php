<!--Inicio Tabla lista Usuario -->
<div class="card shadow mb-4">
    <div class="card-header py-3 centro">
        <h4 class="m-0 font-weight-bold text-dark text-center"><?php echo $title; ?></h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

                <br>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" title="Resgistrar Producto" onclick=" crearCategoria()" class="btn btn-outline-primary my-2 my-sm-0" data-bs-toggle="modal" data-bs-target="#modalProductos">
                        <i class="fas fa-wine-bottle"></i>
                    </button>




                </div>


            </div>
        </div>
        <br>
        <table class="table table-sm table-hover text-center" id="tablaProductos" style="width:100%" name="tablaProductos">
            <thead>
                <th>ID</th>
                <th>CODIGO</th>
                <th>CATEGORIA</th>
                <th>PRODUCTO</th>
                <th>PRECIO REAL</th>
                <th>PRECIO PUBLICO</th>
                <th>PRECIO MAYORISTA</th>
                <th>CANTIDAD</th>
                <th>TELEFONO PROVEDOR</th>
                <th>ESTADO</th>
                <th>ACCION</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div