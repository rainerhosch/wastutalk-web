<style>
    body {
        background-color: #f0f2f5;
    }

    .form-container {
        max-width: 768px;
        margin: 40px auto;
    }

    .form-header-card {
        background: #fff;
        border-radius: 8px;
        border-top: 10px solid #673ab7;
        /* Google Form Purple */
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        overflow: hidden;
    }

    .form-header-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .form-header-content {
        padding: 25px 30px;
    }

    .form-title {
        font-size: 32px;
        color: #202124;
        font-weight: 400;
        margin-bottom: 15px;
    }

    .form-desc {
        font-size: 14px;
        color: #5f6368;
    }

    .form-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 25px 30px;
        margin-bottom: 15px;
    }

    .form-label-custom {
        font-size: 16px;
        color: #202124;
        font-weight: 500;
        margin-bottom: 15px;
    }

    .form-control-custom {
        border: none;
        border-bottom: 1px solid #dadce0;
        border-radius: 0;
        padding: 8px 0;
        font-size: 14px;
        background-color: transparent;
        transition: border-bottom 0.2s;
    }

    .form-control-custom:focus {
        box-shadow: none;
        border-bottom: 2px solid #673ab7;
        background-color: transparent;
    }

    .required-asterisk {
        color: #d93025;
    }

    .btn-submit {
        background-color: #673ab7;
        color: #fff;
        padding: 10px 24px;
        border-radius: 4px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s;
    }

    .btn-submit:hover {
        background-color: #5e35b1;
        color: #fff;
    }
</style>

<div class="main-content">
    <div class="container form-container">

        <?php if ($this->session->flashdata('alert')): ?>
            <div class="mb-4">
                <?= $this->session->flashdata('alert'); ?>
            </div>
        <?php endif; ?>

        <!-- Form Header -->
        <div class="form-header-card">
            <?php if (!empty($event->event_image)): ?>
                <img src="<?php echo base_url('assets/uploads/event/' . date('Y', strtotime($event->sesi_date)) . '/' . $event->event_image); ?>"
                    class="form-header-img" alt="Banner Event">
            <?php endif; ?>

            <div class="form-header-content">
                <h1 class="form-title">Presensi: <?= $event->tema_event; ?></h1>
                <div class="form-desc">
                    <p><strong>Label:</strong> <?= $event->title; ?></p>
                    <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($event->sesi_date)); ?> |
                        <strong>Waktu:</strong> <?= date('H:i', strtotime($event->start_time)); ?> -
                        <?= date('H:i', strtotime($event->end_time)); ?> WIB
                    </p>
                    <p><strong>Pemateri:</strong> <?= $event->speaker; ?></p>
                    <hr>
                    <p>Silakan isi form daftar hadir di bawah ini dengan data yang valid. Tanda <span
                            class="required-asterisk">*</span> menunjukkan pertanyaan wajib diisi.</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="<?= site_url('event/submit_presensi'); ?>" method="POST">
            <input type="hidden" name="id_event" value="<?= $event->id; ?>">

            <!-- Field: Nama Lengkap -->
            <div class="form-card">
                <label for="nama" class="form-label-custom">Nama Lengkap <span
                        class="required-asterisk">*</span></label>
                <input type="text" class="form-control form-control-custom" id="nama" name="nama"
                    placeholder="Jawaban Anda" required>
            </div>

            <!-- Field: NIM/NIDN -->
            <div class="form-card">
                <label for="kode_participant" class="form-label-custom">NIM/NIDN <span
                        class="required-asterisk">*</span></label>
                <input type="text" class="form-control form-control-custom" id="kode_participant"
                    name="kode_participant" placeholder="Jawaban Anda" required>
            </div>

            <!-- Field: Email -->
            <div class="form-card">
                <label for="email" class="form-label-custom">Email <span class="required-asterisk">*</span></label>
                <input type="email" class="form-control form-control-custom" id="email" name="email"
                    placeholder="Jawaban Anda" required>
            </div>

            <!-- Field: No Handphone -->
            <div class="form-card">
                <label for="no_hp" class="form-label-custom">No Handphone</label>
                <input type="text" class="form-control form-control-custom" id="no_hp" name="no_hp"
                    placeholder="Jawaban Anda">
            </div>

            <!-- Field: Nama Institusi -->
            <div class="form-card">
                <label for="institusi" class="form-label-custom">Nama Institusi <span
                        class="required-asterisk">*</span></label>
                <input type="text" class="form-control form-control-custom" id="institusi" name="institusi"
                    placeholder="Contoh: STT Wastukancana" required>
            </div>

            <!-- Field: Program Studi -->
            <div class="form-card">
                <label for="program_studi" class="form-label-custom">Program Studi <span
                        class="required-asterisk">*</span></label>
                <input type="text" class="form-control form-control-custom" id="program_studi" name="program_studi"
                    placeholder="Contoh: Teknik Pangan" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 mb-5">
                <button type="submit" class="btn btn-submit">Kirim Presensi</button>
                <a href="<?= site_url('event/detail?id=' . $event->id); ?>"
                    class="text-decoration-none text-muted">Kembali ke Detail Event</a>
            </div>
        </form>

    </div>
</div>