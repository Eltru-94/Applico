<?= $this->extend('plantilla/layout')?>

<?= $this->section('titulo')?>
<?php echo $title;?>
<?= $this->endSection()?>
<?= $this->section('contenido')?>
<br>
<?=$this->include('productos/formulario')?>
<?=$this->include('productos/tabla')?>

<?= $this->endSection()?>


<?= $this->section('scripts')?>
<?=$this->include('productos/productos')?>
<?= $this->endSection()?>