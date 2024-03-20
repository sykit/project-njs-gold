<!-- Button trigger modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProductLabel">Edit Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- skeleton loader -->
                <div style="display:relative;">
                    <?php $this->load->view('/components/ssc-modal.php'); ?>
                </div>
                <!-- skeleton loader -->

                <form enctype="multipart/form-data" id="editProductFormImage" class="mb-3" method="POST"
                    action="<?= base_url(); ?>product/edit_image">
                    <div class="row">
                        <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                            <label class="mb-2">Gambar Produk</label>
                            <input type="hidden" name="product_class_id" />
                            <input accept="image/*" type="file" name="up_image" class="form-control" placeholder=""
                                required />
                            <small class="text-muted text-smallest">Accept (png/jpg/jpeg/webp). Maks. upload
                                4MB</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-lg-3 mt-2">Simpan</button>
                </form>
                <hr />
                <form enctype="multipart/form-data" id="editProductForm" class="mt-2" method="POST"
                    action="<?= base_url(); ?>product/edit">
                    <div class="js-form">
                        <div class="row">
                            <input type="hidden" name="product_class_id" />
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2" required>
                                <label class="mb-2">Kategori</label>
                                <?php $this->load->view('/components/select-category'); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Sub Kategori Produk</label>
                                <?php $this->load->view('/components/select-subcategory'); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Nama Produk</label>
                                <input type="text" name="product_class_name" class="form-control" required />
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <la class="mb-2">Kode Produk</la bel>
                                <input type="text" name="product_class_code" class="form-control" required />
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian Utama (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight1')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Sepuh</label>
                                <?php $this->load->view('/components/select-sepuh'); ?>
                            </div>
                        </div>
                        <div class="js-ukuran-cincin d-none">
                            <hr />
                            <h5 class="mb-4">Ukuran Cincin</h5>
                            <div class="row">
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 1</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id1')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 2</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id2')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 3</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id3')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 4</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id4')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 5</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id5')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 6</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id6')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 7</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id7')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 8</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id8')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 9</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id9')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 10</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id10')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 11</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id11')); ?>
                                </div>
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Cincin Varian 12</label>
                                    <?php $this->load->view('/components/select-ringsize', array('data_id' => 'ring_size_id12')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="js-ukuran-gelang d-none">
                            <hr />
                            <h5 class="mb-4">Ukuran Gelang (Bentuk, Ukuran)</h5>
                            <div class="row">
                                <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                    <label class="mb-2">Ukuran Gelang Varian</label>
                                    <?php $this->load->view('/components/select-braceletsize', array('data_id' => 'bracelet_size_id1')); ?>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <h5 class="mb-4">Detail Kadar & Berat Produk</h5>
                        <div class="row">
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 2</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id2')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 2 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight2')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 3</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id3')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 3 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight3')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 4</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id4')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 4 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight4')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 5</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id5')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 5 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight5')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 6</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id6')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 6 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight6')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 7</label>
                                <?php $this->load->view('/components/select-rate',  array('data_id' => 'prd_rate_id7')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 7 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight7')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 8</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id8')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 8 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight8')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 9</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id9')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 9 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight9')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 10</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id10')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 10 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight10')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 11</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id11')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 11 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight11')); ?>
                            </div>


                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Kadar Produk - Varian 12</label>
                                <?php $this->load->view('/components/select-rate', array('data_id' => 'prd_rate_id12')); ?>
                            </div>
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2">
                                <label class="mb-2">Berat Produk - Varian 12 (gr)</label>
                                <?php $this->load->view('/components/input-weight', array('data_id' => 'prd_class_weight12')); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-lg-3 mt-2">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>