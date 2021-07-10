<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Especialidades
<?= $this->endsection('titulo') ?>

<?= $this->section('contenido') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-primary mt-2">
                    <div class="card-header">
                        <h3 class="card-title">
                            Especialidades
                            <small>Listado</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" href="<?= base_url(route_to('especialidades_create')) ?>"><i class="fa fa-fw fa-plus-circle"></i> Nuevo registro</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
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
                        <table id="t_modalidades" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Figura</th>
                                    <th>Nivel de Educación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_especialidades">
                                <?php foreach ($especialidades as $v) : ?>
                                    <tr data-index="<?= $v->id_especialidad ?>" data-orden="<?= $v->es_orden ?>">
                                        <td><?= $v->id_especialidad ?></td>
                                        <td><?= $v->es_nombre ?></td>
                                        <td><?= $v->es_figura ?></td>
                                        <td><?= $v->te_nombre ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url(route_to('especialidades_edit', $v->id_especialidad)) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url(route_to('especialidades_delete', $v->id_especialidad)) ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-times-circle"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <?= $pager->links() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endsection('contenido') ?>