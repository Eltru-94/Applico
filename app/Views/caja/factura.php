<?= $this->extend('plantilla/layoutfactura') ?>
<?= $this->section('contenido') ?>

<!--Inicio Tabla lista Usuario -->


<div class="card shadow mb-4">
    <div class="card-header py-3 centro">
        <h4 class="m-0 font-weight-bold text-dark text-center"><?php echo "Factura N.-".$title; ?></h4>
    </div>
    <br>
    <div class="form-group row">
        <div class="col-sm-4 mb-4 mb-sm-0">
            &nbsp;<label class="large mb-1"><strong>Cliente : </strong><?php echo $cliente[0]['nombre'] . " ", $cliente[0]['apellido']; ?> </label>
        </div>

        <div class="col-sm-4 mb-4 mb-sm-0">
            &nbsp;<label class="large mb-1"><strong>Cedula : </strong><?php echo $cliente[0]['cedula']; ?> </label>

        </div>
        <div class="col-sm-4 mb-4 mb-sm-0">
            &nbsp;<label class="large mb-1"><strong>Telefono : </strong><?php echo $cliente[0]['telefono']; ?> </label>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-12 mb-12 mb-sm-0">
            &nbsp;<label class="large mb-1"><strong>Direccion : </strong><?php echo $cliente[0]['direccion']; ?> </label>
        </div>
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">CODIGO</th>
                    <th scope="col">DESCRIPCION</th>
                    <th scope="col">V. UNIT</th>
                    <th scope="col">V. TOTAL</th>
                </tr>
            </thead>
            <?php $precio = 0 ?>
            <?php $total = 0 ?>
            <?php foreach ($fdetalles as $key => $value) { ?>
                <?php if ($value['estado'] == 1) { ?>
                    <?php $precio = $value['preciopublico']; ?>

                <?php } ?>

                <?php if ($value['estado'] == 2) { ?>
                    <?php $precio = $value['preciomayorista']; ?>
                <?php } ?>
                <?php $total = $precio * $value['cantidad']; ?>
                <tr>
                    <td><?php echo $value['cantidad']; ?></td>
                    <td><?php echo $value['codigo']; ?></td>
                    <td><?php echo $value['producto']; ?></td>
                    <td><?php echo "$ " . $precio; ?></td>
                    <td><?php echo "$ " . $total; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" class="text-right"><strong>SUBTOTAL</strong></td>
                <td colspan="1"><?php echo "$ " . $fencabezado[0]['subtotal']; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>IVA 12%</strong></td>
                <td colspan="1"><?php echo "$ " . $fencabezado[0]['iva']; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>TOTAL</strong></td>
                <td colspan="1"><?php echo "$ " . $fencabezado[0]['total']; ?></td>
            </tr>
        </table>


    </div>
</div <?= $this->endSection() ?>