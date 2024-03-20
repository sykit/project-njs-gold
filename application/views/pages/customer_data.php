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
                                        <label class="mb-2 text-right">Sales Area</label>
                                    </div>
                                    <div class=" col-10">
                                        <select class="form-control" name="sales_area_id" onchange="updateClusterMain()">
                                            <option value="x"> All</option>
                                            <?php
                                            foreach ($sales_area as $item) {
                                            ?>
                                                <option value="<?= $item->sales_area_id; ?>"><?= trim($item->sales_area_name); ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="mb-2 text-right">Nama Cluster</label>
                                    </div>
                                    <div class=" col-10">
                                        <select class="form-control" name="cluster_id">
                                            <option value="x"> All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <label class="mb-2 text-right">Tipe Pelanggan</label>
                                    </div>
                                    <div class=" col-10">
                                        <select class="form-control" name="company_type_id">
                                            <option value="x"> All</option>
                                            <?php
                                            foreach ($company_type as $item) {
                                            ?>
                                                <option value="<?= $item->company_type_id; ?>"><?= trim($item->company_type_name); ?></option>
                                            <?php
                                            }
                                            ?>
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
                        <div class="d-flex">
                            <div class="ms-auto">
                                <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#addcustomer" onclick="openAddCustomer()">
                                    Tambah Pelanggan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-12">
                        <table class="table table-strip" id="table_customer">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Area</th>
                                    <th>Cluster</th>
                                    <th>Tipe Pelanggan</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Owner</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Tindakan</th>
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
<?php $this->load->view("modal/modal-add-customer.php"); ?>
<?php $this->load->view("modal/modal-edit-customer.php"); ?>
<?php $this->load->view("modal/modal-delete-customer.php"); ?>

<script>
    let dTable=""

    $(function() {
        dTable = new DataTable('#table_customer', {
            "bFilter": true,
            "lengthMenu": [10, 20, ],
            "bSort": true,
            "ordering": true,
            "processing": true,
            "serverSide": false,
            "responsive": true,
            "language": {
                "emptyTable": "<i class='bi-info-circle-fill'></i>&nbsp;&nbsp;Tidak ada data yang ditampilkan"
            },
            "ajax": {
                "url": URL + 'asynccustomer/getAllCustomer',
                "dataSrc": "",
                timeout: 3000,
            },
            "drawCallback": function(settings) {
                setTimeout(() => {
                    $('.js-skeleton').addClass('d-none');
                    $('.js-table').css('visibility', 'visible');
                }, 25);
            },
            columns: [
                {
                    data: 'no'
                },
                {
                    data: 'sales_area_name'
                },
                {
                    data: 'cluster_name'
                },
                {
                    data: 'company_type_name'
                },
                {
                    data: 'company_code'
                },
                {
                    data: 'company_name'
                },
                {
                    data: 'company_owner_name'
                },
                {
                    data: 'company_address'
                },
                {
                    data: 'company_phone'
                },
                
                {
                    data: 'company_id'
                }
            ],
            createdRow: function(row, data, dataIndex) {
                let str = '<a data-bs-target="#editcustomer" data-bs-toggle="modal" onclick="openEditcustomer(\'' + data.company_id + '\')" class="btn btn-primary"><i class="bi bi-pen"></i></a>' +
                    '<a data-bs-target="#delcustomer" data-bs-toggle="modal" href="" onclick="openDeletecustomer(\'' + data.company_id + '\',\'' + data.company_name + '\')"class="btn btn-danger"><i class="bi bi-trash"></i></a>'
                $(row).find('td:eq(9)').empty().append(str)
            }

        });
    });

    function updateClusterMain() {
        let sales_area_id = $('#searchView select[name=sales_area_id]').val()
        console.log(sales_area_id);

        generateURL = URL + 'Asynccustomer/getClusterBySalesArea'

        $.ajax({
            url: generateURL,
            type: "GET",
            data: {
                sales_area_id: sales_area_id,
            },
            success: function(data) {
                console.log(data);
                data = JSON.parse(data);
                let cluster_id = $('#searchView select[name=cluster_id]')
                cluster_id.empty().append('<option value="x"> All</option>')
                for(let i = 0; i<data.length; i++){
                    cluster_id.append('<option value="'+data[i].cluster_id+'">'+data[i].cluster_name+'</option>')
                }
                cluster_id.select2()
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    
    function updateTable(){
        let sales_area_id = $('#searchView select[name=sales_area_id]').val()
        let cluster_id = $('#searchView select[name=cluster_id]').val()
        let company_type_id = $('#searchView select[name=company_type_id]').val()

        let url =  URL + 'asynccustomer/getCustomer?sales_area_id='+sales_area_id+'&cluster_id='+cluster_id+'&company_type_id='+company_type_id
        
        dTable.clear().draw();
        dTable.ajax.url(url).load();
    }
</script>