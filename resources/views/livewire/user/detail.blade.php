<div class="">
    <x-admin-body-header :title="'Laporan Siswa'" :description="'Laporan progress siswa'">

        <div class="d-flex justify-content-end">
            <div class="me-3 text-end">
                <span class="fw-bold">
                    Ahmad Fajruddin Syauqi
                </span> <br>
                Murid kelas 1
            </div>
            <div>
                <img src="{{ asset('assets/default_avatar.jpg') }}" alt="" class="mx-auto d-block rounded-circle"
                    style="height: 48px; width: 48px;">
            </div>
        </div>
    </x-admin-body-header>
    <div class="bg-white p-3 mt-2">
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
                ajax: "{{ route('users.datatable') }}",
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