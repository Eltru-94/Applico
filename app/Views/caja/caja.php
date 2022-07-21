<script>
    let titulo_precio_publico = document.getElementById("titulo_precio_publico");
    let titulo_precio_mayorista = document.getElementById("titulo_precio_mayorista");

    let tablaAddproductos = $('#tablaVentaProductos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Productos",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registro del la factura detalle del _START_ al _END_ de un total de _TOTAL_",
            "infoEmpty": "Mostrando registro del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado un todal de _MAX_ re)",
            "sSearch": "Buscar : ",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        },
    });


    function loadAddProductos() {


        tablaAddproductos.row().clear();
        let Url = "<?php echo base_url('Fdetalles/selectFacturaDetalle') ?>" + "/" + $('#id_fencabezado').val();

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                let cont = 1;
                let tam = res['facturaDetalle'].length;

                let suma = 0;
                res['facturaDetalle'].forEach(detalle => {

                    let total = detalle.cantidad * detalle[0];
                    let accion = ` <a class='btn btn-outline-primary' title="Actualizar" data-bs-toggle="modal"
                        data-bs-target="#modalAddProductosUpdate" onclick="editAddProducto(` + detalle.id_fdetalle + `)"> <i class='fas fa-edit'></i></a>`;
                    let btnEliminar = `<a class='btn btn-outline-danger' title="Eliminar" onclick="deletAddProducto(` + detalle.id_fdetalle + `)"> <i class='fas fa-trash'></i></a>`;
                    tablaAddproductos.row.add([detalle.codigo, detalle.producto, detalle.cantidad, "$" + detalle[0], "$" + total, accion + btnEliminar]);
                    suma += total;
                    if (cont == tam) {
                        let iva = parseFloat(suma * 0.12).toFixed(2);
                        let subtotal = parseFloat(suma - iva).toFixed(2);
                        let totalpagar = parseFloat(suma).toFixed(2);
                        tablaAddproductos.row.add([" ", " ", " ", "<strong>Total</strong>", "$" + totalpagar, "---"]);
                        tablaAddproductos.row.add([" ", " ", " ", "<strong>Subtotal</strong>", "$" + subtotal, "---"]);
                        tablaAddproductos.row.add([" ", " ", " ", "<strong>Iva 12%</strong>", "$" + iva, "---"]);
                    }
                    cont++


                });

                tablaAddproductos.draw(true);
            }
        });

    }

    function AnularFactura() {

        let Url = `<?php echo base_url() ?>/Fencabezado/anular/` + $('#id_fencabezado').val();
        Swal.fire({
            title: 'Esta seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!'
        }).then((result) => {
            if (result.isConfirmed) {


                $.ajax({
                    'type': "get",
                    url: Url,
                    dataType: 'json',
                    success: function(res) {

                        if (res.success) {

                            toastr["success"](res.success, 'Factura');
                            window.location.reload();


                        }

                    }
                });

            }
        });

    }

    function clienteRegistrado() {

        let Url = `<?php echo base_url() ?>/Fencabezado/selectClienteForIdFencabezado`;
        $.ajax({
            'type': "get",
            url: Url,
            dataType: 'json',
            success: function(res) {
                console.log(res.cliente.length)
                if (res.cliente.length != 0) {
                    $('#nombre').val(res.cliente[0].nombre);
                    $('#apellido').val(res.cliente[0].apellido);
                    $('#telefono').val(res.cliente[0].telefono);
                    $('#direccion').val(res.cliente[0].direccion);
                    $('#id_cliente').val(res.cliente[0].id_cliente);
                    $('#cedula').val(res.cliente[0].cedula);
                } else {
                    $('#nombre').val("");
                    $('#apellido').val("");
                    $('#telefono').val("");
                    $('#direccion').val("");
                    $('#id_cliente').val("");
                    $('#cedula').val("");
                }


            }
        });

    }

    function PagarFactura() {

        let Url = `<?php echo base_url() ?>/Fencabezado/procesar/` + $('#id_fencabezado').val();
        let impresion = `<?php echo base_url() ?>/Fencabezado/impresionFactura//` + $('#id_fencabezado').val();


        Swal.fire({
            title: 'Esta seguro?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!'
        }).then((result) => {
            if (result.isConfirmed) {


                $.ajax({
                    method: 'get',
                    url: Url,
                    dataType: 'json',
                    success: function(res) {

                        if (res.success) {
                            toastr["success"](res.success);
                            $('#id_fencabezado').val(" ");
                            clienteRegistrado();
                            desactivarBotenes()
                            $("#tablaVentaProductos").empty();
                            window.location.href = impresion;


                        }


                    }
                });


            }
        });

    }

    function Buscar() {
        let Url = "<?php echo base_url('Clientes/selectForCI') ?> ";
        let mensaje = $('#cedula').val();

        $.ajax({
            'type': 'post',
            url: Url,
            data: {
                'cedula': mensaje
            },
            dataType: 'json',
            success: function(res) {
                clearErrors();
                clearFields();
                if (res.cliente) {

                    $('#nombre').val(res.cliente[0].nombre);
                    $('#apellido').val(res.cliente[0].apellido);
                    $('#telefono').val(res.cliente[0].telefono);
                    $('#direccion').val(res.cliente[0].direccion);
                    $('#id_cliente').val(res.cliente[0].id_cliente);
                    $('#btnGuardarCliente').prop('disabled', false);
                    $('#forCliente').find('span.cedula_error').text(res.mensaje);
                    $('#spancedula').removeClass('text-danger');
                    $("#spancedula").addClass("text-success");
                    enableFields();
                }
                $.each(res.error, function(prefix, val) {
                    $('#forCliente').find('span.' + prefix + '_error').text(val);
                });

            }
        });

    }

    function editAddProducto(id_fdetalle) {

        let Url = "<?php echo base_url('Fdetalles/selectFdetalleForId') ?>/" + id_fdetalle;
        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                $('#cantidad_update').val(res.fdetalle[0].cantidad)
                $('#id_fdetalle_update').val(res.fdetalle[0].id_fdetalle)
                $('#id_producto_update').val(res.fdetalle[0].id_producto)

            }
        });

    }

    function deletAddProducto(id) {

        let Url = `<?php echo base_url() ?>/Fdetalles/delete/` + id;

        Swal.fire({
            title: 'Esta seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    'type': "get",
                    url: Url,
                    dataType: 'json',
                    success: function(res) {

                        if (res.success) {

                            toastr["success"](res.success, 'Producto');
                            loadAddProductos();

                        }
                    }
                });

            }
        });

    }

    $("#btnGuardarCliente").click(function(e) {
        e.preventDefault();
        let Url = '<?php echo base_url('Clientes/store') ?>';
        var fd = new FormData(document.getElementById("forCliente"));

        $.ajax({
            type: "post",
            url: Url,
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {
                clearErrorsDatos()
                enableFields();
                if (res.success) {

                    $('#id_fencabezado').val(res.id_fencabezado);
                    disabledFields();
                    activarBotenes();
                    toastr["success"](res.success);

                } else {
                    $('#btnGuardarCliente').prop('disabled', false);
                    $.each(res.error, function(prefix, val) {
                        $('#forCliente').find('span.' + prefix + '_error').text(val);
                    });

                }

            }
        });

    });

    $("#btnAddProductoUpdate").click(function(e) {
        e.preventDefault();
        let Url = '<?php echo base_url('Fdetalles/updateCantidadProducto') ?>';
        var fd = new FormData(document.getElementById("forAddProductosUpdate"));

        $.ajax({
            type: "post",
            url: Url,
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {
                clearAddProductosUpdate();
                if (res.success) {

                    clearErrorEditProducto();
                    $('#modalAddProductosUpdate').modal('hide');
                    toastr["success"](res.success, 'Producto');
                    loadAddProductos();

                } else {

                    $.each(res.error, function(prefix, val) {
                        $('#forAddProductosUpdate').find('span.' + prefix + '_error').text(val);
                    });
                }

            }
        });

    });

    function productoActivos() {

        selectIdFencabezado();

        let Url = "<?php echo base_url('Productos/productosActivos') ?>";
        let producto = document.getElementById("id_producto");
        $('#forAddProductos').find('span.stock_error').text(" ");
        $('#forAddProductos').find('span.precio_error').text(" ");
        let mensaje = "";
        let aux = 0;
        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {

                res['productos'].forEach(prod => {

                    mensaje += "<option  value='" + prod.id_producto + "'>" + prod.codigo + "</option>";

                });
                producto.innerHTML = mensaje;
            }
        });

    }

    function select() {

        let Url = "<?php echo base_url('Productos/update/') ?>/" + $('#id_producto').val();

        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {

                res['producto'].forEach(pro => {

                    $('#descripcion').val(pro.producto);
                    $('#stock').val(pro.cantidad);
                    titulo_precio_publico.innerHTML = "<span3>" + "$ " + pro.preciopublico + "</span>"
                    titulo_precio_mayorista.innerHTML = "<span3>" + "$ " + pro.preciomayorista + "</span>"
                    $('#preciomayorista').val(pro.preciomayorista);
                    $('#preciopublico').val(pro.preciopublico);


                });

            }
        });
    }


    function selectIdFencabezado() {

        let Url = "<?php echo base_url('Fdetalles/selectFacturaEncabezado/') ?>/" + $('#id_user').val();

        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                console.log(res)
                if (res.id_fencabezado != null) {
                    $('#id_fencabezado').val(res.id_fencabezado);

                    loadAddProductos()
                    activarBotenes();

                }


            }
        });
    }



    function calcularPrecioMayorista() {
        $('#forAddProductos').find('span.stock_error').text(" ");
        $('#forAddProductos').find('span.precio_error').text(" ");
        let preciomayorista = $('#preciomayorista').val();
        let cantidad = $('#cantidad').val();
        $('#estado').val(2);
        $('#preciototal').val(preciomayorista * cantidad)

    }


    function calcularPrecioPublico() {
        $('#forAddProductos').find('span.stock_error').text(" ");
        $('#forAddProductos').find('span.precio_error').text(" ");
        $('#estado').val(1);
        let preciopublico = $('#preciopublico').val();
        let cantidad = $('#cantidad').val();
        $('#preciototal').val(preciopublico * cantidad)

    }



    $("#btnAddProducto").click(function(e) {
        e.preventDefault();


        let Url = '<?php echo base_url('Fdetalles/store') ?>';

        $.ajax({
            method: 'post',
            url: Url,
            data: {
                'estado': $('#estado').val(),
                'cantidad': $('#cantidad').val(),
                'id_producto': $('#id_producto').val(),
                'id_fencabezado': $('#id_fencabezado').val(),
                'stock': $('#stock').val()
            },
            dataType: "json",
            success: function(res) {

                if (res.success) {
                    $('#forAddProductos').trigger('reset');
                    loadAddProductos();
                    $('#modalAddProductos').modal('hide');
                    toastr["success"](res.success, 'Producto');
                } else {
                    $.each(res.error, function(prefix, val) {
                        $('#forAddProductos').find('span.' + prefix + '_error').text(val);
                    });
                }

            }
        })

    });


    /** Method from clear fields*/





    function clearErrors() {

        $('#forCliente').find('span.cedula_error').text("");
        $('#spancedula').removeClass('text-success');
        $("#spancedula").addClass("text-danger");
        disabledFields();

    }

    function clearFields() {
        $('#nombre').val("");
        $('#apellido').val("");
        $('#telefono').val("");
        $('#direccion').val("");

    }

    function enableFields() {

        $('#nombre').prop('disabled', false);
        $('#apellido').prop('disabled', false);
        $('#telefono').prop('disabled', false);
        $('#direccion').prop('disabled', false);
    }


    function disabledFields() {

        $('#nombre').prop('disabled', true);
        $('#apellido').prop('disabled', true);
        $('#telefono').prop('disabled', true);
        $('#direccion').prop('disabled', true);

    }

    function clearErrorsDatos() {
        $('#forCliente').find('span.nombre_error').text("");
        $('#forCliente').find('span.apellido_error').text("");
        $('#forCliente').find('span.telefono_error').text("");
        $('#forCliente').find('span.direccion_error').text("");

    }

    /** Clear form AddProductosUpdate*/

    function clearAddProductosUpdate() {
        $('#forAddProductosUpdate').find('span.cantidad_error').text("");
    }


    function activarBotenes() {

        $('#btnGuardarCliente').prop('disabled', true);
        $('#btn_agregar').prop('disabled', false);
        $('#btn_anular').prop('disabled', false);
        $('#btn_procesar').prop('disabled', false);
        $('#cedula').prop('disabled', true);
        clienteRegistrado();

    }

    function desactivarBotenes() {


        $('#btn_agregar').prop('disabled', true);
        $('#btn_anular').prop('disabled', true);
        $('#btn_procesar').prop('disabled', true);
        $('#cedula').prop('disabled', false);
        clienteRegistrado();

    }



    function clearErrorEditProducto() {
        $('#cantidad_update').val(1)
        $('#forAddProductosUpdate').find('span.cantidad_error').text("");
    }

    window.onload = productoActivos;
</script>