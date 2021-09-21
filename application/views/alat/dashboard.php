<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row card-header">
                        <div class="col-11">
                            <h4>List Pasien</h4>
                        </div>
                        <div class="col-1">
                            <a href="<?= base_url() ?>alat/editPasien/1/1" class="btn btn-success">Tambah</a>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td class="font-weight-600">Kusnandi</td>
                                    <td class="font-weight-600">0752625599</td>
                                    <td>
                                        <a href="<?= base_url() ?>alat/listRecord/1/1" class="btn btn-info">Detail</a>
                                        <a href="<?= base_url() ?>alat/editPasien/1/1" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>alat/deletePasien/1/1" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-600">Oktaviana</td>
                                    <td class="font-weight-600">0752622311</td>
                                    <td>
                                        <a href="<?= base_url() ?>alat/listRecord/1/1" class="btn btn-info">Detail</a>
                                        <a href="<?= base_url() ?>alat/editPasien/1/1" class="btn btn-primary">Edit</a>
                                        <a href="<?= base_url() ?>alat/deletePasien/1/1" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>