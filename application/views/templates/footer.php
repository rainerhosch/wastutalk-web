<footer class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <h5>Wastutalk STT Wastukancana</h5>
                <p class="pe-4">Event Sharing Sekolah Tinggi Teknologi Wastukancana Purwakarta.</p>
                <div class="social-links mt-3">
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled">
                    <li><a href="<?php echo site_url(); ?>">Beranda</a></li>
                    <!-- <li><a href="<?php echo site_url('pengumuman/' . date('Y')); ?>">Pengumuman</a></li> -->
                    <li><a href="<?php echo site_url('arsip/' . date('Y')); ?>">Arsip</a></li>
                    <li><a href="<?php echo site_url('panduan/panduan-pembicara'); ?>">Panduan</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-6">
                <h5>Tautan Terkait</h5>
                <ul class="list-unstyled">
                    <li><a href="https://stt-wastukancana.ac.id" target="_blank">Website STT Wastukancana</a></li>
                    <li><a href="https://simak.wastu.digital">Sistem Informasi Akademik</a></li>
                    <li><a href="https://elib.wastu.digital">Perpustakaan Digital</a></li>
                    <li><a href="https://pmb.wastu.digital">Penerimaan Mahasiswa</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-12">
                <h5>Hubungi Kami</h5>
                <p>
                    Jl. Cikopak No.53, Sadang<br>
                    Kab. Purwakarta, Jawa Barat 41151<br><br>
                    <strong>Telepon:</strong> (0264) 200996<br>
                    <strong>Email:</strong> ppm@wastukancana.ac.id<br>
                </p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container text-center">
            <small>&copy; <?php echo date('Y'); ?> Pusat PPM STT Wastukancana. All Rights Reserved.</small>
        </div>
    </div>
</footer>
<style>
    /* --- Social Media Links Style --- */
.footer .social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    margin-right: 10px;
    text-decoration: none;
    transition: background-color 0.3s;
}
.footer .social-links a:hover {
    background-color: var(--accent-color);
    color: var(--primary-color);
}
</style>
