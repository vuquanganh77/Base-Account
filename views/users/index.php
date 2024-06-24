<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="shortcut icon" href="https://static-gcdn.basecdn.net/account/image/fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="../../css/user.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="../../script.js"></script>
</head>

<body>
    <div id="main" class="main">
        <!-- Man pop up -->
        <div class="model-container">
            <div class="model">
                <div class="model-upper">
                    <div class="model-upper-title">EDIT PERSONAL PROFILE</div>
                </div>

                <form class="model-form" action="/user/update" method="post" enctype="multipart/form-data">
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <div class='error'><?php echo $error; ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="modal-form-detail">
                        <div class="model-left">
                            <div class="model-left-row">
                                <div class="model-title">Your first name</div>
                                <div class="model-subtitle">Your first name</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Your last name</div>
                                <div class="model-subtitle">Your last name</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Email</div>
                                <div class="model-subtitle">Your email address</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Username</div>
                                <div class="model-subtitle">Your username</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Job title</div>
                                <div class="model-subtitle">Job title</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Profile image</div>
                                <div class="model-subtitle">Profile image</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Date of birth</div>
                                <div class="model-subtitle">Date of birth</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Your phone number</div>
                                <div class="model-subtitle">Your phone number</div>
                            </div>
                            <div class="model-left-row">
                                <div class="model-title">Current address</div>
                                <div class="model-subtitle">Current address</div>
                            </div>
                        </div>

                        <div class="model-right">
                            <div class="model-input"><input type="text" name="first_name" placeholder="Tên của bạn" value="<?php echo $userData['first_name'] ?>"></div>
                            <div class="model-input"><input type="text" name="last_name" placeholder="Họ của bạn" value="<?php echo $userData['last_name'] ?>"></div>
                            <div class="model-input"><input type="text" name="email" placeholder="Email" value="<?php echo $userData['email'] ?>" disabled></div>
                            <div class="model-input"><input type="text" name="username" placeholder="Username" value="<?php echo $userData['username'] ?>" disabled></div>
                            <div class="model-input"><input type="text" name="job_title" placeholder="Jobtitle" value="<?php echo $userData['job_title'] ?>"></div>
                            <div class="model-input-image"><input type="file" id="imageUpload" name="profile_image" accept="image/*"></div>

                            <div class="model-input model-input_dropdown">
                                <select id="date-dropdown" name="date-dropdown" class="dropdown">
                                    <?php
                                    $currentDate = $userData['date'];        // Giá trị date lấy từ cơ sở dữ liệu
                                    if ($currentDate === '') {
                                        echo '<option value="" disabled hidden selected>-- Select date --</option>';
                                    } else {
                                        echo '<option value="" disabled hidden>-- Select date --</option>';
                                    }
                                    $dates = range(1, 31);                    // Tạo mảng từ 1 đến 31

                                    foreach ($dates as $date) {
                                        $selected = ($date == $currentDate) ? 'selected' : '';
                                        echo "<option value='$date' $selected>$date</option>";
                                    }
                                    ?>
                                </select>

                                <select id="month-dropdown" name="month-dropdown" class="dropdown dropdown1">
                                    
                                    <?php
                                    $currentMonth = $userData['month'];        // Giá trị month lấy từ cơ sở dữ liệu
                                    if ($currentMonth === '') {
                                        echo '<option value="" disabled hidden selected>-- Select month --</option>';
                                    } else {
                                        echo '<option value="" disabled hidden>-- Select month --</option>';
                                    }
                                    $months = range(1, 12);                    // Tạo mảng từ 1 đến 12

                                    foreach ($months as $month) {
                                        $selected = ($month == $currentMonth) ? 'selected' : '';
                                        echo "<option value='$month' $selected>$month</option>";
                                    }
                                    ?>
                                </select>

                                <select id="year-dropdown" name="year-dropdown" class="dropdown">
                                    <?php
                                    $currentYear = $userData['year'];        // Giá trị month lấy từ cơ sở dữ liệu
                                    if ($currentYear === '') {
                                        echo '<option value="" disabled hidden selected>-- Select year --</option>';
                                    } else {
                                        echo '<option value="" disabled hidden>-- Select year --</option>';
                                    }
                                    $years = range(2024, 1960);                    // Tạo mảng từ 1 đến 12

                                    foreach ($years as $year) {
                                        $selected = ($year == $currentYear) ? 'selected' : '';
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="model-input"><input type="text" name="phone_number" placeholder="Phone Number" value="<?php echo $userData['phone_number'] ?>"></div>
                            <div class="model-input model-address"><input type="text" name="address" placeholder="Address" value="<?php echo $userData['address'] ?>"></div>
                        </div>
                    </div>
                    <div class="button-group">
                        <div id="close" class="button2">Cancel</div>
                        <button class="button1" type="submit">Update</button>
                    </div>
                </form>

            </div>
        </div>
        <!-- Ket thuc man pop up -->
        <div class="sidebar">
            <div class="logo"></div>
            <div class='menu'>
                <div class='item'>
                    <a href="#" class='nav-items'><?php if ($userData['profile_image'] !== null) : ?>
                            <img src="../../<?= htmlspecialchars($userData['profile_image']) ?>" alt="">
                        <?php else : ?>
                            <img src="../../images/default.jpg" alt="">
                        <?php endif; ?></a>
                </div>

                <div class="mid-item">
                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fas fa-user"></i>Cá nhân</a>
                    </div>

                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fas fa-bell"></i>Thông báo</a>
                    </div>

                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fa-solid fa-user-group"></i>Thành viên</a>
                    </div>

                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fa-solid fa-user-group"></i>Nhóm</a>
                    </div>

                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fas fa-caret-up"></i>TK Khách</a>
                    </div>

                    <div class='item'>
                        <a href="#" class='nav-items'><i class="fas fa-bookmark"></i>Ứng dụng</a>
                    </div>
                </div>

                <div class='logout item bot-item'>
                    <a href="/user/logout" class='nav-items'><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="upper">
                <div class="text">
                    <div class="title">Tài khoản</div>
                    <div class="job-title"><?php echo $userData['last_name'] . " " . $userData['first_name'] . " (" . $userData['username'] . ")" . "   " . $userData['job_title'] ?></div>
                </div>
                <button id="editbtn" onclick="togglePopup()" class="bt-edit">Edit my account</button>
            </div>


            <div class="user-details">
                <div class="ava"><?php if ($userData['profile_image'] !== null) : ?>
                        <img src="../../<?= htmlspecialchars($userData['profile_image']) ?>" alt="">
                    <?php else : ?>
                        <img src="../../images/default.jpg" alt="">
                    <?php endif; ?>
                </div>
                <div class="info">
                    <div class="name line1"> <?php echo $userData['last_name'] . " " . $userData['first_name'] ?></div>
                    <div class="job-title line1"><?php echo $userData['job_title'] !== '' ? $userData['job_title'] : "Chưa nhập chức danh" ?></div>
                    <div class="email line2">Địa chỉ email &emsp; <?php echo $userData['email'] ?></div>
                    <div class="phone-number line2">Số điện thoại &emsp; <?php echo $userData['phone_number'] !== '' ? $userData['phone_number'] : "Chưa nhập số điện thoại" ?></div>
                </div>
            </div>

            <div class="form">
                <div class="info">
                    <div class="contact row"> Thông tin liên hệ </div>
                    <div class="group-row"> Nhóm(2) </div>
                    <div class="group">
                        <div class="group-name">Nhóm 90 user của Mai</div>
                        <div class="group-detail">83 thành viên &ensp; Tham gia ngày 31-08-2022</div>
                    </div>
                    <div class="group">
                        <div class="group-name">Nhóm 100 user của Mai</div>
                        <div class="group-detail">102 thành viên &ensp; Tham gia ngày 31-08-2022</div>
                    </div>
                    <div class="row down">Nhân viên trực tiếp(0)</div>
                    <div class="row">Học vấn</div>
                    <div class="row">Kinh nghiệm làm việc</div>
                </div>
            </div>
        </div>

        <div class='details'>
            <div class="user-info">
                <div class="name"><?php echo $userData['last_name'] . " " . $userData['first_name'] ?></div>
                <div class="title"><?php echo '@' . $userData['username'] ?> &ensp; <?php echo $userData['email'] ?></div>
            </div>

            <div class="user-info-details">
                <div class="user-title">THÔNG TIN TÀI KHOẢN</div>

                <div class="list-user-item">
                    <div class="user-item"><i class="fa-solid fas fa-cog"></i>Tài khoản</div>
                    <div class="user-item"><i class="fa-solid fas fa-pencil-alt"></i>Chỉnh sửa</div>
                    <div class="user-item"><i class="fa-solid fas fa-compass"></i>Ngôn ngữ</div>
                    <div class="user-item"><i class="fa-solid fas fa-exclamation-triangle"></i>Đổi mật khẩu</div>
                    <div class="user-item"><i class="fa-solid fas fa-palette"></i>Đổi màu hiển thị</div>
                    <div class="user-item"><i class="fa-solid far fa-calendar-alt"></i>Lịch làm việc</div>
                    <div class="user-item"><i class="fa-solid fas fa-shield"></i>Bảo mật hai lớp</div>
                </div>

                <div class="user-title1">ỨNG DỤNG - BẢO MẬT</div>
                <div class="user-title">TÙY CHỈNH NÂNG CAO</div>

                <div class="list-user-item">
                    <div class="user-item"><i class="fa-solid fas fa-history"></i>Lịch sử đăng nhập</div>
                    <div class="user-item"><i class="fa-solid fas fa-desktop"></i>Quản lý thiết bị</div>
                    <div class="user-item"><i class="fa-solid fas fa-envelope"></i>Tùy chỉnh email thông báo</div>
                    <div class="user-item"><i class="fa-solid fas fa-clock"></i>Chỉnh sửa múi giờ</div>
                    <div class="user-item"><i class="fa-solid fas fa-user-clock"></i>Ủy quyền tạm thời</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>