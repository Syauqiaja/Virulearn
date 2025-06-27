<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <x-head/>

  <title>{{$title ?? config('app.name')}}</title>
</head>

<body class="bg-light">
  <div class="container-fluid">
    <div class="row g-0">
      <!-- Sidebar -->
      <x-navigation.navbar />
      {{-- <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="position-sticky pt-3">
        </div>
      </nav> --}}

      <!-- Page content -->
      <main class="col-md-9 ms-auto col-lg-10 px-3 py-3">
        {{ $slot }}
      </main>
    </div>
  </div>

  @stack('modals')
  @livewire('wire-elements-modal')

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>
  @stack('scripts')
</body>

</html>