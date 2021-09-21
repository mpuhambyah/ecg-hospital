<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Pasien</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card author-box card-primary">
                    <div class="card-body">
                        <div class="author-box-left">
                            <img alt="image" src="<?= base_url() ?>/assets/img/avatar-1.png" class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                        </div>
                        <div class="author-box-details">
                            <div class="author-box-name">
                                <a href="#">Kusnandi</a>
                            </div>
                            <div class="author-box-job">NIK. 0752625599</div>
                            <div class="author-box-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Input Text</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nomor Handphone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control phone-number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-map-marker"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control currency">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal lahir</label>
                            <input type="date" class="form-control datemask" placeholder="YYYY/MM/DD">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>