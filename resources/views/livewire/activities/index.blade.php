<div>
    <x-flash-message/>
    <x-admin-body-header :title="'Daftar Aktivitas'" :description="'Daftar aktivitas yang telah ditambahkan'">
        <button class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#createNewModal">Buat Baru
            +</button>
    </x-admin-body-header>

    <div class="p-3 bg-white mt-3 mx-0 row g-2">
        @foreach ($activities as $activity)
            <x-activity-item :activity="$activity" wire:key='{{ $activity->id }}'>{{$activity->title}}</x-activity-item>
        @endforeach
    </div>

    <div class="modal fade" id="createNewModal" tabindex="-1" aria-hidden="true">
        <livewire:activities.components.create-activity-dialog></livewire:activities.components.create-activity-dialog>
    </div>
</div>