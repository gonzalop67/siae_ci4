<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Crear Periodo de Educación
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
                            Periodo de Educación
                            <small>Crear</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-success btn-sm" href="<?= base_url(route_to('periodos_evaluacion')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('periodos_evaluacion_store'))) ?>" method="POST" autocomplete="off">
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
                            <div class="form-group row <?= session('errors.pe_nombre') ? 'has-error' : '' ?>">
                                <label for="pe_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pe_nombre" id="pe_nombre" value="<?= old('pe_nombre') ?>" autofocus>
                                    <span class="help-block"><?= session('errors.pe_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.pe_abreviatura') ? 'has-error' : '' ?>">
                                <label for="pe_abreviatura" class="col-sm-2 col-form-label requerido">Abreviatura:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pe_abreviatura" id="pe_abreviatura" value="<?= old('pe_abreviatura') ?>" autofocus>
                                    <span class="help-block"><?= session('errors.pe_abreviatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.id_tipo_periodo') ? 'has-error' : '' ?>">
                                <label for="id_tipo_periodo" class="col-sm-2 col-form-label requerido">Tipo Periodo:</label>
                                <div class="col-sm-10">
                                    <select name="id_tipo_periodo" id="id_tipo_periodo" class="form-control">
                                    <option value="">Seleccione...</option>
                                        <?php foreach($tipos_periodo as $tipo_periodo): ?>
                                        <option value="<?=$tipo_periodo->id_tipo_periodo;?>" <?= old('id_tipo_periodo') == $tipo_periodo->id_tipo_periodo ? 'selected' : '' ?>><?=$tipo_periodo->tp_descripcion;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_tipo_periodo') ?></span>
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
<script src="<?php echo base_url(); ?>/public/js/admin/periodos_evaluacion/crear.js"></script>
<?= $this->endsection('scripts') ?>