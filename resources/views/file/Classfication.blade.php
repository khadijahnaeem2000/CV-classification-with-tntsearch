<!-- resources/views/file/upload.blade.php -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
       <style>
        .container-box {
            align-items:center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            max-width: 400px; /* Adjust the max-width as needed */
            margin: auto; 
            top:20%;/* Center the container */
        }

        .form-group {
            max-width: 300px; /* Adjust the max-width as needed */
            margin: auto; /* Center the form within the container */
        }
    </style>
</head>
<body>
<div class="container mt-5 container-box">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <center> <h1>CLASSIFICATION</h1></center>
        <form action="{{ route('ClassficationStore',$filter->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="files">Classfication Type One</label>
                <input type="text" name="ClassifyTypeOne"  class="form-control" required>
            </div>
            <div class="form-group">
                <label for="files">Classification Type Two</label>
                <input type="text" name="ClassifyTypeTwo"  class="form-control" required>
            </div>
            <br>
           <center> <button type="submit" class="btn btn-primary">Save</button></center>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
