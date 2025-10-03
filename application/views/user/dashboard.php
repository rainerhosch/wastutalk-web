<main class="container py-4">
    <h2 class="mb-4">Event Terbaru</h2>
    <div class="row">
        <?php if (isset($event_list) && !empty($event_list)): ?>
            <?php foreach ($event_list as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($event['event_image'])): ?>
                            <img src="<?= base_url('assets/uploads/event/' . date('Y') . '/' . $event['event_image']) ?>"
                                class="card-img-top" alt="Banner Event">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                            <p class="card-text mb-1">
                                <strong>Tanggal:</strong> <?= date('d M Y', strtotime($event['sesi_date'])) ?>
                            </p>
                            <p class="card-text mb-1">
                                <strong>Jam:</strong> <?= htmlspecialchars($event['start_time']) ?> -
                                <?= htmlspecialchars($event['end_time']) ?>
                            </p>
                            <p class="card-text mb-1">
                                <strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?>
                            </p>
                            <?php if (!empty($event['speaker'])): ?>
                                <p class="card-text mb-1">
                                    <strong>Pembicara:</strong> <?= htmlspecialchars($event['speaker']) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="<?= base_url('user/event/register/' . htmlspecialchars($event['id'])) ?>" class="btn btn-success btn-sm">Daftar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada event terbaru.
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>