@props([
    'src',
    'alt',
    'class',
    'width',
    'height',
    'loading',
    'responsive',
    'rounded',
    'thumbnail',
    'id',
    'style',
    'popup',
    'popupTitle',
    'popupWidth',
    'popupHeight',
    'attributes'
])

@if($src)
    <img
        src="{{ $src }}"
        alt="{{ $alt }}"
        class="{{ $class }} {{ $popup ? 'image-popup-cursor' : '' }}"
        @if($id) id="{{ $id }}" @endif
        @if($width) width="{{ $width }}" @endif
        @if($height) height="{{ $height }}" @endif
        @if($loading) loading="{{ $loading }}" @endif
        @if($style) style="{{ $style }}" @endif
        @if($popup)
            onclick="showImagePopup('{{ $src }}', '{{ addslashes($popupTitle) }}', {{ $popupWidth ?? 'null' }}, {{ $popupHeight ?? 'null' }})"
            style="cursor: pointer;"
            data-src="{{ $src }}"
            data-title="{{ $popupTitle }}"
            data-width="{{ $popupWidth }}"
            data-height="{{ $popupHeight }}"
        @endif
        @if($attributes)
            @foreach($attributes as $key => $value)
                {{ $key }}="{{ $value }}"
            @endforeach
        @endif
    >

    {{-- Inline JavaScript for image popup (fallback) --}}
    @if($popup)
        <script>
            function showImagePopup(src, title, maxWidth, maxHeight) {
                // Create overlay
                const overlay = document.createElement('div');
                overlay.className = 'image-popup-overlay';
                overlay.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.8);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    cursor: pointer;
                `;

                // Create image container
                const container = document.createElement('div');
                container.style.cssText = `
                    position: relative;
                    max-width: 90vw;
                    max-height: 90vh;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                `;

                // Create title
                const titleElement = document.createElement('div');
                titleElement.textContent = title;
                titleElement.style.cssText = `
                    color: white;
                    font-size: 16px;
                    margin-bottom: 10px;
                    text-align: center;
                `;

                // Create image
                const img = document.createElement('img');
                img.src = src;
                img.alt = title;
                img.style.cssText = `
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: contain;
                    border-radius: 8px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
                `;

                // Set max dimensions if provided
                if (maxWidth) {
                    img.style.maxWidth = maxWidth + 'px';
                }
                if (maxHeight) {
                    img.style.maxHeight = maxHeight + 'px';
                }

                // Create close button
                const closeButton = document.createElement('button');
                closeButton.innerHTML = '×';
                closeButton.className = 'image-popup-close-btn'; // Add class for CSS targeting
                closeButton.style.cssText = `
                    position: absolute !important;
                    top: -15px !important;
                    right: -25px !important;
                    width: 30px !important;
                    height: 30px !important;
                    background: rgba(255, 255, 255, 0.2) !important;
                    color: white !important;
                    border: none !important;
                    font-size: 20px !important;
                    cursor: pointer !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    border-radius: 0 !important;
                `;

                // Ensure no border-radius is applied
                closeButton.style.borderRadius = '0px';

                // Add event listeners
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) {
                        document.body.removeChild(overlay);
                    }
                });

                closeButton.addEventListener('click', function() {
                    document.body.removeChild(overlay);
                });

                // Add escape key listener
                const escapeHandler = function(e) {
                    if (e.key === 'Escape') {
                        document.body.removeChild(overlay);
                        document.removeEventListener('keydown', escapeHandler);
                    }
                };
                document.addEventListener('keydown', escapeHandler);

                // Assemble popup
                container.appendChild(titleElement);
                container.appendChild(closeButton);
                container.appendChild(img);
                overlay.appendChild(container);

                // Add to body
                document.body.appendChild(overlay);

                // Focus management for accessibility
                closeButton.focus();
            }

            // Make sure the function is available globally
            window.showImagePopup = showImagePopup;
        </script>
    @endif
@else
    {{-- Placeholder for missing image --}}
    <div class="d-flex align-items-center justify-content-center bg-light text-muted {{ $class }}"
         @if($id) id="{{ $id }}" @endif
         @if($width) style="width: {{ $width }}px; height: {{ $height ?? $width }}px;" @endif
         @if($style) style="{{ $style }}" @endif
         @if($attributes)
            @foreach($attributes as $key => $value)
                {{ $key }}="{{ $value }}"
            @endforeach
         @endif
    >
        <svg width="48" height="48" viewBox="0 0 24 24" fill="currentColor">
            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
        </svg>
        <span class="visually-hidden">No image available</span>
    </div>
@endif