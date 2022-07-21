<?= $this->extend('plantilla/layout')?>
<?= $this->section('titulo')?>
<?php echo $title;?>
<?= $this->endSection()?>

<?= $this->section('contenido')?>
<br>
<?=$this->include('productos/categoria/formulario')?>
<?=$this->include('productos/categoria/tabla')?>

<?= $this->endSection()?>


<?= $this->section('scripts')?>
<?=$this->include('productos/categoria/categoria')?>
<?= $this->endSection()?>