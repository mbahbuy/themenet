  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $title == 'dashboard' ? 'javascript:void(0)' : url_to('dashboard') ?>" class="brand-link">
      <img src="/template/adminLTE/dist/img/logo.png" alt="Satu Media Digital Indonesia" class="brand-image img-fluid elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SatuMedia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= $hal == 'dashboard/index' ? 'javascript:void(0)' : url_to('dashboard') ?>" class="nav-link <?= $hal == 'dashboard/index' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php if (in_groups(['admin', 'redaktur', 'contributor', 'editor'], user_id())):?>
            <li class="nav-item  <?= strpos($hal, 'article') !== false ? 'menu-open' : '' ?>">
              <a href="javascript:void(0)" class="nav-link <?= strpos($hal, 'article') !== false ? 'active' : '' ?>">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Editorial
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= $hal == 'article/form' ? 'javascript:void(0)' : url_to('article.form') ?>" class="nav-link <?= $hal == 'article/form' ? 'active' : '' ?>">
                    <p class="ml-4">Form article</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= $hal == 'article/list' ? 'javascript:void(0)' : url_to('article.index') ?>" class="nav-link <?= $hal == 'article/list' ? 'active' : '' ?>">
                    <p class="ml-4">List article</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item  <?= strpos($hal, 'gallery') !== false ? 'menu-open' : '' ?>">
              <a href="javascript:void(0)" class="nav-link <?= strpos($hal, 'gallery') !== false ? 'active' : '' ?>">
                <i class="nav-icon far fa-image"></i>
                <p>
                  Gallery
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= $hal == 'gallery/foto' ? 'javascript:void(0)' : url_to('gallery.foto') ?>" class="nav-link <?= $hal == 'gallery/foto' ? 'active' : '' ?>">
                    <p class="ml-4">Foto</p>
                  </a>
                </li>
              </ul>
            </li>
            <?php if(in_groups(['admin', 'redaktur'], user_id())): ?>
              <li class="nav-item  <?= strpos($hal, 'report') !== false ? 'menu-open' : '' ?>">
                <a href="javascript:void(0)" class="nav-link <?= strpos($hal, 'report') !== false ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Report
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= $hal == 'report/page_view' ? 'javascript:void(0)' : url_to('report.page_view') ?>" class="nav-link <?= $hal == 'report/page_view' ? 'active' : '' ?>">
                      <p class="ml-4">Page View</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'report/page_active' ? 'javascript:void(0)' : url_to('report.page_active') ?>" class="nav-link <?= $hal == 'report/page_active' ? 'active' : '' ?>">
                      <p class="ml-4">Page Active</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'report/rubrik' ? 'javascript:void(0)' : url_to('report.rubrik') ?>" class="nav-link <?= $hal == 'report/rubrik' ? 'active' : '' ?>">
                      <p class="ml-4">Rubrik</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'report/tag' ? 'javascript:void(0)' : url_to('report.tag') ?>" class="nav-link <?= $hal == 'report/tag' ? 'active' : '' ?>">
                      <p class="ml-4">Tag</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'report/top_search' ? 'javascript:void(0)' : url_to('report.top_search') ?>" class="nav-link <?= $hal == 'report/top_search' ? 'active' : '' ?>">
                      <p class="ml-4">Top Search</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item  <?= strpos($hal, 'preference') !== false ? 'menu-open' : '' ?>">
                <a href="javascript:void(0)" class="nav-link <?= strpos($hal, 'preference') !== false ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-sliders-h"></i>
                  <p>
                    Preference
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= $hal == 'preference/rubrik' ? 'javascript:void(0)' : url_to('preference.rubrik') ?>" class="nav-link <?= $hal == 'preference/rubrik' ? 'active' : '' ?>">
                      <p class="ml-4">Rubrik</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'preference/tag' ? 'javascript:void(0)' : url_to('preference.tag') ?>" class="nav-link <?= $hal == 'preference/tag' ? 'active' : '' ?>">
                      <p class="ml-4">Tag</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= $hal == 'preference/template' ? 'javascript:void(0)' : url_to('preference.template') ?>" class="nav-link <?= $hal == 'preference/template' ? 'active' : '' ?>">
                      <p class="ml-4">Template</p>
                    </a>
                  </li>
                  <?php if(in_groups('admin', user_id())): ?>
                  <li class="nav-item">
                    <a href="<?= $hal == 'preference/user' ? 'javascript:void(0)' : url_to('preference.user') ?>" class="nav-link <?= $hal == 'preference/user' ? 'active' : '' ?>">
                      <p class="ml-4">User</p>
                    </a>
                  </li>
                  <?php endif; ?>
                </ul>
              </li>
            <?php endif; ?>
          <?php endif; ?>
          <!-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/uplot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>uPlot</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>