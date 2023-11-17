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
            overflow-x: hidden; 
        }
    /* Style for the file input container */
    .file-input-container {
        position: relative;
        width: 700px; /* Adjust the width as needed */
        height: 550px; /* Adjust the height as needed */
        overflow: hidden;
        border-radius: 5px;
     
        margin: 10px 0; /* Optional margin */
    }

    /* Style for the actual file input */
    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Style for the "Choose File" label */
    .file-label {
        display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center;
    margin-top:10%;
    margin-left:50px /* Center vertically */
    width: 50%;
    height: 10%;
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #3498db; /* Border color */
    border-radius: 5px;
    background-color: #3498db; /* Background color */
    color: black; /* Text color */
    text-align: center;
    line-height: 30px; /* Line height should match height for vertical centering */
    cursor: pointer;
    }
</style>

<!-- HTML for the styled file input -->

</head>
<body>
    <div class="container-fluid mt-5" >
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('file.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                     <label for="files">ClassifyTypeOne:</label>
                     <div class="file-input-container">
    <input type="file" name="ClassifyTypeOne" id="files" multiple accept=".pdf" class="file-input" required >
    <p onchange="updateLabel()" styl="color:black"></p>
    <label for="files" class="file-label">Choose File</label>
</div>

                    </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                      <label for="files">ClassifyTypeTwo:</label>
                      <div class="file-input-container">
    <input type="file" name="ClassifyTypeOne" id="files" multiple accept=".pdf" class="file-input" required>
 <label for="files" class="file-label">Choose File</label>
</div>

                   </div>
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                      <label for="files">Guest:</label>
                      <div class="file-input-container">
    <input type="file" name="ClassifyTypeOne" id="files" multiple accept=".pdf" class="file-input" required>
  <label for="files" class="file-label">Choose File</label>
</div>

                   </div>
                </div>
            </div>
      <center>      <button type="submit" class="btn btn-primary">Upload Files</button></center>
        </form>
    </div>
    <script>
    function updateLabel() {
        var input = document.getElementById('files');
        var label = document.getElementById('fileLabel');

        if (input.files.length > 0) {
            // Display the names of all selected files
            label.textContent = Array.from(input.files).map(file => file.name).join(', ');
        } else {
            // If no file is selected, revert to the default label
            label.textContent = 'Choose File';
        }
    }
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
