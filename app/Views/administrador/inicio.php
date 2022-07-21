<script>
    const colorFondo = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(125, 9, 255, 0.2)',
        'rgba(54, 22, 25, 0.2)',
        'rgba(15, 6, 123, 0.2)',
        'rgba(235, 72, 200, 0.2)',
        'rgba(203, 21, 25, 0.2)',
        'rgba(185, 15, 164, 0.2)'
    ];
    const colorBoder = [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(125, 9, 255, 1)',
        'rgba(54, 22, 25, 1)',
        'rgba(15, 6, 123, 1)',
        'rgba(235, 72, 200, 1)',
        'rgba(203, 21, 25, 1)',
        'rgba(185, 15, 164, 1)'
    ];

  

   



    function Cargarfunciones() {

        let Url = "<?php echo base_url('Fencabezados/totalRealizado') ?>";
        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
                let currentTime = new Date();
                
                let mensajeTotalDia = '<h2> <i class="fas fa-dollar-sign"></i> &nbsp;' + parseFloat(res.total_dia[0].total).toFixed(2) + '&nbsp;<h2><h5>TOTAL DEL DIA : '+dialabel(currentTime.getDay()+"")+'</h5>';
                let dia = document.getElementById("total_dia");
                dia.innerHTML = mensajeTotalDia;


                let mensajeTotalMes = '<h2> <i class="fas fa-dollar-sign"></i> &nbsp;' + parseFloat(res.total_mes[0].total).toFixed(2) + '&nbsp;<h2><h5>TOTAL DEL MES : '+meseslabel((currentTime.getMonth()+1)+"")+'</h5>';
                let mes = document.getElementById("total_mes");
                mes.innerHTML = mensajeTotalMes;

                let mensajeTotalAnio = '<h2> <i class="fas fa-dollar-sign"></i> &nbsp;' + parseFloat(res.total_anio[0].total).toFixed(2) + '&nbsp;<h2><h5>TOTAL DE AÑO : '+currentTime.getFullYear()+'</h5>';
                let anio = document.getElementById("total_anio");
                anio.innerHTML = mensajeTotalAnio;
               
                totalGraficos();

            }
        });

    }


    function totalGraficos() {
        let Url = "<?php echo base_url('Fencabezados/totalRealizadasMes') ?>";
        let ctx = document.getElementById('myAreaChart').getContext('2d');

        $.ajax({
            'type': 'get',
            url: Url,
            dataType: 'json',
            success: function(res) {
                let total = [];
                let labels = [];
                
                res['total_mes'].forEach(tot => {
                
                    total.push(tot.TOTAL);
                    labels.push(meseslabel(tot.mes));
                });
                total.push(0);
                new Chart(ctx, {
                    type: 'bar', // Tipo de gráfica
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Estadistica de ventas',
                            data: total,
                            backgroundColor: colorFondo,
                            borderColor: colorBoder,
                            borderWidth: 2
                        }]

                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        title: {
                            display: true,
                            text: "Android Cel",
                        }
                    }
                });
            }
        });
    }


    function meseslabel(mes) {
        let mensaje="";
        switch (mes) {
            case '1':
                mensaje= "ENERO";
                break;
            case '2':
                mensaje= "FEBRERO";
                break;
            case '3':
                return "MARZO";
                break;
            case '4':
                mensaje="ABRIL";
                break;
            case '5':
               mensaje="MAYO";
                break;
            case '6':
                mensaje="JUNIO";
                break;
            case '7':
               mensaje="JULIO";
                break;
            case '8':
                mensaje="AGOSTO";
                break;
            case '9':
                mensaje="SEPTIEMBRE";
                break;
            case '10':
                mensaje="OCTUBRE";
                break;
            case '11':
               mensaje="NOVIEMBRE";
                break;
            case '12':
                mensaje="DICIEMBRE";
                break;
                
            default:
                // code block
        }

        return mensaje;
    }

    
    function dialabel(mes) {
        let mensaje="";
        switch (mes) {
            case '1':
                mensaje= "LUNES";
                break;
            case '2':
                mensaje= "MARTES";
                break;
            case '3':
                return "MIERCOLES";
                break;
            case '4':
                mensaje="JUEVES";
                break;
            case '5':
               mensaje="VIERNES";
                break;
            case '6':
                mensaje="SABADO";
                break;
            case '7':
               mensaje="DOMINGO";
                break;
            case '8':
                mensaje="AGOSTO";
                break;
            default:
                // code block
        }

        return mensaje;
    }

    window.onload = Cargarfunciones;
</script>