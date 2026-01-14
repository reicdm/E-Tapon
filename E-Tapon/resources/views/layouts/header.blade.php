@php
// Define the current route to determine active links
$currentRoute = request()->route() ? request()->route()->getName() : '';
use Illuminate\Support\Str;
@endphp

<style>
    /* ------------------------------------- */
    /* --- COLOR VARIABLES (Unchanged) --- */
    /* ------------------------------------- */
    :root {
        --color-dark-green: #1f4b2c;
        --color-orange: #e68200;
        --color-light-olive: #d5ed9f;
        --color-beige: #fffbe6;
        --color-link: #e68200;

        --active-link-color: var(--color-dark-green);
        --active-border-color: var(--color-dark-green);
    }

    /* ------------------------------------- */
    /* --------- TOP NAVBAR STYLES --------- */
    /* ------------------------------------- */
    .navbar {
        margin: 0 !important;
        padding: 0 !important;
    }

    .navbar-etapon {
        background-color: var(--color-orange);
        height: 80px;
        display: flex;
        align-items: center;
    }

    .navbar-title {
        color: var(--color-beige);
        font-weight: bold;
        text-decoration: none;
        font-size: 24px;
    }

    .navbar-title:hover,
    .profile-icon-link:hover {
        color: var(--color-dark-green) !important;
    }

    .profile-img-top {
        width: 32px;
        height: 32px;
        object-fit: contain;
        display: block;
    }

    .navbar-etapon a {
        display: flex;
        align-items: center;
    }

    /* ------------------------------------- */
    /* ------- BOTTOM NAVBAR STYLES  ------- */
    /* ------------------------------------- */
    .nav-item {
        margin: 0 10px;
    }

    .nav-link {
        color: rgba(0, 0, 0, .55);
        padding-bottom: 5px;
    }

    .nav-link:hover,
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
        <a href="{{ route('collector.profile') }}">
            <img src="{{ asset('icons/C_profile.png') }}" class="profile-img-top">
        </a>
    </div>
</nav>

<nav class="navbar navbar-expand-lg justify-content-center mt-0">
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