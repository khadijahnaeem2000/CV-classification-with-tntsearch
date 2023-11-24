<?php

namespace App\Http\Controllers;
use App\Models\filterfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index($id)
    {
          $filter = filterfile::find($id);
        return view('file.upload',compact('filter'));
    }

 public function store(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'files.*' => 'required|mimes:pdf|max:10240', // PDF files, max size 10 MB
    ]);

    // Find the filterfile based on the provided ID
    $filter = filterfile::find($id);

    if (!$filter) {
        // Handle the case where the filter is not found
        return redirect()->back()->with('error', 'Filter not found.');
    }

    // Get the folder name from the filterfile model
    $folderNameOne = $filter->FolderNameOne;
    $folderNameTwo = $filter->FolderNameTwo;
    $guest = $filter->Guest;
    // Loop through each file in the request
    foreach ($request->file('ClassifyTypeOne') as $classifyOne) {
        // Get the original name of the file
        $fileNameOne = $classifyOne->getClientOriginalName();

        // Move the file to the specified folder within the public directory
        $classifyOne->move(public_path($folderNameOne), $fileNameOne);
    }
     foreach ($request->file('ClassifyTypeTwo') as $classifyTwo) {
        // Get the original name of the file
        $fileNameTwo = $classifyTwo->getClientOriginalName();

        // Move the file to the specified folder within the public directory
        $classifyTwo->move(public_path($folderNameTwo), $fileNameTwo);
    }
      foreach ($request->file('Guest') as $classifyguest) {
        // Get the original name of the file
        $fileGuest = $classifyguest->getClientOriginalName();

        // Move the file to the specified folder within the public directory
        $classifyguest->move(public_path($guest), $fileGuest);
    }

    $filterId = $filter->id;

    // Redirect back to the previous page with a success message
    return redirect()->route('train', ['id' => $filterId]);
}

}
