<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Logo -->
    <a href="{{ url('') }}" class="brand-link">
        <img src="{{ asset('vendor/cesi/core/img/logo.png') }}"
             alt="{{ config('cesi.core.project_name') }}"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('cesi.core.project_name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php

                $traverse = function ($menus) use (&$traverse) {
                    foreach ($menus as $menu) {
                        $submenus = count($menu->children);
                        $lpermitido = $menu->checkTieneAlgunPermiso();

                        if ($lpermitido) {
                            if ($submenus) {
                                echo "<li class='nav-item has-treeview'>\n";
                            } else {
                                echo "<li class='nav-item'>\n";
                            }

                            echo '<a href="' . $menu->getUrl() . '" title="' .$menu->link. '" class="nav-link">';
                            if ($menu->icon) {
                                echo '<i class="nav-icon fas ' . $menu->icon . '"></i>';
                            }
                            echo '<p>' . $menu->name . '</p>';
                            if ($submenus) {
                                echo '<i class="right fas fa-angle-left"></i>';
                            }
                            echo "</a>\n";

                            if ($submenus) {
                                echo "<ul class='nav nav-treeview'>\n";
                                $traverse($menu->children);
                                echo "</ul>\n";
                            }
                            echo "</li>\n";
                        }
                    }
                };

                // $menuRoot = Cesi\Core\app\Models\CoreMenu::get()->first();
                $menuRoot = Cesi\Core\app\Models\CoreMenu::whereIsRoot()->first();
                $traverse($menuRoot->children);
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!-- /Main Sidebar Container -->