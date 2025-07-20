@php
$user = Illuminate\Support\Facades\Auth::user();
@endphp

<nav id="sidebarMenu" class="sidebar bg-white p-3">
  <div class="d-flex justify-content-between align-items-center">
    <a href="/" class="d-flex align-items-center mb-3 link-primary text-decoration-none d-none d-md-flex">
      <i class="bi bi-mortarboard fs-2 me-2"></i>
      <span class="fs-4 fw-bold">Virulearn</span>
    </a>
    <!-- Close button for mobile -->
    <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarCloseBtn" aria-label="Close sidebar">
      <i class="bi bi-x fs-5"></i>
    </button>
  </div>
  <hr class="d-none d-md-block">

  <ul class="nav nav-pills flex-column mb-auto mt-4 mt-md-0">
    <x-navigation.navlink :icon="'bi-house'" :href="route('home')" :active="request()->routeIs('home')">
      Dashboard
    </x-navigation.navlink>
    <x-navigation.navlink :icon="'bi-book'" :href="route('activities.index')"
      :active="request()->routeIs('activities.*')">
      Aktivitas
    </x-navigation.navlink>
    <x-navigation.navlink :icon="'bi-card-text'" :href="route('article.list')"
      :active="request()->routeIs('article.*')">
      Artikel
    </x-navigation.navlink>
    <x-navigation.navlink :icon="'bi-box'" :href="route('viewer')" :active="request()->routeIs('viewer')">
      3D Viewer
    </x-navigation.navlink>

    @if (Auth::user()->hasRole('admin'))
    <x-navigation.navlink :icon="'bi-people'" :href="route('user.index')" :active="request()->routeIs('user.*')">
      Daftar Member
    </x-navigation.navlink>
    <x-navigation.navlink :icon="'bi-bar-chart'" :href="route('report.index')" :active="request()->routeIs('report.*')">
      Report Aktivitas
    </x-navigation.navlink>

    <li class="nav-item accordion">
      <h2 class="accordion-header">
        <button
          class="accordion-button nav-link px-3 text-primary d-flex align-items-center {{ request()->routeIs('edit-exam.*') ? '' : 'collapsed' }}"
          type="button" data-bs-toggle="collapse" data-bs-target="#collapseEditExam"
          aria-expanded="{{ request()->routeIs('edit-exam.*') ? 'true' : 'false' }}" aria-controls="collapseEditExam">
          <i class="bi bi-puzzle fs-3"></i>
          <span class="ms-2 fs-6 fw-light">Edit Soal</span>
        </button>
      </h2>
      <div id="collapseEditExam"
        class="accordion-collapse collapse {{ request()->routeIs('edit-exam.*') ? 'show' : '' }}">
        <div class="accordion-body px-0">
          <ul class="nav nav-pills flex-column">
            <x-navigation.navlink :navigate="false" :href="route('edit-exam.pretest', ['type' => 'pretest'])"
              :active="request()->routeIs('edit-exam.pretest')">
              Pre-Test
            </x-navigation.navlink>
            <x-navigation.navlink :navigate="false" :href="route('edit-exam.posttest', ['type' => 'posttest'])"
              :active="request()->routeIs('edit-exam.posttest')">
              Post-Test
            </x-navigation.navlink>
          </ul>
        </div>
      </div>
    </li>
    @endif
  </ul>

  <hr class="mt-5">

  <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser"
      data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ $user->photo ? storage_url($user->photo) : asset('assets/default_avatar.jpg') }}" alt="User Avatar"
        width="32" height="32" class="rounded-circle me-2">
      <strong>{{ $user->name }}</strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
      <li><a class="dropdown-item" href="{{ route('user.detail', ['user' => Auth::user()->id]) }}">Profile</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a>
      </li>
    </ul>
  </div>
</nav>

@pushOnce('modals')
<div class="modal fade" id="logoutModal" tabindex="1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Keluar dari akun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin keluar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <a type="button" class="btn btn-danger" href="{{ route('logout') }}">Keluar</a>
      </div>
    </div>
  </div>
</div>
@endPushOnce