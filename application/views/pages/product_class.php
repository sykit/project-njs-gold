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
                                <li class="breadcrumb-item"><a href="<?= base_url();?>">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <!-- respons -->
                    <?php $this->load->view('/components/response.php'); ?>
                    <!-- end respons -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <div class="col col-12 col-lg-12">
                            <div class="d-flex">
                                <!-- <div class="me-auto">
                                    <div class="d-lg-flex d-block">
                                        <div class="dropdown">
                                            <div class="me-2 mb-2">Filter berdasarkan :</div>
                                            <select class="form-control" name="<?= $data_id; ?>">
                                                <option value=""> Filter Varian <i class="bi bi-caret-right"></i>
                                                </option>
                                                <?php 
                                                    foreach($rate as $item){
                                                        ?>
                                                <option value="<?=  $item->prd_rate_id; ?>"><?= $item->prd_rate_code; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                            </select>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">375 8K</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addProduct">
                                        Tambah Produk
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-12">
                                                
                            <!-- skeleton loader -->
                            <div style="display:relative;">
                                <?php $this->load->view('/components/ssc-table.php'); ?>
                            </div>
                            <!-- skeleton loader -->

                            <div class="table-responsive js-table">
                                <table class="table table-strip" id="table_product">
                                    <thead>
                                        <th>Nama</th>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Cat.Name</th>
                                        <th>Sub Cat.Name</th>
                                        <th>Rate Code</th>
                                        <th>Tindakan</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>