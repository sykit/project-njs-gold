<div class="d-flex mb-lg-4 mb-2">
    <div class="d-block">
        <h5 style="font-size:16px; margin-bottom:0;padding-top:14px;padding-left:8px;" class="fw-bold"><?= $title; ?></h5>
    </div>
    <div class="d-none d-lg-block info ms-lg-auto">
        <div class="d-flex">
            <div class="d-flex ms-lg-4">
                <div>
                    <i class="bi bi-person fs-1" style="position:relative;top:-3px;">
                    </i>
                </div>
                <div class="ms-lg-3 ms-2">
                    <div>
                        <span class="fw-normal" style="font-size:13px;">
                        <?=  $this->session->userdata('surname'); ?>
                        </span>
                    </div>
                    <div>
                        <span class="fw-bold" style="font-size:13px;">
                        <?=  $this->session->userdata('func_group_name'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>