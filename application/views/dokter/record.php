<div class="main-content">
    <section class="section">
        <div class="row section-header">
            <h1 class="col-7"><?= $listRekaman[0]['nama'] ?> - Rekaman <?= $id_rekaman ?></h1>

            <div class="col-5 text-right">

                <button id="check" onclick="checked();" class="btn btn-icon mr-2" hidden><i class="fas fa-check" aria-hidden="true"></i></button>

                <button class="btn btn-icon mr-2 btn-primary" id="btn_convert"><i class="fa fa-camera" aria-hidden="true"></i></button>
                <div id="previewImg" hidden>
                </div>
                <button style="color:white" class="btn btn-icon mr-2 btn-primary" onclick="download();"><i class="fas fa-download"></i> CSV SEMUA</button>
                <button style="color:white" class="btn btn-icon mr-2 btn-primary" onclick="downloadII();"><i class="fas fa-download"></i> CSV LEAD II</button>
                <button id="FS" class="btn btn-icon mr-2 btn-info" onclick="openFullscreen();"><i class="fa fa-expand" aria-hidden="true"></i></button>
                <button id="closeFS" class="btn btn-icon mr-2 btn-danger" onclick="closeFullscreen();" hidden><i class="fas fa-compress"></i></button>
            </div>
        </div>
        <div id="html-content-holder">
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