<?php 
// $this->load->view('./templates/header');
?>
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <?php $this->load->view('./templates/page');?>
    <?php echo $this->session->userdata('status');?>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Drawers-->
<!--begin::Activities drawer-->
<?php $this->load->view('./templates/drawers');?>
<!--end::Chat drawer-->
<!--end::Drawers-->
<!--begin::Modals-->
<!--begin::Modal - Create App-->
<?php $this->load->view('./templates/modals');?>
<!--end::Modal - Select Location-->
<!--end::Modals-->