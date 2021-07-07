  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center">
        <a href="#" class="brand-link">
         <img src="<?php echo base_url(); ?>/public/dist/img/<?php echo session("foto") ?>"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"> 
        <span class="brand-text font-weight-light"><b>SIAE 2</b> <small>(<?php echo session('periodo') ?>)</small></span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mb-3 text-center">
        <div class="info">
          <a href="#" class="d-block"><?php echo session('nombre') ?><br><?php echo session('rol_name') ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url(route_to('dashboard')); ?>" 
              class="nav-link <?= service('request')->uri->getPath() == 'auth/dashboard' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php 
            $model = model('Menus_model');
            $menusNivel1 = $model->listarMenusNivel1(session("id_perfil")); 
            foreach($menusNivel1 as $menu) {
                if(count($model->listarMenusHijos($menu->id_menu)) > 0) { ?>
                    <li class="nav-item has-treeview">                        
                        <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-laptop"></i> 
                          <p>
                            <?php echo $menu->mnu_texto; ?>
                              <i class="right fas fa-angle-left"></i>
                          </p> 
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($model->listarMenusHijos($menu->id_menu) as $menu2) { ?>
                                <li class="nav-item">
                                  <a href="<?php echo base_url() . $menu2->mnu_link; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                      <?php echo $menu2->mnu_texto; ?>
                                    </p>
                                  </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li> 
                <?php } else { ?>
                    <li class="nav-item">                        
                        <a href="<?php echo base_url() . $menu->mnu_link; ?>" class="nav-link">
                          <i class="nav-icon fas fa-laptop"></i>
                          <p>
                            <?php echo $menu->mnu_texto; ?>
                          </p>
                        </a>
                    </li> 
                <?php } 
            }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>