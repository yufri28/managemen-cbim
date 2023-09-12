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
                            <span class="card-label fw-bolder fs-3 mb-1">Tambah Pengguna</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3">
                        <form action="<?=base_url('users/add_user');?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" required name="username" id="username"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" required class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Role</label>
                                <select name="role_user" required class="form-select form-select"
                                    aria-label="Small select example">
                                    <option value="">-- Pilih Role --</option>
                                    <?php foreach ($dataRole as $key => $role):?>
                                    <option value="<?=$role['id_role']?>"><?=$role['role']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small>
                                    <i>
                                        Jika role tidak ada pada pilihan,
                                        <a href="<?=base_url('users/show_role_add');?>">
                                            Klik
                                        </a>
                                        untuk tambah data role!
                                    </i>
                                </small>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?=base_url('users');?>" class="btn my-3 me-1 btn-danger">Kembali</a>
                                <button type="submit" class="btn my-3 btn-primary">Simpan</button>
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