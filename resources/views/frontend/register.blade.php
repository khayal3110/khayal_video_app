@extends('layouts.app')
@section('content')
    <section>
        <h2>Register for an Account</h2>

        <form id="register" method="post" onsubmit="return false;">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required
                title="username length should at least 3 character and start with characters" minlength="3"
                pattern="[a-zA-Z][a-zA-Z0-9_]*" placeholder="Enter username without space">
            <label id="nameError" style="color: red;"></label>

            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Enter your email address" name="email" required />

            <label for="password">Password:</label>
            <input type="password" id="password" title="password must be at least 8 character long and contain at least 1 upper case letter AND 1 number and 1 special character like /*-+!@#$^&~[]" name="password" placeholder="Password must be minimum 8 charcter" required pattern="^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{8,}$" />
            <label id="passwordError" style="color: red;"></label>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm_Password" placeholder="Password must be minimum 8 charcter"
                name="confirm_password" required />
            <label id="confirmPasswordError" style="color: red;"></label>

            <label for="age-confirmation">
                <input type="checkbox" style="width: 46px;
          height: 17px;" id="age-confirmation"
                    name="age-confirmation" required />
                I confirm that I am 13+ years of age.
            </label>
            <label id="ageConfirmationErr" style="color: red;"></label>
            <br />
            <label for="terms-privacy">
                <input type="checkbox" id="terms-privacy" style="width: 46px;
          height: 17px;" name="terms-privacy"
                    required />
                I accept the <a href="#">TOS and Privacy Rules</a>.
            </label>
            <br />

            <button type="submit">Register</button>
        </form>
    </section>
@endsection
@push('script')
    <script>
        $('body').on('submit', '#register', function(event) {
            console.log("From Submit Form")
            // event.preventDefault();
            var formData = new FormData(this);
            var ajaxurl = base_url + '/save-user';
            $('.ajax-loader').show();
            var request = $.ajax({
                url: ajaxurl,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json"
            });
            request.done(function(response) {
                $('.ajax-loader').hide();
                if (response.sts == false) {
                    swal("!" + response.msg, {
                        icon: "error",
                    });
                } else {
                    swal("Success " + response.msg, {
                        icon: "success",
                    });

                    setTimeout(function() {
                        window.location.href = base_url + '/login';

                    }, 3000);


                }
            });
            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: ' + error.message);
            });
            return false;
        });
    </script>
@endpush
