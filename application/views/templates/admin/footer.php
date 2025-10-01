<!--begin::Footer-->
<style>
    .app-footer {
        background: linear-gradient(90deg, #f8fafc 0%, #e3e8ee 100%);
        border-top: 1.5px solid #e0e6ed;
        color: #34495e;
        font-size: 1rem;
        padding: 1.25rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 -2px 16px rgba(44, 62, 80, 0.04);
        position: relative;
        z-index: 10;
    }
    .app-footer a {
        color: #4f8cff;
        font-weight: 500;
        transition: color 0.2s;
    }
    .app-footer a:hover {
        color: #38c6d9;
        text-decoration: underline;
    }
    .app-footer .footer-right {
        font-size: 1.05rem;
        color: #7b8a99;
        letter-spacing: 0.02em;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .app-footer .footer-copyright {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.05rem;
    }
    @media (max-width: 768px) {
        .app-footer {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
            gap: 0.5rem;
        }
        .app-footer .footer-right,
        .app-footer .footer-copyright {
            justify-content: center;
        }
    }
</style>
<footer class="app-footer">
    <div class="footer-copyright">
        <strong>
            &copy; 2014-2025&nbsp;
            <a href="#" class="text-decoration-none">Wastukancana</a>.
        </strong>
        <span>All rights reserved.</span>
    </div>
    <div class="footer-right float-end d-none d-sm-inline">
        <i class="bi bi-lightning-charge-fill" style="color:#f7b731;"></i>
        <span>Made with <span style="color:#eb5c5c;">&#10084;</span> by WithDiv</span>
    </div>
</footer>
<!--end::Footer-->