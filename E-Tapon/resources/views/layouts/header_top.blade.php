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
</style>

<nav class="navbar">
    <div class="navbar-etapon container-fluid">
        <a class="navbar-title" href="#">E-Tapon</a>
        <a href="{{ route('collector.profile') }}">
            <img src="{{ asset('icons/C_profile.png') }}" class="profile-img-top">
        </a>
    </div>
</nav>