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
                                <li class="breadcrumb-item active" aria-current="page">Daftar Sub Kategori</li>
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
                                        data-bs-target="#addSubCategory">
                                        Tambah Sub Kategori
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
                                    <th>Kategori</th>
                                    <th>Tindakan</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $i = 0;
                                        foreach($subcategory as $item){
                                            $i++;
                                            ?>
                                    <tr>
                                        <td>
                                            <?= $i; ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(isset($item->sub_image)){
                                                    ?>
                                            <img width="32" class="lazyload blur-up"
                                                data-src="<?= base_url(); ?>public/uploads/<?= $item->sub_image;?>"
                                                alt="" />
                                            <?php
                                                }else {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                        <td><?= $item->prd_sub_cat_name;?></td>
                                        <td><?= $item->product_category_name;?></td>
                                        <td>
                                            <a data-bs-target="#editSubCategory" data-bs-toggle="modal" href=""
                                                data-subcategory-name="<?= $item->prd_sub_cat_name;?>"
                                                data-subcategory-id="<?= $item->prd_sub_cat_id;?>"
                                                data-subcategory-image="<?= $item->sub_image;?>"
                                                class="btn btn-primary"><i class="bi bi-pen"></i></a>
                                            <a data-bs-target="#delSubCategory" data-bs-toggle="modal" href=""
                                                data-subcategory-name="<?= $item->prd_sub_cat_name;?>"
                                                data-subcategory-id="<?= $item->prd_sub_cat_id;?>"
                                                data-subcategory-image="<?= $item->sub_image;?>"
                                                class="btn btn-danger"><i class="bi bi-trash"></i></a>
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