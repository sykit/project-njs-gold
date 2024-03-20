<section>
    <div class="container-fluid ps-lg-0">
        <div class="row g-0 mb-3 mb-lg-1 mt-lg-5 mt-2">
            <div class="col-lg-6 col-12 offset-0 offset-lg-3">
                <div class="login d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-12 mx-none mx-auto">
                                <div class="card">
                                    <div class="login-brand text-center" style="background:black;border-top-left-radius:4px; border-top-right-radius:4px;">
                                        <img data-src="<?= base_url();?>public/images/njslogo.png" class="lazyload blur-up" height="100%" alt=""
                                            style="text-align:center;">
                                    </div>
                                    <div class="card-body p-lg-4 p-3">
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
                                                <input type="email" name="credential" class="form-control"
                                                    id="floatingInput" placeholder="name@example.com">
                                                <label for="floatingInput">Email address</label>
                                            </div>
    
                                            <div class="d-grid">
                                                <button class="btn btn-lg btn-primary rounded-1 btn-login text-uppercase fw-bold mb-2"
                                                    type="submit">Request reset password</button>
                                            </div>
    
                                            <div class="form-check mb-3 mt-3 d-block text-center">
                                                <a class="fw-bold" href="<?= base_url();?>" target="_self">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="bottom-text text-center mt-3">
                                    &copy;  NJS Gold. All rights reserved.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>