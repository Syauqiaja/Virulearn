<button 
    data-bs-toggle="modal"
    data-bs-target="#editLKPD"
    wire:click="$dispatch('edit-lkpd', {userLkpd: {{ $userLkpd->id }}})"
    class="btn btn-outline-{{ $type }} rounded-pill fs-6 {{ $type == 'danger' ? 'disabled' : '' }}">
    {{ $status }}
</button>