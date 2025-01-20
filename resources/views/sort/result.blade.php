<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pilihan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2980B9;
            /* Warna latar belakang biru */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .menu-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="menu-container">
        <h5 class="mb-2">Hasil Pengurutan</h5>
        <div class="d-grid gap-2">
            <hr>
            @foreach ($numbers as $number)
                @php
                    // Array warna tombol
                    $colors = ['btn-success', 'btn-warning', 'btn-danger', 'btn-info', 'btn-primary', 'btn-secondary', 'btn-dark'];
                    // Pilih warna secara acak
                    $btnClass = $colors[array_rand($colors)];
                @endphp
                <button type="button" class="btn {{ $btnClass }}">{{ $number }}</button>
            @endforeach
            <hr>
            <a id="download-btn" href="{{ route('sort.download') }}" class="btn btn-outline-success">Download</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const downloadButton = document.getElementById('download-btn');
            if (downloadButton) {
                downloadButton.addEventListener('click', function() {
                    setTimeout(() => {
                        // Redirect setelah unduhan (0.5 detik)
                        window.location.href = "{{ route('sort.index') }}";
                    }, 500); // Sesuaikan waktu delay
                });
            }
        });
    </script>

</body>

</html>
