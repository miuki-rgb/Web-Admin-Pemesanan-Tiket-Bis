@extends('layouts.admin')

@section('header')
    Scan Tiket
@endsection

@section('content')
<div class="max-w-xl mx-auto">
    <!-- Camera Section -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 p-6 mb-6">
        <div class="text-center mb-6">
            <h3 class="text-lg font-bold text-p-navy">Verifikasi Tiket</h3>
            <p class="text-sm text-gray-500">Gunakan kamera atau upload gambar QR Code</p>
        </div>
        
        <!-- Tab Switcher (Optional visual separation) -->
        <div class="flex justify-center mb-6 space-x-4">
            <button onclick="switchMode('camera')" id="btn-mode-camera" class="px-4 py-2 rounded-lg font-semibold text-sm bg-p-navy text-white shadow-md transition">
                Gunakan Kamera
            </button>
            <button onclick="switchMode('file')" id="btn-mode-file" class="px-4 py-2 rounded-lg font-semibold text-sm bg-gray-200 text-gray-600 hover:bg-gray-300 transition">
                Upload Gambar
            </button>
        </div>

        <!-- MODE CAMERA -->
        <div id="mode-camera" class="block">
            <div id="reader" class="w-full bg-gray-100 rounded-lg overflow-hidden relative min-h-[300px] border-2 border-dashed border-gray-300 flex items-center justify-center">
                <div id="camera-placeholder" class="text-center p-6">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-gray-500 mb-4">Kamera belum aktif</p>
                    <button id="start-camera-btn" class="bg-p-red hover:bg-p-maroon text-white font-bold py-2 px-6 rounded-lg shadow transition">
                        Aktifkan Kamera
                    </button>
                </div>
                <div id="permission-error" class="hidden text-center p-6 text-red-600">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <p class="font-bold">Akses Kamera Ditolak</p>
                    <p class="text-sm mt-1">Mohon izinkan akses kamera di browser Anda lalu muat ulang halaman ini.</p>
                </div>
            </div>

            <div id="scan-controls" class="hidden mt-4 text-center">
                <button id="stop-camera-btn" class="text-red-600 font-semibold hover:text-red-800 text-sm">
                    Matikan Kamera
                </button>
            </div>
        </div>

        <!-- MODE FILE -->
        <div id="mode-file" class="hidden">
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:bg-gray-50 transition relative">
                <input type="file" id="qr-input-file" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                </svg>
                <p class="text-lg font-semibold text-p-navy">Klik untuk Upload Gambar</p>
                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF</p>
            </div>
            <p id="file-name" class="mt-2 text-sm text-center text-gray-600 font-medium"></p>
        </div>

    </div>

    <!-- Result Section -->
    <div id="result-container" class="hidden bg-white overflow-hidden shadow-lg rounded-xl border-l-4 p-6 transition-all duration-300">
        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
            <span id="result-icon" class="mr-2"></span>
            Hasil Scan
        </h3>
        
        <div id="result-message" class="text-lg font-medium mb-4"></div>
        
        <div id="ticket-details" class="hidden bg-gray-50 rounded-lg p-4 border border-gray-200">
            <div class="grid grid-cols-1 gap-3 text-sm">
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Penumpang</span>
                    <span class="font-bold text-gray-800" id="passenger-name"></span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Rute</span>
                    <span class="font-bold text-gray-800" id="route-name"></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Bus</span>
                    <span class="font-bold text-gray-800" id="bus-name"></span>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button onclick="resetScanner()" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700 transition">
                    Scan Lagi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
    const html5QrCode = new Html5Qrcode("reader");
    const startBtn = document.getElementById('start-camera-btn');
    const stopBtn = document.getElementById('stop-camera-btn');
    const placeholder = document.getElementById('camera-placeholder');
    const permissionError = document.getElementById('permission-error');
    const scanControls = document.getElementById('scan-controls');
    const fileInput = document.getElementById('qr-input-file');
    const fileNameDisplay = document.getElementById('file-name');
    
    // Mode Switching
    const btnModeCamera = document.getElementById('btn-mode-camera');
    const btnModeFile = document.getElementById('btn-mode-file');
    const divModeCamera = document.getElementById('mode-camera');
    const divModeFile = document.getElementById('mode-file');

    // Result elements
    const resultContainer = document.getElementById('result-container');
    const resultMessage = document.getElementById('result-message');
    const ticketDetails = document.getElementById('ticket-details');
    const resultIcon = document.getElementById('result-icon');

    // Beep sound
    const beep = new Audio('https://www.soundjay.com/button/beep-07.wav');

    // --- MODE SWITCHING Logic ---
    window.switchMode = function(mode) {
        // Reset scanner first
        if(html5QrCode.isScanning) {
            html5QrCode.stop().then(() => {
                scanControls.classList.add('hidden');
                placeholder.classList.remove('hidden');
            });
        }
        resetScanner();

        if (mode === 'camera') {
            divModeCamera.classList.remove('hidden');
            divModeFile.classList.add('hidden');
            
            btnModeCamera.classList.add('bg-p-navy', 'text-white', 'shadow-md');
            btnModeCamera.classList.remove('bg-gray-200', 'text-gray-600');
            
            btnModeFile.classList.remove('bg-p-navy', 'text-white', 'shadow-md');
            btnModeFile.classList.add('bg-gray-200', 'text-gray-600');
        } else {
            divModeCamera.classList.add('hidden');
            divModeFile.classList.remove('hidden');
            
            btnModeFile.classList.add('bg-p-navy', 'text-white', 'shadow-md');
            btnModeFile.classList.remove('bg-gray-200', 'text-gray-600');
            
            btnModeCamera.classList.remove('bg-p-navy', 'text-white', 'shadow-md');
            btnModeCamera.classList.add('bg-gray-200', 'text-gray-600');
        }
    }

    // --- CAMERA LOGIC ---
    startBtn.addEventListener('click', () => {
        placeholder.classList.add('hidden');
        permissionError.classList.add('hidden');
        
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: { width: 250, height: 250 } },
            onScanSuccess,
            onScanFailure
        )
        .then(() => {
            scanControls.classList.remove('hidden');
        })
        .catch(err => {
            console.error(err);
            placeholder.classList.add('hidden');
            permissionError.classList.remove('hidden');
        });
    });

    stopBtn.addEventListener('click', () => {
        html5QrCode.stop().then(() => {
            scanControls.classList.add('hidden');
            placeholder.classList.remove('hidden');
        });
    });

    // --- FILE UPLOAD LOGIC ---
    fileInput.addEventListener('change', e => {
        if (e.target.files.length === 0) return;
        
        const imageFile = e.target.files[0];
        fileNameDisplay.textContent = "Memproses: " + imageFile.name;

        // Use library to scan file
        html5QrCode.scanFile(imageFile, true)
            .then(decodedText => {
                // Success
                onScanSuccess(decodedText, null);
            })
            .catch(err => {
                // Error / No QR Found
                fileNameDisplay.textContent = "Gagal: Tidak ditemukan QR Code pada gambar ini.";
                fileNameDisplay.classList.add('text-red-600');
                console.error("Error scanning file.", err);
            });
    });

    let isScanning = true;

    function onScanSuccess(decodedText, decodedResult) {
        if (!isScanning) return;
        
        console.log(`Code matched = ${decodedText}`);
        beep.play();

        // Pause processing
        isScanning = false;
        
        // If camera is running, pause it visually
        if(html5QrCode.isScanning) {
            html5QrCode.pause();
        }

        // Send to server
        fetch('{{ route("admin.scan-ticket") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ qr_code: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            showResult(data);
        })
        .catch(err => {
            console.error(err);
            showResult({ valid: false, message: 'Terjadi kesalahan jaringan.' });
        });
    }

    function onScanFailure(error) {
        // Ignore failures in camera stream
    }

    function showResult(data) {
        resultContainer.classList.remove('hidden');
        resultContainer.className = `bg-white overflow-hidden shadow-lg rounded-xl border-l-8 p-6 transition-all duration-300 ${data.valid ? 'border-green-500' : 'border-red-500'}`;
        
        if (data.valid) {
            resultMessage.innerHTML = `<span class="text-green-600">${data.message}</span>`;
            document.getElementById('passenger-name').innerText = data.passenger;
            document.getElementById('route-name').innerText = data.route;
            document.getElementById('bus-name').innerText = data.bus;
            
            ticketDetails.classList.remove('hidden');
        } else {
            resultMessage.innerHTML = `<span class="text-red-600">${data.message}</span>`;
            ticketDetails.classList.add('hidden');
        }
    }

    function resetScanner() {
        resultContainer.classList.add('hidden');
        isScanning = true;
        fileNameDisplay.textContent = "";
        fileInput.value = ""; // Clear file input
        
        // If camera was active, resume it
        try {
            if(html5QrCode.getState() === 3) { // 3 = PAUSED
                html5QrCode.resume();
            }
        } catch(e) {
            console.log(e);
        }
    }
</script>
@endsection
