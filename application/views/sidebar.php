<?php 
    $isAuth = $this->session->userdata('authenticated');
    $userType = $this->session->userdata('usertype');
?>
<div class="menu__left">
    <div class="menu__left--wrapper">
        <div class="mb-lg-2 mb-1 pb-lg-2">
            <img data-src="<?= base_url()?>public/images/main-logo.svg" class="lazyload blur-up" width="150" alt="" />
        </div>
        <div class="header-user">
            <div>Selamat Datang</div>
            <div style="color:#AA7B00;" class="fw-bold"><?=  $this->session->userdata('surname'); ?></div>
        </div>
        <hr/>
        <?php
            if($userType == 'super_admin'){
                ?>
                <div>
                    <a href="<?= base_url();?>super/">
                        <i class="bi bi-house me-2"></i> Beranda
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>super/database">
                        <i class="bi bi-file-earmark-text me-2"></i> Database
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>super/akun">
                        <i class="bi bi-person me-2"></i> Akun
                    </a>
                </div>
                <hr />
                <?php
            }else if($userType == 'admin'){
                ?>
                <div>
                    <a href="<?= base_url();?>admin/">
                        <i class="bi bi-house me-2"></i> Beranda
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>admin/riwayat">
                        <i class="bi bi-clock-history me-2"></i> Riwayat
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>admin/database">
                        <i class="bi bi-database me-2"></i> Database
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>admin/classtype">
                        <i class="bi bi-list-check me-2"></i> Kelas
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>admin/statistik">
                        <i class="bi bi-bar-chart-line me-2"></i> Statistik
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>admin/akun">
                        <i class="bi bi-person me-2"></i> Akun
                    </a>
                </div>
                <?php
            }else {
                ?>
                <div>
                    <a href="<?= base_url();?>user/">
                        <i class="bi bi-house me-2"></i> Beranda
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>user/riwayat">
                        <i class="bi bi-file-earmark-text me-2"></i> Riwayat
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>user/statistik">
                        <i class="bi bi-file-earmark-text me-2"></i> Statistik
                    </a>
                </div>
                <div>
                    <a href="<?= base_url();?>user/akun">
                        <i class="bi bi-person me-2"></i> Akun
                    </a>
                </div>
                <?php
            }

        ?>
        <div>
            <a href="<?= base_url();?>auth/logout">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </div>
    </div>
</div>