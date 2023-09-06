<?php $this->load->view('./auth/header');?>
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-image: url(<?=base_url();?>assets/media/illustrations/sketchy-1/14.png">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="<?=base_url();?><?=base_url();?>demo6/dist/index.html" class="mb-6 text-center">
                <img alt="Logo" src="<?=base_url();?>assets/media/logos/logo-cbim.png" class="h-90px" />
                <h1>CBIM</h1>
            </a>
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form class="form w-100" novalidate="novalidate" method="post" id="kt_sign_in_form"
                    action="<?=base_url('auth/login');?>">
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">LOG IN</h1>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" required
                            name="username" autocomplete="off" />
                    </div>
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" required type="password"
                            name="password" autocomplete="off" />
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Login</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./auth/footer');?>