<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kusnandi</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Rekaman</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tr>
                                    <th>Rekaman</th>
                                    <th>Status</th>
                                    <th>Tanggal Rekaman</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td class="font-weight-600">Rekaman 3</td>
                                    <td>
                                        <div class="badge badge-warning">Uncheked</div>
                                    </td>
                                    <td>September 19, 2021</td>
                                    <td>
                                        <a href="<?= base_url() ?>alat/record/1/1" class="btn btn-info">Detail</a>
                                        <a href="<?= base_url() ?>alat/deletePasien/1/1" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-600">Rekaman 2</td>
                                    <td>
                                        <div class="badge badge-success">Checked</div>
                                    </td>
                                    <td>September 1, 2021</td>
                                    <td>
                                        <a href="<?= base_url() ?>alat/record/1/1" class="btn btn-info">Detail</a>
                                        <a href="<?= base_url() ?>alat/deletePasien/1/1" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-600">Rekaman 1</td>
                                    <td>
                                        <div class="badge badge-success">Checked</div>
                                    </td>
                                    <td>Oktober 15, 2021</td>
                                    <td>
                                        <a href="<?= base_url() ?>alat/record/1/1" class="btn btn-info">Detail</a>
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