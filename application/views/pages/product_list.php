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
                                <li class="breadcrumb-item active" aria-current="page">Daftar Katalog Produk</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <div class="col col-12 col-lg-12">
                            <div class="category__menu js-category-menu d-flex gap-5 fw-bold">
                                <?php
                                    foreach($menu_category as $item){
                                        ?>
                                <a href="#" data-idcategory="<?= $item->product_category_id;?>"
                                    id="<?= $item->product_category_name ?>"><?= $item->product_category_name; ?></a>
                                <?php
                                    }
                                ?>

                                <div class="hero-menu js-hero-menu">
                                    <div class="hero-menu--list js-submenu-list">
                                        <div class="menu-thumb js-csubmenu p-4">
                                            <?php $this->load->view('components/ssc-block.php'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex mb-lg-3 mb-4">
                        <div>Koleksi Baru (<span class="js-total-newproduct">0</span>)</div>
                        <div class="ms-auto"><a href="<?= base_url();?>products/0/0/0/0" class="text-dark">Lihat Semua</a></div>
                    </div>
                    <?php $this->load->view('components/ssc-block-big.php', array('class' => 'js-newprodpl')); ?>
                    <div class="row js-newproduct">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>