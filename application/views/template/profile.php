<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="<?= base_url() ?>/assets/img/avatar-1.png" class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <a href="#"><?= $profileUser['nama'] ?></a>
                            </div>
                            <?php if ($profileUser['alamat'] != NULL) { ?>
                                <div class="author-box-description">
                                    <p><?= $profileUser['alamat'] ?></p>
                                </div>
                            <?php } ?>
                            <div class="author-box-job"><?= $profileUser['role'] ?> / <?= $profileUser['username'] ?></div>
                            <?php if ($profileUser['is_active'] == 1) { ?>
                                <div class="author-box-job">Akun telah aktif bergabung pada <?= date('d-m-Y H:i:s', $profileUser['date_created']) ?></div>
                            <?php } else { ?>
                                <div class="author-box-job">Akun sedang non-aktif bergabung pada <?= date('d-m-Y H:i:s', $profileUser['date_created']) ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>