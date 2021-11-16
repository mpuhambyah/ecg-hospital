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
                                    <th>Nama</th>
                                    <th>Username</th>
                                </tr>
                                <?php foreach ($listPasien as $l) : ?>
                                    <tr>
                                        <td class="font-weight-600"><?= $l['nama'] ?></td>
                                        <td><?= $l['email'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>admin/resetPassword/<?= $l['id'] ?>" class="btn btn-primary">Reset Password</a>
                                            <a href="<?= base_url() ?>admin/deleteUser/<?= $l['id'] ?>" class="btn btn-danger">Delete User</a>
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