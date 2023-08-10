function closeToastPopup(){
    $('#custom-toast').hide()
    $('#custom-toast').remove()
}

$(document).ready(function(){
   
    $('body').on('submit', '#registerForm', function(){
        if(is_form_validate('registerForm')){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/save-user';
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
                if(response.sts == false){
                    toastr["error"](response.msg);
                } 
                else{
                    $('#registerForm')[0].reset();
                    $('#login-tab').trigger('click');
                    toastr["success"](response.msg);
                }

            });

            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: '+ error.message);

            }); 
        }
        return false;
    });

    $('body').on('submit', '#loginForm', function(){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/login';
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
                if(response.sts == false){
                    toastr["error"](response.msg);
                }
                else{
                    // window.location.href = ;
                }
            });
            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: '+ error.message);
            }); 
        
        return false;
    });

    $('body').on('submit', '#loginOTPForm', function () {
        if (is_form_validate('loginOTPForm')) {
            var formData = new FormData(this);
            var ajaxurl = base_url+'/confirm-login-otp';
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
                console.log(response);
                if(response.sts == false){
                    toastr["error"](response.msg);
                } else {
                    window.location.href = base_url+response.redirect_url;
                }
            });
            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: '+ error.message);
            }); 
        }
        return false;
    })

    if($('.input-phone').length > 0){
        $('.input-phone').intlInputPhone();
    }
    

    $('body').on('submit', '#forgot-password', function(){
        if(is_form_validate('forgot-password')){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/send-forgot-password-email';
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
                if(response.sts == false){
                    toastr["error"](response.msg);
                } 
                else{
                    $('#forgot-password')[0].reset();
                    toastr["success"](response.msg);
                }

            });

            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: '+ error.message);

            }); 
        }
        return false;
    });

    $('body').on('submit', '#update-password', function(){
        if(is_form_validate('update-password')){
            var formData = new FormData(this);
            var ajaxurl = base_url+'/update-password';
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
                if(response.sts == false){
                    toastr["error"](response.msg);
                } 
                else{
                    toastr["success"](response.msg);
                    window.location.href = base_url;
                }

            });

            request.fail(function(jqXHR, textStatus) {
                $('.ajax-loader').hide();
                var error = JSON.parse(jqXHR.responseText);
                toastr["error"]('Request failed: '+ error.message);

            }); 
        }
        return false;
    });
});
