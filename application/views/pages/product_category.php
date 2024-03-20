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
                                <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
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
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCategory">
                                        Tambah Kategori
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-12">
                            <table class="table table-strip">
                                <thead>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Nama</th>
                                    <th>Tindakan</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        foreach($category as $item){
                                            $i++;
                                            ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(isset($item->image)){
                                                    ?>
                                            <img class="lazyload blur-up" width="32"
                                                data-src="<?= base_url(); ?>public/uploads/<?= $item->image;?>"
                                                alt="" />
                                            <?php
                                                }else if($item->image == NULL || $item->image == ''){
                                                   ?>
                                            <img class="lazyload blur-up" width="32"
                                                data-src="<?= base_url(); ?>public/images/placeholder.jpg"
                                                alt="" />
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?= $item->product_category_name; ?></td>
                                        <td>
                                            <a href="" data-category-name="<?= $item->product_category_name; ?>"
                                                data-category-id="<?= $item->product_category_id ; ?>"
                                                data-category-image="<?= $item->image; ?>"
                                                data-bs-target="#editCategory" data-bs-toggle="modal"
                                                class="btn btn-primary"><i class="bi bi-pen"></i></a>
                                            <a href="" data-category-name="<?= $item->product_category_name; ?>"
                                                data-category-id="<?= $item->product_category_id ; ?>"
                                                data-category-image="<?= $item->image; ?>" data-bs-target="#delCategory"
                                                data-bs-toggle="modal" class="btn btn-danger"><i
                                                    class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>