<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Upload File</h1>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Form Upload</h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <?= form_open_multipart(base_url('dokter/addFile')) ?>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pasien</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" id="pasien" name="pasien" onchange="list_rekaman()">
                            <option value="" selected disabled hidden>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Rekaman</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" id="rekaman" name="rekaman">
                            <option value="" selected disabled hidden>
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" id="id_file" name="id_file">
                            <option value="1">Deteksi Puncak R</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                    <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="fileuser" name="fileuser">
                            <label class="custom-file-label" for="fileuser"></label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    var list_rekaman = function() {},
        list_pasien = function() {};
    $(document).ready(function() {
        var pasien = $('[id=\'pasien\']');
        var rekaman = $('[id=\'rekaman\']');

        list_rekaman = function() {
            const id = pasien.val();
            if (id != "") {
                $.ajax({
                    url: base + "dokter/list_rekaman",
                    data: {
                        id: id,
                    },
                    method: "post",
                    dataType: "json",
                    success: function(data) {
                        var html = '<option value=""></option>';
                        for (let i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id + '"> Rekaman ' + data[i].id + ' </option>';
                        }
                        rekaman.html(html);
                    }
                });
            } else {
                var html = '<option value=""></option>';
                rekaman.html(html);
            }
        };
        list_pasien = function() {
            $.ajax({
                url: base + "dokter/list_pasien",
                method: "post",
                dataType: "json",
                success: function(data) {
                    var html = '<option value=""></option>';
                    for (let i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '"> ' + data[i].nama + ' </option>';
                    }
                    pasien.html(html);
                    list_rekaman();
                },
            });
        };

        list_pasien();

    });
</script>