<style>
    /* Modal Content/Box */
    .modal-content2 {
        text-align: center;
        background-color: #fefefe;
        margin: 5% auto 15% auto;
        border: 1px solid #888;
        width: 80%;
    }

    /* Style the horizontal ruler */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    .modal-notify .modal-header {
        border-radius: 3px 3px 0 0;
    }

    .modal-notify .modal-content {
        border-radius: 3px;
    }
</style>
<style>
    /* Switch Component */
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
        vertical-align: middle;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch span {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 24px;
    }

    .switch span:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .switch-primary input:checked+span {
        background-color: #88b0db;
    }

    .switch input:checked+span {
        background-color: #4caf50;
    }

    .switch input:focus+span {
        box-shadow: 0 0 1px #88b0db;
    }

    .switch input:checked+span:before {
        transform: translateX(22px);
    }

    .switch-primary span {
        background-color: #ccc;
    }

    .switch-primary input:checked+span {
        background-color: #88b0db;
    }
</style>

<!-- Page content -->
<script>
    $(document).ready(function () {
        $(this).on("click", "#proses_edit", function (e) {
            e.preventDefault();
            let id_user = $(this).attr("value");
            if (id_user == "") {
                alert("Error in id user");
            } else {
                $.ajax({
                    type: "post",
                    url: "user/EditUser",
                    data: {
                        id_user: id_user,
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        $("#editUser").modal("show");
                        $("#edit_id_user").val(response.id);
                        $("#edit_nama").val(response.name);
                        $("#edit_username").val(response.email);
                        $("#edit_password").val(response.password_hash);
                        $("#edit_role option[class='" + response.role + "']").attr(
                            "selected",
                            "selected"
                        );
                        $("#edit_role option[class='" + response.role + "']").trigger(
                            "change"
                        );
                        // $('#edit_password').val(response.password);
                        // $('#edit_role').val(response.role);
                    },
                    error: function (e) {
                        error_server();
                    },
                });
            }
        });

        $(this).on("click", "#hapus_user", function (e) {
            e.preventDefault();
            let id_user = $(this).attr("value");
            console.log(id_user);
            if (id_user == "") {
                alert("Error in id user");
            } else {
                $("#hapus_id_user").val(id_user);
            }
        });
        // end modul user
    });
</script>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('success') . '</div>';
            } elseif ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
            }
            ?>

            <!-- Block Menu -->
            <style>
                /* Custom Modern & Clean Styles for Submenu Management */
                .custom-card {
                    background: #fff;
                    border-radius: 18px;
                    box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
                    border: none;
                    margin-bottom: 2rem;
                    transition: box-shadow 0.2s;
                }

                .custom-card:hover {
                    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.14);
                }

                .custom-card-header {
                    background: linear-gradient(90deg, #4f8cff 0%, #38c6d9 100%);
                    border-radius: 18px 18px 0 0;
                    padding: 1.5rem 2rem 1rem 2rem;
                    color: #fff;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .custom-card-title {
                    font-size: 1.5rem;
                    font-weight: 600;
                    letter-spacing: 0.5px;
                    margin: 0;
                }

                .custom-btn-add {
                    background: #4f8cff;
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    padding: 0.5rem 1.5rem;
                    font-weight: 500;
                    font-size: 1rem;
                    transition: background 0.2s;
                }

                .custom-btn-add:hover {
                    background: #08464f;
                    color: #fff;
                }

                .custom-btn-edit {
                    background: #ffba4f33;
                    color: #000;
                    border: none;
                    border-radius: 8px;
                    font-weight: 500;
                    font-size: 1rem;
                    transition: background 0.2s;
                }

                .custom-btn-edit:hover {
                    background: #ffe5bd;
                    color: #fff;
                }

                .custom-btn-delete {
                    background: #eb5c5c8c;
                    color: #000;
                    border: none;
                    border-radius: 8px;
                    font-weight: 500;
                    font-size: 1rem;
                    transition: background 0.2s;
                }

                .custom-btn-delete:hover {
                    background: #ffbfbf;
                    color: #fff;
                }

                .custom-table {
                    width: 100%;
                    border-collapse: separate;
                    border-spacing: 0;
                    background: #f9fbfd;
                    border-radius: 0 0 18px 18px;
                    overflow: hidden;
                }

                .custom-table th,
                .custom-table td {
                    padding: 1rem 0.75rem;
                    text-align: center;
                    vertical-align: middle;
                }

                .custom-table thead th {
                    background: #f1f5fa;
                    color: #4f8cff;
                    font-weight: 600;
                    border-bottom: 2px solid #e3e8ee;
                }

                .custom-table tbody tr {
                    transition: background 0.15s;
                }

                .custom-table tbody tr:hover {
                    background: #eaf6ff;
                }

                .custom-table td {
                    color: #34495e;
                    font-size: 1rem;
                }

                .custom-pagination {
                    display: flex;
                    justify-content: flex-end;
                    padding: 1rem 2rem;
                    background: transparent;
                }

                .custom-pagination .page-item .page-link {
                    color: #4f8cff;
                    border: none;
                    background: transparent;
                    font-weight: 500;
                    border-radius: 6px;
                    margin: 0 2px;
                    transition: background 0.2s, color 0.2s;
                }

                .custom-pagination .page-item.active .page-link,
                .custom-pagination .page-item .page-link:hover {
                    background: #4f8cff;
                    color: #fff;
                }

                @media (max-width: 768px) {

                    .custom-card-header,
                    .custom-pagination {
                        padding: 1rem;
                    }

                    .custom-table th,
                    .custom-table td {
                        padding: 0.5rem 0.25rem;
                        font-size: 0.95rem;
                    }
                }
            </style>
            <div class="row">
                <div class="col-md-12">

                    <div class="custom-card mb-4">
                        <div class="custom-card-header">
                            <h3 class="custom-card-title"><?= $page; ?></h3>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn custom-btn-add btnAdd" data-bs-toggle="modal"
                                    data-bs-target="#addUser">
                                    Add User
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table id="menu-datatable" class="custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Tools</th>
                                    </tr>
                                </thead>
                                <tbody id="user_tbody">
                                    <?php $i = 1; ?>
                                    <?php foreach ($datauser as $u):
                                        // if($mn['is_active'] != 0):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i; ?></td>
                                            <td class="text-center"><?= $u['name']; ?></td>
                                            <td class="text-center"><?= $u['email']; ?></td>
                                            <td class="text-center"><?= $u['role']; ?></td>
                                            <td class="text-center"><?= $u['created_at']; ?></td>
                                            <td class="text-center">
                                                <?php if ($u['role'] != 'Administrator'): ?>
                                                    <a href="#" class="btn custom-btn-edit" id="proses_edit"
                                                        value="<?= $u['id']; ?>"><i class="bi bi-pencil-square"></i></a> |
                                                    <a href="#" onclick="document.getElementById('id01').style.display='block'"
                                                        class="custom-btn-delete btn" id="hapus_user"
                                                        value="<?= $u['id']; ?>"><i class="bi bi-trash"></i></a>
                                                <?php else: ?>
                                                    <a class="btn btn-secondary btn-sm" readonly><i class="bi bi-key"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="custom-pagination">
                            <ul class="pagination pagination-sm m-0 float-end">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END Block Menu -->


            <!-- modal add -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-notify modal-warning" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header text-center">
                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Tambah User</h4>
                        </div>

                        <!--Body-->
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/user'); ?>/AddUser" method="post"
                                enctype="multipart/form-data">
                                <div class="md-form mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="nama_user">Nama</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="nama_user" name="nama_user"
                                            class="form-control validate" required>
                                    </div>
                                </div>
                                <div class="md-form mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="username">Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" id="username" name="username" class="form-control validate" required>
                                    </div>
                                </div>
                                <div class="md-form mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right"
                                            for="add_password">Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" id="add_password" name="add_password"
                                            class="form-control validate" required>
                                    </div>
                                </div>
                                <div class="md-form row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="add_role">Role</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="add_role" name="add_role" class="form-select form-select-sm"
                                            style="width: 100%;">
                                            <option value="x" disabled>--Pilih Role--</option>
                                            <?php $user_role = $this->user->roleUser()->result_array();
                                            foreach ($user_role as $ur): ?>
                                                <option class="<?= $ur['id_role']; ?>" value="<?= $ur['id_role']; ?>">
                                                    <?= $ur['role_type'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>
            <!-- end modal add -->

            <!-- modal edit -->
            <div class="modal" tabindex="-1" role="dialog" id="editUser">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/user'); ?>/UpdateUser" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" class="form-control" value="" name="edit_id_user"
                                    id="edit_id_user">
                                <input type="hidden" class="form-control" name="edit_username" id="edit_username">
                                <!-- <input type="text" value="" id="edit_id_user" name="edit_id_user" class="form-control validate"> -->
                                <div class="md-form mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="edit_nama">Nama</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="edit_nama" name="edit_nama"
                                            class="form-control validate">
                                    </div>
                                </div>

                                <div class="md-form mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right"
                                            for="edit_password">Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" id="edit_password" name="edit_password"
                                            class="form-control validate">
                                    </div>
                                </div>

                                <div class="md-form row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="edit_role">Role</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="edit_role" name="edit_role" class="form-select form-select-sm"
                                            style="width: 100%;">
                                            <option value="x" disabled>--Pilih Role--</option>
                                            <?php $user_role = $this->user->roleUser()->result_array();
                                            foreach ($user_role as $ur): ?>
                                                <option class="<?= $ur['id_role']; ?>" value="<?= $ur['id_role']; ?>">
                                                    <?= $ur['role_type'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal edit -->

            <!-- Delete Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="id01">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content2">
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/user'); ?>/DeleteUser" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" class="form-control" value="" name="hapus_id_user"
                                    id="hapus_id_user">
                                <h1>Delete Account</h1>
                                <p>Apakah anda yakin, ingin menghapus akun tersebut?</p>

                                <div class="clearfix">
                                    <button type="button" onclick="document.getElementById('id01').style.display='none'"
                                        class="btn btn-warning">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Delete Modal -->



        </div>
    </div>
</main>
<!-- END Page Content -->
<!-- <script>
    const myModal = document.getElementById('addMenu')
    const myInput = document.getElementById('addMenu')
    const myInput = document.getElementById('addMenu')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script> -->