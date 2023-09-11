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
                            <span class="card-label fw-bolder fs-3 mb-1">Edit Pengguna</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-3">
                        <?php foreach ($dataUser as $key => $user):?>
                        <form action="<?=base_url('users/save_edit_user');?>" method="post">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" value="<?=$user['id_auth'];?>" required
                                    name="id_auth" id="id_auth">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" value="<?=$user['username'];?>" required
                                    name="username" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                <small>
                                    <i>
                                        Kosongkan jika tidak ingin mengubah password!
                                    </i>
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Role</label>
                                <select name="role_user" required class="form-select form-select"
                                    aria-label="Small select example">
                                    <option selected>-- Pilih Role --</option>
                                    <?php foreach ($dataRole as $key => $role):?>
                                    <option <?= $user['f_id_role'] == $role['id_role'] ? 'selected':'';?>
                                        value="<?=$role['id_role']?>"><?=$role['role']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="<?=base_url('users');?>" class="btn my-3 me-1 btn-danger">Kembali</a>
                                <button type="submit" class="btn my-3 btn-primary">Simpan</button>
                            </div>
                        </form>
                        <?php endforeach; ?>
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