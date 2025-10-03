<!--begin::Sidebar-->
<style>
    /* Modern Clean Sidebar Styles */
    .app-sidebar {
        background: linear-gradient(135deg, #f8fafc 0%, #e3e8ee 100%);
        border-right: 1.5px solid #e0e6ed;
        min-height: 100vh;
        box-shadow: 2px 0 16px rgba(44, 62, 80, 0.04);
        transition: background 0.2s;
    }
    .sidebar-brand {
        padding: 2rem 1.5rem 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #e3e8ee;
        background: #ecf0f4;
    }
    .sidebar-brand .brand-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
    }
    .sidebar-brand .brand-image {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        background: #eaf6ff;
        object-fit: contain;
    }
    .sidebar-brand .brand-text {
        font-size: 1.35rem;
        font-weight: 700;
        color: #0dcaf0;
        letter-spacing: 1px;
        text-shadow: 0 1px 0 #fff;
    }
    .sidebar-wrapper {
        padding: 1.5rem 0.5rem 1.5rem 0.5rem;
    }
    .sidebar-menu {
        gap: 0.25rem;
    }
    .sidebar-menu .nav-item {
        margin-bottom: 0.25rem;
        border-radius: 10px;
        transition: background 0.18s;
    }
    .sidebar-menu .nav-item.active,
    .sidebar-menu .nav-item:hover {
        background: linear-gradient(90deg, #eaf6ff 0%, #b894ff2e 100%);
        /* background: linear-gradient(90deg, #eaf6ff 0%, #0dcaf0 100%); */
        /* background: linear-gradient(90deg, #eaf6ff 0%, #d6eaff 100%); */
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.04);
    }
    .sidebar-menu .nav-link {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        padding: 0.85rem 1.25rem;
        color: #34495e;
        font-size: 1.08rem;
        font-weight: 500;
        border-radius: 10px;
        background: transparent;
        transition: color 0.18s, background 0.18s;
        text-decoration: none;
    }
    .sidebar-menu .nav-link.active,
    .sidebar-menu .nav-link:focus,
    .sidebar-menu .nav-link:hover {
        color: #4f8cff;
        background: transparent;
    }
    .sidebar-menu .nav-icon {
        font-size: 1.25rem;
        color: #38c6d9;
        background: #eaf6ff;
        border-radius: 6px;
        padding: 0.35rem;
        min-width: 2rem;
        text-align: center;
        transition: background 0.18s, color 0.18s;
    }
    .sidebar-menu .nav-link.active>p,
    .sidebar-menu .nav-link:focus>p,
    .sidebar-menu .nav-link:hover>p
    {
        /* font-size: 1rem; */
        /* font-weight: 500; */
        color: #4e8ffd;
        /* text-shadow: 0 1px 0 #fff; */
    }
    /* .sidebar-menu .nav-link:focus,
    .sidebar-menu .nav-link:hover
    {
        font-size: 1rem;
        font-weight: 500;
        color: #276099;
        text-shadow: 0 1px 0 #fff;
    } */
    .sidebar-menu .nav-item.active .nav-icon,
    .sidebar-menu .nav-link:hover .nav-icon {
        color: #000;
        background: #4f8cff;
    }
    .sidebar-menu .nav-arrow {
        margin-left: auto;
        font-size: 1rem;
        color: #b0b8c1;
        transition: transform 0.2s;
    }
    .sidebar-menu .nav-item.active > .nav-link .nav-arrow {
        color: #4f8cff;
        transform: rotate(-90deg);
    }
    .nav-treeview {
        background: #f5faff;
        border-radius: 8px;
        margin: 0.25rem 0 0.5rem 0.5rem;
        padding: 0.25rem 0.5rem 0.25rem 1.25rem;
        box-shadow: none;
    }
    .nav-treeview .nav-item {
        margin-bottom: 0.15rem;
        border-radius: 8px;
    }
    .nav-treeview .nav-link {
        font-size: 0.98rem;
        color: #4f8cff;
        padding: 0.6rem 1rem;
        background: transparent;
        border-radius: 8px;
        font-weight: 500;
        gap: 0.65rem;
    }
    .nav-treeview .nav-link:hover,
    .nav-treeview .nav-link.active {
        background: #eaf6ff;
        color: #38c6d9;
    }
    .nav-treeview .nav-icon {
        font-size: 1.1rem;
        color: #38c6d9;
        background: #eaf6ff;
        border-radius: 5px;
        padding: 0.2rem;
        min-width: 1.5rem;
        text-align: center;
    }
    @media (max-width: 991px) {
        .app-sidebar {
            min-width: 0;
            width: 100vw;
            border-right: none;
        }
        .sidebar-wrapper {
            padding: 1rem 0.25rem;
        }
        .sidebar-brand {
            padding: 1.25rem 1rem 1rem 1rem;
        }
    }
</style>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="<?= base_url('admin/dashboard'); ?>" class="brand-link">
            <span class="brand-text fw-light">WASTU-TALK</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <?php
                if ($this->session->userdata('role') == 1) {
                    $where = [
                        'm.is_active' => 1
                    ];
                    // $this->db->distinct();
                    $this->db->select('m.id_menu, m.nama_menu, m.link_menu, m.type, m.icon, m.is_active');
                    $this->db->from('sys_menu m');
                    $this->db->where($where);
                    $this->db->order_by('m.urutan_menu', 'asc');
                    // $this->db->order_by('m.id_menu', 'asc');
                    $menu = $this->db->get()->result_array();
                } else {
                    $where = [
                        'uam.role_id' => $this->session->userdata('role'),
                        'm.is_active' => 1
                    ];
                    // $this->db->distinct();
                    $this->db->select('m.id_menu, m.nama_menu, m.link_menu, m.type, m.icon, m.is_active');
                    $this->db->from('sys_menu m');
                    $this->db->join('sys_user_access_menu uam', 'm.id_menu=uam.menu_id');
                    $this->db->where($where);
                    // $this->db->order_by('m.id_menu', 'asc');
                    $this->db->order_by('m.type', 'desc');
                    $menu = $this->db->get()->result_array();
                }

                
                foreach ($menu as $mn):
                    ?>
                    <?php if ($mn['type'] != 'dinamis'): ?>
                        <?php $class = ($this->uri->segment(1).'/'.$this->uri->segment(2) == $mn['link_menu']) ? 'active menu-open' : ''; ?>
                        <li class="nav-item <?= $class ?>">
                            <a href="<?= base_url('') . $mn['link_menu']; ?>" class="nav-link <?= $class ?>">
                                <i class="nav-icon <?= $mn['icon']; ?>"></i>
                                <p class="nav-text"><strong><?= $mn['nama_menu'] ?></strong></p>
                            </a>
                        </li>
                    <?php else: ?>
                        <?php $class = ($this->uri->segment(2) == $mn['link_menu']) ? 'active menu-open' : ''; ?>
                        <li class="nav-item <?= $class ?>">
                            <a href="javascript:void(0)" class="nav-link <?= $class ?>">
                                <i class="nav-icon <?= $mn['icon']; ?>"></i>
                                <p class="nav-text">
                                    <strong><?= $mn['nama_menu'] ?></strong>
                                    <i class="nav-arrow bi bi-chevron-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                $where = [
                                    'sm.is_active' => 1
                                ];
                                $this->db->select('*');
                                $this->db->from('sys_submenu sm');
                                $this->db->where($where);
                                $this->db->order_by('nama_submenu', 'asc');
                                $submenu = $this->db->get()->result_array();
                                foreach ($submenu as $sm):
                                    if ($sm['id_menu'] === $mn['id_menu']):
                                        $classx = ($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3) == $sm['url']) ? 'active' : '';
                                ?>
                                        <li class="nav-item mx-1" style="font-size: 14px;">
                                            <a href="<?= base_url('') . $sm['url']; ?>" class="nav-link <?= $classx ?>">
                                                <i class="nav-icon <?= $sm['icon'] ?>"></i>
                                                <p class="nav-text"><?= $sm['nama_submenu']; ?></p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</aside>
<!--end::Sidebar-->