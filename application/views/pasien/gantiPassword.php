<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Setting</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Ganti Password</h4>
            </div>
            <div class="card-body ">
                <?= $this->session->flashdata('message'); ?>
                <?= form_open_multipart(base_url('pasien/gantiPassword')) ?>
                <div class="form-group">
                    <label for="current_password">Kata Sandi Lama</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <?= form_error('current_password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password1">Kata Sandi Baru</label>
                    <input type="password" class="form-control" id="new_password1" name="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="new_password2">Ulangi Kata Sandi</label>
                    <input type="password" class="form-control" id="new_password2" name="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <button class="btn btn-primary">Ganti</button>
                </div>
            </div>
        </div>
    </section>
</div>