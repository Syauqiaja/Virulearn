<div>
    <x-flash-message />
    <x-admin-body-header :title="'Laporan Siswa'" :description="'Laporan progress siswa'">
    </x-admin-body-header>

    <div class="p-3 bg-white mt-3 mx-0 row g-2">
        <table id="userTable" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
                ajax: "{{ route('user.datatable') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        
        console.log('message.processed');
        console.log($wire);
        
    });
</script>
@endscript