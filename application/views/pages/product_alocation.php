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
                                 <li class="breadcrumb-item"><a href="<?= base_url(); ?>product">Product</a></li>
                                 <li class="breadcrumb-item active" aria-current="page">Alokasi Produk</li>
                             </ol>
                         </nav>
                     </div>
                     <!-- end breadcrumb -->
                    <?php $this->load->view('/components/response.php'); ?>

                     <script>
                         function updatePelanggan() {

                             let nwom = $('#transaction-content select[name=nwom]').val()
                             console.log(nwom);

                             generateURL = URL + 'Asyncproductalocation/getNWOMDetail'

                             $.ajax({
                                 url: generateURL,
                                 type: "GET",
                                 data: {
                                     nwom: nwom,
                                 },
                                 success: function(data) {
                                     console.log(data);
                                     data = JSON.parse(data);
                                     $('#transaction-content input[name=kategori_pelanggan]').val(data[0].company_type_name)
                                     $('#transaction-content input[name=pelanggan]').val(data[0].company_name)
                                     updateTable();
                                 },
                                 error: function(err) {
                                     console.log(err);
                                 }
                             });
                         }
                     </script>
                     <style>
                         .text-right {
                             text-align: end;
                         }
                     </style>
                     <div class="row mb-lg-5 mb-2 mt-lg-4 pt-lg-2 ">
                         <div class="col col-12 col-lg-12">
                             <form enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>manage/product_alocation/add">
                                 <div class="card text-left">
                                     <div class="card-header">
                                         <div class="d-flex gap-3 scm-header-menu">
                                             <!-- <button type="button" title="Add Record" href="#somAddProduct" data-bs-target="#somAddProduct" data-bs-toggle="modal"><i class="bi bi-file-earmark-plus-fill fs-3"></i></button> -->
                                             <!-- <button type="submit" title="Simpan"><i class="bi bi-save2-fill fs-3"></i></button> -->
                                             <button type="submit" name="send" title="Kirim"><i class="bi bi-send-check-fill fs-3"></i></button>
                                             <!-- <button type="submit" name="reject" title="Menolak"><i class="bi bi-file-earmark-x-fill fs-3"></i></button> -->
                                             <!-- <button type="submit" title="Tindak-lanjut"><i class="bi bi-file-earmark-arrow-up-fill fs-3"></i></button> -->
                                             <button name="print" title="Cetak"><i class="bi bi-printer-fill fs-3"></i></button>
                                         </div>
                                     </div>
                                     <div class="card-body print-area" id="transaction-content">
                                         <div class="trans-title">
                                             <h4 class="fw-bold mb-4 mb-lg-2">Alokasi Produk</h4>
                                         </div>
                                         <div class="transaction__header">
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Kode Transaksi
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <input type="text" class="form-control" name="trans_code" value="-" readonly />
                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Tanggal Transaksi
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <select class="form-control" name="trans_date" disabled>
                                                         <option value="<?php echo strtotime(date_create()->format('l, d-M-Y H:i:s')) * 1000; ?>"><?php echo date_create()->format('l, d-M-Y H:i:s'); ?></option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Status Transaksi
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <select name="trans_status_id" class="form-control js-trans-status" disabled>
                                                         <?php
                                                            foreach ($trans_status as $item) {
                                                            ?>
                                                             <option value="<?= $item->trans_status_id; ?>" <?php if($item->trans_status_id == '4'){echo "selected";}?>>
                                                                 <?= $item->trans_status_name; ?></option>
                                                         <?php
                                                            }
                                                            ?>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Lokasi Transaksi
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <select class="form-control js-trans-loc1" name="trans_loc" disabled>
                                                         <?php
                                                            foreach ($trans_loc as $item) {
                                                            ?>
                                                             <option value="<?= $item->company_id; ?>">
                                                                 <?= $item->company_name; ?></option>
                                                         <?php
                                                            }
                                                            ?>
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <hr style="color:black" />
                                         <div class="text-center text--blue-soft mb-lg-3 mb-4">
                                             *DOKUMEN INI MERUPAKAN BUKTI TRANSAKSI YANG DIAKUI OLEH PT NJS*
                                         </div>

                                         <div class="transaction__detail">
                                             <h6 class="fw-bold mb-4">Deskripsi Permintaan</h6>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Nomor Work Order Marketing
                                                     </label>
                                                 </div>
                                                 <!-- <?php if($item->th_id == '1'){echo"selected";} ?> -->
                                                 <div class="col col-lg-4">
                                                     <select class="form-control" name="nwom" onchange="updatePelanggan()">
                                                         <?php
                                                            foreach ($nwom as $item) {
                                                            ?>
                                                             <option value="<?= $item->th_id; ?>" ><?= $item->trans_code; ?></option>
                                                         <?php
                                                            }
                                                            ?>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Kategori Pelanggan
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <input type="text" name="kategori_pelanggan" class="form-control" readonly>
                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Pelanggan
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <input type="text" name="pelanggan" class="form-control" readonly>

                                                 </div>
                                             </div>
                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Catatan
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-4">
                                                     <input type="text" class="form-control" name="note" />
                                                 </div>
                                             </div>

                                             <div class="row mb-2">
                                                 <div class="col col-lg-2">
                                                     <label>
                                                         Total Berat
                                                     </label>
                                                 </div>
                                                 <div class="col col-lg-2" style="max-width:200px;">
                                                     <input type="text" name="total_berat" class="form-control" readonly>
                                                 </div>
                                             </div>



                                             <div class="table-responsive mt-5 js-table-order">
                                                 <table class="table table-strip " id="table-detail">
                                                     <thead>
                                                         <th>No</th>
                                                         <th>Nomor Model</th>
                                                         <th>Kategori</th>
                                                         <th>Sub Kategori</th>
                                                         <th>Kode Sepuh</th>
                                                         <th>Kode Kadar</th>
                                                         <th>Ukuran</th>
                                                         <th>Jumlah Order</th>
                                                         <th>Jumlah Alokasi</th>
                                                         <th>Berat Alokasi</th>
                                                         <!-- <th class="no-print">Tindakan</th> -->
                                                     </thead>
                                                     <tbody class="js-table-order-body">

                                                     </tbody>
                                                 </table>
                                             </div>
                                             <div class="row mt-4">
                                                 <div class="col col-4 col-lg-2">
                                                     Dikirim oleh:
                                                 </div>
                                                 <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                     <b><?php echo $this->session->userdata('surname'); ?></b>
                                                 </div>
                                                 <div class="col col-4 col-lg-2" style="border-bottom: 1px solid #ccc;">
                                                     <?php echo date('Y/m/d'); ?>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="card-footer text-body-secondary d-none">
                                         2 days ago
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <script>
                         let dTable = ""

                         $(function() {
                             updatePelanggan();

                             dTable = new DataTable('#table-detail', {
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
                                     "url": URL + 'Asyncproductalocation/getListOrder',
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
                                         data: 'no'
                                     },
                                     {
                                         data: 'product_class_name'
                                     },
                                     {
                                         data: 'product_category_name'
                                     },
                                     {
                                         data: 'prd_sub_cat_name'
                                     },
                                     {
                                         data: 'sepuh_code'
                                     },
                                     {
                                         data: 'prd_rate_code'
                                     },
                                     {
                                         data: 'size'
                                     },
                                     {
                                         data: 'n1'
                                     },
                                     {
                                         data: 'n1'
                                     },
                                     {
                                         data: 'n2'
                                     },

                                    //  {
                                    //      data: 'td_id'
                                    //  }
                                 ],
                                 createdRow: function(row, data, dataIndex) {
                                    //  let str = '<a data-bs-target="#editcustomer" data-bs-toggle="modal" onclick="openEditcustomer(\'' + data.company_id + '\')" class="btn btn-primary"><i class="bi bi-pen"></i></a>'
                                    //  $(row).find('td:eq(10)').empty().append(str)
                                     let str2 = '<input type="number" class="form-control text-right" value="' + data.n1 + '" name="n1\[\]" onchange="updateTotalBerat()">'
                                     $(row).find('td:eq(8)').empty().append(str2)
                                     let str3 = '<input type="number" class="form-control text-right" value="' + data.n2 + '" name="n2\[\]" onchange="updateTotalBerat()">'
                                     $(row).find('td:eq(9)').empty().append(str3)
                                     let str4 = '<input type="hidden" class="form-control text-right" value="' + data.td_id + '" name="td_id\[\]" >'
                                     $(row).find('td:eq(0)').append(str4)

                                 },
                                 "drawCallback": function(settings) {
                                     updateTotalBerat()

                                 },


                             });
                         });

                         //  function updateClusterMain() {
                         //     let nwom = $('#transaction-content select[name=nwom]').val()

                         //     //  let sales_area_id = $('#searchView select[name=sales_area_id]').val()
                         //     //  console.log(sales_area_id);

                         //      generateURL = URL + 'Asyncproductalocation/getListOrder'

                         //      $.ajax({
                         //          url: generateURL,
                         //          type: "GET",
                         //          data: {
                         //             id: nwom,
                         //          },
                         //          success: function(data) {
                         //              console.log(data);
                         //              data = JSON.parse(data);
                         //              let cluster_id = $('#searchView select[name=cluster_id]')
                         //              cluster_id.empty().append('<option value="x"> All</option>')
                         //              for (let i = 0; i < data.length; i++) {
                         //                  cluster_id.append('<option value="' + data[i].cluster_id + '">' + data[i].cluster_name + '</option>')
                         //              }
                         //              cluster_id.select2()
                         //          },
                         //          error: function(err) {
                         //              console.log(err);
                         //          }
                         //      });
                         //  }


                         function updateTable() {
                             let nwom = $('#transaction-content select[name=nwom]').val()

                             let sales_area_id = $('#searchView select[name=sales_area_id]').val()
                             let cluster_id = $('#searchView select[name=cluster_id]').val()
                             let company_type_id = $('#searchView select[name=company_type_id]').val()

                             let url = URL + 'Asyncproductalocation/getListOrder?th_id=' + nwom

                             dTable.clear().draw();
                             dTable.ajax.url(url).load();
                             updateTotalBerat()
                         }

                         function updateTotalBerat() {
                             total_berat = 0;
                             $('#transaction-content input[name="n2[]"]').each(function(index, value) {
                                 total_berat += parseInt($(value).val())
                             })
                             $('#transaction-content input[name=total_berat]').val(total_berat)
                             console.log(total_berat)
                         }
                     </script>
                 </div>
             </div>
         </div>
     </div>
 </div>