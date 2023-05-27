@include('layouts.header')

<div class="container h-100 design">
    <section>
        <div class="d-flex">

            <div class="row">

                <div class="col-md-6">
                    <div>
                        <img src="{{ 'photo/side.jpg' }}" alt="" height="800px" width="600px">
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-register">
                        <form action="{{ url('/') }}" method="post" id="Login_form">
                            @csrf
                            <h2 class="text-center mt-2">Sign In</h2>

                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="email">Email</label>
                                        <span class="error">*</span>
                                        <input type="text" name="email" id="email" class="form-control"
                                            value="{{ old('email') }}" />
                                        @error('email')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 p-2">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Password</label>
                                        <span class="error">*</span>
                                        <input type="password" name="pass" id="password" class="form-control"
                                            value="{{ old('pass') }}" />
                                        @error('pass')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="pt-3 d-flex justify-content-center">
                                <button class="btn btn-lg btn-dark" name="login" type="submit">login</button>
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

        $('#Login_form').validate({
            errorElement: 'label',
            errorClass: 'jquery-error',
            rules: {
                email: {
                    required: true,
                    email: true
                },
                pass: {
                    required: true,
                    regex: true,
                    minlength: 8,
                    maxlength: 16
                },
            },
            messages: {
                email: {
                    required: "Enter your Email Address",
                },
                pass: {
                    required: "Enter password",
                    minlength: "minimum 8 length allowed",
                },

            }

        });

    });
</script>
