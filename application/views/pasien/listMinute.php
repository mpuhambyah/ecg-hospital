<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $pasien['nama'] ?></h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Rekaman <?= $id_rekaman ?> - <?= $JumlahlistMinute['jumlah'] ?> Data</h4>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>Rekaman</th>
                                    <th>Action</th>
                                </tr>
                                <?php for ($i = 1; $i <= $listRekaman; $i++) { ?>
                                    <tr>
                                        <td class="font-weight-600">Menit ke-<?= $i ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>pasien/record/<?= $id . "/" . $id_rekaman . "/" . $i ?>" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>