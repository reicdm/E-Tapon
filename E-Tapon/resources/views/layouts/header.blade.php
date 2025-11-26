<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-beige: #fffbe6;
        --color-link: #e68200;
    }

    .navbar-etapon {
        background-color: var(--color-orange);
        height: 80px;
        justify-content: center;
    }

    .navbar-title {
        color: var(--color-dark-green);
        font-weight: bold;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%231f4b2c' stroke-width='3.5' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
    }



    .nav-item {
        color: var(--color-dark-green);
        font-size: 14px;
        margin: 0 10px;
    }

    .nav-link {
        color: rgba(0, 0, 0, .55);
    }

    .nav-link:focus {
        color: var(--color-dark-green);
    }

    .nav-link.active {
        color: var(--color-dark-green);
        font-weight: bold;
        border-bottom: 3px solid var(--color-dark-green);
    }
</style>

<nav class="navbar">
    <div class="navbar-etapon container-fluid">
        <a class="navbar-title" href="#">E-Tapon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bold"></span>
        </button>
    </div>
</nav>

<nav class="navbar navbar-expand-lg justify-content-center">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('collector.dashboard') ? 'active' : '' }}"
                href="{{ route('collector.dashboard') }}">
                Overview
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('collector.schedule') ? 'active' : '' }}"
                href="{{ route('collector.schedule') }}">
                Schedule
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('collector.request') ? 'active' : '' }}"
                href="{{ route('collector.request') }}">
                Request
            </a>
        </li>
    </ul>
</nav>