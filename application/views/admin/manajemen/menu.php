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
                                    data-bs-target="#addMenu">
                                    Add Menu
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table id="menu-datatable" class="custom-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Menu</th>
                                        <th class="text-center">Tipe</th>
                                        <th class="text-center">Icon</th>
                                        <th class="text-center">Status Aktif</th>
                                        <th class="text-center">Option</th>
                                    </tr>
                                </thead>
                                <tbody id="menu_tbody">
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
            <div class="modal fade" id="addMenu" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header text-center">
                            <h4 class="modal-title fs-5 white-text w-100 font-weight-bold py-2">Tambah Menu</h4>
                            <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                        </div>

                        <!--Body-->
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/menu'); ?>/AddNewMenu" method="post"
                                enctype="multipart/form-data">
                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="nama_menu">Nama</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="nama_menu" name="nama_menu"
                                            class="form-control validate">
                                        <input class="form-control" type="hidden" id="is_active" name="is_active"
                                            value="0">
                                    </div>
                                </div>
                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="link_menu">Link Menu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="link_menu" name="link_menu"
                                            class="form-control validate">
                                    </div>
                                </div>
                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="icon_menu">Icon</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="icon_menu" name="icon_menu"
                                            class="form-control validate">
                                    </div>
                                </div>
                                <div class="input-group input-group-sm row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="type_menu">Type</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="type_menu" name="type_menu" class="form-select form-select-sm"
                                            style="width: 100%;" data-placeholder="Pilih Type Menu.." tabindex="-1"
                                            aria-hidden="true">
                                            <option value="x" disabled>--Pilih Tipe--</option>
                                            <option value="statis">Statis</option>
                                            <option value="dinamis">Dinamis</option>
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
            <div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Menu</h5>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/menu'); ?>/UpdateMenu" method="post"
                                enctype="multipart/form-data">
                                <input class="form-control" type="hidden" class="form-control" value=""
                                    name="id_menu_edit" id="id_menu_edit">
                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="nama_menu_edit">Nama
                                            Menu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="nama_menu_edit"
                                            name="nama_menu_edit" class="form-control validate">
                                    </div>
                                </div>

                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="link_menu_edit">Link
                                            Menu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="link_menu_edit"
                                            name="link_menu_edit" class="form-control validate">
                                    </div>
                                </div>
                                <div class="input-group input-group-sm mb-5 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="icon_menu_edit">Icon</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" id="icon_menu_edit"
                                            name="icon_menu_edit" class="form-control validate">
                                    </div>
                                </div>

                                <div class="input-group input-group-sm row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="type_menu_edit">Type</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="type_menu_edit" name="type_menu_edit"
                                            class="form-select form-select-sm" style="width: 100%;">
                                            <option value="x" disabled>--Pilih Tipe--</option>
                                            <?php $type = $this->menu->typeMenu()->result_array();
                                            foreach ($type as $t):
                                                ?>
                                                <option class="<?= $t['type']; ?>" value="<?= $t['type']; ?>">
                                                    <?= strtoupper($t['type']); ?>
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
            <div class="modal" tabindex="-1" role="dialog" id="hapusMenu">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content2">
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/menu'); ?>/DeleteMenu" method="post"
                                enctype="multipart/form-data">
                                <input class="form-control" type="hidden" class="form-control" value=""
                                    name="hapus_id_menu" id="hapus_id_menu">
                                <h1>Delete Menu</h1>
                                <p>Apakah anda yakin, ingin menghapus menu tersebut?</p>

                                <div class="clearfix">
                                    <button type="button"
                                        onclick="document.getElementById('hapusMenu').style.display='none'"
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