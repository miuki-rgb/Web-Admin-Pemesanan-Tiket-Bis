@extends('layouts.admin')

@section('header')
    Ticket Scanner
@endsection

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div id="reader" width="600px"></div>
        
        <div id="result-container" class="mt-6 hidden">
            <h3 class="text-lg font-bold mb-2">Scan Result</h3>
            <div id="result-message" class="p-4 rounded text-white text-center font-bold mb-4"></div>
            
            <div id="ticket-details" class="hidden border p-4 rounded bg-gray-50">
                <p><strong>Passenger:</strong> <span id="passenger-name"></span></p>
                <p><strong>Route:</strong> <span id="route-name"></span></p>
                <p><strong>Bus:</strong> <span id="bus-name"></span></p>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // Handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        
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
            const container = document.getElementById('result-container');
            const messageDiv = document.getElementById('result-message');
            const detailsDiv = document.getElementById('ticket-details');
            
            container.classList.remove('hidden');
            
            if (data.valid) {
                messageDiv.className = 'p-4 rounded text-white text-center font-bold mb-4 bg-green-500';
                messageDiv.innerText = data.message;
                
                document.getElementById('passenger-name').innerText = data.passenger;
                document.getElementById('route-name').innerText = data.route;
                document.getElementById('bus-name').innerText = data.bus;
                detailsDiv.classList.remove('hidden');
                
                // Optional: Stop scanning after success
                // html5QrcodeScanner.clear();
            } else {
                messageDiv.className = 'p-4 rounded text-white text-center font-bold mb-4 bg-red-500';
                messageDiv.innerText = data.message;
                detailsDiv.classList.add('hidden');
            }
        })
        .catch(err => {
            console.error(err);
        });
    }

    function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
@endsection
