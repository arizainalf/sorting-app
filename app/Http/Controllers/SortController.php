<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SortController extends Controller
{
    public function menu()
    {
        return view('sort.menu');
    }

    public function inputAngka()
    {
        return view('sort.input-angka');
    }

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

    public function clearSortNumber()
    {
        session()->forget('sorted_numbers');
        session()->flash('success', 'Sukses menghapus data angka yang tersimpan.');
        return redirect()->route('sort.index');
    }

    public function result()
    {
        if (! session()->has('sorted_numbers')) {
            session()->flash('error', 'Tidak ada data angka yang tersimpan.');
            return redirect()->route('sort.index');
        }
        $numbers = session('sorted_numbers', []);
        return view('sort.result', compact('numbers'));
    }

    public function download()
    {
        $numbers = session('sorted_numbers', []);
        if (empty($numbers)) {
            return redirect()->route('sort.index')->with('error', 'Tidak ada data untuk diunduh.');
        }

        $filename = 'sorted_numbers_' . now()->timestamp . '.txt';
        $content  = implode("\n", $numbers);

        session()->flash('success', 'Data berhasil diunduh.');

        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, [
            'Content-Type'              => 'text/plain',
            'Content-Disposition'       => "attachment; filename={$filename}",
            'Cache-Control'             => 'no-cache',
            'Content-Transfer-Encoding' => 'binary',
            'Connection'                => 'keep-alive',
        ]);
    }

}
