<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel File Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        * {
            overflow-x: hidden; 
        }

      .container {
    height: 300px;
    display: flex;
    flex-direction: column; /* Change to column layout */
    align-items: center;
    justify-content: center;
     border-radius: 24px;
      border: 0.2px solid grey;
      
     /* Set container background color */
}

.card {
    /* Ensure the card takes 100% of the height of its container */
    height: 60%;
    width: 80%;
    color:white;
    /* Add padding for better visual appearance */
    padding: 10px;
    background-color: #D3D3D3; /* Set card background color */
}



.file-label {
    display: flex;
     flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 80%; /* Adjusted to 100% width */
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #3498db;
    border-radius: 24px;
    background-color: #3498db;
    color: black;
    text-align: center;
    line-height: 30px;
    cursor: pointer;
}


        /* Style for the selected files container */
   
    </style>
</head>
<body>
    <div class="container-fluid mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('file.store',$filter->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                     <center>   <label for="ClassifyTypeOne">ClassifyTypeOne:</label></center>

                      <div class="container">
                     <label for="ClassifyTypeOne" class="file-label">Choose File</label>
                     <input type="file" name="ClassifyTypeOne[]" id="ClassifyTypeOne" multiple accept=".pdf" class="file-input" required hidden>
                      <div class="card">
                      
                      <div style="overflow-y: auto;">
                         <p id="selectedFilesClassifyTypeOne"></p>
                      </div>
                         </div>
                    </div>
        
                    </div>
                </div>
                   <div class="col-md-4">
                    <div class="form-group">
                        <center><label for="ClassifyTypeTwo">ClassifyTypeTwo:</label></center>

                      <div class="container">
                     <label for="ClassifyTypeTwo" class="file-label">Choose File</label>
                     <input type="file" name="ClassifyTypeTwo[]" id="ClassifyTypeTwo" multiple accept=".pdf" class="file-input" required hidden>
                      <div class="card">
                       <p id="selectedFilesClassifyTypeTwo"></p>
                         </div>
                    </div>
        
                    </div>
                </div>
                   <div class="col-md-4">
                    <div class="form-group">
                   <center>     <label for="Guest">Guest:</label></center>

                      <div class="container">
                     <label for="Guest" class="file-label">Choose File</label>
                     <input type="file" name="Guest[]" id="Guest" multiple accept=".pdf" class="file-input" required hidden>
                      <div class="card">
                       <p id="selectedFilesGuest"></p>
                         </div>
                    </div>
        
                    </div>
                </div>
            </div>
            <center><button type="submit" class="btn btn-primary">Upload Files</button></center>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
 <script>
        document.getElementById('ClassifyTypeOne').addEventListener('change', function(event) {
            const fileInput = event.target;
            const selectedFilesParagraph = document.getElementById('selectedFilesClassifyTypeOne');

            // Check if files are selected
            if (fileInput.files.length > 0) {
                let fileNames = '';
                for (const file of fileInput.files) {
                    fileNames += file.name + '<br>';
                }
                selectedFilesParagraph.innerHTML = 'Selected Files:<br>' + fileNames;
            } else {
                selectedFilesParagraph.innerHTML = 'No files selected';
            }
        });
    </script>
     <script>
        document.getElementById('ClassifyTypeTwo').addEventListener('change', function(event) {
            const fileInput = event.target;
            const selectedFilesParagraph = document.getElementById('selectedFilesClassifyTypeTwo');

            // Check if files are selected
            if (fileInput.files.length > 0) {
                let fileNames = '';
                for (const file of fileInput.files) {
                    fileNames += file.name + '<br>';
                }
                selectedFilesParagraph.innerHTML = 'Selected Files:<br>' + fileNames;
            } else {
                selectedFilesParagraph.innerHTML = 'No files selected';
            }
        });
    </script>
        <script>
        document.getElementById('Guest').addEventListener('change', function(event) {
            const fileInput = event.target;
            const selectedFilesParagraph = document.getElementById('selectedFilesGuest');

            // Check if files are selected
            if (fileInput.files.length > 0) {
                let fileNames = '';
                for (const file of fileInput.files) {
                    fileNames += file.name + '<br>';
                }
                selectedFilesParagraph.innerHTML = 'Selected Files:<br>' + fileNames;
            } else {
                selectedFilesParagraph.innerHTML = 'No files selected';
            }
        });
    </script>
</body>
</html>
