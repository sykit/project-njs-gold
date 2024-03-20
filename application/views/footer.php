</main>

<!-- load all modal here -->
  <?php $this->load->view("modal/modal-add-user.php"); ?>
  <?php $this->load->view("modal/modal-add-category.php"); ?>
  <?php $this->load->view("modal/modal-add-subcategory.php"); ?>
  <?php $this->load->view("modal/modal-add-fgroup.php"); ?>
  <?php $this->load->view("modal/modal-add-product"); ?>

  <?php $this->load->view("modal/modal-edit-fgroup.php"); ?>
  <?php $this->load->view("modal/modal-edit-category.php"); ?>
  <?php $this->load->view("modal/modal-edit-subcategory.php"); ?>
  <?php $this->load->view("modal/modal-edit-product.php"); ?>
  <?php $this->load->view("modal/modal-edit-user.php"); ?>
  
  <?php $this->load->view("modal/modal-delete-fgroup.php"); ?>
  <?php $this->load->view("modal/modal-delete-category.php"); ?>
  <?php $this->load->view("modal/modal-delete-subcategory.php"); ?>
  <?php $this->load->view("modal/modal-delete-product.php"); ?>

  <?php $this->load->view("modal/modal-product.php"); ?>
<!-- end load modal -->

<!-- start modal scm -->
  <?php $this->load->view("modal/scm/som/modal-order-detail.php"); ?>
  <?php $this->load->view("modal/scm/som/modal-edit-order-detail.php"); ?>
<!-- end modal scm -->

<script src="<?= base_url(); ?>public/js/core/bpopper.min.js"></script>
<script src="<?= base_url(); ?>public/js/core/cbootstrap.min.js"></script>
<script src="<?= base_url(); ?>public/js/core/dmatchheight.js"></script>
<script src="<?= base_url(); ?>public/js/core/elazysizes.min.js"></script>
<script src="<?= base_url(); ?>public/js/core/fjqueryform.min.js"></script>
<script src="<?= base_url(); ?>public/js/core/fsweetalert.min.js"></script>
<script src="<?= base_url(); ?>public/js/core/gimagepicker.min.js"></script>
<script src="<?= base_url(); ?>public/js/vendors.min.js"></script>
<script src="<?= base_url(); ?>public/js/lodash.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/xlsx.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.5/jszip.js"></script>
<script src="<?= base_url(); ?>public/js/auth.js"></script>
<script src="<?= base_url(); ?>public/js/main.js"></script>
<script src="<?= base_url(); ?>public/js/form.js"></script>
<script src="<?= base_url(); ?>public/js/modal.js"></script>
<script src="<?= base_url(); ?>public/js/product.js"></script>
<script src="<?= base_url(); ?>public/js/menu.js"></script>
<script src="<?= base_url(); ?>public/js/scm/alpha.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/som.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/somdl.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/som-inprogress.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/som-order-detail.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/som-inprocess.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/som-complete.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/somv.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/somv-inprogress.js"></script>
<script src="<?= base_url(); ?>public/js/scm/som/somv-inprocess.js"></script>


</body>
</html>
