<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Pasien</h4>
                    </div>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped text-center">
                                <tr>
                                    <th>Alat</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                                <?php foreach ($listPasien as $l) : ?>
                                    <tr>
                                        <td><?= $l['nama_alat'] ?></td>
                                        <td class="font-weight-600"><?= $l['nama'] ?></td>
                                        <td><?= $l['nik'] ?></td>
                                        <td><?= $l['alamat'] ?></td>
                                        <td>
                                            <?php if ($l['aktivasi'] == 1) { ?>
                                                <a href="<?= base_url() ?>alat/listRecord/<?= $l['id'] ?>" class="btn btn-success">Aktif</a>
                                            <?php } else {  ?>
                                                <a href="<?= base_url() ?>alat/listRecord/<?= $l['id'] ?>" class="btn btn-secondary">Tidak Aktif</a>
                                            <?php } ?>
                                            <a href="<?= base_url() ?>alat/listRecord/<?= $l['id'] ?>" class="btn btn-primary">Detail</a>
                                            <a href="<?= base_url() ?>alat/editPasien/<?= $l['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a data-toggle="modal" data-target="#deleteModal" class="deletePasien btn btn-danger" data-id=<?= $l['id'] ?> style="color:white">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
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
            <div class="modal-body">Anda yakin ingin menghapus pasien?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                <a class="delete-btn btn btn-primary" href="<?= base_url() ?>alat/deletePasien/">Ya</a>
            </div>
        </div>
    </div>
</div>