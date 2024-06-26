$(document).ready(function() {
    const account = {
        name: "",
        email: "",
        username: "",
        password: "",
        re_enter_password: ""
    };

    const leftContainer = $('#leftContainer');

    const scrollWrap = $('<div>').addClass('scroll-wrap');
    const boxWrap = $('<div>').addClass('box-wrap');
    const logo = $('<div>').addClass('logo');
    const logoLink = $('<a>').attr('href', '/');
    const logoImg = $('<img>').attr({
        src: 'https://share-gcdn.basecdn.net/brand/logo.full.png',
        alt: 'logo'
    });

    logoLink.append(logoImg);
    logo.append(logoLink);
    boxWrap.append(logo);

    const form = $('<form>').attr({
        action: '/signup',
        method: 'POST'
    });

    const title = $('<div>').addClass('title').html('<h1>Đăng ký</h1>');
    const alert = $('<div>').addClass('alert alert-danger').hide();
    const subTitle = $('<div>').addClass('sub-title');
    const formContent = $('<div>').addClass('form');

    const fields = [
        { label: 'Họ và tên', type: 'text', name: 'name', placeholder: 'Tên của bạn', value: account.name },
        { label: 'Email', type: 'text', name: 'email', placeholder: 'Email của bạn', value: account.email },
        { label: 'Tên đăng nhập', type: 'text', name: 'username', placeholder: 'Tên đăng nhập của bạn', value: account.username },
        { label: 'Mật khẩu', type: 'password', name: 'password', placeholder: 'Mật khẩu của bạn', value: account.password },
        { label: 'Nhập lại mật khẩu', type: 'password', name: 're_enter_password', placeholder: 'Nhập lại mật khẩu của bạn', value: account.re_enter_password }
    ];

    fields.forEach(field => {
        const row = $('<div>').addClass('row');
        const label = $('<div>').addClass('label').text(field.label);
        const inputDiv = $('<div>').addClass('input');
        const input = $('<input>').attr({
            type: field.type,
            name: field.name,
            placeholder: field.placeholder,
            value: field.value
        });

        inputDiv.append(input);
        row.append(label, inputDiv);
        formContent.append(row);
    });

    const submitButton = $('<button>').addClass('submit').attr('type', 'submit').text('Đăng ký');

    form.append(title, alert, subTitle, formContent, submitButton);
    boxWrap.append(form);
    scrollWrap.append(boxWrap);
    leftContainer.append(scrollWrap);
}); 


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
