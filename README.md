# ỨNG DỤNG BASE ACCOUNT

# REQUIREMENTS
- PHP
- mySQL
- MailHog
- Google ReCAPTCHA (V2)

# CÀI ĐẶT
- git clone https://github.com/vuquanganh77/Base-Account.git
- Import file database db.sql
- Cài đặt MailHog, sau đó truy cập localhost:8025 (port mặc định của MailHog) để test mail trên môi trường local
- Tạo SITE_KEY và SECRET_KEY cho Google ReCAPTCHA tại link sau https://www.google.com/recaptcha/admin/create
- Tạo file config.php trong folder config và thêm 2 giá trị key vừa tạo vào theo mẫu ở file config/config.php.example
- Chạy lệnh cd public sau đó là php -S localhost:8080 để khởi tạo server

# CHỨC NĂNG
- Đăng ký
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/1132ee3f-2ab9-4721-86f5-3a96517ecff0)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/91db2af2-f984-4ebb-a788-c26e9d7f6841)

- Đăng nhập
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/3b77b84d-2c62-49fa-96fb-d56396c9e374)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/26ec6d79-416b-4089-ba43-4bf6b7d4d58f)

- Chức năng Save login (7 ngày)

![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/9dc3e200-f239-4fd5-a425-844a29fbeb7e)
(Ảnh trên là đăng nhập với checkbox save login được tick)

![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/8522d6d1-976c-4af2-a7c7-225abc06d4a8)
(Ảnh trên là đăng nhập với checkbox save login không được tick)

- Hiển thị CAPTCHA nếu đăng nhập sai quá 3 lần
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/ef052751-2ff8-41cd-b2b1-93c992261314)

- Chức năng Quên mật khẩu
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/49dd7a13-06dc-4fff-8c64-37a80b6de355)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/4de4fad4-f9c4-46ca-9722-72428c5be8e3)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/ad9b31b3-e211-4a91-a81e-46f23666dc9c)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/24e2eae3-0709-4486-a16d-7367d289f621)
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/0e9431f9-a04f-4167-972f-ddfec8743a7d)



- Hiển thị profile người dùng
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/d22616ed-ef76-4ae3-acf5-e05dc2b3934f)

- Chỉnh sửa thông tin người dùng
  
![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/6d49c644-8462-499f-b833-94b44688733a)


      + Chức năng Upload ảnh
  
  ![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/64da2656-5d37-4769-ae82-3ea49cbda0e2)
  ![image](https://github.com/vuquanganh77/Base-Account/assets/55951091/edf373d5-2d49-4029-bfb9-567e3b668c01)

- Đăng xuất


test