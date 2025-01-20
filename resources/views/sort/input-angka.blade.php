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
    <h5 class="mb-2">Jumlah Angka</h5>
    <div class="d-grid gap-2">
        <form id="chooseCountForm" class="mb-4">
            <hr>
            <div class="mb-3">
                <input type="number" id="count" class="form-control" placeholder="Masukkan jumlah angka" required>
            </div>
            <hr>
            <button type="button" id="generateForm" class="btn btn-primary">Generate Form</button>
        </form>
    </div>
  </div>
   <!-- Modal untuk memasukkan angka -->
        <div class="modal modal-sm fade" id="numberModal" tabindex="-1" aria-labelledby="numberModalLabel" aria-hidden="true">
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

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
