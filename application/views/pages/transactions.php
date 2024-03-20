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
                                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <?php
                            foreach($allmenu as $item){
                                ?>
                                    <div class="col col-12 col-lg-3">
                                        <h6 class="fw-bold mt-2 menu-header" data-bs-toggle="collapse"
                                            data-bs-target="# <?= $item['group_name'];?>" aria-expanded="true" aria-controls="<?= $item['group_name'];?>">
                                            <?= $item['group_name'];?>
                                            <span class="float-end"><i class="bi bi-chevron-down"></i></span>
                                        </h6>
                                        <div class="expand" id="<?= $item['group_name'];?>">
                                            <?php 
                                                foreach($item['list'] as $menu){
                                                    ?>
                                                        <div class="px-0 py-2 card-body link">
                                                            <?php
                                                                $disabledLink = "";

                                                                if($menu['is_initial_activity'] == 2){
                                                                    ?>
                                                                        <a class="fw-normal text-muted" disabled="disabled" style="text-decoration:none;">
                                                                            <?= $menu['activity_name']; ?>
                                                                        </a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <a class="fw-normal"
                                                                            href="<?= base_url()?><?= $menu['routes']; ?>">
                                                                            <?= $menu['activity_name']; ?>
                                                                        </a>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    <?php
                                                }
                                            ?>
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
</div>