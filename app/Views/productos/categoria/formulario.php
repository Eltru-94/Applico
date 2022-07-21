<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloCategoria"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearFormulario()" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form name="forCategoria" id="forCategoria" enctype="multipart/form-data">

                    <div class="form-group row">
                        <div class="col-sm-12 mb-12 mb-sm-0">
                            <label class="small mb-1">Categoria : </label>
                            <input type="hidden" class="form-control" id="id_categoria" name="id_categoria">
                            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria : ">
                            <span class="text-danger error-text categoria_error"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" onclick="clearFormulario()" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="btnCategoria" name="btnCategoria" class="btn btn-outline-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>