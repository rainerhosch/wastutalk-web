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
		
		<!-- Statistics Section -->
		<div class="row g-4 mb-5">
			<!-- Chart Widget -->
			<div class="col-lg-8">
				<div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
					<div class="card-body p-4">
						<h5 class="card-title fw-bold mb-4 text-primary d-flex align-items-center">
							<i class="fa-solid fa-chart-simple me-2"></i> Statistik Partisipan per Event
						</h5>
						<div style="position: relative; height: 260px;">
							<canvas id="participantsChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Stats Counter Cards -->
			<div class="col-lg-4">
				<div class="d-flex flex-column gap-3 h-100 justify-content-between">
					<!-- Event Card -->
					<div class="card border-0 shadow-sm rounded-4 text-white flex-fill p-3" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<p class="mb-1 text-white-50 small fw-semibold">Total Event</p>
								<h3 class="mb-0 fw-bold"><?= $total_event; ?></h3>
							</div>
							<div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
								<i class="fa-regular fa-calendar-days fs-3"></i>
							</div>
						</div>
					</div>
					
					<!-- Speaker Card -->
					<div class="card border-0 shadow-sm rounded-4 text-white flex-fill p-3" style="background: linear-gradient(135deg, #1b5e20, #4caf50);">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<p class="mb-1 text-white-50 small fw-semibold">Total Pemateri</p>
								<h3 class="mb-0 fw-bold"><?= $total_speaker; ?></h3>
							</div>
							<div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
								<i class="fa-solid fa-user-tie fs-3"></i>
							</div>
						</div>
					</div>
					
					<!-- Participant Card -->
					<div class="card border-0 shadow-sm rounded-4 text-white flex-fill p-3" style="background: linear-gradient(135deg, #e65100, var(--accent-color));">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<p class="mb-1 text-white-50 small fw-semibold">Total Partisipan</p>
								<h3 class="mb-0 fw-bold"><?= $total_participant; ?></h3>
							</div>
							<div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
								<i class="fa-solid fa-users fs-3"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Latest Posts Section -->
		<div id="event-terbaru">
			<h2 class="section-title"><?= $page;?></h2>
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
								<img src="<?php echo base_url('assets/uploads/event/'.date('Y', strtotime($post->sesi_date)) . '/' . $post->event_image); ?>" class="card-img-top"
									alt="<?php echo $post->title; ?>">

								<div class="card-body">
									<p class="card-meta">
										<span><?php echo date('d M Y', strtotime($post->sesi_date)); ?></span> -
										<span class="badge text-bg-primary"><?php echo $post->title; ?></span>
									</p>
									<h5 class="card-title" style="font-size:14px;"><?php echo $post->tema_event; ?></h5>
									<p class="card-text text-muted" style="font-size:12px;"><?= $post->speaker; ?></p>
									<p class="card-text text-muted mb-3" style="font-size:12px;">
										<i class="fa-solid fa-users text-primary me-1"></i><strong><?= $post->participant_count; ?></strong> Partisipan
									</p>
									<a href="<?php echo site_url('event/detail?id=' . $post->id); ?>" class="btn btn-primary">Lihat
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
			
			<!-- Pagination Section -->
			<?php if (isset($total_pages) && $total_pages > 1): ?>
				<nav aria-label="Navigasi Event" class="mt-5">
					<ul class="pagination justify-content-center gap-2">
						<!-- Tombol Sebelumnya (Previous) -->
						<li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
							<a class="page-link px-4 py-2 border-0 shadow-sm rounded-pill text-dark d-flex align-items-center" href="<?php echo ($current_page > 1) ? site_url('event?page=' . ($current_page - 1)) : '#'; ?>" tabindex="-1" <?php echo ($current_page <= 1) ? 'aria-disabled="true" style="opacity: 0.5; pointer-events: none;"' : ''; ?>>
								<i class="fa-solid fa-chevron-left me-2 text-primary"></i> Sebelumnya
							</a>
						</li>
						
						<!-- Halaman Aktif / Info Halaman -->
						<li class="page-item disabled">
							<span class="page-link px-4 py-2 border-0 shadow-sm rounded-pill bg-white text-dark fw-semibold">
								Halaman <?php echo $current_page; ?> dari <?php echo $total_pages; ?>
							</span>
						</li>

						<!-- Tombol Selanjutnya (Next) -->
						<li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
							<a class="page-link px-4 py-2 border-0 shadow-sm rounded-pill text-dark d-flex align-items-center" href="<?php echo ($current_page < $total_pages) ? site_url('event?page=' . ($current_page + 1)) : '#'; ?>" <?php echo ($current_page >= $total_pages) ? 'aria-disabled="true" style="opacity: 0.5; pointer-events: none;"' : ''; ?>>
								Selanjutnya <i class="fa-solid fa-chevron-right ms-2 text-primary"></i>
							</a>
						</li>
					</ul>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- Chart.js CDN & Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('participantsChart').getContext('2d');
    
    // Prepare chart data from PHP
    const chartData = <?php echo json_encode($chart_data); ?>;
    const labels = chartData.map(item => item.label);
    const data = chartData.map(item => item.value);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Partisipan',
                data: data,
                backgroundColor: 'rgba(25, 118, 210, 0.75)', // matches --secondary-color
                borderColor: '#0D47A1', // matches --primary-color
                borderWidth: 2,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(13, 71, 161, 0.9)',
                barPercentage: 0.5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#212529',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#6c757d',
                        font: {
                            family: 'Inter',
                            size: 11
                        }
                    },
                    grid: {
                        color: '#f1f1f1'
                    }
                },
                x: {
                    ticks: {
                        color: '#6c757d',
                        font: {
                            family: 'Inter',
                            size: 10
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>