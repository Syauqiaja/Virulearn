<div>
    <x-flash-message />
    <x-admin-body-header :title="'Laporan Aktivitas'" :description="'Laporan progress tiap aktivitas'">
    </x-admin-body-header>

    <div class="p-3 bg-white mt-3 mx-0 row g-2">
        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Materi</th>
                    <th>Latsol</th>
                    <th>Skor LKPD</th>
                    <th>LKPD</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>


    <div class="modal fade" id="editLKPD" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <livewire:report.edit-lkpd-point>
    </div>
</div>

@script
<script>
    let datatable;
    window.addEventListener('livewire:navigated', ()=>{
        let wrapper = document.getElementsByClassName('dataTables_wrapper');
        if(wrapper.length > 0){
            console.warn('datatable already initialized');
            return;
        }
        

        datatable = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: "{{ route('user.activity.datatable', ['activity' => $activity->id]) }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'material', name: 'material' },
                    { data: 'latsol', name: 'latsol' },
                    { data: 'lkpd', name: 'lkpd' },
                    { data: 'lkpd_status', name: 'lkpd_status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        
        Livewire.on('lkpd-updated', (data) => {
            datatable.ajax.reload();
        });
        
    });
</script>
@endscript