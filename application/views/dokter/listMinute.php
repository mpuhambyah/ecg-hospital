<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $pasien['nama'] ?></h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Rekaman</h4>
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
                                            <a href="<?= base_url() ?>dokter/record/<?= $id . "/" . $id_rekaman . "/" . $i ?>" class="btn btn-primary">Detail</a>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Dihapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin ingin menghapus rekaman?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                <a class="delete-btn btn btn-primary" href="<?= base_url() ?>dokter/deleteRecord/<?= $l['id_rekaman'] ?>">Ya</a>
            </div>
        </div>
    </div>
</div>