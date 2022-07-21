<script>
    let tablaFencabezados = $('#tablaFencabezados').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Factura",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registro de Facturación del _START_ al _END_ de un total de _TOTAL_",
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

    function loadFencabezados() {
        tablaFencabezados.row().clear();
        let Url = "<?php echo base_url('Fencabezados/selectRealizado') ?>";

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                let cont = 1;
                res['fencabezado'].forEach(fencabezado => {

                    let cliente = fencabezado.cnombre + "" + fencabezado.capellido;
                    tablaFencabezados.row.add([cont,cliente,fencabezado.numerofactura,fencabezado.subtotal,fencabezado.iva,fencabezado.total,fencabezado.created_at,`<a class='btn btn-outline-danger' title='Imprimir Factura'  href='<?php echo base_url()?>/Fencabezado/impresionFactura/` + fencabezado.id_fencabezado + `'> <i class='fas fa-file-pdf'></i></a>`]);
                    cont++;
                });
                tablaFencabezados.draw(true);
            }
        });

    }


    window.onload = loadFencabezados;
</script>