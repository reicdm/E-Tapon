@php
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
    color: var(--color-orange);
  }

  .nav-link.active {
    color: var(--color-orange);
    font-weight: bold;
    border-bottom: 3px solid var(--color-orange);
  }
</style>

<header>
  <nav class="navbar navbar-etapon">
    <div class="container-fluid">
      <a class="navbar-title" href="{{ route('resident.dashboard') }}">E-Tapon</a>

      <a class="profile-icon-link" href="{{ route('resident.profile') }}" aria-label="Account Profile">
        <svg xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          width="34" height="34"
          fill="currentColor">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 
      10-10S17.52 2 12 2zm0 3c1.93 0 3.5 1.57 3.5 
      3.5S13.93 12 12 12s-3.5-1.57-3.5-3.5S10.07 
      5 12 5zm0 14.2c-2.5 0-4.71-1.28-6-3.21.03-1.99 
      4.03-3.08 6-3.08 1.96 0 5.97 1.09 6 
      3.08-1.29 1.93-3.5 3.21-6 3.21z" />
        </svg>
      </a>

    </div>
  </nav>

  <nav class="navbar justify-content-center mt-0" id="bottom-nav">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link @if(Str::startsWith($currentRoute, 'resident.dashboard')) active @endif"
          href="{{ route('resident.dashboard') }}">Overview</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(Str::startsWith($currentRoute, 'resident.schedule')) active @endif"
          href="{{ route('resident.schedule') }}">Schedule</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(Str::startsWith($currentRoute, 'resident.request')) active @endif"
          href="{{ route('resident.request') }}">Request</a>
      </li>
    </ul>
  </nav>
</header>