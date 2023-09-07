<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <?php foreach ($dataParentMenu as $key => $ParentMenu):?>
                <div class="col-xxl-12">
                    <!--begin::Tables Widget 9-->
                    <div class="card card-xxl-stretch mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1"><?=$ParentMenu['short_name'];?></span>
                                <span class="text-muted mt-1 fw-bold fs-7"><?=$ParentMenu['long_name'];?></span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <form action="<?= base_url('menu/save_akses'); ?>" method="post">
                            <input type="hidden" name="id_menu" value="<?=$ParentMenu['id_menu'];?>" />
                            <div class="card-body py-3">
                                <!--begin::Table container-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bolder text-muted">
                                                <th class="min-w-150px">Pengguna</th>
                                                <th class="min-w-140px">Role</th>
                                                <th class="w-25px">
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            data-kt-check="true"
                                                            data-kt-check-target=".widget-9-check" />
                                                    </div>
                                                </th>
                                                <th class="min-w-100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>
                                            <?php foreach ($dataPengguna as $key => $pengguna):?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <img src="<?=base_url();?>assets/media/avatars/150-11.jpg"
                                                                alt="" />
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a href="#"
                                                                class="text-dark fw-bolder text-hover-primary fs-6"><?=$pengguna['username'];?></a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#"
                                                        class="text-dark fw-bolder text-hover-primary d-block fs-6"><?=$pengguna['role'];?></a>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input widget-9-check" name="id_auth[]"
                                                            type="checkbox" value="<?=$pengguna['id_auth'];?>" />
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="<?=base_url('menu');?>" class="btn my-3 me-1 btn-danger">Kembali</a>
                                    <button type="submit" class="btn my-3 btn-primary">Simpan</button>
                                </div>
                                <!--end::Table container-->
                            </div>
                        </form>
                        <!--begin::Body-->
                    </div>
                    <!--end::Tables Widget 9-->
                </div>
                <!--end::Col-->
                <?php endforeach; ?>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
    <!--end::Row-->
</div>

<?php $this->load->view('./templates/drawers');?>
<?php $this->load->view('./templates/modals');?>