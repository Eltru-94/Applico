<script>
    let tituloCate = document.getElementById("tituloCategoria");
    let edit = false;

    let tablaCategoria = $('#tablaCategoria').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Categoria",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registro de usuarios del _START_ al _END_ de un total de _TOTAL_",
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


    function tituloCategoria() {
        tituloCate.innerHTML = "<h5> Registrar  Categoria</h5>";
    }

    function loadCategorias() {
        tablaCategoria.row().clear();
        let Url = "<?php echo base_url('Categorias/select') ?>";

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                let cont = 1;
                var temp = "";
                res['categorias'].forEach(catego => {
                    let colorestado = estadoColor(catego.estado);
                    let mensaje = estado(catego.estado);
                    let btnColor = btnColorDelete(catego.estado);
                    let accion = "<div class='btn-group'><a class='btn btn-outline-primary ' title='Actualizar' data-bs-toggle='modal' data-bs-target='#modalCategoria'  onclick='update(" +
                        catego.id_categoria +
                        ")'><i class='fas fa-shopping-bag'></i> <a " + btnColor + " title='Eliminar'  onclick='deleteCategoria(" +
                        catego.id_categoria + "," + catego.estado +
                        ")'>" + mensaje + "</a></div> ";
                    tablaCategoria.row.add([cont, catego.categoria, colorestado, accion]);
                    cont++;
                });
                tablaCategoria.draw(true);
            }
        });

    }


    function deleteCategoria(id, estado) {

        let Url = "<?php echo base_url('Categorias/delete') ?>";
        if (estado == 1) {
            estado = 0;
        } else {
            estado = 1;
        }
        let mensaje =mensajeAlertEstado(estado,"Categoria");
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
                        'id_categoria': id,
                        'estado': estado
                    },
                    success: function(res) {
                      
                        loadCategorias();
                        if (res.estado == 1) {
                            toastr["success"](res.success,"Categoria");
                        }
                        if (res.estado == 0) {
                            toastr["error"](res.success,"Categoria");
                        }



                    }

                });
            }
        });
    }



    function update(valor) {

        tituloCate.innerHTML = "<h5> Actualizar Categoria</h5>";

        let Url = "<?php echo base_url('Categorias/update/') ?>/" + valor;



        $.ajax({
            method: 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
                res['categorias'].forEach(catego => {


                    $('#id_categoria').val(catego.id_categoria);
                    $('#categoria').val(catego.categoria);


                });
                edit = true;
            }
        });
    }


    $("#btnCategoria").click(function(e) {
        e.preventDefault();
        clearErrors();

        let Url = edit === false ? '<?php echo base_url('Categorias/store') ?>' :
            '<?php echo base_url('Categorias/datoUpdate') ?>';
        var fd = new FormData(document.getElementById("forCategoria"));

        $.ajax({
            type: "post",
            url: Url,
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {
                console.log(res);
                if (res.success) {

                    edit = false;
                    $('#forCategoria').trigger('reset');
                    toastr["success"](res.success,"Categoria");
                    loadCategorias();
                    $('#modalCategoria').modal('hide');


                } else {
                    //clearErrors();
                    $.each(res.error, function(prefix, val) {
                        $('#forCategoria').find('span.' + prefix + '_error').text(val);
                    });

                }



            }
        });


    });



    function clearErrors() {

        $('#forCategoria').find('span.categoria_error').text("");
    }

    function clearFormulario(){
        $('#forCategoria').trigger('reset');
        clearErrors();
    }

    window.onload = loadCategorias;
</script>