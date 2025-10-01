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
<!-- Event Management Page -->
<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="custom-card mb-4">
                    <div class="custom-card-header d-flex justify-content-between align-items-center">
                        <h3 class="custom-card-title"><?= $page; ?></h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalAddEvent">
                            <i class="fa fa-plus me-1"></i> Tambah Event
                        </button>
                    </div>
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

        <!-- Modal Tambah Event -->
        <div class="modal fade" id="modalAddEvent" tabindex="-1" aria-labelledby="modalAddEventLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form_add_event" enctype="multipart/form-data" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddEventLabel">Add Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="add_event_name" class="form-label">Nama Event</label>
                                <input type="text" class="form-control" id="add_event_name" name="event_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_title" class="form-label">Label Event</label>
                                <input type="text" class="form-control" id="add_title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_event_speaker" class="form-label">Pemateri</label>
                                <input type="text" class="form-control" id="add_event_speaker" name="speaker" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_tema_event" class="form-label">Tema</label>
                                <textarea class="form-control" id="add_tema_event" name="tema_event"
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="add_sesi_date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="add_sesi_date" name="sesi_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_start_time" class="form-label">Jam Mulai</label>
                                <input type="time" class="form-control" id="add_start_time" name="start_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_end_time" class="form-label">Jam Selesai</label>
                                <input type="time" class="form-control" id="add_end_time" name="end_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_location" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" id="add_location" name="location" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_event_uri" class="form-label">Link Event</label>
                                <input type="text" class="form-control" id="add_event_uri" name="event_uri" required>
                            </div>
                            <div class="mb-3">
                                <label for="add_presensi_uri" class="form-label">Link Presensi</label>
                                <input type="text" class="form-control" id="add_presensi_uri" name="presensi_uri"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="add_event_banner" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="add_event_banner" name="event_banner" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Edit Event -->
        <div class="modal fade" id="modalEditEvent" tabindex="-1" aria-labelledby="modalEditEventLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                </div>
            </div>
        </div>
    </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        // Load data event
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
                                <button class="btn btn-sm btn-warning btn-edit-event" data-id="${event.id}"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger btn-delete-event" data-id="${event.id}"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>`;
                        });
                    } else {
                        html = `<tr><td colspan="6" class="text-center">Belum ada data event.</td></tr>`;
                    }
                    $('#event_tbody').html(html);
                }
            });
        }

        loadEventData();

        // Tambah event
        $('#form_add_event').on('submit', function (e) {
            e.preventDefault();

            const form = $('#form_add_event')[0];
            const formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "Event/add_event",
                data: formData,
                contentType: false,      // penting: biar browser set sendiri
                processData: false,      // penting: biar FormData tidak diubah jadi string
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        $('#modalAddEvent').modal('hide');
                        $('#form_add_event')[0].reset();
                        loadEventData();
                    } else {
                        alert(response.msg || 'Gagal menambah event.');
                    }
                }
            });
        });

        // Edit event (show modal)
        $(document).on('click', '.btn-edit-event', function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "Event/get_event_by_id",
                data: { id: id },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    if (response.status) {
                        let event = response.data;
                        let html = `
                        <form id="form_edit_event">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditEventLabel">Edit Event</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="${event.id}">
                                <div class="mb-3">
                                    <label for="edit_event_name" class="form-label">Nama Event</label>
                                    <input type="text" class="form-control" id="edit_event_name" name="event_name" value="${event.event_name}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_title" class="form-label">Label Event</label>
                                    <input type="text" class="form-control" id="edit_title" name="title" value="${event.title}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_sesi_date" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="edit_sesi_date" name="sesi_date" value="${event.sesi_date}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_start_time" class="form-label">Jam Mulai</label>
                                    <input type="time" class="form-control" id="edit_start_time" name="start_time" value="${event.start_time}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_end_time" class="form-label">Jam Selesai</label>
                                    <input type="time" class="form-control" id="edit_end_time" name="end_time" value="${event.end_time}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_location" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="edit_location" name="location" value="${event.location}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_event_uri" class="form-label">Link Event</label>
                                    <input type="text" class="form-control" id="edit_event_uri" name="event_uri" value="${event.event_uri}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_presensi_uri" class="form-label">Link Presensi</label>
                                    <input type="text" class="form-control" id="edit_presensi_uri" name="presensi_uri" value="${event.presensi_uri}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_tema_event" class="form-label">Tema</label>
                                    <textarea class="form-control" id="edit_tema_event" name="tema_event" required>${event.tema_event}</textarea>
                                </div>
                            <div class="mb-3">
                                <label for="edit_event_banner" class="form-label">Upload File (Opsional)</label>
                                <input type="file" class="form-control" id="edit_event_banner" name="event_banner">
                                <div class="form-text">File saat ini: <span id="current_event_banner">${event.file_name ? event.file_name : 'Tidak ada file'}</span></div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                        `;
                        $('#modalEditEvent .modal-content').html(html);
                        $('#modalEditEvent').modal('show');
                    } else {
                        alert(response.msg || 'Gagal mengambil data event.');
                    }
                }
            });
        });

        // Submit edit event
        $(document).on('submit', '#form_edit_event', function (e) {
            e.preventDefault();
            const form = $('#form_edit_event')[0];
            const formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "Event/update_event",
                data: formData,
                contentType: false,      // penting: biar browser set sendiri
                processData: false,      // penting: biar FormData tidak diubah jadi string
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        $('#modalEditEvent').modal('hide');
                        $('#form_edit_event')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.msg || 'Event berhasil diupdate.'
                        });
                        loadEventData();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.msg || 'Gagal mengupdate event.'
                        });
                    }
                }
            });
        });
    });
    // Inisialisasi flatpickr pada elemen yang sudah ada dan yang akan dirender dinamis
    function initializeFlatpickr() {
        if (typeof flatpickr !== "undefined") {
            // Date picker untuk tanggal
            $("[id$='_sesi_date']").each(function () {
                if (!this._flatpickr) {
                    $(this).flatpickr({
                        // dateFormat: "mm-dd-YYYY",
                        allowInput: true,
                        // locale: "id"
                    });
                }
            });

            // Time picker untuk jam mulai
            $("[id$='_start_time']").each(function () {
                if (!this._flatpickr) {
                    $(this).flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        allowInput: true
                    });
                }
            });

            // Time picker untuk jam selesai
            $("[id$='_end_time']").each(function () {
                if (!this._flatpickr) {
                    $(this).flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        allowInput: true
                    });
                }
            });
        }
    }

    // Panggil saat dokumen siap
    $(document).ready(function () {
        initializeFlatpickr();
    });

    // Panggil juga setiap kali konten dinamis dirender (misal setelah ajax render modal/form)
    $(document).on('shown.bs.modal', function () {
        initializeFlatpickr();
    });
</script>