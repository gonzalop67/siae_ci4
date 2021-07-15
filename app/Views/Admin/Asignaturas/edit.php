<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Crear Asignatura
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
                            Asignaturas
                            <small>Crear</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-success btn-sm" href="<?= base_url(route_to('asignaturas')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('asignaturas_update'))) ?>" method="POST" autocomplete="off">
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
                            <input type="hidden" name="id_asignatura" value="<?= $asignatura->id_asignatura ?>">
                            <div class="form-group row <?= session('errors.as_nombre') ? 'has-error' : '' ?>">
                                <label for="as_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="as_nombre" id="as_nombre" value="<?= old('as_nombre') ?? $asignatura->as_nombre ?>" autofocus>
                                    <span class="help-block"><?= session('errors.as_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.as_abreviatura') ? 'has-error' : '' ?>">
                                <label for="mo_nombre" class="col-sm-2 col-form-label requerido">Abreviatura:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="as_abreviatura" id="as_abreviatura" value="<?= old('as_abreviatura') ?? $asignatura->as_abreviatura ?>" autofocus>
                                    <span class="help-block"><?= session('errors.as_abreviatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_tipo_asignatura" class="col-sm-2 col-form-label requerido">Tipo de Asignatura:</label>
                                <div class="col-sm-10">
                                    <select name="id_tipo_asignatura" id="id_tipo_asignatura" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($tipos_asignatura as $tipo_asignatura) : ?>
                                            <?php
                                            $selected = '';
                                            if (!empty(old('id_tipo_asignatura'))) {
                                                if (old('id_tipo_asignatura') == $tipo_asignatura->id_tipo_asignatura) {
                                                    $selected = 'selected';
                                                }
                                            } else {
                                                if ($asignatura->id_tipo_asignatura == $tipo_asignatura->id_tipo_asignatura) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option value="<?= $tipo_asignatura->id_tipo_asignatura; ?>" <?= $selected ?>><?= $tipo_asignatura->ta_descripcion; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_tipo_asignatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_area" class="col-sm-2 col-form-label requerido">Area:</label>
                                <div class="col-sm-10">
                                    <select name="id_area" id="id_area" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($areas as $area) : ?>
                                            <?php
                                            $selected = '';
                                            if (!empty(old('id_area'))) {
                                                if (old('id_area') == $area->id_area) {
                                                    $selected = 'selected';
                                                }
                                            } else {
                                                if ($asignatura->id_area == $area->id_area) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            ?>
                                            <option value="<?= $area->id_area; ?>" <?= $selected ?>><?= $area->ar_nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_area') ?></span>
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
