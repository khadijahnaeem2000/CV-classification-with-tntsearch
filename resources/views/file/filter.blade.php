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
         .custom-btn {
    color: #28a745; /* Set the desired text color */
    background-color: transparent; /* Make the background transparent */
    border: 1px solid #28a745; /* Add a border to create the outline effect */
    cursor: default !important; /* Set cursor to default, !important overrides Bootstrap */
  }

  .custom-btn:hover {
    background-color: transparent; /* Remove hover background color */
    color: #28a745; /* Set the text color on hover */
  }
    </style>
</head>
<body>
    <!-- Your blade view file -->

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Your other view content goes here -->

    <div class="container mt-5 container-box">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <center><h1>Filter</h1></center>
        <form action="{{ route('filterStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="files">FilterName</label>
                <input type="text" name="FilterName" id="files" multiple accept=".pdf" class="form-control" required style="width: 100%;">
            </div>
            <br>
           <center> <button type="submit" class="btn btn-primary btn-sm">Save</button></center>
        </form>
    </div>

    <br>
    <br>
    <br>
        <div class="container">
           <div class="card " style="height:400px;overflow-y:auto">
     
             <div class="card-body">
              <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Filter Name</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filter as $filter)
                    <tr>
                        <td scope="row">{{$filter->id}}</td>
                        <td>{{$filter->FilterName}}</td>
                        <td>@if($filter->Status == 1)
                            <a href="{{route('reUpdateStatus',$filter->id)}}" class="btn custom-btn">Activated</a>
                            @elseif($filter->Status == 0)
                            <a href="{{route('updateStatus',$filter->id)}}" class="btn btn-success">Active</a>
                            @endif
                   <td>
                        <a href="#" onclick="deleteEmployee({{ $filter->id }})" class="btn btn-danger">Delete</a>
                            <form  id="employee-edit-action-{{ $filter->id }}" action="{{ route('delete_filter',$filter->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                   </td>
                    </tr>
                         
                   @endforeach
                </tbody>
              </table>
             </div>
           </div>
        </div>
    <script>
        function deleteEmployee(id) {
            if (confirm("Are you sure you want to delete?")) {
                document.getElementById('employee-edit-action-'+id).submit();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>
