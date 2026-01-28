<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원 관리</title>
  <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <?php
    require_once './header.php';
    $users = db::fetchAll("select * from user where super_admin = 0");
  ?>
  <main class="view-box">
        <header>
      <div>
        <h1>회원 관리</h1>
        <p>회원들을 관리하세요</p>
      </div>
    </header>
    <table class="nomal-table">
      <thead>
        <th>역할</th>
        <th>아이디</th>
        <th>이름</th>
        <th>이메일</th>
        <th>가입일</th>
        <th>관리</th>
      </thead>
      <tbody>
        <?php foreach($users as $user) { ?>
          <tr>
            <td>
              <?php if ($user->super_admin == 1) { ?>
                <span class="user-type" style="background-color:#f3e248">슈퍼 관리자</span>
              <?php } else if ($user->admin == 1) { ?>
                <span class="user-type" style="background-color:#9cdc12">서점 관리자</span>
              <?php } else { ?>
                <span class="user-type">일반 유저</span>
              <?php } ?>
            </td>
            <td><?=$user->id?></td>
            <td><?=$user->name?></td>
            <td><?=$user->email?></td>
            <td><?=$user->date?></td>
            <td class="btns" style="display:block;">
              <a href="./userDeleteAction.php?idx=<?=$user->idx?>" onclick="return confirm('정말 삭제하시겠습니까?')" class="red-btn btn">탈퇴</a>
              <?php if($user->admin == 1){ ?>
              <a href="./userDeleteAdminAction.php?idx=<?=$user->idx?>" class="white-btn btn">관리자 해제</a>
              <?php } else { ?>
              <a href="./userAddAdmin.php?idx=<?=$user->idx?>" class="white-btn btn">관리자 등록</a>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>
</body>
</html>