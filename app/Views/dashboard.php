<?= $this->extend('layouts/layout') ?>

<?= $this->section('titulo') ?>
Dashboard
<?= $this->endsection('titulo') ?>

<?= $this->section('contenido') ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              Dashboard
              <small>Sistema Integrado de Administración Estudiantil</small>
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>2</h3>

                <p>Autoridades</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>17</h3>

                <p>Docentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>475</h3>

                <p>Estudiantes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>23</h3>

                <p>Representantes</p>
              </div>
              <div class="icon">
                <i class="ion ion-woman"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
<?= $this->endsection('contenido') ?>

