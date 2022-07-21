<script>
    let tituloProducto = document.getElementById("tituloModal");
    let edit = false;
    //Cargar datos para la tabla
    let tablaProductos = $('#tablaProductos').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Productos",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registro de productos del _START_ al _END_ de un total de _TOTAL_",
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


    function selectCategoriasEstadoUno(aux) {

        let Url = "<?php echo base_url('Categorias/selectEstado1') ?>";
        let categoria = document.getElementById("id_categoria");

        let mensaje = "";
        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
            
                    res['categorias'].forEach(categoria => {
                        if (aux == categoria.id_categoria) {
                            mensaje += "<option  onclick='crearCodigoProducto()' selected value='" + categoria.id_categoria + "'>" + categoria.categoria +
                                "</option>";
                        } else {
                            mensaje += "<option onclick='crearCodigoProducto()' value='" + categoria.id_categoria + "'>" + categoria.categoria + "</option>";
                        }

                    });
                categoria.innerHTML = mensaje;
            }
        });

    }

    function crearCodigoProducto() {



        let Url = "<?php echo base_url('Productos/crearCodigo/') ?>/" + $("#id_categoria").val();



        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
                $('#codigo').val(res.codigoProducto);
            }
        });
    }



    function loadProductos() {
        tablaProductos.row().clear();
        let Url = "<?php echo base_url('Productos/select') ?>";

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {

               
                let cont = 1;
                var temp = "";
                res['productos'].forEach(pro => {
                    let colorestado = estadoColor(pro.estado);
                    let pre_real = `<span class="badge badge-pill bg-primary"><i class="fas fa-dollar-sign"></i>` + pro.precioreal + `</span>`;
                    let pre_publico = `<span class="badge badge-pill bg-secondary"><i class="fas fa-dollar-sign"></i>` + pro.preciopublico + `</span>`;
                    let pre_mayorista = `<span class="badge badge-pill bg-warning"><i class="fas fa-dollar-sign"></i>` + pro.preciomayorista + `</span>`;
                    let mensaje = estado(pro.estado);
                    let btnColor = btnColorDelete(pro.estado);
                    let accion = "<div class='btn-group'><a class='btn btn-outline-primary ' titlse='Actualizar' data-bs-toggle='modal' data-bs-target='#modalProductos'  onclick='update(" +
                        pro.id_producto +
                        ")'><i class='fas fa-cart-plus'></i></a> <a " + btnColor + " title='Eliminar'  onclick='deleteProducto(" +
                        pro.id_producto + "," + pro.estado +
                        ")'>" + mensaje + "</a></div> ";
                    tablaProductos.row.add([cont, pro.codigo, pro.categoria, pro.producto, pre_real, pre_publico, pre_mayorista, colorCantidad(pro.cantidad), pro.telefonoproveedor, colorestado, accion]);
                    cont++;
                });
                tablaProductos.draw(true);
            }
        });

    }


    $("#btnProducto").click(function(e) {
        e.preventDefault();
        clearErrors();

        let Url = edit === false ? '<?php echo base_url('Productos/store') ?>' :
            '<?php echo base_url('Productos/updateDato') ?>';
        var fd = new FormData(document.getElementById("forProductos"));

        $.ajax({
            type: "post",
            url: Url,
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {

                if (res.success) {
                    console.log(res)
                    edit = false;
                    $('#forProductos').trigger('reset');
                    toastr["success"](res.success,'Producto');
                    loadProductos();
                    $('#modalProductos').modal('hide');


                } else {
                 
                    $.each(res.error, function(prefix, val) {
                        $('#forProductos').find('span.' + prefix + '_error').text(val);
                    });

                }



            }
        });


    });

    function deleteProducto(id, estado) {

        let Url = "<?php echo base_url('Productos/delete') ?>";
        if (estado == 1) {
            estado = 0;
        } else {
            estado = 1;
        }
        let mensaje = mensajeAlertEstado(estado, "Producto");
        Swal.fire({
            title: mensaje,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'post',
                    url: Url,
                    data: {
                        'id_producto': id,
                        'estado': estado
                    },
                    success: function(res) {
                       
                        loadProductos();
                        if (res.estado == 1) {
                            toastr["success"](res.success,"Producto");
                        }
                        if (res.estado == 0) {
                            toastr["error"](res.success,"Producto");
                        }



                    }

                });
            }
        });
    }

    function crearCategoria() {
        selectCategoriasEstadoUno(0);
        $('#codigo').prop('disabled', false);
        $('#id_categoria').prop('disabled', false);
        tituloProducto.innerHTML = "<h5> Registrar Producto</h5>";

    }

    function clearErrors() {
        $('#forProductos').find('span.codigo_error').text("");
        $('#forProductos').find('span.id_categoria_error').text("");
        $('#forProductos').find('span.producto_error').text("");
        $('#forProductos').find('span.preciopublico_error').text("");
        $('#forProductos').find('span.precioreal_error').text("");
        $('#forProductos').find('span.preciomayorista_error').text("");
        $('#forProductos').find('span.cantidad_error').text("");

    }

    function update(valor) {
        $('#codigo').prop('disabled', true);
        $('#id_categoria').prop('disabled', true);
        tituloProducto.innerHTML = "<h5> Actualizar Poducto</h5>";

        let Url = "<?php echo base_url('Productos/update/') ?>/" + valor;



        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
                console.log(res);
                res['producto'].forEach(pro => {


                    $('#id_producto').val(pro.id_producto);
                    $('#producto').val(pro.producto);
                    $('#precioreal').val(pro.precioreal);
                    $('#preciopublico').val(pro.preciopublico);
                    $('#preciomayorista').val(pro.preciomayorista);
                    $('#cantidad').val(1);
                    $('#codigo').val(pro.codigo);
                    $('#telefonoproveedor').val(pro.telefonoproveedor);
                    selectCategoriasEstadoUno(pro.id_categoria);

                });
                edit = true;
            }
        });
    }



    function clearFormulario() {
        $('#forProductos').trigger('reset');
        clearErrors();
    }


    window.onload = loadProductos;
</script>