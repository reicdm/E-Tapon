<style>
  /* ------------------------------------- */
  /* ---- COLOR VARIABLES (Unchanged) ---- */
  /* ------------------------------------- */
  :root {
    --color-dark-green: #1f4b2c;
    --color-orange: #e68200;
    --color-light-olive: #d5ed9f;
    --color-beige: #fffbe6;
    --color-link: #e68200;
  }

  /* ------------------------------------- */
  /* --------- TOP NAVBAR STYLES --------- */
  /* ------------------------------------- */
  .navbar {
    margin-top: 0 !important;
  }

  .navbar-etapon {
    background-color: var(--color-dark-green);
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

  .profile-icon-link {
    font-size: 24px;
    color: var(--color-beige) !important;
    text-decoration: none;
    padding: 0 0.75rem;
  }

  .navbar-title:hover,
  .profile-icon-link:hover {
    color: var(--color-light-olive) !important;
  }
</style>

<header>
  <nav class="navbar navbar-etapon">
    <div class="container-fluid">
      <a class="navbar-title" href="{{ route('resident.dashboard') }}">E-Tapon</a>

      <!-- BACK ICON -->
      <a class="navbar-title" href="{{ route('resident.dashboard') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
          <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
        </svg>
      </a>
    </div>
  </nav>
</header>