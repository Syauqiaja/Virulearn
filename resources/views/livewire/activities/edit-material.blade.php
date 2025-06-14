<div>
    <x-admin-body-header :title="'Edit Materi'" :description="$activity->title">
        <button class="btn btn-primary" wire:click="save">Simpan</button>
    </x-admin-body-header>

    <div class="p-3 bg-white mt-3 mx-0 d-flex flex-row gap-2 flex-wrap">
        @for ($i = 0; $i < count($content); $i++) <a
            class="btn {{ $activeIndex == $i ? 'btn-primary' : 'btn-outline-secondary' }} d-inline"
            wire:click='changeIndex({{ $i }})'>
            {{$i + 1}}
            </a>
            @endfor
            <a wire:click='addPage' class="btn btn-outline-secondary d-inline">Tambah halaman +</a>
    </div>

    <div class="p-3 bg-white mt-3 mx-0 row g-2 pb-5" wire:ignore>
        <div id="editor-container">
            <div id="editor">{!! $content[$activeIndex] !!}</div>
        </div>
    </div>
</div>

@script
<script>
    let editor;

    function initQuill(content = '') {
        const el = document.getElementById('editor');
        if (!el) {
            console.warn('Editor element not found. Delaying init...');
            return;
        }

        if (el.classList.contains('ql-container')) {
            const contentContainer = document.getElementsByClassName('ql-editor')[0];
            contentContainer.innerHTML = content;
            console.log('Quill already initialized.');
            return;
        }

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
            const html = editor.root.innerHTML;
            @this.updateContent(html);
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
    }
    // document.addEventListener('livewire:load', () => {
    //     const initialContent = document.getElementById("editor")?.innerHTML ?? "";
    //     initQuill(initialContent);
    //     Livewire.hook('message.processed', (message, component) => {
    //         const iContent = document.getElementById("editor")?.innerHTML ?? "";
    //         initQuill(iContent);
    //     });

    //     Livewire.on('load-quill', (data) => {
    //         initQuill(data.content);
    //     });

    // })

    function initializeQuillEditor() {
        const e = document.getElementById('editor');
        if (e && !e.classList.contains('ql-container')) {
            const initialContent = e.innerHTML ?? '';
            initQuill(initialContent);
            console.log('Quill initialized with:', initialContent);
        } else if(!e){
            console.warn('Editor not found');
        }else{
            console.warn('Editor already initialized');
        }
    }
    // After Livewire updates
    window.addEventListener('livewire:navigated', ()=>{
        initializeQuillEditor();
        
        console.log('message.processed');
        console.log($wire);
        
    });

    window.Livewire.on('load-quill', (data) => {
        initQuill(data[0].content);
        console.log('load-quill '+data[0].content);
    });

    window.Livewire.on('imageUploaded', function (imagePaths) {
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
</script>
@endscript