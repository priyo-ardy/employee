<aside class="app-sidebar bg-body-secondary" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="<?= base_url() . 'MainMenu'; ?>" class="brand-link">
            <img
                src="<?= base_url() . 'img/favicon.png'; ?>"
                alt="Schlemmer Indonesia"
                class="brand-image opacity-75" />
            <span class="brand-text fw-light">Schlemmer Indonesia</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-header">DASHBOARD</li>
                <li class="nav-item">
                    <a href="<?= base_url() . 'dashboard' ?>" class="nav-link">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">TRANSACTION</li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item"></li>
                <li class="nav-header">APP SETUP</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-gear"></i>
                        <p>
                            User Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users') ?>" class="nav-link" onclick="loading()">
                                <i class="nav-icon bi bi-arrow-right-circle"></i>
                                <p>
                                    User List
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() . 'logout' ?>" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-left"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>