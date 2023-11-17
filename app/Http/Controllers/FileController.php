<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        return view('file.upload');
    }

    public function store(Request $request)
    {
        $foldername="typeone";
        $request->validate([
            "$foldername.*" => 'required|mimes:pdf|max:10240', // PDF files, max size 10 MB
        ]);

        foreach ($request->file('files') as $file) {
            $fileName = $file->getClientOriginalName();
            $file->move(public_path($foldername), $fileName); // Save file to public/files folder
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }
}
