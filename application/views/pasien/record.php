<div class="main-content">
    <section class="section">
        <div class="row section-header">
            <h1 class="col-7"><?= $listRekaman[0]['nama'] ?> - Rekaman <?= $id_rekaman ?> - Menit <?= $minute ?></h1>
            <div class="col-5 text-right hideButton" hidden>
                <div hidden>
                    <button id="check" onclick="checked();" class="btn btn-icon mr-2" hidden><i class="fas fa-check" aria-hidden="true"></i></button>

                    <button class="btn btn-icon mr-2 btn-primary" id="btn_convert"><i class="fa fa-camera" aria-hidden="true"></i></button>
                    <div id="previewImg" hidden>
                    </div>
                    <button style="color:white" class="btn btn-icon mr-2 btn-primary" onclick="download();"><i class="fas fa-download"></i> CSV SEMUA</button>
                    <button style="color:white" class="btn btn-icon mr-2 btn-primary" onclick="downloadII();"><i class="fas fa-download"></i> CSV LEAD II</button>
                </div>
                <button id="FS" class="btn btn-icon mr-2 btn-info" onclick="openFullscreen();"><i class="fa fa-expand" aria-hidden="true"></i></button>
                <button id="closeFS" class="btn btn-icon mr-2 btn-danger" onclick="closeFullscreen();" hidden><i class="fas fa-compress"></i></button>
            </div>
        </div>
        <?php for ($i = 1 + (15 * ($minute - 1)); $i <= 15 * $minute; $i++) { ?>
            <button id="buttonRange<?= $i ?>" data-id="<?= $i ?>" style="color:white" data-min="<?= ($i - 1) * 800 ?>" data-max="<?= ($i * 800) - 1 ?>" class="setRange btn btn-icon mb-3 btn-secondary hideButton"></i> <?= ($i - 1) * 800 ?> - <?= ($i * 800) - 1 ?></button>
        <?php } ?>
        <div class="text-center hideButtonEnable" style="margin-top: 200px;">
            <h4>Please Wait...</h4>
            <img src="<?= base_url("assets/img/load.gif") ?>" width="300" />
        </div>
        <div id="html-content-holder" class="hideButton" hidden>
            <div class="row bk no-gutters pb-3 pt-3">
                <div class="col-3">
                    <div id="chart_i">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_avr">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v1">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v4">
                    </div>
                </div>
            </div>
            <div class="row bk no-gutters pb-3">
                <div class="col-3">
                    <div id="chart_ii">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_avl">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v2">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v5">
                    </div>
                </div>
            </div>
            <div class="row bk no-gutters pb-3">
                <div class="col-3">
                    <div id="chart_iii">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_avf">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v3">
                    </div>
                </div>
                <div class="col-3">
                    <div id="chart_v6">
                    </div>
                </div>
            </div>
            <div class="row bk no-gutters pb-3 mb-5">
                <div class="col-12">
                    <div id="chart_ii_full">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>