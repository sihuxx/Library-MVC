<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Library</title>
  <link rel="stylesheet" href="/style/style.css">
  <link rel="stylesheet" href="/fontawesome/css/font-awesome.css">
</head>
<body>

<?php
$user = $_SESSION["ss"] ?? false;
?>

<header class="header">
    <div class="header-content">
        <a href="/" class="logo">
            <img src="/images/logo.png" alt="로고">
        </a>

                <?php if (!$user) { ?>
            <nav class="nav1">
                <ul>
                    <li><a href="/"></a></li>
                </ul>
                <ul>
                    <li><a href="/"></a></li>
                </ul>
            </nav>
        <?php } else if ($user->admin == 1) { ?>
            <nav class="nav1">
                <ul>
                    <li><a href="/bookAdmin">책 관리</a></li>
                </ul>
                <ul>
                    <li><a href="/rentalAdmin">책 대여 유저 조회</a></li>
                </ul>
                </nav>
        <?php } else if ($user->super_admin == 1) { ?>
            <nav class="nav1">
                <ul>
                    <li><a href="/storeAdmin">서점 관리</a></li>
                </ul>
                <ul>
                    <li><a href="/userAdmin">회원 관리</a></li>
                </ul>
            </nav>
        <?php } else { ?>
            <nav class="nav1">
                <ul>
                    <li><a href="/storeList">서점 조회</a></li>
                </ul>
                <ul>
                    <li><a href="/myProfile">마이 프로필</a></li>
                </ul>
            </nav>
        <?php } ?>

        <?php if (!$user) { ?>
            <nav>
                <ul>
                    <li><a href="/reg">회원가입</a></li>
                </ul>
                <ul>
                    <li><a href="/login">로그인</a></li>
                </ul>
            </nav>
        <?php } else if ($user->admin == 1) { ?>
            <nav>
                <ul>
                    <li><a><?= $user->id ?></a></li>
                    <span class="user-type" style="background-color:#9cdc12">서점 관리자</span>
                </ul>
                <ul>
                    <li><a href="/logout">로그아웃</a></li>
                </ul>
            </nav>
        <?php } else if ($user->super_admin == 1) { ?>
            <nav>
                <ul>
                    <li><a><?= $user->id ?></a></li>
                    <span class="user-type" style="background-color:#f3e248">슈퍼 관리자</span>
                </ul>
                <ul>
                    <li><a href="/logout">로그아웃</a></li>
                </ul>
            </nav>
        <?php } else { ?>
            <nav>
                <ul>
                    <li><a><?= $user->id ?></a></li>
                    <span class="user-type">일반 유저</span>
                </ul>
                <ul>
                    <li><a href="/logout">로그아웃</a></li>
                </ul>
            </nav>
        <?php } ?>
    </div>
</header>