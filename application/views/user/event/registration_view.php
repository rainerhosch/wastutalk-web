<style>
    .registration-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
        border: none;
        margin-bottom: 2rem;
        transition: box-shadow 0.2s;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .registration-card-header {
        background: linear-gradient(90deg, #4f8cff 0%, #38c6d9 100%);
        border-radius: 18px 18px 0 0;
        padding: 1.5rem 2rem 1rem 2rem;
        color: #fff;
        text-align: center;
    }
    .registration-card-title {
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin: 0;
    }
    .registration-form .form-label {
        font-weight: 500;
    }
    .registration-form .form-control {
        border-radius: 8px;
    }
    .registration-form .btn-primary {
        background: #4f8cff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        font-size: 1rem;
        transition: background 0.2s;
    }
    .registration-form .btn-primary:hover {
        background: #08464f;
    }
</style>

<main class="main-content">
    <div class="container-fluid py-4">
        <div class="registration-card mb-4">
            <div class="registration-card-header">
                <h3 class="registration-card-title">Form Pendaftaran Event</h3>
            </div>
            <div class="card-body p-4">
                <form id="form_event_registration" class="registration-form" enctype="multipart/form-data" method="post">
                    <div class="mb-3">
                        <label for="event_select" class="form-label">Pilih Event</label>
                        <select class="form-control" id="event_select" name="event_id" disabled>
                            <option value="">-- Pilih Event --</option>
                            <?php if (!empty($event_latest)) : ?>
                                <?php foreach ($event_latest as $event) : ?>
                                    <option value="<?= $event->id; ?>" <?= (isset($event_id) && $event_id == $event->id) ? 'selected' : ''; ?>>
                                        <?= $event->title; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="participant_name" class="form-label">Nama Lengkap <span style="font-size: 10px; color: red;">*(nama digunakan untuk sertifikat)</span></label>
                        <input type="text" class="form-control" id="participant_name" name="participant_name" value="<?= $user[0]->name;?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="participant_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="participant_email" name="participant_email" value="<?= $user[0]->email;?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="participant_phone" class="form-label">No. HP</label>
                        <input type="text" class="form-control" id="participant_phone" name="participant_phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="institution" class="form-label">Asal Instansi/Sekolah</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        // Load daftar event ke select
        function loadEventOptions() {
            $.ajax({
                type: "GET",
                url: "Event/get_event_list",
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">-- Pilih Event --</option>';
                    if (response.status && response.data.event_list.length > 0) {
                        $.each(response.data.event_list, function (i, event) {
                            options += `<option value="${event.id}">${event.title} (${event.sesi_date})</option>`;
                        });
                    }
                    $('#event_select').html(options);
                }
            });
        }

        loadEventOptions();

        // Submit form pendaftaran event
        $('#form_event_registration').on('submit', function (e) {
            e.preventDefault();

            const form = $('#form_event_registration')[0];
            const formData = new FormData(form);

            $.ajax({
                type: "POST",
                url: "Event/register_event",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        $('#form_event_registration')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Berhasil',
                            text: response.msg || 'Anda berhasil mendaftar event.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.msg || 'Pendaftaran gagal.'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan pada server.'
                    });
                }
            });
        });
    });
</script>