<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "2000",
        "timeOut": "2000",
        "extendedTimeOut": "2000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    function estadoColor(id) {
        var mensaje = "";
        switch (id) {
            case ('1'):
                mensaje = `<span class="badge badge-pill bg-success">Activo</span>`;
                break;
            case ('0'):
                mensaje = `<span class="badge badge-pill bg-danger">Inactivo</span>`
                break;
        }
        return mensaje;

    }


    function colorCantidad(valor) {

        let cantidad = "";
        if (valor > 5) {
            return cantidad = `<span class="badge badge-pill bg-info"><strong>` + valor + `</strong></span>`;
        } else {
            return cantidad = `<span class="badge badge-pill bg-danger">` + valor + `</span>`;
        }

    }

    function estado(valor) {

        let rolmensaje = "";
        if (valor == 1) {
            return rolmesanje = " <i class='fas fa-check'></i>";
        }

        if (valor == 0) {
            return rolmesanje = " <i class='far fa-times-circle'></i>";
        }

    }

    function mensajeAlertEstado(valor, nombre) {

        let rolmensaje = "";
        if (valor == 1) {
            return rolmesanje = "Activar " + nombre + "!";
        }

        if (valor == 0) {
            return rolmesanje = "Desactivar " + nombre + "!";
        }

    }


    function btnColorDelete(valor) {

        let rolmensaje = "";
        if (valor == 1) {
            return rolmesanje = "class = 'btn btn-outline-success'";
        }

        if (valor == 0) {
            return rolmesanje = "class = 'btn btn-outline-danger'";
        }

    }
</script>