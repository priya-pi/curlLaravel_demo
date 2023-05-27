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
                <h6 class="text-center">{{ session()->get('message') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @if(session()->has('info'))
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div class="alert-dismissible">
                <h6 class="text-center">{{ session()->get('info') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

</div>

<nav class="navbar navbar-expand-lg navbar-light theme" style="background-color:#ffffff;" id="">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <h3>welcome to : <b>{{ $first_name }}  {{ $last_name }}</b> </h3>
        </a>
    </div>
</nav>

<div class="container-fluid back mt-5">
    <div class="mt-5 p-3 mb-5">

        <h3 class="text-center p-3 theme">Authors Details</h3>

        <div class="row mb-2">
            <div class="col-md-8 p-2">
                <a href="{{ 'logout' }}" class="btn btn-danger">logout</a>
            </div>
        </div>

        <table class="table table-light" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>FIRSTNAME</th>
                    <th>LASTNAME</th>
                    <th>BIRTHDAY</th>
                    <th>GENDER</th>
                    <th>PLACE OF BIRTH</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>

                @if ($authors == null)
                <tr>
                    <td colspan="10" class="text-center"> No data available</td>
                </tr>
                @else
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->first_name }}</td>
                            <td>{{ $author->last_name }}</td>
                            <td>{{ $author->birthday }}</td>
                            <td>{{ $author->gender }}</td>
                            <td>{{ $author->place_of_birth }}</td>
                            <td>
                                <a href="{{ 'singleAuthor/'. $author->id }}"><i class="fa-sharp fa-solid fa-eye px-3"></i></a>
                                <a onclick='deleteData({{ $author->id }})'><i class="fa-solid fa-trash-can"></i></a>
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>
</div>

<script>

    function deleteData(author) {

        swal("Are you sure you want to delete Author", {
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
                url: "dashboard/delete/" + author,
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


