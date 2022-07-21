<?= $this->extend('plantilla/layout')?>

<?= $this->section('titulo')?>
<?php echo $title ?>
<?= $this->endSection()?>



<?= $this->section('contenido')?>
<br>
<br>
<?=$this->include('plantilla/cards') ?>

<?= $this->endSection()?>

/*Scripts Inicio*/
<?= $this->section('scripts')?>
<?=$this->include('administrador/inicio') ?>
<?= $this->endSection()?>
