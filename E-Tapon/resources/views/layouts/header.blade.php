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
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                <a class="nav-link" href="#">Features</a>
                <a class="nav-link" href="#">Pricing</a>
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </div>
        </div>
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