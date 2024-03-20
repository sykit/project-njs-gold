<section class="login__backdrop">
    <div class="container-fluid ps-lg-0">
        <div class="row g-0 mb-3 mb-lg-1 mt-lg-5 mt-2">
            <div class="col-lg-6 col-12 offset-0 offset-lg-3">
                <div class="login d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-12 mx-none mx-auto">
                                <h5 class="text-dark text-center fw-bold p-3" style="line-height:1.6;">Supply Chain
                                    Management <br />Information Application (SMItA) </h5>
                                <div class="card js-login-form">
                                    <div class="card-body p-lg-4 py-4 px-5">
                                        <form class="needs-validation" action="<?= base_url(); ?>auth/submit_login"
                                            method="POST">
                                            <?php
                            if ($this->session->flashdata('message')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                                <?php echo $this->session->flashdata('message') ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            <?php   } else if ($this->session->flashdata('success')) {
                            ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?php echo $this->session->flashdata('success') ?>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                            <?php
                            }
                          ?>
                                            <div class="form-floating mb-3">
                                                <input type="email" name="credential"
                                                    class="form-control js-login-email" id="floatingInput"
                                                    placeholder="name@example.com">
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" name="password"
                                                    class="form-control js-login-password" id="floatingPassword"
                                                    placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                            </div>

                                            <div class="text-center mb-3">
                                                <select class="form-control d-none js-fgroup-info" disabled name="fgroup">
                                                    <?php
                                                        foreach($fgroup as $item){
                                                            ?>
                                                    <option value="<?= $item->func_group_id; ?>">
                                                        <?= $item->func_group_name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <div class="text-center text-danger d-none js-login-error mb-3 mt-1">Email tidak terdaftar di functional group terkait</div>
                                            </div>

                                            <div class="form-check mb-3 mt-3 d-block text-center d-none">
                                                <a class="fw-bold" href="<?= base_url();?>forgot" target="_self">Lupa
                                                    password ?</a>
                                            </div>

                                            <div class="d-grid">
                                                <button
                                                    class="btn btn-lg btn-primary rounded-1 btn-login text-uppercase fw-bold mb-2 js-btn-login"
                                                    type="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="bottom-text text-center mt-3">
                                    <div class="py-4">
                                        <img data-src="<?= base_url();?>public/images/njslogo.png"
                                            class="lazyload blur-up me-2" height="22" alt="" style="text-align:center;">
                                        PT Nafiri Jaffa Sentosa | &copy; Copyright 2023
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>