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
        $.ajax({
            type: "GET",
            url: "menu/getDataMenu",
            dataType: "json",
            success: function (response) {
                if (response.length !== 0) {
                    // console.log(response);
                    let html = ``;
                    let no = 1;
                    $.each(response, function (i, value) {
                        html += `<tr>`;
                        html += `<td class="text-center">${no}</td>`;
                        html += `<td class="text-center">${value.nama_menu}</td>`;
                        html += `<td class="text-center">${value.type}</td>`;
                        html += `<td class="text-center"><i class="${value.icon}"></i></td>`;
                        if (value.is_active == 1) {
                            html += `<td class="text-center"><label class="switch switch-primary"><input id="toggle_menu|${value.id_menu}" for-cek="toggle_menu" type="checkbox" value="${value.id_menu}" status="${value.is_active}" checked><span></span></label></td>`;
                        } else {
                            html += `<td class="text-center"><label class="switch switch-primary"><input id="toggle_menu|${value.id_menu}" for-cek="toggle_menu" type="checkbox" value="${value.id_menu}" status="${value.is_active}"><span></span></label></td>`;
                        }
                        html +=
                            `<td class="text-center">` +
                            `<a href="#" class="btn custom-btn-edit btn-sm edit-menu" id="btn_edit_menu" value="${value.id_menu}"><i class="bi bi-pencil-square"></i></a> | ` +
                            `<a href="#" onclick="document.getElementById('hapusMenu').style.display='block'" class="btn custom-btn-delete btn-sm btn-hapus" id="btn_hapus_menu" value="${value.id_menu}"><i class="bi bi-trash"></i></a>` +
                            `</td>`;
                        html += `</tr>`;
                        no++;
                    });
                    $("#menu_tbody").html(html);
                    // Toggle
                    $('input[type="checkbox"]').change(function (event) {
                        let cek = $(this).attr("for-cek");
                        if (cek == "toggle_menu") {
                            let id_menu = $(this).attr("value");
                            let status = $(this).attr("status");
                            if (status == 0) {
                                is_active = 1;
                            } else {
                                is_active = 0;
                            }
                            // =============================================
                            if (id_menu == "") {
                                alert("Error in id user");
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "menu/ChangeStatusMenu",
                                    data: {
                                        id_menu: id_menu,
                                        status: is_active,
                                    },
                                    dataType: "json",
                                    success: function (response) {
                                        location.reload();
                                    },
                                    error: function (e) {
                                        error_server();
                                    },
                                });
                            }
                        }
                        // end cek
                    });
                    // End Toggle
                    // =======================================
                    // hapus menu
                    $("a.btn-hapus").click(function () {
                        let id_menu = $(this).attr("value");
                        console.log(id_menu);
                        if (id_menu == "") {
                            alert("Error in id menu");
                        } else {
                            $("#hapus_id_menu").val(id_menu);
                        }
                    });
                    // end hapus menu
                }
            },
        });

        $(this).on("click", "#btn_edit_menu", function (e) {
            e.preventDefault();
            let id_menu = $(this).attr("value");
            // console.log(id_menu);
            if (id_menu == "") {
                alert("Error in id user");
            } else {
                $.ajax({
                    type: "post",
                    url: "menu/EditMenu",
                    data: {
                        id_menu: id_menu,
                    },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $("#editMenu").modal("show");
                        $("#id_menu_edit").val(response.id_menu);
                        $("#nama_menu_edit").val(response.nama_menu);
                        $("#link_menu_edit").val(response.link_menu);
                        $("#icon_menu_edit").val(response.icon);
                        $("#type_menu_edit option[class='" + response.type + "']").attr(
                            "selected",
                            "selected"
                        );
                        $("#type_menu_edit option[class='" + response.type + "']").trigger(
                            "change"
                        );
                    },
                    error: function (e) {
                        error_server();
                    },
                });
            }
        });
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
                    /* padding: 1rem 0.75rem; */
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
                            <button type="button" class="custom-btn-add btnAdd" data-bs-toggle="modal"
                                data-bs-target="#modalAddUserRole">
                                <i class="fa fa-plus me-1"></i> Add Role
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table id="menu-datatable" class="custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Menu Access</th>
                                        <th class="text-center">Tools</th>
                                    </tr>
                                </thead>
                                <tbody id="user_access_menu_tbody">
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

            <!-- Modal Add new role -->
            <div class="modal fade" id="modalAddUserRole" tabindex="-1" role="dialog"
                aria-labelledby="modalAddUserRoleTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Role Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_user_role" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="role_type" class="col-sm-3 col-form-label">Type Role</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="role_type" name="role_type"
                                            placeholder="Nama / Type Role" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                            <label for="desc" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" required>
                            </div>
                        </div> -->
                                <div class="row mt-3">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2 float-right">
                                        <button type="submit"
                                            class="btn btn-sm btn-primary btn_save_role_user">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal add menu access -->
            <div class="modal fade" id="modalAddMenuAccess" tabindex="-1" role="dialog"
                aria-labelledby="modalAddMenuAccessTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Akses Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_menu_access" enctype="multipart/form-data">
                                <div class="form-group row mb-3">
                                    <label for="type_role" class="col-sm-3 col-form-label">Type Role</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" class="form-control" id="id_role" name="id_role">
                                        <input type="text" class="form-control" id="type_role" name="type_role"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="select_menu_access" class="col-sm-3 col-form-label">Menu</label>
                                    <div class="col-sm-9">
                                        <select class="form-control custom-select" id="select_menu_access"
                                            name="select_menu_access">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2 float-right">
                                        <button type="submit" class="btn btn-sm btn-primary btn_save_menu_access"
                                            disabled>Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            url: 'UserAccesMenu/data_user_access_menu',
            dataType: "json",
            success: function (response) {
                console.log(response)
                let html = ``;
                $.each(response.data, function (i, value) {
                    html += `<tr>`;
                    html += `<td class="text-center">${value.role_type}</td>`;
                    html += `<td class="text-center"><a data-toggle="collapse" data-bs-target="#demo${value.id_role}" data-bs-toggle="collapse" class="btn btn-xs btn-default btn_access_menu accordion-toggle" nama-role="${value.role_type}" value="${value.id_role}"><i class="bi bi-eye"></i></a> 
                        <a data-toggle="tooltip" data-placement="top" title="Add new access menu for this role." class="btn btn-xs btn-primary btn_add_menu_access" nama-role="${value.role_type}" value="${value.id_role}"><i class="bi bi-plus text-small"></i></a></td>`;
                    html += `<a data-toggle="tooltip" data-placement="top" title="Delete this role." class="btn btn-xs btn-danger btn_delete_role" role-type="${value.role_type}" value="${value.id_role}"><i class="bi bi-trash text-small"></i></a>`;
                    html += `<td class="text-center">`;
                    if (value.role_type != 'Dev System') {
                        html += `<a data-toggle="tooltip" data-placement="top" title="Delete this role." class="btn btn-xs btn-danger btn_delete_role" role-type="${value.role_type}" value="${value.id_role}"><i class="bi bi-trash text-small"></i></a>`;
                    } else {
                        html += `<i>This role can't delete!</i>`;
                    }
                    html += `</tr>`;
                    html += `<tr>`;
                    html += `<td colspan="12" class="hiddenRow">`;
                    html += `<div id="demo${value.id_role}" data-bs-parent="demo${value.id_role}" class="accordion-collapse collapse">`;
                    html += `<table class="table table-striped table-bordered">`;
                    html += `<thead>`;
                    html += `<tr>`;
                    html += `<th class="text-center">Nama Menu</th>`;
                    html += `<th class="text-center">Tools</th>`;
                    html += `</tr>`;
                    html += `</thead>`;
                    $.each(value.menu_access, function (i, role_access_menu) {
                        html += `<tbody>`;
                        html += `<tr>`;
                        html += `<td class="text-center">${role_access_menu.nama_menu}</td>`;
                        html += `<td class="text-center">`;
                        if (role_access_menu.editable != 'N/A') {
                            html += `<a class="btn btn-xs custom-btn-delete btn_delete_uam" nama-menu-access="${role_access_menu.nama_menu}" value="${role_access_menu.id}"><i class="bi bi-trash"></i></a>`;
                        } else {
                            html += `<i>Not Deletable!</i>`;
                        }
                        html += `</td>`;
                        html += `</tr>`;
                        html += `</tbody>`;
                    });
                    html += `</table>`;
                    html += `</div>`;
                    html += `</td>`;
                    html += `</tr>`;
                });
                $("#user_access_menu_tbody").html(html);

                $('.btn_add_menu_access').on('click', function () {
                    let role_id = $(this).attr('value');
                    console.log(role_id)
                    $.ajax({
                        type: "POST",
                        url: "UserAccesMenu/get_menu_access",
                        data: {
                            role_id: role_id,
                        },
                        dataType: "json",
                        success: function (response) {
                            console.log(response);
                            $('#modalAddMenuAccess').modal("show");
                            $("#type_role").val(response.data.role_type);
                            $("#id_role").val(response.data.id_role);
                            if (response.data.menu_can_use != null) {
                                $('#select_menu_access').append(`<option value="x">-- Pilih Menu --</option>`);
                                $.each(response.data.menu_can_use, function (i, menu) {
                                    $('#select_menu_access').append(`<option value="${menu.id_menu}">${menu.nama_menu}</option>`);
                                });
                            }


                        }
                    })
                });
                $('#modalAddMenuAccess').on('hidden.bs.modal', function (e) {
                    $('#form_menu_access')[0].reset();
                    $('#select_menu_access').html(``);
                });

                $('#select_menu_access').on('change', function () {
                    let id_menu = this.value;
                    if (id_menu != 'x') {
                        $('.btn_save_menu_access').prop('disabled', false)
                    } else {
                        $('.btn_save_menu_access').prop('disabled', true)
                    }
                });

                $("#form_menu_access").submit(function (e) {
                    e.preventDefault();
                    let form = $(this);
                    $.ajax({
                        type: "POST",
                        url: "UserAccesMenu/simpan_menu_access",
                        data: form.serializeArray(),
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            let icon = ``;
                            let title = ``;
                            let text = ``;
                            if (response.code === 200) {
                                icon = `success`;
                                title = `Success`;
                            } else {
                                icon = `error`;
                                title = `Error`;
                            }
                            Swal.fire({
                                icon: icon,
                                title: title,
                                text: response.msg,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function (isConfirm) {
                                location.reload()
                            });
                        }
                    })
                });

                $("#form_user_role").submit(function (e) {
                    e.preventDefault();
                    let form = $(this);
                    $.ajax({
                        type: "POST",
                        url: "UserAccesMenu/simpan_role_baru",
                        data: form.serializeArray(),
                        dataType: "json",
                        success: function (response) {
                            // console.log(response);
                            let icon = ``;
                            let title = ``;
                            let text = ``;
                            if (response.code === 200) {
                                icon = `success`;
                                title = `Success`;
                            } else {
                                icon = `error`;
                                title = `Error`;
                            }
                            Swal.fire({
                                icon: icon,
                                title: title,
                                text: response.msg,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function (isConfirm) {
                                location.reload()
                            });
                        }
                    })
                });

                $('.btn_delete_role').on('click', function () {
                    let id = $(this).attr('value');
                    let nama = $(this).attr('role-type');
                    // console.log(nama);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `${nama} role, will delete!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "UserAccesMenu/delete_role_user", // where you wanna post
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function (response) {
                                    // console.log(response)
                                    let title = ``;
                                    let msg = ``;
                                    let icon = ``;
                                    if (response.code === 200) {
                                        title = `Deleted`;
                                        icon = `success`;
                                    } else {
                                        title = `Error!`;
                                        icon = `error`;
                                    }
                                    Swal.fire(
                                        title,
                                        response.msg,
                                        icon
                                    )
                                    location.reload();
                                }
                            })
                        }
                    })
                })

                $('.btn_edit_role').on('click', function () {
                    let id = $(this).attr('value');
                    console.log(id);
                });
                $('.btn_delete_uam').on('click', function () {
                    let id = $(this).attr('value');
                    let nama = $(this).attr('nama-menu-access');
                    // console.log(id);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `The access to ${nama}, will delete for this role!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "UserAccesMenu/delete_role_access_menu", // where you wanna post
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function (response) {
                                    // console.log(response)
                                    let title = ``;
                                    let msg = ``;
                                    let icon = ``;
                                    if (response.code === 200) {
                                        title = `Deleted`;
                                        icon = `success`;
                                    } else {
                                        title = `Error!`;
                                        icon = `error`;
                                    }
                                    Swal.fire(
                                        title,
                                        response.msg,
                                        icon
                                    )
                                    location.reload();
                                }
                            })
                        }
                    })
                });
            }
        });
    });
</script>
<!-- END Page Content -->
<!-- <script>
    const myModal = document.getElementById('addMenu')
    const myInput = document.getElementById('addMenu')
    const myInput = document.getElementById('addMenu')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script> -->