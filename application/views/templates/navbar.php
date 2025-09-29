<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo site_url(); ?>">
            <i class="fas fa-comments"></i>
            Wastutalk
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo site_url(); ?>">Beranda</a>
                </li>
                
                <?php 
                    $years = date('Y'); 
                    $menu_items = [
                        'event' => 'Events',
                        'about' => 'About Us',
                        'contact' => 'Contact Us'
                    ];
                ?>

                <?php foreach ($menu_items as $slug => $label): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $label; ?>
                    </a>
                    <!-- <ul class="dropdown-menu">
                        <?php foreach ($years as $year): ?>
                        <li><a class="dropdown-item" href="<?php echo site_url($slug . '/' . $year); ?>"><?php echo $year; ?></a></li>
                        <?php endforeach; ?>
                    </ul> -->
                </li>
                <?php endforeach; ?>

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Panduan
                    </a>
                    <ul class="dropdown-menu" style="right: 0; left: auto; min-width: 220px;">
                        <li><a class="dropdown-item" href="<?php echo site_url('panduan/panduan-pembicara'); ?>">Panduan Pembicara</a></li>
                        <li><a class="dropdown-item" href="<?php echo site_url('panduan/panduan-peserta'); ?>">Panduan Peserta</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</nav>