<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Editar Modalidad
<?= $this->endsection('titulo') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/custom.css">
<?= $this->endsection('styles') ?>

<?= $this->section('contenido') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-warning mt-2">
                    <div class="card-header">
                        <h3 class="card-title">
                            Modalidades
                            <small>Editar</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-warning btn-sm" href="<?= base_url(route_to('modalidades')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('modalidades_update'))) ?>" method="POST" autocomplete="off">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <?php if (session('msg')) : ?>
                                        <div class="alert alert-<?= session('msg.type') ?> alert-dismissible" style="margin-top: 2px">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <p><i class="icon fa fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></p>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <input type="hidden" name="id_modalidad" id="id_modalidad" value="<?= $modalidad->id_modalidad ?>">
                            <div class="form-group row <?= session('errors.mo_nombre') ? 'has-error' : '' ?>">
                                <label for="mo_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="mo_nombre" id="mo_nombre" value="<?= old('mo_nombre') ?? $modalidad->mo_nombre ?>" autofocus>
                                    <span class="help-block"><?= session('errors.mo_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mo_activo" class="col-sm-2 col-form-label requerido">Activo:</label>
                                <div class="col-sm-10">
                                    <select name="mo_activo" id="mo_activo" class="form-control">
                                        <option value="1" <?= old('mo_activo') ?? $modalidad->mo_activo == 1 ? 'selected' : '' ?>>S??</option>
                                        <option value="0" <?= old('mo_activo') ?? $modalidad->mo_activo == 0 ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endsection('contenido') ?>