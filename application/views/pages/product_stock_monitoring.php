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
                                <li class="breadcrumb-item active" aria-current="page">Kelola Pelanggan</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- end breadcrumb -->
                    <!-- respons -->
                    <?php $this->load->view('/components/response.php'); ?>
                    <!-- end respons -->
                    <div class="row mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                        <div class="mb-lg-5 mb-2 mt-lg-4  pt-lg-2">
                            <div class="col col-12 col-lg-6 mb-lg-2 mb-2" id="searchView">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="mb-2 text-right">Kategori Produk</label>
                                    </div>
                                    <div class=" col-10">

                                        <select class="form-control" name="product_category_id" onchange="updateSubCategory()" required>
                                            <option value="x" selected> ALL</option>
                                            <?php
                                            foreach ($category as $item) {
                                            ?>
                                                <option value="<?= $item->product_category_id; ?>">
                                                    <?= $item->product_category_name; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="mb-2 text-right">Sub Kategori Produk</label>
                                    </div>
                                    <div class=" col-10">

                                        <select class="form-control" name="prd_sub_cat_id" required>
                                            <option value="x" selected> ALL</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">

                                    </div>
                                    <div class="col-push-2 col-10">
                                        <button type="button" class="btn btn-primary" onclick="updateTable()">
                                            proses
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col col-12 col-lg-12">
                        <table class="table table-strip" id="tabel_product_Stock">
                            <thead>
                                <tr>
                                    <th>Kategori Produk</th>
                                    <th>Sub Kategori Produk</th>
                                    <th>Kadar</th>
                                    <th>Sepuh</th>
                                    <th>Jumlah</th>
                                    <th>Berat (gr)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<?php $this->load->view("modal/modal-detail-product-stock.php"); ?>

<script>
    let dTable = ""

    $(function() {
        dTable = new DataTable('#tabel_product_Stock', {
            "bFilter": true,
            "lengthMenu": [10, 20, ],
            "bSort": true,
            "ordering": true,
            "processing": true,
            "serverSide": false,
            "responsive": true,
            "searching": false,

            "language": {
                "emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
            },
            "ajax": {
                "url": URL + 'Asyncproductstock/getAllProductStock',
                "dataSrc": "",
                timeout: 3000,
            },
            "drawCallback": function(settings) {
                setTimeout(() => {
                    $('.js-skeleton').addClass('d-none');
                    $('.js-table').css('visibility', 'visible');
                }, 25);
            },
            columns: [{
                    data: 'product_category_name'
                },
                {
                    data: 'prd_sub_cat_name'
                },
                {
                    data: 'prd_rate_code'
                },
                {
                    data: 'sepuh_code'
                },
                {
                    data: 'jumlah',
                    class: 'text-end'
                },
                {
                    data: 'jewelry_weight',
                    class: 'text-end'
                },

            ],
            createdRow: function(row, data, dataIndex) {
                let str = '<a class="text-primary" data-bs-target="#detailProdukStock" data-bs-toggle="modal" onclick="openDetailProductStok(\'' + data.product_category_id + '\',\'' + data.prd_sub_cat_id + '\',\'' + data.prd_sub_cat_name + '\')" >'+data.prd_sub_cat_name+'</a>'
                $(row).find('td:eq(1)').empty().append(str)
            }
            

        });
    });

    function updateSubCategory() {
        let product_category_id = $('#searchView select[name=product_category_id]').val()
        console.log(product_category_id);

        generateURL = URL + 'Asyncproductstock/getSubCategory'

        $.ajax({
            url: generateURL,
            type: "GET",
            data: {
                product_category_id: product_category_id,
            },
            success: function(data) {
                console.log(data);
                data = JSON.parse(data);
                let cluster_id = $('#searchView select[name=prd_sub_cat_id]')
                cluster_id.empty().append('<option value="x"> All</option>')
                for (let i = 0; i < data.length; i++) {
                    cluster_id.append('<option value="' + data[i].prd_sub_cat_id + '">' + data[i].prd_sub_cat_name + '</option>')
                }
                cluster_id.select2()
            },
            error: function(err) {
                console.log(err);
            }
        });
    }


    function updateTable() {
        let product_category_id = $('#searchView select[name=product_category_id]').val()
        let prd_sub_cat_id = $('#searchView select[name=prd_sub_cat_id]').val()

        let url = URL + 'Asyncproductstock/getProductStock?prd_sub_cat_id=' + prd_sub_cat_id + '&product_category_id=' + product_category_id

        dTable.clear().draw();
        dTable.ajax.url(url).load();
    }
</script>