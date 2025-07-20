<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <x-head />
  @stack('styles')

  <title>{{$title ?? config('app.name')}}</title>
</head>

<!-- Page Layout -->

<body class="bg-light">
  <div class="container-fluid p-0">

    <!-- Mobile Sidebar Toggle (Mobile only) -->
    <div id="mobileSidebarToggle" class="d-md-none bg-white border-bottom px-3 py-2 w-100">
      <div class="d-flex justify-content-between">
        <button class="btn btn-outline-primary" type="button" id="sidebarToggleBtn" aria-label="Toggle navigation">
          <i class="bi bi-list fs-4"></i>
        </button>
  
        <a href="/" class="d-flex align-items-center link-primary text-decoration-none">
          <i class="bi bi-mortarboard fs-2 me-2"></i>
          <span class="fs-4 fw-bold">Virulearn</span>
        </a>
      </div>
    </div>
      <!-- Sidebar Backdrop (Mobile only) -->
      <div class="sidebar-backdrop d-md-none" id="sidebarBackdrop"></div>

    <div class="d-flex">
  
      <!-- Sidebar Component -->
      <x-navigation.navbar />
  
      <!-- Main Content -->
      <main class="main-content p-md-3 p-1" style="max-width: 100%;">
        {{ $slot }}
      </main>
    </div>

  </div>
</body>


@stack('modals')
@livewire('wire-elements-modal')

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/scrapooo/quill-resize-module@1.0.2/dist/quill-resize-module.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>

</html>