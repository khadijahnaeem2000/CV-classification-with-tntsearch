<!-- resources/views/file/upload.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        *{
            overflow-x:hidden;
            overflow-y:hidden;
        }
    </style>
</head>
<body>
    <h1>Display PDF</h1>

    <p>Folder Name: {{ $folderName }}</p>
<div class="row">
    <div class="col-md-1" style="margin-top:20%">
         @if(is_array($pdfFiles) && count($pdfFiles) > 2)
        <button id="prevButton" class="btn btn-primary">Previous</button>
         @endif
    </div>
    <div class="col-md-10">
    <div class="pdf-container">
        @if(isset($pdfFiles[0]))
            <iframe id="pdfViewer" src="{{ asset($pdfFiles[0]) }}" width="100%" height="600px"></iframe>
        @else
            <p>No PDF files found.</p>
        @endif
    </div>

    </div>
    <div class="col-md-1" style="margin-top:20%">

    @if(is_array($pdfFiles) && count($pdfFiles) > 1)
     
        <button id="nextButton" class="btn btn-primary">Next</button>
    @endif
    </div>
</div>


    <script>
        let currentIndex = 0;
        const pdfFiles = @json($pdfFiles);
        const assetBaseUrl = "{{ asset('') }}"; // This will get the base URL using the asset function

        document.getElementById('nextButton').addEventListener('click', function () {
            if (currentIndex < pdfFiles.length - 1) {
                currentIndex++;
                document.getElementById('pdfViewer').src = assetBaseUrl + pdfFiles[currentIndex];
            }
        });

        document.getElementById('prevButton').addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                document.getElementById('pdfViewer').src = assetBaseUrl + pdfFiles[currentIndex];
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
