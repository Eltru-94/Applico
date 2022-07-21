<script>
    let tablaClientes = $('#tablaClientes').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Clientes",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registro de clientes del _START_ al _END_ de un total de _TOTAL_",
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

    function loadClientes() {
        tablaClientes.row().clear();
        let Url = "<?php echo base_url('Clientes/select') ?>";

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {


                let cont = 1;

                res['clientes'].forEach(cliente => {

                    tablaClientes.row.add([cont, cliente.nombre, cliente.apellido, cliente.cedula, cliente.telefono, cliente.direccion, cliente.created_at]);
                    cont++;
                });
                tablaClientes.draw(true);
            }
        });

    }


    window.onload = loadClientes;
</script>