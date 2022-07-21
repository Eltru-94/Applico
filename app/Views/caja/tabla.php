<!--Inicio Tabla lista Usuario -->
<div class="card shadow mb-4">
    <div class="card-header py-3 centro">
        <h4 class="m-0 font-weight-bold text-dark text-center"><?php echo $title; ?></h4>
    </div>

    <div class="card-body">
        <div class="row">
            <h4 class="text-left"><i class="fas fa-file-alt"></i> &nbsp; Nueva venta</h4>
        </div>
        <hr>
        <div class="row">
            <h6 class="text-left"><i class="fas fa-user"></i> &nbsp; Datos Cliente</h6>
        </div>
        <div class="row">
            <div class="col-md-12">

                <button type="button" hidden id="btnCrearCliente" name="btnCrearCliente" onclick="crearCliente()" title="Resgistrar Cliente" class="btn btn-outline-primary my-2 my-sm-0">
                    <i class="fas fa-user-plus"></i>&nbsp;Registrar Cliente
                </button>

            </div>
        </div>
        <br>
        <form name="forCliente" id="forCliente" enctype="multipart/form-data">

            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label class="small mb-1">Cédula : </label>
                    <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo session('loggedUser') ?>">
                    <input type="hidden" class="form-control" id="id_cliente" name="id_cliente">
                    <input type="text" class="form-control" id="cedula" name="cedula" onkeyup="Buscar()" placeholder="Ingrese la cédula : ">
                    <span id="spancedula" name="spancedula" class="text-danger error-text cedula_error"></span>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label class="small mb-1">Nombre : </label>

                    <input type="text" class="form-control" id="nombre" disabled name="nombre" placeholder="Nombre : ">
                    <span class="text-danger error-text nombre_error"></span>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label class="small mb-1">Apellido : </label>
                    <input type="text" class="form-control" id="apellido" disabled name="apellido" placeholder="Apellido : ">
                    <span class="text-danger error-text apellido_error"></span>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-sm-4 mb-4 mb-sm-0">
                    <label class="small mb-1">Telefono : </label>
                    <input type="text" disabled class="form-control" id="telefono" name="telefono" placeholder="Telefono : ">
                    <span class="text-danger error-text telefono_error"></span>
                </div>
                <div class="col-sm-8 mb-8 mb-sm-0">
                    <label class="small mb-1">Direccion : </label>
                    <input type="text" disabled class="form-control" id="direccion" name="direccion" placeholder="direccion : ">
                    <span class="text-danger error-text direccion_error"></span>
                </div>
            </div>

            <input type="submit" id="btnGuardarCliente" disabled name="btnGuardarCliente" class="btn btn-primary" value="Guardar">



        </form>
        <br>
        <hr>
        <div class="row">
            <h6 class="text-left"><i class="fas fa-cart-plus"></i>&nbsp; Agregar Producto</h6>
        </div>
        <div class="form-group row">


        </div>

        <div class="form-group row">

            <div class="col-sm-12 mb-12 mb-sm-0">
                <input type="hidden" class="form-control" id="id_fencabezado" name="id_fencabezado">
                <div class="btn-group" role="group" aria-label="Basic example">

                    <button type="button" id="btn_agregar" name="btn_agregar" disabled class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddProductos"><i class="fas fa-cart-plus"></i>&nbsp; Agregar</button>
                    <button type="button" id="btn_anular" name="btn_anular" disabled onclick="AnularFactura()" class="btn btn-danger"><i class="fas fa-times-circle"></i>&nbsp;Anular</button>
                    <button type="button" id="btn_procesar" name="btn_procesar" disabled onclick="PagarFactura()" class="btn btn-info"><i class="fas fa-edit"></i>&nbsp;Procesar</button>

                </div>


            </div>
        </div>

        <hr>

        <table class="table table-sm table-hover text-center" id="tablaVentaProductos" style="width:100%" name="tablaVentaProductos">
            <thead>
                <th>CODIGO</th>
                <th>DESCRIPCION</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>PRECIO TOTAL</th>
                <th>ACCION</th>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>
</div>

<div class="modal fade" id="modalAddProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Añadir Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form name="forAddProductos" id="forAddProductos" enctype="multipart/form-data">

                    <div class="form-group row">

                        <input type="hidden" class="form-control" id="estado" name="estado">

                        <div class="col-sm-6 mb-6 mb-sm-0">
                            <label class="small mb-1">Codigo : </label>
                            <select name="id_producto" id="id_producto" class="form-control" onchange="select()">
                            </select>

                            <span class="text-danger error-text id_producto_error"></span>
                        </div>
                        <div class="col-sm-6 mb-6 mb-sm-0">
                            <label class="small mb-1">Descripcion : </label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" disabled>
                            <span class="text-danger error-text descripcion_error"></span>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Stock </label>
                            <input type="text" class="form-control" id="stock" name="stock" disabled placeholder="0.0">
                            <span class="text-danger error-text stock_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Cantidad : </label>
                            <input type="number" class="form-control" id="cantidad" min="1" name="cantidad" value="1">
                            <span class="text-danger error-text cantidad_error"></span>
                        </div>

                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1">Precio Total : </label>
                            <input type="text" class="form-control" id="preciototal" name="preciototal" disabled placeholder="$0.0">
                            <span class="text-danger error-text preciototal_error"></span>
                        </div>
                    </div>

                    <div class="form-group row">

                        <input type="hidden" class="form-control" id="preciomayorista" name="preciomayorista" disabled>
                        <input type="hidden" class="form-control" id="preciopublico" name="preciopublico" disabled>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1"><strong>Precio publico : </strong></label>
                            <input type="radio" id="precio" name="precio" onclick="calcularPrecioPublico()"> <label id="titulo_precio_publico" class="small mb-1"></label>

                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">
                            <label class="small mb-1"><strong>Precio Mayorista : </strong> </label>
                            <input type="radio" id="precio" name="precio" onclick="calcularPrecioMayorista()"> <label id="titulo_precio_mayorista" class="small mb-1"></label>
                            <span class="text-danger error-text precio_error"></span>
                        </div>
                        <div class="col-sm-4 mb-4 mb-sm-0">

                        </div>
                    </div>




                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" onclick="" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="btnAddProducto" name="btnAddProducto" class="btn btn-outline-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Modal update field cantidad -->
<div class="modal fade" id="modalAddProductosUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal">Actualizar Producto</h5>
                <button type="button" onclick="clearErrorEditProducto()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form name="forAddProductosUpdate" id="forAddProductosUpdate" enctype="multipart/form-data">


                    <div class="form-group row">

                        <div class="col-sm-12 mb-12 mb-sm-0">
                            <label class="small mb-1">Cantidad : </label>
                            <input type="hidden" class="form-control" id="id_fdetalle_update" name="id_fdetalle_update">
                            <input type="hidden" class="form-control" id="id_producto_update" name="id_producto_update">
                            <input type="number" class="form-control" id="cantidad_update" name="cantidad_update" value="1">
                            <span class="text-danger error-text cantidad_error"></span>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" onclick="clearErrorEditProducto()" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" id="btnAddProductoUpdate" name="btnAddProductoUpdate" class="btn btn-outline-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>