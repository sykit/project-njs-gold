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
                                <li class="breadcrumb-item active" aria-current="page">Daftar Kelola Fungsi</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->

                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <div class="col col-12 col-lg-12">
                            <div class="d-flex">
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addFgroup">
                                        Tambah Group
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-12">
                            <table class="table table-strip">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tindakan</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach($fgroup as $item){
                                            ?>
                                    <tr>
                                        <td><?= $item->func_group_id?></td>
                                        <td><?= $item->func_group_name?></td>
                                        <td>
                                            <button data-fgroup-id="<?= $item->func_group_id; ?>"
                                                data-fgroup-name="<?= $item->func_group_name; ?>" type="button"
                                                data-bs-toggle="modal" data-bs-target="#editFgroup"
                                                class="btn btn-primary me-2"><i class="bi bi-pen"></i></button>
                                            <button data-fgroup-id="<?= $item->func_group_id; ?>"
                                                data-fgroup-name="<?= $item->func_group_name; ?>" class="btn btn-danger"
                                                data-bs-toggle="modal" data-bs-target="#delFgroup"><i
                                                    class="bi bi-trash"></i></button>
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