<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>List File</h1>
        </div>
        <?php foreach ($listFile as $l) : ?>
            <div class="card card-hero">
                <a class="card-header" href="<?= base_url() ?>dokter/recordRpeak/<?= $l['id_pasien'] ?>/<?= $l['id_rekaman'] ?>/<?= $l['id'] ?>" style="color:white;text-decoration:none;">
                    <div class=" card-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h4><?= $l['nama_pasien'] ?></h4>
                    <div class="card-description">Rekaman <?= $l['id_rekaman'] ?></div>
                </a>
                <div class="card-body p-0">
                    <div class="tickets-list">
                        <a href="<?= base_url() ?>dokter/record/" class="ticket-item">
                            <div class="ticket-title">
                                <h4><?= $l['keterangan'] ?></h4>
                            </div>
                            <div class="ticket-info">
                                <div>Uploaded by <?= $l['nama_user'] ?></div>
                                <div class="bullet"></div>
                                <div class="text-primary"><?= date('d-m-Y H:i:s', $l['tanggal']) ?></div>
                            </div>
                        </a>
                        <a data-id="<?= $l['id'] ?>" class="downloadFileCSV ticket-item ticket-more">
                            Download CSV<i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </section>
</div>