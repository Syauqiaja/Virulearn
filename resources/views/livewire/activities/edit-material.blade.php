<div>
    <x-admin-body-header :title="'Edit Materi'" :description="$activity_name">
        <button class="btn btn-primary">Simpan</button>
    </x-admin-body-header>

    <div class="p-3 bg-white mt-3 mx-0 d-flex flex-row gap-2 flex-wrap">
        @for ($i = 0; $i < $totalPage; $i++)
            <a class="btn btn-outline-secondary d-inline">{{$i + 1}}</a>
        @endfor
        <a wire:click='addPage' class="btn btn-outline-secondary d-inline">Tambah halaman +</a>
    </div>
    <div class="p-3 bg-white mt-3 mx-0 row g-2" wire:ignore>
        <div id="editor" wire:model='content'>
            <h2>Judul Aktivitas</h2>
            <p>Some initial <strong>bold</strong> text</p>
        </div>
    </div>
</div>

@script
<script>
    let editor;

    function initQuill() {
        console.log("Quill initiated");

        const el = document.getElementById('editor');
        if (el && !el.classList.contains('ql-container')) {
            editor = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['image', 'link'],
                        ['align', { 'align': 'center' }],
                        ['clean']
                    ]
                }
            });

            editor.getModule('toolbar').addHandler('image', function () {
                @this.set('content', editor.root.innerHTML);

                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = function () {
                    var file = input.files[0];
                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function (event) {
                            var base64Data = event.target.result;

                            @this.uploadImage(base64Data);
                        };
                        // Read the file as a data URL (base64)
                        reader.readAsDataURL(file);
                    }
                };
            });
        }
        let previousImages = [];

        editor.on('text-change', function (delta, oldDelta, source) {
            var currentImages = [];

            var container = editor.container.firstChild;

            container.querySelectorAll('img').forEach(function (img) {
                currentImages.push(img.src);
            });

            var removedImages = previousImages.filter(function (image) {
                return !currentImages.includes(image);
            });

            removedImages.forEach(function (image) {
                @this.deleteImage(image);
                console.log('Image removed:', image);
            });

            // Update the previous list of images
            previousImages = currentImages;
        });

        Livewire.on('imageUploaded', function (imagePaths) {
            if (Array.isArray(imagePaths) && imagePaths.length > 0) {
                var imagePath = imagePaths[0]; // Extract the first image path from the array
                console.log('Received imagePath:', imagePath);

                if (imagePath && imagePath.trim() !== '') {
                    var range = editor.getSelection(true);
                    editor.insertText(range ? range.index : editor.getLength(), '\n', 'user');
                    editor.insertEmbed(range ? range.index + 1 : editor.getLength(), 'image', imagePath);
                } else {
                    console.warn('Received empty or invalid imagePath');
                }
            } else {
                console.warn('Received empty or invalid imagePaths array');
            }
        });
    }
    document.addEventListener('livewire:load', () => {
        initQuill();
        Livewire.hook('message.processed', (message, component) => {
            initQuill();
        });
    })

    initQuill();

</script>
@endscript