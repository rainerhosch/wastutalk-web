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
            url: "submenu/getDataSubMenu",
            dataType: "json",
            success: function (response) {
                if (response.length !== 0) {
                    console.log(response);
                    let html = ``;
                    let no = 1;
                    $.each(response, function (i, value) {
                        html += `<tr>`;
                        html += `<td class="text-center">${no}</td>`;
                        html += `<td class="text-center">${value.nama_menu}</td>`;
                        html += `<td class="text-center">${value.nama_submenu}</td>`;
                        html += `<td class="text-center">${value.url}</td>`;
                        html += `<td class="text-center"><i class="${value.icon}"></i></td>`;
                        if (value.is_active == 1) {
                            html += `<td class="text-center"><label class="switch switch-primary"><input id="toggle_submenu|${value.id_submenu}" for-cek="submenu" type="checkbox" value="${value.id_submenu}" status="${value.is_active}" checked><span></span></label></td>`;
                        } else {
                            html += `<td class="text-center"><label class="switch switch-primary"><input id="toggle_submenu|${value.id_submenu}" for-cek="submenu" type="checkbox" value="${value.id_submenu}" status="${value.is_active}"><span></span></label></td>`;
                        }
                        html +=
                            `<td class="text-center">` +
                            `<a href="#" class="btn custom-btn-edit btn-sm" id="btn_edit_submenu" value="${value.id_submenu}"><i class="bi bi-pencil-square"></i></a> | ` +
                            `<a href="#" onclick="document.getElementById('hapusSubmenu').style.display='block'" class="btn custom-btn-delete btn-sm btn-hapus-submenu" id="btn_hapus_submenu" value="${value.id_submenu}"><i class="bi bi-trash"></i></a>` +
                            `</td>`;
                        html += `</tr>`;
                        no++;
                    });
                    $("#submenu_tbody").html(html);
                    // Toggle
                    $('input[type="checkbox"]').change(function (event) {
                        // let id = $(this).attr("id");
                        let define = $(this).attr("for-cek");
                        if (define == "submenu") {
                            let id_submenu = $(this).attr("value");
                            let status = $(this).attr("status");
                            if (status == 0) {
                                is_active = 1;
                            } else {
                                is_active = 0;
                            }
                            if (id_submenu == "") {
                                alert("Error in id_submenu");
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "submenu/ChangeStatusSubmenu",
                                    data: {
                                        id_submenu: id_submenu,
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
                    });
                    // End Toggle
                    // hapus menu
                    $("a.btn-hapus-submenu").click(function () {
                        let id_submenu = $(this).attr("value");
                        // console.log(id_submenu);
                        if (id_submenu == "") {
                            alert("Error in id menu");
                        } else {
                            $("#hapus_id_submenu").val(id_submenu);
                        }
                    });
                    // end hapus menu
                }
            },
        });

        $(this).on("click", "#btn_edit_submenu", function (e) {
            e.preventDefault();
            let id_submenu = $(this).attr("value");
            // console.log(id_menu);
            if (id_submenu == "") {
                alert("Error in id user");
            } else {
                $.ajax({
                    type: "post",
                    url: "submenu/EditSubmenu",
                    data: {
                        id_submenu: id_submenu,
                    },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        $("#editSubmenu").modal("show");
                        $("#id_submenu_edit").val(response.id_submenu);
                        $("#nama_submenu_edit").val(response.nama_submenu);
                        $("#link_submenu_edit").val(response.url);
                        $("#icon_submenu_edit").val(response.icon);
                        $("#menu_parent_edit option[class='" + response.id_menu + "']").attr(
                            "selected",
                            "selected"
                        );
                        $(
                            "#menu_parent_edit option[class='" + response.id_menu + "']"
                        ).trigger("change");
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
                    background: #ffba4f;
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
                    background: #eb5c5c;
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
                .custom-table th, .custom-table td {
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
                    .custom-card-header, .custom-pagination {
                        padding: 1rem;
                    }
                    .custom-table th, .custom-table td {
                        padding: 0.5rem 0.25rem;
                        font-size: 0.95rem;
                    }
                }
            </style>
            <div class="row">
                <div class="col-12">
                    <div class="custom-card">
                        <div class="custom-card-header">
                            <span class="custom-card-title"><?= $page; ?></span>
                            <button type="button" class="custom-btn-add btnAdd" data-bs-toggle="modal"
                                data-bs-target="#addSubmenu">
                                <i class="fa fa-plus me-1"></i> Add Submenu
                            </button>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table id="menu-datatable" class="custom-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu Parent</th>
                                        <th>Nama Submenu</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th>Status Aktif</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody id="submenu_tbody">
                                    <!-- Data will be loaded here dynamically -->
                                </tbody>
                            </table>
                        </div>
                        <div class="custom-pagination">
                            <ul class="pagination pagination-sm m-0">
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
            <div class="modal fade" id="addSubmenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-notify modal-warning" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title white-text w-100 font-weight-bold py-2">Tambah Submenu</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/submenu'); ?>/AddNewSubmenu" method="post"
                                enctype="multipart/form-data">
                                <div class="md-form row mb-2">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="menu_parent">Menu
                                            Parent</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="menu_parent" name="menu_parent"
                                            class="form-select form-select-md" style="width: 100%;"
                                            data-placeholder="Pilih Parent Menu.." tabindex="-1" aria-hidden="true">
                                            <option value="x" disabled>--Pilih Menu--</option>
                                            <?php
                                            $where = [
                                                'editable =' => 'YES',
                                                'type' => 'dinamis'
                                            ];
                                            $menu = $this->menu->getMenu($where)->result_array();
                                            foreach ($menu as $mn): ?>
                                                <option value="<?= $mn['id_menu'] ?>"><?= $mn['nama_menu'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="nama_submenu">Nama
                                            Submenu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="nama_submenu" name="nama_submenu"
                                            class="form-control validate">
                                        <input type="hidden" id="is_active" name="is_active" value="0">
                                    </div>
                                </div>
                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="url_submenu">Url</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="url_submenu" name="url_submenu"
                                            class="form-control validate">
                                    </div>
                                </div>
                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="icon_submenu">Icon</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="icon_submenu" name="icon_submenu"
                                            class="form-control validate">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer justify-content-right text-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal add -->


            <!-- modal edit -->
            <div class="modal" tabindex="-1" role="dialog" id="editSubmenu">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Submenu</h5>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/submenu'); ?>/UpdateSubmenu" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" class="form-control" value="" name="id_submenu_edit"
                                    id="id_submenu_edit">
                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="nama_submenu_edit">Nama
                                            submenu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="nama_submenu_edit" name="nama_submenu_edit"
                                            class="form-control validate">
                                    </div>
                                </div>

                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="link_submenu_edit">Link
                                            submenu</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="link_submenu_edit" name="link_submenu_edit"
                                            class="form-control validate">
                                    </div>
                                </div>
                                <div class="md-form mb-2 row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right"
                                            for="icon_submenu_edit">Icon</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" id="icon_submenu_edit" name="icon_submenu_edit"
                                            class="form-control validate">
                                    </div>
                                </div>

                                <div class="md-form row">
                                    <div class="col-md-3">
                                        <label data-error="wrong" data-success="right" for="menu_parent_edit">Menu
                                            Parent</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select id="menu_parent_edit" name="menu_parent_edit"
                                            class="form-select form-select-md" style="width: 100%;">
                                            <option value="x" disabled>--Pilih Menu--</option>
                                            <?php
                                            $where = [
                                                'editable =' => 'YES',
                                                'type' => 'dinamis'
                                            ];
                                            $menu = $this->menu->getMenu($where)->result_array();
                                            foreach ($menu as $mn): ?>
                                                <option class="<?= $mn['id_menu'] ?>" value="<?= $mn['id_menu'] ?>">
                                                    <?= $mn['nama_menu'] ?>
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
            <div class="modal" tabindex="-1" role="dialog" id="hapusSubmenu">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content2">
                        <div class="modal-body">
                            <form action="<?= base_url('admin/manajemen/submenu'); ?>/DeleteSubmenu" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" class="form-control" value="" name="hapus_id_submenu"
                                    id="hapus_id_submenu">
                                <h1>Delete Submenu</h1>
                                <p>Apakah anda yakin, ingin menghapus submenu tersebut?</p>

                                <div class="clearfix">
                                    <button type="button"
                                        onclick="document.getElementById('hapusSubmenu').style.display='none'"
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