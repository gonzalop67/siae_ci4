<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIAE Web 2 | <?= $this->renderSection('titulo') ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Inicio Header -->
        <?= $this->include('layouts/header') ?>
        <!-- Fin Header -->

        <!-- Inicio Aside -->
        <?= $this->include('layouts/aside') ?>
        <!-- Fin Aside -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Inicio Content -->
            <section class="content">
                <?= $this->renderSection('contenido') ?>
            </section>
            <!-- Fin Content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Inicio Footer -->
        <?= $this->include('layouts/footer') ?>
        <!-- Fin Footer -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url(); ?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/public/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>/public/dist/js/demo.js"></script>

    <?= $this->renderSection('scriptsPlugins') ?>

    <?= $this->renderSection('scripts') ?>
</body>

</html>