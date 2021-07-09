<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Niveles de Educación
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
                            Niveles de Educación
                            <small>Listado</small>
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-outline-primary btn-sm" href="<?= base_url(route_to('tipos_educacion_create')) ?>"><i class="fa fa-fw fa-plus-circle"></i> Nuevo registro</a>
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
                        <table id="t_niveles_educacion" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>¿Es Bachillerato?</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_niveles_educacion">
                                <?php foreach ($tipos_educacion as $v) : ?>
                                    <tr data-index="<?= $v->id_tipo_educacion ?>" data-orden="<?= $v->te_orden ?>">
                                        <td><?= $v->id_tipo_educacion ?></td>
                                        <td><?= $v->te_nombre ?></td>
                                        <td><?= $v->te_bachillerato == 1 ? 'Sí' : 'No' ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url(route_to('tipos_educacion_edit', $v->id_tipo_educacion)) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
                                                <a href="<?= base_url(route_to('tipos_educacion_delete', $v->id_tipo_educacion)) ?>" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-times-circle"></i></a>
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

<?= $this->section('scriptsPlugins') ?>
<script src="<?php echo base_url(); ?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
<?= $this->endsection('scriptsPlugins') ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {

    $('table tbody').sortable({
        update: function(event, ui) {
            $(this).children().each(function(index) {
                if ($(this).attr('data-orden') != (index + 1)) {
                    $(this).attr('data-orden', (index + 1)).addClass('updated');
                }
            });
            saveNewPositions();
        }
    });

});

function saveNewPositions() {
    var positions = [];
    $('.updated').each(function() {
        positions.push([$(this).attr('data-index'), $(this).attr('data-orden')]);
        $(this).removeClass('updated');
    });

    $.ajax({
        url: "<?= base_url(route_to('tipos_educacion_saveNewPositions')) ?>",
        method: 'POST',
        dataType: 'text',
        data: {
            positions: positions
        },
        success: function(response) {
            console.log(response);
        }
    });
}
</script>
<?= $this->endsection('scripts') ?>