<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Upload File</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Pasien</h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <?= form_open_multipart(base_url('alat/addPasien')) ?>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="nik" name="nik">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>