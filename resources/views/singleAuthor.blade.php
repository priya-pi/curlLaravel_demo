
@include('layouts.header')

<div class="ajax-loader">
    <img src="{{ asset('photo/loader.gif') }}" class="rounded-circle" height="300" width="400"/>
</div>

<div class="container w-50">

    @if (session()->has('message'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div class="alert-dismissible">
                <h5 class="text-center">{{ session()->get('message') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

</div>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#ffffff;" id="">
    <div class="container-fluid d-flex justify-content-end">
        <div class="dropdown">
            <a class="navbar-brand" data-bs-toggle="modal" data-bs-target="#profileModel">
                <img src="{{ asset('photo/profile.png') }}" alt="profile picture" class="rounded-circle" height="50px" width="50px">
            </a>

          </div>
    </div>
</nav>

<div class="modal" tabindex="-1" id="profileModel" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="text-center">Author</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('photo/profile.png') }}" alt="profile picture" class="rounded-circle" height="150px" width="150px">
            </div>
            <div class="d-flex">
                <div class="row">
                    <div class="col-md-12">
                        <p> <b>ID : </b> {{ $singleAuthor->id }}</p>
                        <p> <b>First Name : </b> {{ $singleAuthor->first_name }}</p>
                        <p> <b>Last Name: </b> {{ $singleAuthor->last_name }}</p>
                        <p> <b>Birthday : </b> {{ $singleAuthor->birthday }}</p>
                        <p> <b>Gender : </b> {{ $singleAuthor->gender }}</p>
                        <p> <b>Place Of Birth : </b> {{ $singleAuthor->place_of_birth }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="container-fluid back mt-5">
    <div class="mt-5 p-3 mb-5">

        <h3 class="text-center p-3 theme">Author book Details</h3>
        <div class="row mb-2">
            <div class="col-md-8 p-2">
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Home</a>
                <a href="{{ route('create') }}" class="btn btn-success">Add book</a>
            </div>
        </div>

        <table class="table table-light" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>release date</th>
                    <th>description</th>
                    <th>isbn</th>
                    <th>format OF BIRTH</th>
                    <th>number of pages</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @if ($singleAuthor->books == null)
                <tr>
                    <td colspan="10" class="text-center"> No data available</td>
                </tr>
                @else
                    @foreach ($singleAuthor->books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->release_date }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->format }}</td>
                            <td>{{ $book->number_of_pages }}</td>
                            <td>
                                <a onclick='deleteData({{ $book->id }})'><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                     @endforeach
                @endif
            </tbody>
        </table>

    </div>
</div>

<script>

    function deleteData(book) {

        swal("Are you sure you want to delete this book", {
            dangerMode: true,
            buttons: true,
            icon: "warning",
        }).then(function(isConfirm) {

            if (isConfirm) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "delete/" + book,
                type: "delete",
                beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
                },
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                },
                complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
                }
            });
            }
        });

    }
</script>



