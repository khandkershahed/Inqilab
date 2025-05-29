@props([
    'id' => 'lfm_' . uniqid(),
    'inputId' => 'thumbnail_' . uniqid(),
    'previewId' => 'holder_' . uniqid(),
    'name',
    'value' => '',
    'placeholder' => 'Image Path',
])

<div class="row">
    <div class="col-8 d-flex align-items-center">
        <span class="input-group-btn">
            <a id="{{ $id }}" data-input="{{ $inputId }}" data-preview="{{ $previewId }}" class="btn btn-primary d-flex">
                <i class="fas fa-picture-o me-1"></i> Choose
            </a>
        </span>
        <input id="{{ $inputId }}" class="form-control @error($name)is-invalid @enderror"
               type="text" name="{{ $name }}"
               value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-4">
        <div id="{{ $previewId }}" style="margin-top:15px; max-height:100px;">
            @if (!empty(old($name, $value)))
                <img src="{{ old($name, $value) }}" class="img-fluid" style="height: 5rem;">
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        lfm('{{ $id }}', 'image', { prefix: '/laravel-filemanager' });
    });

    function lfm(id, type, options) {
        let button = document.getElementById(id);

        button.addEventListener('click', function () {
            let route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            let target_input = document.getElementById(button.getAttribute('data-input'));
            let target_preview = document.getElementById(button.getAttribute('data-preview'));

            window.open(route_prefix + '?type=' + (type || 'file'), 'FileManager', 'width=900,height=600');

            window.SetUrl = function (items) {
                let file_path = items.map(item => item.url).join(',');
                target_input.value = file_path;
                target_input.dispatchEvent(new Event('change'));

                target_preview.innerHTML = '';
                items.forEach(function (item) {
                    let img = document.createElement('img');
                    img.setAttribute('style', 'height: 5rem; margin-right: 5px;');
                    img.setAttribute('src', item.thumb_url);
                    target_preview.appendChild(img);
                });
            };
        });
    }
</script>
@endpush
