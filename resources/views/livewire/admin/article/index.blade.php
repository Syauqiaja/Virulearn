<div>
   <nav class="navbar navbar-light bg-white rounded px-2 py-1 d-flex justify-content-start">
      <div class="container-fluid mx-0" style="max-width: 740px;">
         <a class="navbar-brand fw-bold">Artikel Pilihan</a>
         <div class="d-flex justify-content-end">
            <div class="d-flex">
               <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" wire:model='query'>
               <button class="btn btn-outline-success" wire:click='search'>Search</button>
            </div>
            @haspermission('modify article')
               <button class="btn btn-outline-primary ms-3" data-bs-toggle="modal" data-bs-target="#createNewModal">Tambahkan <i class="bi bi-plus"></i></button>
            @endhaspermission
         </div>
      </div>
   </nav>
   <div class="mt-2 p-3 bg-white">
      <div class="row row-cols-1 g-3 px-3">
         @foreach ($articles as $article)
         <div class="card px-0" style="max-width: 720px;">
            <div class="row g-0">
               @if ($article->thumbnail)
                  <div class="col-md-4 h-100">
                  <img src="{{ storage_url($article->thumbnail) }}"
                        class="img-fluid h-100 w-100 rounded-start"
                        style="object-fit: cover;" alt="...">
                  </div>
               @endif

               <div class="{{ $article->thumbnail ? 'col-md-8' : 'col-md-12' }}">
                  <div class="card-body h-100">
                  <h5 class="card-title">{{ $article->title }}</h5>
                  @if ($article->overview)
                     <p class="card-text max-lines-2">{{ $article->overview }}</p>
                  @endif
                  <div class="d-flex justify-content-start">
                     <a href="{{ $article->url }}" target="_blank" class="btn btn-outline-primary">Buka artikel <i class="ms-1 bi bi-arrow-right-circle"></i></a> 
                     @haspermission('modify article')
                        <a href="{{ $article->url }}" wire:click="$dispatch('edit-mode', {id: {{ $article->id }}})" target="_blank" class="ms-2 btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createNewModal">Edit <i class="ms-1 bi bi-pencil"></i></a> 
                     @endhaspermission
                  </div>
                  </div>
               </div>
            </div>
         </div>

         @endforeach
      </div>
   </div>
   <div class="modal fade" id="createNewModal" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
      <livewire:admin.article.edit></livewire:admin.article.edit>
    </div>
</div>
