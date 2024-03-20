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
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                                        Tambah Pengguna
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-12">
                            <table class="table table-strip">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $item) { ?>
                                        <tr>

                                            <td><?= $item->surname; ?></td>
                                            <td><?= $item->jabatan; ?></td>
                                            <td><?= $item->email; ?></td>
                                            
                                            <td>
                                            <a data-bs-target="#editUser" data-bs-toggle="modal" onclick="openEditUser('<?= $item->user_id?>')"
                                                class="btn btn-primary"><i class="bi bi-pen"></i></a>

                                                <a data-bs-target="#delUser" data-bs-toggle="modal" href="" onclick="openDeleteUser('<?= $item->user_id?>','<?= $item->surname; ?>')"class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("modal/modal-edit-user.php"); ?>
<?php $this->load->view("modal/modal-delete-user.php"); ?>
