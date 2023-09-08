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
                            <span class="card-label fw-bolder fs-3 mb-1">Edit Sub Menu</span>
                        </h3>
                    </div>
                    <hr>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3">
                        <h5 class="card-title align-items-start flex-column">
                            <span class="card-label text-primary fw-bolder fs-4 mb-1">Sub Menu</span>
                        </h5>
                        <?php foreach ($dataSubMenu as $key => $menu):?>
                        <form action="<?=base_url('menu/save_edit_sub');?>" method="post">
                            <div class="mb-3">
                                <input type="hidden" value="<?=$menu['id_sub'];?>" class="form-control" required
                                    name="id_sub" id="id_sub">
                                <input type="hidden" value="<?=$menu['parent_id'];?>" class="form-control" required
                                    name="id_parent" id="id_parent">
                            </div>
                            <div class="mb-3">
                                <label for="nama_menu" class="form-label">Short Name</label>
                                <input type="text" class="form-control" value="<?=$menu['nama_menu'];?>" required
                                    name="nama_menu" id="nama_menu">
                            </div>
                            <div class="mb-3">
                                <label for="link_menu" class="form-label">Link Sub Menu</label>
                                <input type="text" class="form-control" value="<?=$menu['link_menu'];?>" required
                                    name="link_menu" id="link_menu">
                            </div>
                            <div class="text-end my-3">
                                <a href="<?=base_url('menu');?>" class="btn btn-sm btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                        <?php endforeach;?>
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