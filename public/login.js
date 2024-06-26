$(document).ready(function() {
    $('form').on('submit', function(event) {
        $('.spinner, .overlay').show();
        event.preventDefault(); 
        var formData = $(this).serialize();

        $.ajax({
            url: '/',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    // alert('Đăng ký thành công!');
                    window.location.href = '/user'; // Redirect to the login page
                } else {
                    if(response.is_captcha_display){
                        $('.g-recaptcha').show();
                    }
                    var errors = response.errors;
                    var errorHtml = '';
                    for (var i in errors) { 
                        errorHtml += '<div class="error">' + errors[i] + '</div>'; 
                    } 

                    $('.alert-danger').html(errorHtml).show();
                }

                $('.spinner, .overlay').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any unexpected errors
                alert('Có lỗi xảy ra: ' + textStatus);
                $('.spinner, .overlay').hide();
            }
        });
    });
});