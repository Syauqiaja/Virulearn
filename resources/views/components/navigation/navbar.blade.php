@php
$user = Illuminate\Support\Facades\Auth::user();
@endphp

<div id="sidebarMenu" class="col-md-3 col-lg-2 d-block d-flex flex-column bg-white sidebar position-fixed h-100 p-3">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-primary text-decoration-none">
    <i class="bi bi-mortarboard fs-2 me-2"></i>
    <span class="fs-4 fw-bold">Virulearn</span>
  </a>
  <hr>
  <ul class="nav nav-pills mb-auto flex-column">
    <x-navigation.navlink :icon="'bi-house'" :href="route('home')" :active="request()->routeIs('home')">Dashboard
    </x-navigation.navlink>
    <x-navigation.navlink :icon="'bi-book'" :href="route('activities.index')"
      :active="request()->routeIs('activities.*')">Aktivitas
    </x-navigation.navlink>
    @if (Auth::user()->hasRole('admin'))
    <x-navigation.navlink :icon="'bi-people'" :href="route('user.index')" :active="request()->routeIs('user.*')">Daftar
      Member
    </x-navigation.navlink>
    @endif
    <x-navigation.navlink :icon="'bi-card-text'" :href="route('article.list')"
      :active="request()->routeIs('article.*')">
      Artikel
    </x-navigation.navlink>

    <x-navigation.navlink :icon="'bi-box'" :href="route('viewer')" :active="request()->routeIs('viewer')">3D Viewer
    </x-navigation.navlink>
  </ul>
  <hr>
  <div class="dropdown ">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2"
      data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ $user->photo ? storage_url($user->photo) : asset('assets/default_avatar.jpg') }}" alt="" width="32"
        height="32" class="rounded-circle me-2">
      <strong>{{$user->name}}</strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
      <li><a class="dropdown-item" href="{{ route('user.detail', ['user' => Auth::user()->id]) }}">Profile</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Sign out</a></li>
      {{-- <li><a class="dropdown-item"
          onclick="Livewire.dispatch('openLogoutConfirmation', { component: 'modals.logout-confirmation-modal' })">Sign
          out</a></li> --}}
    </ul>
  </div>

</div>

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