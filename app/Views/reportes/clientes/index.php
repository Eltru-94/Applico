<?= $this->extend('plantilla/layout') ?>
<?= $this->section('titulo') ?>
<?php echo $title; ?>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<br>

<?= $this->include('reportes/clientes/tabla') ?>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<?= $this->include('reportes/clientes/cliente') ?>
<?= $this->endSection() ?>