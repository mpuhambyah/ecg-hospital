<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url() ?>admin/"><?= $profile['title'] ?></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img width="30" height="30" alt="" src="<?= base_url() ?>assets/img/<?= $profile['logo'] ?>">
        </div>
        <ul class="sidebar-menu">
            <?php if ($user['role_id'] == 1) { ?>
                <li class="menu-header">Dashboard</li>
                <li><a class="nav-link textnya" href="<?= base_url() ?>admin/"><i class="fas fa-users"></i> <span>List Pasien</span></a></li>
                <li class="menu-header">Data</li>
                <li><a class="nav-link textnya" href="<?= base_url() ?>admin/logdata"><i class="fas fa-database"></i> <span>Log Data</span></a></li>
                <li><a class="nav-link textnya" href="<?= base_url() ?>admin/activities"><i class="fas fa-list-ul"></i> <span>Activities</span></a></li>
            <?php } elseif ($user['role_id'] == 2) { ?>
                <li class="menu-header">Dashboard</li>
                <li><a class="nav-link textnya" href="<?= base_url() ?>admin/"><i class="fas fa-users"></i> <span>List Pasien</span></a></li>
            <?php } ?>
        </ul>
    </aside>
</div>