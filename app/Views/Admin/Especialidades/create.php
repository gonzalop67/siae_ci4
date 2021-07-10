<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Crear Especialidades
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
                <div class="card card-success mt-2">
                    <div class="card-header">
                        <h3 class="card-title">
                            Especialidades
                            <small>Crear</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-success btn-sm" href="<?= base_url(route_to('especialidades')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('especialidades_store'))) ?>" method="POST" autocomplete="off">
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
                            <div class="form-group row <?= session('errors.es_nombre') ? 'has-error' : '' ?>">
                                <label for="es_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="es_nombre" id="es_nombre" value="<?= old('es_nombre') ?>" autofocus>
                                    <span class="help-block"><?= session('errors.es_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.es_figura') ? 'has-error' : '' ?>">
                                <label for="es_figura" class="col-sm-2 col-form-label requerido">Figura Profesional:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="es_figura" id="es_figura" value="<?= old('es_figura') ?>">
                                    <span class="help-block"><?= session('errors.es_figura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.es_abreviatura') ? 'has-error' : '' ?>">
                                <label for="es_abreviatura" class="col-sm-2 col-form-label requerido">Abreviatura:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="es_abreviatura" id="es_abreviatura" value="<?= old('es_abreviatura') ?>">
                                    <span class="help-block"><?= session('errors.es_abreviatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_tipo_educacion" class="col-sm-2 col-form-label requerido">Nivel de Educación:</label>
                                <div class="col-sm-10">
                                    <select name="id_tipo_educacion" id="id_tipo_educacion" class="form-control">
                                        <?php foreach ($tipos_educacion as $tipo_educacion) : ?>
                                            <option value="<?= $tipo_educacion->id_tipo_educacion; ?>"><?= $tipo_educacion->te_nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_tipo_educacion') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        <button type="button" class="btn btn-default" onclick="limpiar()">Limpiar</button>
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

<?= $this->section('scripts') ?>
<script src="<?php echo base_url(); ?>/public/js/admin/especialidades/crear.js"></script>
<?= $this->endsection('scripts') ?>