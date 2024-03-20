<!-- bottombar -->
<?php $this->load->view("bottombar.php") ?>
<!-- end bottombar -->

<div class="container-fluid js-filter">
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
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <div class="col col-12 col-md-4 col-xl-2">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <a href="<?= base_url();?>products/0/0/0/0"
                                        class="btn btn-danger btn-sm d-block">Reset</a>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-14">Filter Kategori</h6>
                                    <?php $this->load->view('components/select-category-filter'); ?>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-14">Filter Sub Kategori</h6>
                                    <?php $this->load->view('components/select-subcategory-filter', array('disabled' => 'disabled')); ?>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-14">Filter Kadar</h6>
                                    <?php $this->load->view('components/filter-rate'); ?>
                                </div>
                            </div>
                            <div class="card mb-3 d-none">
                                <div class="card-body">
                                    <h6 class="fw-bold text-14">Filter Berat</h6>
                                    <div class="form-group">
                                        <label for="customRange1" class="form-label"><span
                                                class="js-form-rangeval"></span>(gr)</label>
                                        <input type="range" disabled class="form-range js-form-range" min="0" step="0.1" value="0.3" max="20" id="customRange2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-md-8 col-xl-10">
                            <?php $this->load->view('components/ssc-block-big.php', array('class' => 'js-productloader')); ?>
                            <div class="row js-productlist">
                                <!-- all product render here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>