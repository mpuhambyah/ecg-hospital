<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Activities</h1>
        </div>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form method="post" class="needs-validation" novalidate="">
                        <div class="card-header">
                            <h4>History</h4>
                        </div>
                        <div class="card-body">
                            <?php foreach ($listActivity as $l) : ?>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="activities">
                                            <div class="activity">
                                                <div class="activity-icon bg-primary text-white shadow-primary">
                                                    <i class="<?= $l['logo'] ?>"></i>
                                                </div>
                                                <div class="activity-detail">
                                                    <div class="mb-2">
                                                        <span class="text-job text-primary"><?= date('d-m-Y H:i:s', $l['tanggal']) ?></span>
                                                        <span class="bullet"></span>
                                                    </div>
                                                    <p><?= $l['nama_user'] ?> <?= $l['keterangan_activity'] ?> Rekaman <?= $l['id_rekaman'] ?> pada <?= $l['nama_pasien'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>