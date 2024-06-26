document.addEventListener('DOMContentLoaded', function() {
    const account = {
        name: "",
        email: "",
        username: "",
        password: "",
        re_enter_password: ""
    };

    const leftContainer = document.getElementById('leftContainer');
    
    const scrollWrap = document.createElement('div');
    scrollWrap.className = 'scroll-wrap';
    
    const boxWrap = document.createElement('div');
    boxWrap.className = 'box-wrap';
    
    const logo = document.createElement('div');
    logo.className = 'logo';
    
    const logoLink = document.createElement('a');
    logoLink.href = '/';
    
    const logoImg = document.createElement('img');
    logoImg.src = 'https://share-gcdn.basecdn.net/brand/logo.full.png';
    logoImg.alt = 'logo';
    
    logoLink.appendChild(logoImg);
    logo.appendChild(logoLink);
    boxWrap.appendChild(logo);
    
    const form = document.createElement('form');
    form.action = '/signup';
    form.method = 'POST';
    
    const title = document.createElement('div');
    title.className = 'title';
    title.innerHTML = '<h1>Đăng ký</h1>';
    
    const alert = document.createElement('div');
    alert.className = 'alert alert-danger';
    alert.style.display = 'none';
    
    const subTitle = document.createElement('div');
    subTitle.className = 'sub-title';
    
    const formContent = document.createElement('div');
    formContent.className = 'form';
    
    const fields = [
        { label: 'Họ và tên', type: 'text', name: 'name', placeholder: 'Tên của bạn', value: account.name },
        { label: 'Email', type: 'text', name: 'email', placeholder: 'Email của bạn', value: account.email },
        { label: 'Tên đăng nhập', type: 'text', name: 'username', placeholder: 'Tên đăng nhập của bạn', value: account.username },
        { label: 'Mật khẩu', type: 'password', name: 'password', placeholder: 'Mật khẩu của bạn', value: account.password },
        { label: 'Nhập lại mật khẩu', type: 'password', name: 're_enter_password', placeholder: 'Nhập lại mật khẩu của bạn', value: account.re_enter_password }
    ];
    
    fields.forEach(field => {
        const row = document.createElement('div');
        row.className = 'row';
        
        const label = document.createElement('div');
        label.className = 'label';
        label.textContent = field.label;
        
        const inputDiv = document.createElement('div');
        inputDiv.className = 'input';
        
        const input = document.createElement('input');
        input.type = field.type;
        input.name = field.name;
        input.placeholder = field.placeholder;
        input.value = field.value;
        
        inputDiv.appendChild(input);
        row.appendChild(label);
        row.appendChild(inputDiv);
        formContent.appendChild(row);
    });
    
    const submitButton = document.createElement('button');
    submitButton.className = 'submit';
    submitButton.type = 'submit';
    submitButton.textContent = 'Đăng ký';
    
    form.appendChild(title);
    form.appendChild(alert);
    form.appendChild(subTitle);
    form.appendChild(formContent);
    form.appendChild(submitButton);
    
    boxWrap.appendChild(form);
    scrollWrap.appendChild(boxWrap);
    leftContainer.appendChild(scrollWrap);
});
