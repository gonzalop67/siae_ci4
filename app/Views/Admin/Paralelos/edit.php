<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Editar Paralelo
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
                <div class="card card-paralelos mt-2">
                    <div class="card-header">
                        <h3 class="card-title">
                            Paralelos
                            <small>Editar</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-paralelos btn-sm" href="<?= base_url(route_to('paralelos')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('paralelos_update'))) ?>" method="POST" autocomplete="off">
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
                            <input type="hidden" name="id_paralelo" value="<?= $paralelo->id_paralelo ?>">
                            <div class="form-group row <?= session('errors.pa_nombre') ? 'has-error' : '' ?>">
                                <label for="pa_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pa_nombre" id="pa_nombre" value="<?= old('pa_nombre') ?? $paralelo->pa_nombre ?>" autofocus>
                                    <span class="help-block"><?= session('errors.pa_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_curso" class="col-sm-2 col-form-label requerido">Curso:</label>
                                <div class="col-sm-10">
                                    <select name="id_curso" id="id_curso" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($cursos as $curso) : ?>
                                            <option value="<?= $curso->id_curso; ?>" <?= old('id_curso') ?? $curso->id_curso == $paralelo->id_curso ? 'selected' : '' ?>><?= "[" . $curso->es_figura . "] " . $curso->cu_nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_curso') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_jornada" class="col-sm-2 control-label requerido">Jornada:</label>
                                <div class="col-sm-10">
                                    <select name="id_jornada" id="id_jornada" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach($jornadas as $jornada): ?>
                                        <option value="<?=$jornada->id_jornada;?>" <?= old('id_jornada') ?? $jornada->id_jornada == $paralelo->id_jornada ? 'selected' : '' ?>><?=$jornada->jo_nombre;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_jornada') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Guardar</button>
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
