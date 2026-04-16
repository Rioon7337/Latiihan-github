<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Upload;

class UploadController extends Controller
{
    public function form() {
        $uploads = Upload::paginate(5);
        return view('upload', compact('uploads')); // FIX
    }

    public function upload(Request $request) {
        try {
            $request->validate([
                'nama' => 'required|min:3',
                'gambar' => 'required|mimes:jpg,png|max:2048' 
            ]);

            $namaGambar = null;

            if($request->hasFile('gambar')){
                $file = $request->file('gambar');

                $namaGambar = time().'_'.$file->getClientOriginalName();

                $file->move(public_path('images'), $namaGambar);
            }

            Upload::create([   
                'nama' => $request->nama,
                'gambar' => $namaGambar
            ]);

            return redirect()->route('uploads.form')
                ->with('success', 'Foto telah ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error saat mengupload foto: '.$e->getMessage());

            return redirect()->back()
                ->with('error','Terjadi kesalahan pada sistem');
        }
    }


    public function destroy(Upload $upload)
    {
        $path = public_path('images/' .$upload->gambar);

        if (file_exists($path)) {
            unlink($path);
        }

        $upload->delete();

        return back()
            ->with('success', 'Gambar berhasil dihapus.');
    }
}