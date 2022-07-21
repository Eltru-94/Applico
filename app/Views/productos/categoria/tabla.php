<!--Inicio Tabla lista Usuario -->
<div class="card shadow mb-4">
    <div class="card-header py-3 centro">
        <h4 class="m-0 font-weight-bold text-dark text-center"><?php echo $title; ?></h4>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div><button type="button" title="Resgistrar Categoria" class="btn btn-outline-primary my-2 my-sm-0" onclick="tituloCategoria()" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                        <i class="fas fa-plus-square"></i>
                    </button>
                </div>
                <br>

            </div>
        </div>
        <table class="table table-sm table-hover text-center" id="tablaCategoria" style="width:100%" name="tablaCategoria">
            <thead>
                <th>ID</th>
                <th>CATEGORIA</th>
                <th>ESTADO</th>
                <th>ACCION</th>

            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div