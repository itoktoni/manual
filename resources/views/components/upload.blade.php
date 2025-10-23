@props(['name', 'id', 'label', 'hint', 'col', 'class', 'required', 'multiple', 'accept', 'maxSize', 'placeholder', 'value', 'attributes', 'model'])

<div class="col-md-{{ $col }}">
    <div class="form-group">
        @if($label)
            <label for="{{ $id }}" class="form-label">
                {{ $label }}
                @if($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
        @endif

        {{-- 70:30 Flex Layout --}}
        <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
            {{-- Left Side - File Input (70%) --}}
            <div style="flex: 0 0 70%;">
                <input
                    type="file"
                    name="{{ $name }}"
                    id="{{ $id }}"
                    class="{{ $class }} form-control"
                    @if($required) required @endif
                    @if($multiple) multiple @endif
                    @if($accept) accept="{{ $accept }}" @endif
                    @if($maxSize) data-max-size="{{ $maxSize }}" @endif
                    onchange="previewImage(this, '{{ $id }}')"
                    @if($attributes)
                        @foreach($attributes as $key => $value)
                            {{ $key }}="{{ $value }}"
                        @endforeach
                    @endif
                >
            </div>

            {{-- Right Side - Images (30%) --}}
            <div style="flex: 0 0 30%; text-align: center;">
                {{-- Current Image (if editing) --}}
                @if(isset($model) && isset($model->$name) && $model->$name)
                    <div style="margin-top: 0rem;">
                        <x-image
                            src="{{ asset('storage/' . $model->$name) }}"
                            alt="Current"
                            class="img-thumbnail"
                            style="max-width: 100px; max-height: 100px; width: auto; height: auto;"
                            popup="true"
                            popup-title="Current {{ $label }}"
                        />
                    </div>
                @endif

                {{-- Preview Image - Hidden by default --}}
                <div id="preview-container-{{ $id }}" style="display: none;">
                    <img id="preview-image-{{ $id }}" src="" alt="Preview" class="img-thumbnail" style="max-width: 80px; max-height: 60px; width: auto; height: auto;">
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearPreview('{{ $id }}')" title="Remove" style="margin-top: 0.25rem; font-size: 9px; padding: 0.2rem 0.4rem; border-radius: 0;">
                        ×
                    </button>
                </div>

                {{-- Empty state --}}
                @if(!isset($model) || !isset($model->$name) || !$model->$name)
                    <div style="color: #6c757d; font-size: 1.5rem;text-align: left;">
                        <small>No File</small>
                    </div>
                @endif
            </div>
        </div>

        @if($hint)
            <small class="form-text text-muted">{{ $hint }}</small>
        @endif

        @error($name)
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- 70:30 Layout Styles --}}
<style>
/* 70:30 Flex Layout */
.upload-layout {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

/* File Input Section (70%) */
.file-input-section {
    flex: 0 0 70%;
    min-width: 250px;
}

/* Image Section (30%) */
.image-section {
    flex: 0 0 30%;
    min-width: 150px;
    text-align: center;
}

/* Image Thumbnail */
.img-thumbnail {
    transition: all 0.2s ease;
}

.img-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

/* Responsive - Stack on mobile */
@media (max-width: 768px) {
    .upload-layout {
        flex-direction: column;
        gap: 1rem;
    }

    .file-input-section,
    .image-section {
        flex: 1;
        min-width: auto;
    }
}
</style>

{{-- Enhanced JavaScript for image preview --}}
<script>
    function previewImage(input, id) {
        const previewContainer = document.getElementById('preview-container-' + id);
        const previewImage = document.getElementById('preview-image-' + id);

        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    previewContainer.style.visibility = 'visible';
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select an image file.');
                input.value = '';
                previewContainer.style.display = 'none';
            }
        } else {
            previewContainer.style.display = 'none';
            previewContainer.style.visibility = 'hidden';
        }
    }

    function clearPreview(id) {
        const previewContainer = document.getElementById('preview-container-' + id);
        const previewImage = document.getElementById('preview-image-' + id);
        const input = document.getElementById(id);

        previewImage.src = '';
        previewContainer.style.display = 'none';
        previewContainer.style.visibility = 'hidden';
        input.value = '';
    }

    // Ensure preview is hidden on page load
    document.addEventListener('DOMContentLoaded', function() {
        const previewContainers = document.querySelectorAll('[id^="preview-container-"]');
        previewContainers.forEach(function(container) {
            container.style.display = 'none';
            container.style.visibility = 'hidden';
        });
    });

    // Make functions globally available
    window.previewImage = previewImage;
    window.clearPreview = clearPreview;
</script>