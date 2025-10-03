<style>
    .text-justify {
        text-align: justify;
    }

    :root {
        --primary-color: #4A90E2;
        --text-color: #333;
        --background-color: #F8F9FA;
        --border-radius: 8px;
        --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    body {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .event-detail-container {
        display: flex;
        flex-direction: column;
        max-width: 1000px;
        margin: 40px auto;
        background: #fff;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    /* @media (min-width: 768px) {
        .event-detail-container {
            flex-direction: row;
        }
    }

    .event-image-section {
        flex: 1;
        position: relative;
        overflow: hidden;
    }

    .event-image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    } */

    @media (min-width: 768px) {
        .event-detail-container {
            /* Hapus flex-direction: row; */
            flex-direction: column;
        }
    }

    .event-image-section {
        width: 100%;
        /* Gambar akan membentang di seluruh lebar */
        height: 400px;
        /* Atur tinggi tetap atau sesuaikan dengan viewport */
        overflow: hidden;
        position: relative;
        /* Tambahkan aspek rasio untuk konsistensi */
        aspect-ratio: 16 / 9;
    }

    .event-image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Tetap gunakan cover untuk mengisi ruang */
    }

    .event-status {
        position: absolute;
        top: 20px;
        right: 20px;
        color: #fff;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .event-status.completed {
        background-color: #6c757d;
    }

    .event-status.today {
        background-color: #fd7e14;
    }

    .event-status.upcoming {
        background-color: var(--primary-color);
    }

    .event-info-section {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .event-title {
        font-size: 2.2rem;
        line-height: 1.3;
        margin-bottom: 20px;
        color: #2c3e50;
        font-weight: 600;
    }

    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
        color: #7f8c8d;
        font-size: 0.95rem;
    }

    .event-meta span {
        display: flex;
        align-items: center;
    }

    .event-meta i {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .event-speaker,
    .event-description {
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .event-speaker strong {
        color: #2c3e50;
    }

    .event-description {
        font-size: 1rem;
        color: #555;
    }

    .event-actions {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-register,
    .btn-back {
        padding: 12px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-register {
        background-color: var(--primary-color);
        color: #fff;
    }

    .btn-register:hover {
        background-color: #357ABD;
        transform: translateY(-2px);
    }

    .btn-back {
        background-color: #e9ecef;
        color: #6c757d;
    }

    .btn-back:hover {
        background-color: #ced4da;
    }
</style>
<div class="main-content">
    <div class="container">
        <!-- Hero Section -->
        <?php if (!empty($event_latest)): ?>
            <div class="event-detail-container">

                <div class="event-image-section">
                    <img src="<?php echo base_url('assets/uploads/event/' . date('Y', strtotime($event_latest->sesi_date)) . '/' . $event_latest->event_image); ?>"
                        alt="<?= $event_latest->tema_event; ?>">
                </div>

                <div class="event-info-section">
                    <h1 class="event-title"><?= $event_latest->tema_event; ?></h1>

                    <div class="event-meta">
                        <span><i class="bi bi-calendar-event"></i>
                            <?= date('d M Y', strtotime($event_latest->sesi_date)); ?></span>
                        <span><i class="bi bi-clock"></i> <?= date('H:i', strtotime($event_latest->start_time)); ?> -
                            <?= date('H:i', strtotime($event_latest->end_time)); ?> WIB</span>
                        <?php if (!empty($event_latest->lokasi)): ?>
                            <span><i class="bi bi-geo-alt"></i> <?= $event_latest->lokasi; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="event-speaker">
                        <strong>Pembicara:</strong> <?= $event_latest->speaker; ?>
                    </div>

                    <?php if (!empty($event_latest->event_desc)): ?>
                        <div class="event-description text-justify">
                            <?= nl2br($event_latest->event_desc); ?>
                        </div>
                    <?php endif; ?>

                    <div class="event-actions">
                        <?php
                        $today_date_only = date('Y-m-d');
                        $event_date_only = date('Y-m-d', strtotime($event_latest->sesi_date));

                        if ($event_date_only >= $today_date_only) {
                            echo '<a target="_blank" href="' . $event_latest->presensi_uri . '" class="btn-register">Daftar Sekarang</a>';
                            // echo '<a href="#" class="btn-register" data-bs-toggle="modal" data-bs-target="#registerEventModal">Daftar Sekarang</a>';
                        }
                        ?>
                        <a href="<?= site_url('beranda'); ?>" class="btn-back">Kembali ke Beranda</a>
                    </div>
                </div>

            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">Event tidak ditemukan.</div>
        <?php endif; ?>
    </div>

    <!-- Modal Register Event -->
    <div class="modal fade" id="registerEventModal" tabindex="-1" aria-labelledby="registerEventModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('event/regist?id=' . $event_latest->id); ?>" method="post"
                    id="eventRegisterForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerEventModalLabel">Formulir Pendaftaran Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">No. HP/WA</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi/Organisasi</label>
                            <input type="text" class="form-control" id="instansi" name="instansi">
                        </div>
                        <div class="mb-3">
                            <label for="instansi" class="form-label">Program Study <span style="font-size: 10px;">(jika
                                    ada)</span></label>
                            <input type="text" class="form-control" id="instansi" name="instansi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ganti tombol "Daftar Sekarang" agar membuka modal
            var registerBtn = document.querySelector('#btn-register');
            if (registerBtn) {
                registerBtn.setAttribute('type', 'button');
                registerBtn.setAttribute('data-bs-toggle', 'modal');
                registerBtn.setAttribute('data-bs-target', '#registerEventModal');
                registerBtn.removeAttribute('href');
            }
        });
    </script>

</div>