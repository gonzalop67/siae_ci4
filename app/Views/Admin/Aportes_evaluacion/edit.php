<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Aportes de Evaluación
<?= $this->endsection('titulo') ?>

<?= $this->section('styles') ?>
<!-- jquery-ui -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/plugins/jquery-ui/jquery-ui.css">
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
                            Aportes de Evaluación
                            <small>Editar</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-warning btn-sm" href="<?= base_url(route_to('aportes_evaluacion')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('aportes_evaluacion_update'))) ?>" method="POST" autocomplete="off">
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
                            <input type="hidden" name="id_aporte_evaluacion" value="<?= $aporte_evaluacion->id_aporte_evaluacion ?>">
                            <div class="form-group row <?= session('errors.ap_nombre') ? 'has-error' : '' ?>">
                                <label for="ap_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ap_nombre" id="ap_nombre" value="<?= old('ap_nombre') ?? $aporte_evaluacion->ap_nombre ?>" autofocus>
                                    <span class="help-block"><?= session('errors.ap_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.ap_abreviatura') ? 'has-error' : '' ?>">
                                <label for="mo_nombre" class="col-sm-2 col-form-label requerido">Abreviatura:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ap_abreviatura" id="ap_abreviatura" value="<?= old('ap_abreviatura') ?? $aporte_evaluacion->ap_abreviatura ?>">
                                    <span class="help-block"><?= session('errors.ap_abreviatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.ap_fecha_apertura') ? 'has-error' : '' ?>">
                                <label for="mo_nombre" class="col-sm-2 col-form-label requerido">Fecha de inicio:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="cursor: pointer;"><i class="far fa-calendar-alt" onclick="$('#ap_fecha_apertura').focus();"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="ap_fecha_apertura" id="ap_fecha_apertura" value="<?= old('ap_fecha_apertura') ?? $aporte_evaluacion->ap_fecha_apertura ?>">
                                    </div>
                                    <!-- /.input group -->
                                    <span class="help-block"><?= session('errors.ap_fecha_apertura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.ap_fecha_cierre') ? 'has-error' : '' ?>">
                                <label for="mo_nombre" class="col-sm-2 col-form-label requerido">Fecha de fin:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" style="cursor: pointer;"><i class="far fa-calendar-alt" onclick="$('#ap_fecha_cierre').focus();"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="ap_fecha_cierre" id="ap_fecha_cierre" value="<?= old('ap_fecha_cierre') ?? $aporte_evaluacion->ap_fecha_cierre ?>">
                                    </div>
                                    <!-- /.input group -->
                                    <span class="help-block"><?= session('errors.ap_fecha_cierre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_periodo_evaluacion" class="col-sm-2 col-form-label requerido">Periodo:</label>
                                <div class="col-sm-10">
                                    <select name="id_periodo_evaluacion" id="id_periodo_evaluacion" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($periodos_evaluacion as $v) : ?>
                                            <option value="<?= $v->id_periodo_evaluacion; ?>" <?= old('id_periodo_evaluacion') == $v->id_periodo_evaluacion ? 'selected' : ($v->id_periodo_evaluacion == $aporte_evaluacion->id_periodo_evaluacion ? 'selected' : '') ?>><?= $v->pe_nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_periodo_evaluacion') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_tipo_aporte" class="col-sm-2 col-form-label requerido">Tipo:</label>
                                <div class="col-sm-10">
                                    <select name="id_tipo_aporte" id="id_tipo_aporte" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($tipos_aporte as $v) : ?>
                                            <option value="<?= $v->id_tipo_aporte; ?>" <?= old('id_tipo_aporte') == $v->id_tipo_aporte ? 'selected' : ($v->id_tipo_aporte == $aporte_evaluacion->id_tipo_aporte ? 'selected' : '') ?>><?= $v->ta_descripcion; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_tipo_aporte') ?></span>
                                </div>
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

<?= $this->section('scriptsPlugins') ?>
    <!-- jquery-ui -->
    <script src="<?php echo base_url(); ?>/public/plugins/jquery-ui/jquery-ui.js"></script>
<?= $this->endsection('scriptsPlugins') ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function(){
        // JQuery Listo para utilizar
        $("#ap_fecha_apertura").datepicker({
            dateFormat : 'yy-mm-dd',
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            firstDay: 1
        });
        $("#ap_fecha_cierre").datepicker({
            dateFormat : 'yy-mm-dd',
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            firstDay: 1
        });
    });
</script>
<?= $this->endsection('scripts') ?>
