<?php 
    $isAuth = $this->session->userdata('authenticated');
    $userType = $this->session->userdata('usertype');
    $fgroupId = $this->session->userdata('func_group_id');
?>
<div class="menu__left">
    <div class="menu__left--wrapper">
        <div class="menu__left--topper" style="background:black;">
            <div class="d-flex">
                <img src="<?= base_url();?>public/images/logo.png" style="margin-top:10px;" height="50" width="50" />
                <h2 class="fw-bold pt-3">SMItA</h2>
            </div>
        </div>
        <div class="header-user">
            <div>Selamat Datang</div>
            <div style="color:#AA7B00;" class="fw-bold"><i
                    class="bi bi-person-circle me-2"></i><?=  $this->session->userdata('surname'); ?></div>
        </div>
        <hr />
        <div class="main-menu-desktop">
            <h6 class="fw-bold mt-2 menu-header" data-bs-toggle="collapse" data-bs-target="#group_menu_1"
                aria-expanded="true" aria-controls="group_menu_1">
                Katalog Produk
                <span class="float-end"><i class="bi bi-chevron-down"></i></span>
            </h6>
            <div class="expand" id="group_menu_1">
                <?php $this->load->view("components/ssc-menu.php"); ?>
                <div class="p-2 card-body link js-menu-catalog">
                </div>
            </div>

            <h6 class="fw-bold mt-2 menu-header" data-bs-toggle="collapse" data-bs-target="#group_menu_2"
                aria-expanded="true" aria-controls="group_menu_2">
                Supply Chain
                <span class="float-end"><i class="bi bi-chevron-down"></i></span>
            </h6>
            <div class="expand" id="group_menu_2">
                <div class="p-2 card-body link">
                    <a class="fw-normal" href="<?= base_url()?>transactions">
                        Transaksi
                    </a>
                    <a class="fw-normal" href="<?= base_url()?>transactions/inprogress">
                        Draf (<?= $inprogress_count[0]->count ?? 0; ?>)
                    </a>
                    <a class="fw-normal" href="<?= base_url()?>transactions/incoming">
                        Kotak Masuk (<?= $incoming_count[0]->count ?? 0; ?>)
                    </a>
                    <a class="fw-normal" href="<?= base_url()?>transactions/complete">
                        Selesai (<?= $complete_count[0]->count ?? 0; ?>)
                    </a>
                    <a class="fw-normal" href="<?= base_url()?>transactions/inprocess">
                        Dalam Proses (<?= $inprocess_count[0]->count ?? 0; ?>)
                    </a>
                </div>
            </div>
         
            <h6 class="fw-bold mt-2 menu-header" data-bs-toggle="collapse" data-bs-target="#group_menu_3"
                aria-expanded="true" aria-controls="group_menu_3">
                Utilitas
                <span class="float-end"><i class="bi bi-chevron-down"></i></span>
            </h6>
            <div class="expand" id="group_menu_3">
                <?php $this->load->view("components/ssc-menu.php"); ?>
                <div class="p-2 card-body link js-menu-administration">
                </div>
            </div>

            <h6 class="fw-bold mt-2 menu-header" data-bs-toggle="collapse" data-bs-target="#group_menu_4"
                aria-expanded="true" aria-controls="group_menu_4">
                Laporan
                <span class="float-end"><i class="bi bi-chevron-down"></i></span>
            </h6>
            <div class="expand" id="group_menu_4">
                <?php $this->load->view("components/ssc-menu.php"); ?>
                <div class="p-2 card-body link js-menu-report">
                </div>
            </div>
       
            <div class="expand">
                <a href="<?= base_url();?>auth/logout">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>