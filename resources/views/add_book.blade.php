@include('layouts.header')

<div class="container h-100 design">
    <section>
        <div class="d-flex">
            <div class="row">

                <div class="col-md-6">
                    <div>
                        <img src="{{ 'photo/book.avif' }}" alt="" height="800px" width="600px">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-register">
                        <form action="{{ url('create') }}" method="post" id="addBook">
                            @csrf
                            <h2 class="text-center mt-2">Add Book</h2>

                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="author">Authors</label>
                                        <span class="error">*</span>
                                        <select class="form-select" name="author" id="author" aria-label="Default select example">
                                            <option disabled selected>-- select --</option>
                                                @foreach($authors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->first_name }}</option>
                                                @endforeach
                                        </select>
                                        @error('author')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="title">Title</label>
                                        <span class="error">*</span>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="{{ old('title') }}" />
                                        @error('title')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="released_date">Release Date</label>
                                        <span class="error">*</span>
                                        <input type="date" name="release_date" id="release_date" class="form-control"
                                        value="{{ old('release_date') }}" />
                                        @error('release_date')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="number_of_pages">No Of Pages</label>
                                        <span class="error">*</span>
                                        <input type="number" min="0" name="number_of_pages" id="number_of_pages" class="form-control"
                                        value="{{ old('number_of_pages') }}"/>
                                        @error('number_of_pages')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="description">description</label>
                                        <span class="error">*</span>
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ old('description') }}" />
                                        @error('description')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="isbn">Isbn</label>
                                        <span class="error">*</span>
                                        <input type="text" name="isbn" id="isbn" class="form-control"
                                            value="{{ old('isbn') }}" />
                                        @error('isbn')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="format">Format</label>
                                        <span class="error">*</span>
                                        <input type="text" name="format" id="format" class="form-control"
                                            value="{{ old('format') }}" />
                                        @error('format')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-lg btn-dark" name="addbook">Add book</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>
<script>
    $(document).ready(function() {
        jQuery.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || /^[A-Za-z ]+$/.test(value)
        });
        jQuery.validator.addMethod("number", function(value, element) {
            return this.optional(element) || /^[0-9]+$/.test(value)
        });


        $('#addBook').validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                author: {
                    required: true,
                },
                title: {
                    required: true,
                    alpha:true
                },
                release_date: {
                    required: true,
                },
                number_of_pages: {
                    required: true,
                },
                description: {
                    required: true,
                    alpha:true
                },
                isbn: {
                    required: true,
                    number:true,
                },
                format: {
                    required: true,
                    alpha:true
                }
            },
            messages: {
                author: {
                    required: "select author"
                },
                title: {
                    required: "Enter title name",
                    alpha: "Only alphabets allowed",
                },
                release_date: {
                    required: "Enter release_date",
                },
                number_of_pages: {
                    required: "Enter no of pages",
                },
                description: {
                    required: "Enter description",
                    alpha: "Only alphabets allowed",
                },
                isbn: {
                    required: "Enter valid isbn number",
                    number:"Only number required"
                },
                format: {
                    required: "Enter format of book",
                    alpha: "Only alphabets allowed",
                },

            },

        });

    });
</script>
