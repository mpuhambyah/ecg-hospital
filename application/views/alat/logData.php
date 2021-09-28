<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Log Data</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Alat</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Rekaman</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1;
                                foreach ($listPasien as $key => $l) : ?>
                                    <tr>
                                        <th scope="row"><?= $key + 1 ?></th>
                                        <td><?= $l['nama_alat'] ?></td>
                                        <td><?= $l['nama'] ?></td>
                                        <td>Rekaman <?= $l['id_rekaman'] ?></td>
                                        <td><?= date('d-m-Y H:i:s', $l['tanggal']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>