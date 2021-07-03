<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SIAE Web 2 | Log in</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Estilos propios de esta pagina -->
    <style type="text/css">
        .error {
            color: #F00;
            display: none;
        }

        .blanco {
            color: #FFF;
        }
    </style>
</head>

<body class="hold-transition login-page" style="background: url('<?php echo base_url(); ?>/public/images/loginFont.jpg')">
    <div class="login-box blanco">
        <div class="login-logo">
            <h2>S. I. A. E.</h2>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Introduzca sus datos de ingreso</p>
                <?php if (session('msg')) : ?>
                    <div class="alert alert-<?= session('msg.type') ?>">
                        <span><i class="icon fas fa-<?= session('msg.icon') ?>"></i> <?= session('msg.body') ?></span>
                    </div>
                <?php endif ?>
                <form id="form-login" action="<?php echo base_url(route_to('signin')); ?>" method="post" autocomplete="off">
                    <div class="input-group mb-2 has-feedback">
                        <input type="text" class="form-control" placeholder="Usuario" id="username" name="username" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="form-control-feedback">
                                    <img src="<?php echo base_url(); ?>/public/images/if_user_male_172625.png" height="16px" width="16px">
                                </span>
                            </div>
                        </div>
                    </div>
                    <span class="help-desk error" id="mensaje1">Debe ingresar su nombre de Usuario</span>
                    <div class="input-group mb-2 has-feedback">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="form-control-feedback">
                                    <img src="<?php echo base_url(); ?>/public/images/if_91_171450.png" height="16px" width="16px">
                                </span>
                            </div>
                        </div>
                    </div>
                    <span class="help-desk error" id="mensaje2">Debe ingresar su Password</span>
                    <div class="row mb-3">
                        <div class="col-12">
                            <select class="form-control" id="cboPeriodo" name="cboPeriodo">
                                <option value="">Seleccione el periodo lectivo...</option>
                                <?php foreach ($periodos_lectivos as $periodo_lectivo) : ?>
                                    <option value="<?php echo $periodo_lectivo->id_periodo_lectivo; ?>">
                                        <?php echo $periodo_lectivo->pe_anio_inicio . " - " . $periodo_lectivo->pe_anio_fin . " [" . $periodo_lectivo->pe_descripcion . "]"; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <span class="help-desk error" id="mensaje3">Debe seleccionar el periodo lectivo</span>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <select class="form-control" id="cboPerfil" name="cboPerfil">
                                <option value="">Seleccione su perfil...</option>
                                <?php foreach ($perfiles as $perfil) : ?>
                                    <option value="<?php echo $perfil->id_perfil; ?>"><?php echo $perfil->pe_nombre; ?></option>
                                <?php endforeach ?>
                            </select>
                            <span class="help-desk error" id="mensaje4">Debe seleccionar su perfil</span>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="btnEnviar" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer style="text-align: center; color: white;">
        .: &copy; <?php echo date("  Y"); ?> - <?php echo $nombreInstitucion; ?> :.
    </footer>
    <script src="<?php echo base_url(); ?>/public/js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#btnEnviar").click(function() {
                nombre = $("#username").val();
                password = $("#password").val();
                periodo = $("#cboPeriodo").val();
                perfil = $("#cboPerfil").val();
                errors = 0;

                if (nombre == "") {
                    $("#mensaje1").fadeIn("slow");
                    errors++;
                } else {
                    $("#mensaje1").fadeOut();
                }
                if (password == "") {
                    $("#mensaje2").fadeIn("slow");
                    errors++;
                } else {
                    $("#mensaje2").fadeOut();
                }
                if (periodo == "") {
                    $("#mensaje3").fadeIn("slow");
                    errors++;
                } else {
                    $("#mensaje3").fadeOut();
                }
                if (perfil == "") {
                    $("#mensaje4").fadeIn("slow");
                    errors++;
                } else {
                    $("#mensaje4").fadeOut();
                }

                if (errors > 0) {
                    return false;
                }
            });
        });
    </script>
</body>

</html>