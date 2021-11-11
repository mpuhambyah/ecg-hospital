<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url() ?>assets/img/dokter/avatar/avatar-1.png" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?= $user['name'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php if ($user['role_id'] == 1) { ?>
                    <a href="<?= base_url() ?>dokter/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="<?= base_url() ?>dokter/gantiPassword" class="dropdown-item has-icon">
                        <i class="fas fa-key"></i> Ganti Password
                    </a>
                <?php } else if ($user['role_id'] == 2) { ?>
                    <a href="<?= base_url() ?>alat/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="<?= base_url() ?>alat/gantiPassword" class="dropdown-item has-icon">
                        <i class="fas fa-key"></i> Ganti Password
                    </a>
                <?php } else if ($user['role_id'] == 3) { ?>
                    <a href="<?= base_url() ?>pasien/profile" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="<?= base_url() ?>pasien/gantiPassword" class="dropdown-item has-icon">
                        <i class="fas fa-key"></i> Ganti Password
                    </a>
                <?php } ?>
                <a class="dropdown-item has-icon text-danger" data-toggle="modal" data-target="#logoutModal">
                    <b><i class="fas fa-door-open"></i> Logout</b>
                </a>
            </div>
        </li>
    </ul>
</nav>