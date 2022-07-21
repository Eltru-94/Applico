<div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="clearFormulario()" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form name="forProductos" id="forProductos" enctype="multipart/form-data">

                    <div class="form-group row">
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Codigo </label>
                            <input type="hidden" class="form-control" id="id_producto" name="id_producto">
                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="codigo  ">
                            <span class="text-danger error-text codigo_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Categoria : </label>
                            <select name="id_categoria" id="id_categoria" class="form-control" onchange="crearCodigoProducto()">
                            </select>

                            <span class="text-danger error-text id_categoria_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Producto : </label>
                            <input type="text" class="form-control" id="producto" name="producto" placeholder="Ingrese producto  ">
                            <span class="text-danger error-text producto_error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Precio Real : </label>
                            <input type="text" class="form-control" id="precioreal" name="precioreal" placeholder="$ 0.0">
                            <span class="text-danger error-text precioreal_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Precio Publico : </label>
                            <input type="text" class="form-control" id="preciopublico" name="preciopublico" placeholder="$ 0.0 ">
                            <span class="text-danger error-text preciopublico_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Precio Mayorista</label>
                            <input type="text" name="preciomayorista" id="preciomayorista" class="form-control" placeholder="$ 0.0 ">

                            <span class="text-danger error-text preciomayorista_error"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 mb-6 mb-sm-0">
                            <label class="small mb-1">Cantidad : </label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad ">
                            <span class="text-danger error-text cantidad_error"></span>
                        </div>
                        <div class="col-sm-6 mb-6 mb-sm-0">
                            <label class="small mb-1">Telefono Provedor : </label>
                            <input type="text" class="form-control" id="telefonoproveedor" name="telefonoproveedor" placeholder="Telefono Provedor ">
                            <span class="text-danger error-text telefonoproveedor_error"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="clearFormulario()" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="btnProducto" name="btnUser" class="btn btn-outline-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>