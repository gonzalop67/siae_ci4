<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Modalidades
<?= $this->endsection('titulo') ?>

<?= $this->section('contenido') ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="card card-info mt-2">
                    <div class="card-header">
                        <h3 class="card-title">
                            Modalidades
                            <small>Listado</small>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="row">
                        <div class="col-md-2">
                            <a class="btn btn-primary btn-md mt-2 ml-2" href="<?= base_url(route_to('modalidades_create')) ?>">Crear Modalidad</a>
                        </div>
                    </div>
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
                    <hr>
                    <div class="card-body">
                        <table id="t_modalidades" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_modalidades">
                                <?php foreach ($modalidades as $v) : ?>
                                    <tr>
                                        <td><?= $v->id_modalidad ?></td>
                                        <td><?= $v->mo_nombre ?></td>
                                        <td><?= $v->mo_activo == 1 ? 'Sí' : 'No' ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url(route_to('modalidades_edit', $v->id_modalidad)) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url(route_to('modalidades_delete', $v->id_modalidad)) ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-times-circle"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <?= $pager->links() ?>
                    </div>
                    
                    <!-- form start -->
                    <!-- <form class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                        <label class="form-check-label" for="exampleCheck2">Remember me</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- /.card-body -->
                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-info">Sign in</button>
                            <button type="submit" class="btn btn-default float-right">Cancel</button>
                        </div> -->
                        <!-- /.card-footer -->
                    <!-- </form> -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<?= $this->endsection('contenido') ?>