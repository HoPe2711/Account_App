<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <script src="js/profile.js"></script>
    <script src="js/icon.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="https://static-gcdn.basecdn.net/account/image/fav.png" type="image/x-icon">
    <title>Profile</title>
</head>
<body>
<div id="page">
    <div id="menu-left">
        <div class="navbar">
            <div>
                <div class="avatar">
                    <img src="<?php
                    $image = $model->user->profile_image;

                    if ($image == null || !file_exists('image/' . $image)){
                        echo 'image/logo.full.png';
                    } else{
                        echo 'image/' . $model->user->profile_image;
                    }
                    ?>">
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <account-icon></account-icon>
                    </div>
                    <div class="func item-select">Account</div>
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <notify-icon></notify-icon>
                    </div>
                    <div class="func">Notifications</div>
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <member-icon></member-icon>
                    </div>
                    <div class="func">Members</div>
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <group-icon></group-icon>
                    </div>
                    <div class="func">Groups</div>
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <guest-icon></guest-icon>
                    </div>
                    <div class="func">Guests</div>
                </div>
                <div class="item" onclick="selectItem(this)">
                    <div class="icon">
                        <application-icon></application-icon>
                    </div>
                    <div class="func">Applications</div>
                </div>
            </div>
            <a class="item" href="/logout">
                <div class="icon">
                    <logout-icon></logout-icon>
                </div>
                <div class="func">Logout</div>
            </a>
        </div>
    </div>
    <div id="content">
        <div class="header">
            <div class="header-left">
                <div>
                    <back-icon></back-icon>
                </div>
                <div>
                    <div class="account">Account</div>
                    <div class="info">
                        (<?php echo $model->user->first_name ?>)
                        <?php echo $model->user->last_name ?>
                        · <?php echo $model->user->job_title ?>
                    </div>
                </div>
            </div>
            <button class="url" onclick="openPopUp('profile-pop-up')">Edit my account</button>
        </div>
        <div class="pop-up" id="profile-pop-up">
            <div class="pop-up-container profile-pop-up-container" id="profile-pop-up-container">
                <div class="pop-up-header">
                    <div class="pop-up-title">
                        EDIT PERSONAL PROFILE
                    </div>
                    <div class="url" onclick="closePopUp('profile-pop-up')">&#10006;</div>
                </div>
                <form class="profile-pop-up-content" action="" method="post" enctype="multipart/form-data">
                    <div class="profile-pop-up-row">
                        <div>
                            Your first name
                            <div>Your first name</div>
                        </div>
                        <input type="text" name="first_name" placeholder="Your first name"
                               value="<?php echo $model->user->first_name ?>">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Your last name
                            <div>Your last name</div>
                        </div>
                        <input type="text" name="last_name" placeholder="Your last name"
                               value="<?php echo $model->user->last_name ?>">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Email
                            <div>Your email address</div>
                        </div>
                        <input type="text" name="email" disabled
                               placeholder="<?php echo $model->user->email ?>"
                               class="input-disable">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Username
                            <div>Your Username</div>
                        </div>
                        <input type="text" name="user_name" disabled placeholder="@john"
                               class="input-disable bold-text">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Job title
                            <div>Job title</div>
                        </div>
                        <input type="text" name="job_title" placeholder="Job title"
                               value="<?php echo $model->user->job_title ?>">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Profile image
                            <div>Profile image</div>
                        </div>
                        <input type="file" id="myFile" name="profile_image">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Date of birth
                            <div>Date of birth</div>
                        </div>
                        <div class="layout-select">
                            <select name="dob_day">
                                <option value="0">
                                    <?php
                                    $day = $model->user->birthday ?? false;

                                    if ($day){
                                        echo explode("/", $model->user->birthday)[0];
                                    } else{
                                        echo "-- Select date --";
                                    }
                                    ?>
                                </option>
                                <?php
                                for ($day = 1; $day <= 31; $day++){
                                    echo '<option value="' . $day . '">' . $day . '</option>';
                                }
                                ?>
                            </select>
                            <select name="dob_month">
                                <option value="0">
                                    <?php
                                    $day = $model->user->birthday ?? false;

                                    if ($day){
                                        echo explode("/", $model->user->birthday)[1];
                                    } else{
                                        echo "-- Select month --";
                                    }
                                    ?>
                                </option>
                                <?php
                                for ($month = 1; $month <= 12; $month++){
                                    echo '<option value="' . $month . '">' . $month . '</option>';
                                }
                                ?>
                            </select>
                            <select name="dob_year">
                                <option value="0">
                                    <?php
                                    $day = $model->user->birthday ?? false;

                                    if ($day){
                                        echo explode("/", $model->user->birthday)[2];
                                    } else{
                                        echo "-- Select year --";
                                    }
                                    ?>
                                </option>
                                <?php
                                for ($year = 2010; $year >= 1930; $year--){
                                    echo '<option value="' . $year . '">' . $year . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Your phone number
                            <div>Your phone number</div>
                        </div>
                        <input type="text" name="phone" placeholder="Your phone number"
                               value="<?php echo $model->user->phone ?>">
                    </div>
                    <div class="profile-pop-up-row">
                        <div>
                            Current address
                            <div>Current address</div>
                        </div>
                        <input type="text" name="address" placeholder="Current address"
                               value="<?php echo $model->user->address ?>">
                    </div>
                    <div class="profile-pop-up-button">
                        <button type="button" class="btn-cancel"
                                onclick="closePopUp('profile-pop-up')">
                            Cancel
                        </button>
                        <button class="btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="layout">
            <div class="body">
                <div class="info-layout">
                    <div class="layout-avatar">
                        <img id="profile-avatar" onclick="setAvatar()" src="<?php
                        $image = $model->user->profile_image;

                        if ($image == null || !file_exists('image/' . $image)){
                            echo 'image/logo.full.png';
                        } else{
                            echo 'image/' . $model->user->profile_image;
                        }
                        ?>"
                             class="avatar url">
                        <form id="profile-avatar-form" method="post" action="/profile/avatar"
                              enctype="multipart/form-data">
                            <input type="file" id="avatar-image" name="profile_image">
                            <input type='submit' value='Submit'/>
                        </form>
                    </div>
                    <div class="layout-detail">
                        <div class="name">
                            (<?php echo $model->user->first_name ?>)
                            <?php echo $model->user->last_name ?>
                        </div>
                        <div class="job-title">
                            <?php echo $model->user->job_title ?>
                        </div>
                        <table>
                            <tbody>
                            <tr>
                                <td class="profile-table-title">Email address</td>
                                <td><?php echo $model->user->email ?></td>
                            </tr>
                            <tr>
                                <td class="profile-table-title">Phone number</td>
                                <td>
                                    <?php
                                    $tmp = $model->user->phone;

                                    if (!empty($tmp) and !is_null($tmp)){
                                        echo $tmp;
                                    } else{
                                        echo "No information";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="profile-table-title">Direct manager</td>
                                <td><a href="">Khúc Ngọc Đạt</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">CONTACT INFO</div>
                    <table>
                        <tbody>
                        <?php
                        $tmp = $model->user->birthday;

                        if (!empty($tmp) and !is_null($tmp)):
                            ?>
                            <tr>
                                <td class="profile-table-title">Birthday:</td>
                                <td><?php echo $tmp ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php
                        $tmp = $model->user->address;

                        if (!empty($tmp) and !is_null($tmp)):
                            ?>
                            <tr>
                                <td class="profile-table-title">Address:</td>
                                <td><?php echo $tmp ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">USER GROUPS</div>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">DIRECT REPORTS</div>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">EDUCATION BACKGROUND</div>
                    <div class="main-func-notify"> No information</div>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">WORK EXPERIENCES</div>
                    <div class="main-func-notify"> No information</div>
                </div>
                <div class="main-func-layout">
                    <div class="main-func-title">HONORS AND AWARDS
                    </div>
                    <div class="main-func-notify"> No information</div>
                </div>
            </div>
        </div>
    </div>
    <div id="menu-right">
        <div class="info">
            <div class="fi overflow">
                (<?php echo $model->user->first_name ?>)
                <?php echo $model->user->last_name ?>
            </div>
            <div class="se overflow">@john . <?php echo $model->user->email ?></div>
        </div>
        <div class="title">ACCOUNT INFORMATION</div>
        <div class="block">
            <div class="func item-select" onclick="selectFunc(this)">
                <div class="icon">
                    <account-overview-icon></account-overview-icon>
                </div>
                Account overview
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <edit-account-icon></edit-account-icon>
                </div>
                Edit account
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <edit-language-icon></edit-language-icon>
                </div>
                Edit language
            </div>
            <div class="func" onclick="selectFunc(this)" id="change-password">
                <div class="icon">
                    <edit-password-icon></edit-password-icon>
                </div>
                Edit password
            </div>
            <div class="pop-up" id="password-pop-up">
                <div class="pop-up-container profile-pop-up-container" id="password-pop-up-container">
                    <div class="pop-up-header">
                        <div class="pop-up-title">
                            Change password
                        </div>
                        <div class="url" onclick="closePopUp('password-pop-up')">&#10006;</div>
                    </div>
                    <form class="profile-pop-up-content" action="/profile/change-password" method="post">
                        <div class="profile-pop-up-row">
                            <div>
                                Current password
                                <div>Current password</div>
                            </div>
                            <input type="password" name="current_password" placeholder="Current password">
                        </div>
                        <div class="profile-pop-up-row">
                            <div>
                                New password
                                <div>New password</div>
                            </div>
                            <input type="password" name="new_password" placeholder="New password">
                        </div>
                        <div class="profile-pop-up-row">
                            <div>
                                Retype new password
                                <div>Retype new password</div>
                            </div>
                            <input type="password" name="retype_new_password" placeholder="Retype new password">
                        </div>
                        <div class="profile-pop-up-row">
                            <div>
                                Force logout
                                <div>Force logout from all devices</div>
                            </div>
                            <div class="layout-select">
                                <select name="force_logout">
                                    <option value="0">No</option>
                                    <option value="1" selected>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="password-pop-up-note">Change your password may force you to logout of every mobile
                            device
                        </div>
                        <div id="notify-error"> Note </div>
                        <div class="profile-pop-up-button">
                            <button type="button" class="btn-cancel"
                                    onclick="closePopUp('password-pop-up')">
                                Cancel
                            </button>
                            <button class="btn-submit" onclick="changePassword()">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <edit-theme-color-icon></edit-theme-color-icon>
                </div>
                Edit theme color
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <set-timesheet></set-timesheet>
                </div>
                Set timesheet
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <factor-authentication-icon></factor-authentication-icon>
                </div>
                2-factor authentication
            </div>
        </div>
        <div class="title">APPLICATION & SECURITY</div>
        <div class="title">ADVANCE SETTING</div>
        <div class="block">
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <login-histories-icon></login-histories-icon>
                </div>
                Login histories
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <manage-linked-devices-icon></manage-linked-devices-icon>
                </div>
                Manage linked devices
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <edit-mail-notify-icon></edit-mail-notify-icon>
                </div>
                Edit email notification
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <edit-timezone-icon></edit-timezone-icon>
                </div>
                Edit timezone
            </div>
            <div class="func" onclick="selectFunc(this)">
                <div class="icon">
                    <on-leave-delegation-icon></on-leave-delegation-icon>
                </div>
                On-leave delegation
            </div>
        </div>
    </div>
</div>
</body>
</html>