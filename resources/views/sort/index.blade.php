<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort Numbers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Sort Numbers</h1>

        <!-- Flash Message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk memilih jumlah angka -->
        <form id="chooseCountForm" class="mb-4">
            <div class="mb-3">
                <label for="count" class="form-label">Jumlah Angka</label>
                <input type="number" id="count" class="form-control" placeholder="Masukkan jumlah angka" required>
            </div>
            <button type="button" id="generateForm" class="btn btn-primary">Generate Form</button>
        </form>

        <!-- Modal untuk memasukkan angka -->
        <div class="modal fade" id="numberModal" tabindex="-1" aria-labelledby="numberModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="numberModalLabel">Masukkan Angka</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="numberForm" action="{{ route('sort.numbers') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div id="numberInputs"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Sort</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hasil Pengurutan -->
        @if (session('sorted_numbers'))
            <div class="mt-4">
                <h4>Hasil Pengurutan:</h4>
                <ul class="list-group mb-3">
                    @foreach (session('sorted_numbers') as $number)
                        <li class="list-group-item">{{ $number }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('sort.download') }}" class="btn btn-success">Download Hasil</a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('generateForm').addEventListener('click', () => {
            const count = document.getElementById('count').value;
            if (!count || count <= 0) {
                alert('Masukkan jumlah angka yang valid.');
                return;
            }

            const numberInputs = document.getElementById('numberInputs');
            numberInputs.innerHTML = '';

            for (let i = 0; i < count; i++) {
                const inputGroup = document.createElement('div');
                inputGroup.classList.add('mb-3');
                inputGroup.innerHTML = `
                    <label for="numbers_${i}" class="form-label">Angka ${i + 1}</label>
                    <input type="number" name="numbers[]" id="numbers_${i}" class="form-control" required>
                `;
                numberInputs.appendChild(inputGroup);
            }

            const numberModal = new bootstrap.Modal(document.getElementById('numberModal'));
            numberModal.show();
        });
    </script>
</body>
</html>
