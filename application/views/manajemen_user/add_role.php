<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="g-5 gx-xxl-8">
                <!--begin::Tables Widget 10-->
                <div class="card">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Tambah Role</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3">
                        <form action="<?=base_url('users/add_role');?>" method="post">
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" required name="role" id="role">
                            </div>
                            <div class="mb-3">
                                <label for="kode_role" class="form-label">Kode Role</label>
                                <input type="number" name="kode_role" required class="form-control" id="kode_role">
                            </div>
                            <div class="text-end my-3">
                                <a href="<?=base_url('users/show_user_add');?>"
                                    class="btn btn-sm btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!--begin::Body-->
                </div>
                <!--end::Tables Widget 10-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
    <!--end::Row-->
</div>

<?php $this->load->view('./templates/drawers');?>
<?php $this->load->view('./templates/modals');?>