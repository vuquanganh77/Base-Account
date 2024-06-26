$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault();                             // Khong xu ly submit form mac dinh
        $('.spinner, .overlay').show();                     // Hien thi spinner
        var formData = $(this).serialize();

        $.ajax({
            url: '/signup',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    //alert('Đăng ký thành công!');
                    window.location.href = '/'; 
                } else {
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