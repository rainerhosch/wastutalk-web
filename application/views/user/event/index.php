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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-striped custom-table" id="event-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Event</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Jam</th>
                                        <th class="text-center">Lokasi</th>
                                        <th class="text-center">Pemateri</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="event_tbody">
                                    <!-- Data event akan dimuat via AJAX -->
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
        </div>
    </div>
</main>
<!-- END Page Content -->
<script>

    $(document).ready(function () {
        function loadEventData() {
            $.ajax({
                type: "GET",
                url: "Event/get_event_list",
                dataType: "json",
                success: function (response) {
                    let html = '';
                    if (response.status && response.data.event_list.length > 0) {
                        $.each(response.data.event_list, function (i, event) {
                            html += `<tr>
                        <td class="text-center">${i + 1}</td>
                        <td class="text-center">${event.title}</td>
                        <td class="text-center">${event.sesi_date}</td>
                        <td class="text-center" style="font-size: 14px;">
                        Start: ${event.start_time}<br>
                        End: ${event.end_time}</td>
                        <td class="text-center">${event.location}</td>
                        <td class="text-center">${event.speaker}</td>
                        <td class="text-center">
                            ${
                                (function() {
                                    // Menggabungkan sesi_date dan end_time menjadi waktu selesai event
                                    let endDateTimeStr = event.sesi_date + ' ' + event.end_time;
                                    let endDateTime = new Date(endDateTimeStr.replace(/-/g, '/'));
                                    let now = new Date();
                                    if (now < endDateTime) {
                                        // Event belum selesai
                                        return `<a href="${event.event_uri ? event.event_uri : '#'}" class="btn btn-sm btn-primary" target="_blank"><i class="bi bi-box-arrow-in-right"></i> Buka Event</a>`;
                                    } else {
                                        // Event sudah selesai
                                        return `<button class="btn btn-sm btn-warning btn-cetak" data-id="${event.id}"><i class="bi bi-printer"></i> Cetak Sertifikat</button>`;
                                    }
                                })()
                            }
                    </tr>`;
                        });
                    } else {
                        html = `<tr><td colspan="7" class="text-center">Belum ada event, yang anda ikuti.</td></tr>`;
                    }
                    $('#event_tbody').html(html);
                }
            });
        }

        loadEventData();

        $('body').on('click', '.btn-cetak', function(){
            alert('Fitur belum tersedia!')
        })

    })
</script>