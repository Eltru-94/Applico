<?= $this->extend('plantilla/layout')?>

<?= $this->section('titulo')?>
<?php echo $title;?>
<?= $this->endSection()?>
<?= $this->section('contenido')?>
<br>

<?=$this->include('caja/tabla')?>

<?= $this->endSection()?>


<?= $this->section('scripts')?>
<?=$this->include('caja/caja')?>
<?= $this->endSection()?>