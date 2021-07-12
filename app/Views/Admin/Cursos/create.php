<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Crear Curso
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
                            Cursos
                            <small>Crear</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-success btn-sm" href="<?= base_url(route_to('cursos')) ?>"><i class="fa fa-fw fa-reply-all"></i> Volver al listado</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="<?= base_url((route_to('cursos_store'))) ?>" method="POST" autocomplete="off">
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
                            <div class="form-group row <?= session('errors.cu_nombre') ? 'has-error' : '' ?>">
                                <label for="cu_nombre" class="col-sm-2 col-form-label requerido">Nombre:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="cu_nombre" id="cu_nombre" value="<?= old('cu_nombre') ?>" autofocus>
                                    <span class="help-block"><?= session('errors.cu_nombre') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.cu_shortname') ? 'has-error' : '' ?>">
                                <label for="cu_shortname" class="col-sm-2 col-form-label requerido">Nombre Corto:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="cu_shortname" id="cu_shortname" value="<?= old('cu_shortname') ?>">
                                    <span class="help-block"><?= session('errors.cu_shortname') ?></span>
                                </div>
                            </div>
                            <div class="form-group row <?= session('errors.cu_abreviatura') ? 'has-error' : '' ?>">
                                <label for="cu_abreviatura" class="col-sm-2 col-form-label requerido">Abreviatura:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="cu_abreviatura" id="cu_abreviatura" value="<?= old('cu_abreviatura') ?>">
                                    <span class="help-block"><?= session('errors.cu_abreviatura') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quien_inserta_comp" class="col-sm-2 col-form-label requerido">¿Quién inserta comportamiento?</label>
                                <div class="col-sm-10">
                                    <select name="quien_inserta_comp" id="quien_inserta_comp" class="form-control">
                                        <option value="0" <?= old('quien_inserta_comp') == 0 ? 'selected' : '' ?>>Docente</option>
                                        <option value="1" <?= old('quien_inserta_comp') == 1 ? 'selected' : '' ?>>Tutor</option>
                                    </select>
                                    <span class="help-block"><?= session('errors.quien_inserta_comp') ?></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_especialidad" class="col-sm-2 col-form-label requerido">Especialidad:</label>
                                <div class="col-sm-10">
                                    <select name="id_especialidad" id="id_especialidad" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <?php foreach ($especialidades as $especialidad) : ?>
                                            <option value="<?= $especialidad->id_especialidad; ?>" <?= old('id_especialidad') == $especialidad->id_especialidad ? 'selected' : '' ?>><?= $especialidad->es_figura; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block"><?= session('errors.id_especialidad') ?></span>
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
<script src="<?php echo base_url(); ?>/public/js/admin/cursos/crear.js"></script>
<?= $this->endsection('scripts') ?>