@extends('admin.layout')

@section('title', 'Collect Visit Proof')
@section('header', 'Collect Visit Proof')

@section('content')
    <div class="page-card" style="display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
        <div>
            <div style="font-size:18px;font-weight:700;">Visit Proof for #{{ $evaluation->id }}</div>
            <div style="color:#606776;">{{ $evaluation->center_name }} - {{ $evaluation->location }}</div>
        </div>
        <a class="btn btn-secondary" href="{{ route('center-visit-evaluations.index') }}">Back</a>
    </div>

    @if (session('status'))
        <div class="page-card" style="border-color:#bfdbfe;background:#eff6ff;color:#1e3a8a;">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="page-card" style="border-color:#fecaca;background:#fef2f2;color:#991b1b;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('center-visit-evaluations.proof.store', $evaluation->id) }}"
          enctype="multipart/form-data" class="page-card form-grid">
        @csrf

        <div class="form-section">
            <h3>Capture Images</h3>
            <div class="form-row">
                <div class="form-group">
                    <label>Visit Images (Multiple)</label>
                    <input type="file" id="visitImagesInput" name="visit_images[]" multiple accept="image/*" required style="display:none;">
                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                        <button type="button" class="btn" id="startCameraBtn">Start Camera</button>
                        <button type="button" class="btn btn-secondary" id="capturePhotoBtn" disabled>Capture</button>
                        <button type="button" class="btn btn-secondary" id="stopCameraBtn" disabled>Stop</button>
                        <button type="button" class="btn btn-secondary" id="flipCameraBtn" style="display:none;">Flip Camera</button>
                    </div>
                    <div style="color:#606776;font-size:12px;margin-top:6px;">
                        You can open the camera stream and capture multiple photos.
                    </div>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" id="locationStatus" value="Fetching location..." readonly>
                </div>
            </div>
            <input type="hidden" name="visit_latitude" id="visit_latitude">
            <input type="hidden" name="visit_longitude" id="visit_longitude">
            <input type="hidden" name="visit_address" id="visit_address">
        </div>

        <div class="form-section">
            <h3>Preview</h3>
            <video id="cameraPreview" playsinline autoplay muted style="width:240px;height:180px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;display:none;"></video>
            <canvas id="captureCanvas" width="640" height="480" style="display:none;"></canvas>
            <div id="preview" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;"></div>
        </div>

        <div style="display:flex;justify-content:flex-end;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="btn">Save Proof</button>
        </div>
    </form>

    <div class="page-card">
        <div style="font-size:14px;text-transform:uppercase;letter-spacing:0.8px;color:#606776;margin-bottom:10px;">Previous Proofs</div>
        @forelse ($proofs as $proof)
            <div style="margin-bottom:14px;">
                <div style="font-size:12px;color:#606776;margin-bottom:6px;">
                    {{ $proof->created_at }} |
                    {{ $proof->visit_latitude }}, {{ $proof->visit_longitude }}
                    @if ($proof->visit_address)
                        | {{ $proof->visit_address }}
                    @endif
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    @foreach (($proof->visit_images ?? []) as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Proof" style="width:120px;height:90px;object-fit:cover;border-radius:8px;border:1px solid #e5e7eb;">
                    @endforeach
                </div>
            </div>
        @empty
            <div style="color:#606776;">No proofs uploaded yet.</div>
        @endforelse
    </div>
@endsection

@push('scripts')
<script>
    const fileInput = document.getElementById('visitImagesInput');
    const startCameraBtn = document.getElementById('startCameraBtn');
    const capturePhotoBtn = document.getElementById('capturePhotoBtn');
    const stopCameraBtn = document.getElementById('stopCameraBtn');
    const flipCameraBtn = document.getElementById('flipCameraBtn');
    const cameraPreview = document.getElementById('cameraPreview');
    const captureCanvas = document.getElementById('captureCanvas');
    const preview = document.getElementById('preview');
    const latInput = document.getElementById('visit_latitude');
    const lngInput = document.getElementById('visit_longitude');
    const addressInput = document.getElementById('visit_address');
    const locationStatus = document.getElementById('locationStatus');
    let mediaStream = null;
    let facingMode = 'environment';
    const dataTransfer = new DataTransfer();

    const addPreviewImage = (blob) => {
        const url = URL.createObjectURL(blob);
        const img = document.createElement('img');
        img.src = url;
        img.style.width = '120px';
        img.style.height = '90px';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '8px';
        img.style.border = '1px solid #e5e7eb';
        preview.appendChild(img);
    };

    const startCamera = async () => {
            try {
                mediaStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode } });
                cameraPreview.srcObject = mediaStream;
                cameraPreview.style.display = 'block';
                capturePhotoBtn.disabled = false;
                stopCameraBtn.disabled = false;
                if (flipCameraBtn) {
                    flipCameraBtn.style.display = 'inline-flex';
                }
            } catch (err) {
                alert('Camera access failed.');
            }
    };

    if (startCameraBtn) {
        startCameraBtn.addEventListener('click', startCamera);
    }

    if (capturePhotoBtn) {
        capturePhotoBtn.addEventListener('click', () => {
            if (!mediaStream) return;
            const ctx = captureCanvas.getContext('2d');
            captureCanvas.width = cameraPreview.videoWidth || 640;
            captureCanvas.height = cameraPreview.videoHeight || 480;
            ctx.drawImage(cameraPreview, 0, 0, captureCanvas.width, captureCanvas.height);
            captureCanvas.toBlob((blob) => {
                if (!blob) return;
                const file = new File([blob], `visit_${Date.now()}.jpg`, { type: 'image/jpeg' });
                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;
                addPreviewImage(blob);
            }, 'image/jpeg', 0.9);
        });
    }

    if (stopCameraBtn) {
        stopCameraBtn.addEventListener('click', () => {
            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
            cameraPreview.style.display = 'none';
            capturePhotoBtn.disabled = true;
            stopCameraBtn.disabled = true;
            if (flipCameraBtn) {
                flipCameraBtn.style.display = 'none';
            }
        });
    }

    if (flipCameraBtn) {
        flipCameraBtn.addEventListener('click', async () => {
            facingMode = facingMode === 'environment' ? 'user' : 'environment';
            if (mediaStream) {
                mediaStream.getTracks().forEach(track => track.stop());
                mediaStream = null;
            }
            await startCamera();
        });
    }

    const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
    if (isMobile && flipCameraBtn) {
        flipCameraBtn.style.display = 'inline-flex';
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            async (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                latInput.value = lat;
                lngInput.value = lng;
                locationStatus.value = `${lat}, ${lng}`;

                try {
                    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    if (res.ok) {
                        const data = await res.json();
                        if (data.display_name) {
                            addressInput.value = data.display_name;
                            locationStatus.value = `${data.display_name} (${lat}, ${lng})`;
                        }
                    }
                } catch (_) {
                    // ignore reverse geocode errors
                }
            },
            () => {
                locationStatus.value = 'Location permission denied';
            }
        );
    } else {
        locationStatus.value = 'Geolocation not supported';
    }
</script>
@endpush
