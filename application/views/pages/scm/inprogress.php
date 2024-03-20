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
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>transactions/inprogress">Draf (<?php echo sizeof($inprogress_list); ?>)</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->


                    <?php
                        if(sizeof($inprogress_list) > 0){
                            ?>
                    <div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 transaction js-trans-som">
                        <div class="col col-12 col-lg-12">
                            <div class="transaction__detail">
                                <div class="table-responsive mt-5 ">
                                    <table class="table table-strip">
                                        <thead>
                                            <th>Nama Aktivitas</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>PIC</th>
                                            <th>Status Transaksi</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                            if(isset($inprogress_list)){
                                                                foreach($inprogress_list as $item){
                                                                    ?>
                                            <tr>
                                                <td><?= $item->activity_name ?? '-' ;?></td>
                                                <td><?= $item->trans_code ?? '-';?></td>
                                                <td><?= $item->trans_date ?? '-';?></td>
                                                <td><?= $item->surname ?? '-';?></td>
                                                <td>
                                                <a href="<?= base_url(); ?>transaksi/<?= $item->alias; ?>/<?= trim($item->activity_code); ?>/inprogress?th_code=<?= trim($item->trans_code); ?>" class="btn btn-outline-secondary btn-sm"><?= transBadgeId($item->trans_status_id) ?? '-';?></a>
                                                </td>
                                            </tr>
                                            <?php
                                                                }
                                                            }
                                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }else{
                            ?>
                        <div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 transaction js-trans-som">
                            <div class="col col-12 col-lg-12">
                                <div class="alert alert-warning p-2">
                                    Tidak ada inprogress task
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>