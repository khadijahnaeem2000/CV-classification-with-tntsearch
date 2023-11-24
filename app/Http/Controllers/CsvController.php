<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\filterfile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Spatie\PdfToText\Pdf;
use TeamTNT\TNTSearch\Classifier\TNTClassifier;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;


class CsvController extends Controller
{
    public function getClassifyOne($id)
    {
        $filter = filterfile::find($id);
        $csvName = $filter->csvName;
        $folderNameOne = $filter->FolderNameOne;
        // Define the folder where PDF files are stored
        $pdfFolder = public_path($folderNameOne);

        // Define the path to the CSV file
        $csvFilePath = public_path('files/'.$csvName);

        // Check if the PDF folder exists, if not create it
        if (!File::exists($csvFilePath)) {
            // If the file doesn't exist, create it with a header row
            $handle = fopen($csvFilePath, 'w');
           // fputcsv($handle, ['Type', 'Text']); // Add more columns as needed
            fclose($handle);
        }
    
        // Open the CSV file for appending
        $handle = fopen($csvFilePath, 'a');

        // Create or open the CSV file for writing

        // Fetch all PDF files in the folder
        $pdfFiles = File::files($pdfFolder);

        foreach ($pdfFiles as $pdfFile) {
            $pdfPath = $pdfFile->getRealPath();

            // Convert PDF to text
            $pdfText = $this->extractTextFromPDF($pdfPath);
          
            // Write data to the CSV file
            fputcsv($handle, [
                'resume',
                $pdfText, // Add more columns as needed
            ]);
        }

        fclose($handle);

        // Download the CSV file
        return Response::download($csvFilePath, 'download.csv', ['Content-Type' => 'text/csv']);
    }
    public function getClassifyTwo($id)
    {
        $filter = filterfile::find($id);
        $csvName = $filter->csvName;
        $folderNameTwo = $filter->FolderNameTwo;
        // Define the folder where PDF files are stored
        $pdfFolder = public_path($folderNameTwo);

        // Define the path to the CSV file
        $csvFilePath = public_path('files/'.$csvName);

        // Check if the PDF folder exists, if not create it
        if (!File::exists($csvFilePath)) {
            // If the file doesn't exist, create it with a header row
            $handle = fopen($csvFilePath, 'w');
           // fputcsv($handle, ['Type', 'Text']); // Add more columns as needed
            fclose($handle);
        }
    
        // Open the CSV file for appending
        $handle = fopen($csvFilePath, 'a');

        // Create or open the CSV file for writing

        // Fetch all PDF files in the folder
        $pdfFiles = File::files($pdfFolder);

        foreach ($pdfFiles as $pdfFile) {
            $pdfPath = $pdfFile->getRealPath();

            // Convert PDF to text
            $pdfText = $this->extractTextFromPDF($pdfPath);
          
            // Write data to the CSV file
            fputcsv($handle, [
                'resume',
                $pdfText, // Add more columns as needed
            ]);
        }

        fclose($handle);

        // Download the CSV file
        return Response::download($csvFilePath, 'download.csv', ['Content-Type' => 'text/csv']);
    }

    public function extractTextFromPDF($pdfPath)
    {
        try {
            $pdfParser = new Parser();
            $pdf = $pdfParser->parseFile($pdfPath);
        
            // Check if there are any pages in the PDF
            $pages = $pdf->getPages();
            
            if (count($pages) > 0) {
                // Initialize an empty string to store the concatenated text
                $allText = '';
        
                // Loop through all pages
                foreach ($pages as $pageNumber => $page) {
                    // Extract text from the current page
                    $pageText = $page->getText();
        
                    // Concatenate the text from the current page to the overall text
                    $allText .= $pageText;
        
                    // If you want to separate text from different pages, you can add a separator
                    $allText .= "\n\n"; // Add two newlines as a separator
                }
        
                return $allText;
            } else {
                // Handle the case where there are no pages in the PDF
                dd("No pages found in the PDF.");
            }
        } catch (\Exception $e) {
            // Handle the exception (e.g., log the error or return a specific message)
            return "Error extracting text: " . $e->getMessage();
        }
    }

    public function launchFilter($id)
    {
        $filter = filterfile::find($id);
        $csvName = $filter->csvName;
        $filterName = $filter->FilterName;
        $file = public_path('files/'.$csvName);
        $data = $this->loadCSV($file);
    
        $classifier = new TNTClassifier();
    
        foreach ($data as $row) {
     
            // Assuming the first column is Text and the second column is Type
            $text = $row[1];
            $type = $row[0];
            
            $classifier->learn($text, $type);
        }
        $classifyFolder = public_path('classify');
    if (!file_exists($classifyFolder)) {
        mkdir($classifyFolder, 0755, true);
    }
    
    $classifier->save(public_path('classify\\'.$filterName.".csv"));
       
    }
    
    function loadCSV($filePath)
  {
    $csvData = [];

    if (($handle = fopen($filePath, "r")) !== false) {
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            $csvData[] = $data;
        }
        fclose($handle);
    }

    return $csvData;
 }
 function guesspdf()
{
    $pdfFilePath = public_path('guesspdf/test-15.pdf');

    // Use Smalot\PdfParser to extract text from the PDF
    $pdfParser = new Parser();
    $pdf = $pdfParser->parseFile($pdfFilePath);

    // Get all pages
    $pages = $pdf->getPages();

    // Initialize a variable to store concatenated text from all pages
    $allText = '';

    // Loop through all pages
    foreach ($pages as $pageNumber => $page) {
        // Extract text from the current page
        $pageText = $page->getText();

        // Concatenate the text from the current page to the overall text
        $allText .= $pageText;

        // If you want to separate text from different pages, you can add a separator
        $allText .= "\n\n"; // Add two newlines as a separator
    }

    // Load the classifier
    $model = public_path('classify/classify.csv');
    $classifier = new TNTClassifier();
    $classifier->load($model);

    // Predict the category
    $guess = $classifier->predict($allText);

    print_r($guess);
}

public function trainModel($id){
    $this->getClassifyOne($id);
    $this->getClassifyTwo($id);
    $this->launchFilter($id);
    $filter= filterfile::find($id);
    $filterId = $filter->id;
    return redirect()->route('test', ['id' => $filterId]);

}
public function test($id){
   
        $filterFile = FilterFile::findOrFail($id);
        if($filterFile){
         $folderName = $filterFile->Guest;
          
        // Get all PDF files in the folder
        $pdfFiles = glob($folderName . '\*.pdf');
        
        
        return view('file.displayPDF', compact('pdfFiles', 'folderName'));
        }
       
    }


public function train($id){
     $filter = filterfile::find($id);
     return view('file.TrainModel',compact('filter'));
}

}
