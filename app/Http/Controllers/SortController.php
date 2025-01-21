<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SortController extends Controller
{
    // menampilkan halaman menu awal
    public function menu()
    {
        return view('sort.menu');
    }

    // menampilkan halaman input angka
    public function inputAngka()
    {
        return view('sort.input-angka');
    }

    // menerima data angka lalu mengurutkannya dan disimpan di session
    public function sortNumbers(Request $request)
    {
        $request->validate([
            'numbers'   => 'required|array|min:1',
            'numbers.*' => 'required|numeric',
        ]);

        $numbers = $request->input('numbers');
        sort($numbers);

        // Simpan hasil di session
        session(['sorted_numbers' => $numbers]);
        session()->flash('success', 'Berhasil mengurutkan angka.');

        return redirect()->route('sort.index');
    }

    // menghapus data angka yang ada di session
    public function clearSortNumber()
    {
        session()->flush();
        session()->flash('success', 'Sukses menghapus data angka yang tersimpan.');
        return redirect()->route('sort.index');
    }

    // menampilkan hasil dari pengurutan data angka
    public function result()
    {
        if (! session()->has('sorted_numbers')) {
            session()->flash('error', 'Tidak ada data angka yang tersimpan.');
            return redirect()->route('sort.index');
        }
        $numbers = session('sorted_numbers', []);
        return view('sort.result', compact('numbers'));
    }

    // mendownload hasil dari pengurutan data angka ke dalam format .txt
    public function download()
    {
        $numbers = session('sorted_numbers', []);

        if (empty($numbers)) {
            return redirect()->route('sort.index')->with('error', 'Tidak ada data untuk diunduh.');
        }

        $filename = 'sorted_numbers_' . now()->timestamp . '.txt';
        $content  = implode("\n", $numbers);

        // Save the content to disk
        Storage::disk('public')->put($filename, $content);

// Simpan URL ke session untuk diakses di view
        session(['file_url' => $filename]);

        session()->flash('success', 'Berhasil mengunduh hasil pengurutan angka.');

        // Stream the file for download
        return response()->streamDownload(function () use ($filename) {
            echo Storage::disk('public')->get($filename);
        }, $filename, [
            'Content-Type'        => 'text/plain',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

}
