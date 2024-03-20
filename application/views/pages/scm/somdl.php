 <!-- bottombar -->
<?php $this->load->view("bottombar.php") ?>
<!-- end bottombar -->

<div class="container-fluid">
    <div class="row mb-3 mb-lg-1">
        <div class="col col-xl-2 col-1 d-none d-lg-block p-0 m-0">

            <!-- start sidebar -->
            <?php $this->load->view("sidemenu.php") ?>
            <!-- end sidebar -->

        </div>

        <div class="col col-xl-10 col-md-10 m-0 p-0">
            <div class="menu__right">
                <div class="menu__right--topper">
                    <!-- start topbar -->
                    <?php $this->load->view("topbar.php") ?>
                    <!-- end topba -->
                </div>
                <div class="menu__right--wrapper">
                    <!-- breadcrumb -->
                    <div class="d-block ms-auto">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>transactions">Transaksi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">SOM Data Loader</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 transaction js-trans-som">
                        <div class="col col-12 col-lg-12">
                            <form id="somSubmit" enctype="multipart/form-data" method="POST">
                                <div class="card text-left">
                                    <div class="card-header">
                                        <div class="d-flex gap-3 scm-header-menu">
                                            <button type="submit" name="send" title="Kirim"><i class="bi bi-send-check-fill fs-3"></i></button>
                                            <button name="print" title="Cetak"><i class="bi bi-printer-fill fs-3"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body print-area" id="transaction-content">
                                        <div class="trans-title">
                                            <h4 class="fw-bold mb-4 mb-lg-2">SOM Data Loader</h4>
                                        </div>
                                        <div class="transaction__header">
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Kode Transaksi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <input type="text" class="form-control js-kode-transaksi"
                                                        name="trans_code"/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Tanggal Transaksi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <select class="form-control" name="trans_date" disabled>
                                                        <option value="<?php echo strtotime(date_create()->format('l, d-M-Y H:i:s')) * 1000; ?>"><?php echo date_create()->format('l, d-M-Y H:i:s'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Status Transaksi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <select name="trans_status_id" class="form-control js-trans-status" disabled>
                                                        <?php
                                                        foreach ($trans_status as $key => $item) {
                                                            $selected = $key == 1 ? 'selected' : '';
                                                        ?>
                                                            <option value="<?= $item->trans_status_id; ?>" <?= $selected; ?>>
                                                                <?= $item->trans_status_name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Lokasi Transaksi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <select class="form-control js-trans-loc1" name="trans_loc" disabled>
                                                        <?php
                                                            foreach($trans_loc as $item){
                                                                ?>
                                                        <option value="<?= $item->company_id; ?>">
                                                            <?= $item->company_name; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="color:black" />
                                        <div class="text-center text--blue-soft mb-lg-3 mb-4">
                                            *DOKUMEN INI MERUPAKAN BUKTI TRANSAKSI YANG DIAKUI OLEH PT NJS*
                                        </div>
    
                                        <div class="transaction__detail">
                                            <h6 class="fw-bold mb-4">Deskripsi Permintaan</h6>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Kategori Pelanggan
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <select class="form-control js-som-ditujukan">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Pelanggan 
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <select class="form-control js-som-permintaan">
                                                    </select>
                                                </div>
                                            </div>
    
                                            <br />
    
                                            <h6 class="fw-bold mb-4">Syarat dan Ketentuan</h6>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Tanggal Ekspektasi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-2" style="max-width:200px;">
                                                    <input type="date" name="date_expected" class="form-control js-som-date-expect" autocomplete="on" />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Catatan
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <textarea class="form-control js-som-notes" name="notes" rows="1"></textarea>
                                                </div>
                                            </div>

                                            <h6 class="fw-bold mb-4 mt-3">Unggah Dokumen Excel</h6>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                    Unggah Dokumen Excel
                                                    </label><br/>
                                                    <small class="text-muted" style="font-size:10px;">Format yang didukung (xls, xlsx)</small>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <div class="mb-3" id="all_err_message"></div>
                                                    <input type="file" id="fileUpload" class="mb-2" placeholder="Unggah Dokumen Excel"/>
                                                    <input type="button" id="upload" class="btn btn-success btn-sm" value="Upload" />
                                                    <a type="button" id="reset" class="btn btn-danger btn-sm" onclick="window.location.reload();">Reset</a>
                                                    <div id="dvExcel" class="mt-2 mb-2"></div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mt-4">
                                                <div class="col col-4 col-lg-2">
                                                    Dikirim oleh:
                                                </div>
                                                <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                    <b><?php echo $this->session->userdata('surname');?></b>
                                                </div>
                                                <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                    <?php echo date('Y/m/d'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-body-secondary d-none">
                                        2 days ago
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>