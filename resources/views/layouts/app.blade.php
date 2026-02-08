<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan') - Sistem Manajemen Perpustakaan</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Plus Jakarta Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3398ebff;
            --navbar-bg: #ececec;
        }

        * {
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .black-header {
            background-color: #000;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1200;
        }

        .black-header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 6px 16px;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .black-header-content p {
            color: #efefefce;
            font-family: "Inter", sans-serif;
            font-size: 13px;
            font-weight: 500;
        }

        .contact-icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .contact-icons a {
            display: inline-flex;
            align-items: center;
            color: #fff;
            text-decoration: none;
            opacity: 0.95;
        }

        .contact-icons svg {
            width: 16px;
            height: 16px;
            fill: #fff;
        }

        .lang-switcher {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .lang-btn {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        .lang-btn.active {
            background: #fff;
            color: #000;
            border-color: #fff;
        }

        body {
            background-color: #fff;
            min-height: 100vh;
            padding-top: 128px;
        }

        .navbar {
            background: var(--navbar-bg);
            position: fixed;
            top: 48px;
            /* below black header */
            width: 100%;
            height: 80px;
            z-index: 1100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            padding: 0 24px;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            font-weight: 700;
            font-size: 1.15rem;
            margin-right: 20px;
        }

        .navbar-brand img {
            width: 120px;
            height: auto;
            object-fit: contain;
            margin-right: 12px;
        }

        .navbar-nav {
            display: flex;
            flex-direction: row;
            gap: 28px;
            align-items: center;
            margin-left: auto;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar-nav .nav-link {
            color: rgba(0, 0, 0, 0.8);
            text-decoration: none;
            padding: 8px 14px;
            border-radius: 6px;
            transition: all 0.18s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 12px;
        }

        .mobile-toggle svg {
            width: 32px;
            height: 32px;
        }

        .mobile-logo {
            display: none;
        }

        .mobile-sidebar {
            position: fixed;
            top: 0px;
            left: 0;
            width: 250px;
            height: 100%;
            background: #ffffff;
            box-shadow: 2px 0 12px rgba(0, 0, 0, 0.12);
            transform: translateX(-100%);
            transition: transform 0.25s ease;
            z-index: 1201;
            padding-top: 0;
        }

        .mobile-sidebar.open {
            transform: translateX(0);
        }

        .mobile-sidebar .nav-link {
            display: block;
            padding: 12px 18px;
            color: rgba(0, 0, 0, 0.85);
        }

        /* close button inside sidebar */
        .sidebar-close {
            position: absolute;
            top: 8px;
            right: 8px;
            background: transparent;
            border: none;
            padding: 8px;
            cursor: pointer;
            color: #333;
        }

        .sidebar-close svg {
            width: 18px;
            height: 18px;
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease;
            z-index: 1200;
        }

        .sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
        }

        .sidebar-logo {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
        }

        .sidebar-logo img {
            height: 66px;
            width: auto;
            object-fit: contain;
        }

        @media (max-width: 950px) {
            .navbar-brand img {
                width: 90px;
            }

            .navbar-nav {
                gap: 12px;
            }

            body {
                padding-top: 110px;
            }

            .navbar {
                display: none !important;
            }

            .mobile-toggle {
                display: inline-block;
            }

            .mobile-logo {
                display: none;
            }

            .black-header-content {
                padding: 6px 12px;
            }

            body {
                padding-top: 110px;
            }
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            background: rgba(52, 152, 235, 0.08);
            color: var(--primary);
            font-weight: 600;
        }

        .main-content {
            padding: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            background: var(--primary);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
        }

        .btn-primary {
            background: #495057;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #3a488aff 0%, #6a4190 100%);
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }

        .badge-count {
            background: var(--primary);
            font-size: 0.85rem;
            padding: 5px 12px;
        }

        .page-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }
    </style>
</head>

<body>
    <div class="black-header">
        <div class="black-header-content">
            <button class="mobile-toggle" aria-label="Open menu" onclick="openSidebar()" title="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="#fff">
                    <path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" />
                </svg>
            </button>
            <p style="margin:0;">Prototype by Aby, Yosef and Dylan | LnT Back-End Bina Nusantara Computer Club (BNCC) Malang</p>
            <div class="contact-icons">
                <a href="https://github.com/Abysswdh/MidProjectLnT-Backend" target="_blank" title="GitHub">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2 .37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82A7.65 7.65 0 018 4.6c.68 0 1.36.09 2 .27 1.53-1.03 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8 8 0 0016 8c0-4.42-3.58-8-8-8z"></path>
                    </svg>
                </a>
                <div class="lang-switcher">
                    <button class="lang-btn active" data-lang="en" onclick="setLanguage('en')">EN</button>
                    <button class="lang-btn" data-lang="id" onclick="setLanguage('id')">ID</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar">
        <a href="http://127.0.0.1:8000" class="navbar-brand">
            <img src="http://127.0.0.1:8000/images/BINUSTransparent.png" alt="LnT">
        </a>

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === null ? 'active' : '' }}" href="http://127.0.0.1:8000">
                    <i class="bi bi-speedometer2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === 'categories' ? 'active' : '' }}" href="http://127.0.0.1:8000/categories">
                    <i class="bi bi-folder"></i>Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === 'books' ? 'active' : '' }}" href="http://127.0.0.1:8000/books">
                    <i class="bi bi-journal-text"></i>Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === 'members' ? 'active' : '' }}" href="http://127.0.0.1:8000/members">
                    <i class="bi bi-people"></i>Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::segment(1) === 'borrowings' ? 'active' : '' }}" href="http://127.0.0.1:8000/borrowings">
                    <i class="bi bi-arrow-left-right"></i>Peminjaman
                </a>
            </li>
        </ul>
    </nav>
    <div id="sidebarBackdrop" class="sidebar-backdrop" onclick="closeSidebar()"></div>
    <aside id="mobileSidebar" class="mobile-sidebar" aria-hidden="true">
        <button class="sidebar-close" aria-label="Close menu" onclick="closeSidebar()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="sidebar-logo">
            <img src="/images/BINUSTransparent.png" alt="BINUS Logo">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ Request::segment(1) === null ? 'active' : '' }}" href="http://127.0.0.1:8000"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::segment(1) === 'categories' ? 'active' : '' }}" href="http://127.0.0.1:8000/categories"><i class="bi bi-folder"></i> Kategori</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::segment(1) === 'books' ? 'active' : '' }}" href="http://127.0.0.1:8000/books"><i class="bi bi-journal-text"></i> Buku</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::segment(1) === 'members' ? 'active' : '' }}" href="http://127.0.0.1:8000/members"><i class="bi bi-people"></i> Anggota</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::segment(1) === 'borrowings' ? 'active' : '' }}" href="http://127.0.0.1:8000/borrowings"><i class="bi bi-arrow-left-right"></i> Peminjaman</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openSidebar() {
            var sidebar = document.getElementById('mobileSidebar');
            var backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar) sidebar.classList.add('open');
            if (backdrop) backdrop.classList.add('show');
            if (sidebar) sidebar.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            var sidebar = document.getElementById('mobileSidebar');
            var backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar) sidebar.classList.remove('open');
            if (backdrop) backdrop.classList.remove('show');
            if (sidebar) sidebar.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        function setLanguage(lang) {
            document.querySelectorAll('.lang-btn').forEach(function(btn) {
                btn.classList.toggle('active', btn.dataset.lang === lang);
            });
            try {
                localStorage.setItem('ln_lang', lang);
            } catch (e) {}
        }
        document.addEventListener('DOMContentLoaded', function() {
            var stored = null;
            try {
                stored = localStorage.getItem('ln_lang');
            } catch (e) {}
            setLanguage(stored || 'en');
        });
    </script>
    @stack('scripts')
</body>

</html>