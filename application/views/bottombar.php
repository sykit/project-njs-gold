<?php 
    $isAuth = $this->session->userdata('authenticated');
    $userType = $this->session->userdata('usertype');
?>

<div class="bottom-bar d-none">
    <div class="bottom-bar--wrapper">
        <?php
            if($userType == 'admin'){
                ?>
        <!-- menu admin -->
        <div>
            <a class="" href="<?= base_url();?>admin/">
                <i class="bi bi-house"></i>
                <span class="d-block">Beranda</span>
            </a>
        </div>
        <div>
            <a class="" href="<?= base_url();?>admin/riwayat">
                <i class="bi bi-clock-history"></i>
                <span class="d-block">Riwayat</span>
            </a>
        </div>
        <div>
            <a class="" href="<?= base_url();?>admin/database">
                <i class="bi bi-database"></i>
                <span class="d-block">Database</span>
            </a>
        </div>
        <div>
            <a class="" href="<?= base_url();?>admin/classtype">
                <i class="bi bi-list-check"></i>
                <span class="d-block">Kelas</span>
            </a>
        </div>
        <div>
            <a class="" href="<?= base_url();?>admin/statistik">
                <i class="bi bi-bar-chart-line"></i>
                <span class="d-block">Statistik</span>
            </a>
        </div>
        <div>
            <a class="" href="<?= base_url();?>admin/akun">
                <i class="bi bi-person"></i>
                <span class="d-block">Akun</span>
            </a>
        </div>
        <!-- menu admin end -->
        <?php
            }else if($userType == 'super_admin'){
                ?>

        <!-- menu super admin -->
        <div>
            <a href="<?= base_url();?>super/">
                <i class="bi bi-house me-2"></i>
                <span class="d-block">Beranda</span>
            </a>
        </div>
        <div>
            <a href="<?= base_url();?>super/database">
                <i class="bi bi-file-earmark-text me-2"></i>
                <span class="d-block">Database</span>
            </a>
        </div>
        <div>
            <a href="<?= base_url();?>super/akun">
                <i class="bi bi-person me-2"></i>
                <span class="d-block">Akun</span>
            </a>
        </div>

        <!-- menu super admin end -->
        <?php
            }else{
                ?>

        <!-- menu user -->
        <div>
            <a href="<?= base_url();?>user/">
                <i class="bi bi-house me-2"></i>
                <span class="d-block">Beranda</span>
            </a>
        </div>
        <div>
            <a href="<?= base_url();?>user/riwayat">
                <i class="bi bi-file-earmark-text me-2"></i>
                <span class="d-block">Riwayat</span>
            </a>
        </div>
        <div>
            <a href="<?= base_url();?>user/statistik">
                <i class="bi bi-file-earmark-text me-2"></i>
                <span class="d-block">Statistik</span>
            </a>
        </div>
        <div>
            <a href="<?= base_url();?>user/akun">
                <i class="bi bi-person me-2"></i>
                <span class="d-block">Akun</span>
            </a>
        </div>
        <!-- menu user end -->

        <?php
            }
        ?>
    </div>
</div>