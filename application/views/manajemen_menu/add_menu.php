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
                            <span class="card-label fw-bolder fs-3 mb-1">Tambah Menu</span>
                        </h3>
                    </div>
                    <hr>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3">
                        <h5 class="card-title align-items-start flex-column">
                            <span class="card-label text-primary fw-bolder fs-4 mb-1">Parent Menu</span>
                        </h5>
                        <form action="<?=base_url('menu/add_menu');?>" method="post">

                            <div class="mb-3">
                                <label for="id_parent" class="form-label">Short Name</label>
                                <input type="text" value="<?=$jumlah_menu+1?>" class="form-control" required
                                    name="id_parent" id="id_parent">
                            </div>
                            <div class="mb-3">
                                <label for="short_name" class="form-label">Short Name</label>
                                <input type="text" class="form-control" required name="short_name" id="short_name">
                            </div>
                            <div class="mb-3">
                                <label for="long_name" class="form-label">Long Name</label>
                                <input type="text" class="form-control" required name="long_name" id="long_name">
                            </div>
                            <div class="mb-3">
                                <label for="ikon" class="form-label">Ikon</label>
                                <!-- <input type="text" class="form-control" required name="ikon" id="ikon"> -->
                                <textarea class="form-control" required name="ikon" id="ikon"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="link_parent" class="form-label">Link Parent Menu</label>
                                <input type="text" class="form-control" required name="link_parent" id="link_parent">
                            </div>

                            <div id="additional_inputs"></div>
                            <button type="button" id="add_input" class="btn btn-sm btn-secondary"><i
                                    class="bi bi-plus-circle"></i>
                                Sub Menu</button>
                            <div class="text-end my-3">
                                <a href="<?=base_url('menu');?>" class="btn btn-sm btn-danger">Kembali</a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const additionalInputs = document.getElementById('additional_inputs');
    const addInputButton = document.getElementById('add_input');

    let inputIndex = 1;

    addInputButton.addEventListener('click', function() {
        const newInput = `<h5 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-4 text-primary mb-1">Sub Menu</span>
                                    </h5>
                                    <div class="mb-3">
                                        <label for="nama_sub_${inputIndex}" class="form-label">Nama Sub Menu</label>
                                        <input type="text" class="form-control" required name="sub_name[]" id="nama_sub_${inputIndex}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="link_sub_${inputIndex}" class="form-label">Link Sub Menu</label>
                                        <input type="text" class="form-control" required name="link_sub[]" id="link_sub_${inputIndex}">
                                    </div>`;

        additionalInputs.insertAdjacentHTML('beforeend', newInput);
        inputIndex++;
    });
});
</script>