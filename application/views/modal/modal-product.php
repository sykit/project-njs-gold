<!-- Button trigger modal -->
<div class="modal fade" id="productDetail" tabindex="-1" aria-labelledby="productDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fw-bold" id="addCategoryLabel">Detail Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php $this->load->view('components/ssc-modal-product.php'); ?>
                <div class="js-product-detail" style="display:none;">
                    <input type="hidden" class="product_class_id" name="product_class_id" />
                    <div class="row">
                        <div class="col col-12 col-lg-5 mb-lg-2 mb-2">
                            <img class="lazyload blur-up rounded-2 product-card js-product-image"
                                onerror="this.src='<?= base_url();?>public/images/placeholder.jpeg'"
                                data-src="<?= base_url();?>public/images/gelang/GOP00122.jpg" alt="" />
                        </div>
                        <div class="col col-12 col-lg-4 mb-lg-2 mb-2">
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Nama Produk</div>
                                <div class="js-product-name  text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Kode Produk</div>
                                <div class="js-product-code text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Kadar Produk & Berat</div>
                                <div class="js-product-rate-weight text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Sepuh</div>
                                <div class="js-product-sepuh text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Estimasi berat untuk kadar lain</div>
                                <div class="js-product-variant text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group js-rings-size mb-4">
                                <div class="fw-bold text-14">Ukuran Cincin </div>
                                <div class="js-product-ringvariant text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group js-bracelet-size mb-4">
                                <div class="fw-bold text-14">Ukuran Gelang (Bentuk, Ukuran)</div>
                                <div class="js-product-braceletvariant text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12 col-lg-3 mb-4">
                            <div class="form-group mb-3">
                                <div class="fw-bold text-14">Kategori Produk</div>
                                <div class="js-prod-cat-detail  text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="fw-bold text-14">Sub Kategori Produk</div>
                                <div class="js-prod-subcat-detail text-14">
                                    <div class="ssc-line w-80 mb-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>