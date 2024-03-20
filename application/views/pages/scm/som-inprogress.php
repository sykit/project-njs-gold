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
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>transactions/inprogress">Daftar Transaksi Surat Order Marketing (SOM)</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= $trans_header[0]->trans_code ?? '-'; ?> 
                                <?php
                                    if(isset($trans_header[0]->trans_status_id)){
                                        ?>
                                            (<?= transBadgeId($trans_header[0]->trans_status_id) ?? '-'; ?>)
                                        <?php
                                    }else{
                                        echo '';
                                    }
                                ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 transaction js-trans-som js-trans-som-inprogress">
                        <div class="col col-12 col-lg-12">
                            <form id="somInprogressSubmit" enctype="multipart/form-data" method="POST">
                                <div class="card text-left">
                                    <div class="card-header">
                                        <div class="d-flex gap-3 scm-header-menu">
                                            <button type="button" title="Add Record" href="#somAddProduct" data-bs-target="#somAddProduct" data-bs-toggle="modal"><i class="bi bi-file-earmark-plus-fill fs-3"></i></button>
                                            <button type="submit" name="save" title="Simpan"><i class="bi bi-save2-fill fs-3"></i></button>
                                            <button type="submit" name="send" title="Kirim"><i class="bi bi-send-check-fill fs-3"></i></button>
                                            <button type="submit" name="reject" title="Menolak"><i class="bi bi-file-earmark-x-fill fs-3"></i></button>
                                            <button type="submit" disabled name="followup" title="Tindak-lanjut"><i class="bi bi-file-earmark-arrow-up-fill fs-3"></i></button>
                                            <button name="print" title="Cetak"><i class="bi bi-printer-fill fs-3"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body print-area" id="transaction-content">
                                        <div class="trans-title">
                                            <h4 class="fw-bold mb-4 mb-lg-2">Surat Order Marketing</h4>
                                        </div>
                                        <div class="transaction__header">
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Kode Transaksi
                                                    </label>
                                                </div>
                                                <div class="col col-lg-4">
                                                    <input type="text" class="form-control" disabled name="trans_code" value="<?= $trans_header[0]->trans_code; ?>" />
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
                                                        <option value="<?= $trans_header[0]->trans_date; ?>"><?= $trans_header[0]->trans_date; ?></option>
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
                                                                $selected = $key == $trans_header[0]->trans_status_id ? 'selected' : '';
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
                                                            foreach($trans_loc as $key => $item){
                                                                $selected = $key == $trans_header[0]->trans_loc ? 'selected' : '';
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
                                                    <input type="text" name="date_expected" class="form-control js-som-date-expect"/>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col col-lg-2">
                                                    <label>
                                                        Catatan
                                                    </label>f
                                                </div>
                                                <div class="col col-lg-4">
                                                    <textarea class="form-control js-som-notes" name="notes" rows="1"><?= $trans_header[0]->notes; ?></textarea>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row mt-4">
                                                <div class="col col-4 col-lg-2">
                                                    Dikirim oleh:
                                                </div>
                                                <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                    <b><?= $pic[0]->surname; ?></b>
                                                </div>
                                                <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                    <?php echo date('Y/m/d'); ?>
                                                </div>
                                            </div>
    
                                            <div class="table-responsive mt-5 js-table-order">
                                                <table class="table table-strip js-table-order-som">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Nomor Model</th>
                                                        <th>Kategori</th>
                                                        <th>Sub Kategori</th>
                                                        <th>Kode Sepuh</th>
                                                        <th>Kode Karat</th>
                                                        <th>Jumlah</th>
                                                        <th>Ukuran</th>
                                                        <th>Keterangan</th>
                                                        <th>Tindakan</th>
                                                    </thead>
                                                    <tbody class="js-table-order-body">

                                                    </tbody>
                                                </table>
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