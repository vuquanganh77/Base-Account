$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        $('.spinner, .overlay').show();
        // Serialize the form data
        var formData = $(this).serialize();

        $.ajax({
            url: '/signup',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle the response from the server
                if (response.status === 'success') {
                    // If signup is successful, redirect or show a success message
                    //alert('Đăng ký thành công!');
                    window.location.href = '/'; // Redirect to the login page
                    // window.location.href = '/success-page'; // Redirect to a success page if needed
                } else {
                    // If there are validation errors, display them
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