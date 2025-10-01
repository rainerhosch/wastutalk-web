<style>
	.text-justify {
		text-align: justify;
	}

	.ribbon {
		width: 150px;
		height: 32px;
		background:rgb(122, 122, 122);
		color: #fff;
		position: absolute;
		top: 26px;
		left: -34px;
		text-align: center;
		line-height: 32px;
		transform: rotate(315deg);
		font-size: 8px;
		font-weight: bold;
		z-index: 2;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		letter-spacing: 0.5px;
	}

	.ribbon.soon {
		background:rgb(7, 90, 255);
		color: #333;
	}

	.post-card {
		position: relative;
	}
</style>
<div class="main-content">
	<div class="container">
		<!-- Hero Section -->
		<div class="p-5 mb-5 text-white rounded-3"
			style="background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));">
			<div class="container-fluid py-5">
				<h1 class="display-4 fw-bold"><?= $title; ?></h1>
				<p class="fs-4 col-md-10">
					Menginspirasi Perubahan, Mengabdi Lewat Percakapan.
				</p>
				<hr>
				<p class="fs-8 text-justify">
					Wastukancana Talk adalah sarana yang disediakan oleh kampus STT Wastukancana untuk mendukung
					pelaksanaan Tridarma Perguruan Tinggi, khususnya dalam bidang pengabdian kepada masyarakat. Melalui
					platform ini, sivitas akademika dapat berbagi ilmu, hasil penelitian, dan inovasi, serta
					berkontribusi aktif dalam pemberdayaan dan pengembangan masyarakat secara berkelanjutan.
				</p>
				<a href="#event-terbaru" class="btn btn-light btn-lg mt-3 fw-bold">Jelajahi Event</a>
			</div>
		</div>

		<!-- Latest Posts Section -->
		<div id="event-terbaru">
			<h2 class="section-title">Event Terbaru</h2>
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
				<?php if (!empty($event_latest)): ?>
					<?php foreach ($event_latest as $post): ?>
						<div class="col">
							<div class="card post-card h-100">
								<?php
								$today = date('Y-m-d HH:mm:ss');
								$event_date = date('Y-m-d HH:mm:ss', strtotime($post->sesi_date .' '. $post->end_time));

								if ($event_date < $today) {
									// Sudah dilaksanakan
									echo '<div class="ribbon">Sudah Dilaksanakan</div>';
								} elseif ($event_date == $today) {
									// Hari ini
									echo '<div class="ribbon soon">Hari Ini</div>';
								} else {
									// Segera Hadir
									echo '<div class="ribbon soon">Segera Hadir</div>';
								}
								?>
								<img src="<?php echo base_url('assets/uploads/event/'.date('Y') . '/' . $post->event_image); ?>" class="card-img-top"
									alt="<?php echo $post->title; ?>">

								<div class="card-body">
									<p class="card-meta">
										<span><?php echo date('d M Y', strtotime($post->sesi_date)); ?></span> -
										<span class="badge text-bg-primary"><?php echo $post->title; ?></span>
									</p>
									<h5 class="card-title" style="font-size:14px;"><?php echo $post->tema_event; ?></h5>
									<p class="card-text text-muted" style="font-size:12px;"><?= $post->speaker; ?></p>
									<a href="<?php echo site_url('event/' . $post->id); ?>" class="btn btn-primary">Lihat
										Selengkapnya</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div class="col-12">
						<div class="alert alert-info text-center">Belum ada event yang dipublikasikan.</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

</div>