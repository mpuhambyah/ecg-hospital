<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>List Pasien</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped text-center">
                                <tr>
                                    <th>Alat</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($listPasien as $l) : ?>
                                    <tr>
                                        <td><?= $l['nama_alat'] ?></td>
                                        <td class="font-weight-600"><?= $l['nama'] ?></td>
                                        <td><?= $l['alamat'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>dokter/listRecord/<?= $l['id'] ?>" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-hero">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <h4><?= $total ?></h4>
                        <div class="card-description">Pasien belum di crosscheck</div>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($total > 0) { ?>
                            <?php foreach ($listPasienUnchecked as $l) : ?>
                                <div class="tickets-list">
                                    <a href="<?= base_url() ?>dokter/record/<?= $l['id'] . "/" . $l['id_rekaman'] ?>" class="ticket-item">
                                        <div class="ticket-title">
                                            <h4>Rekaman <?= $l['id_rekaman'] ?></h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div><?= $l['nama'] ?></div>
                                            <div class="bullet"></div>
                                            <div class="text-primary"><?= date('d-m-Y H:i:s', $l['tanggal']) ?></div>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                                <a href="#" class="ticket-item ticket-more">
                                    View All <i class="fas fa-chevron-right"></i>
                                </a>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>