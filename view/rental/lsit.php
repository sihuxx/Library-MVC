<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>책 대여 유저 조회 선택</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./fontawesome/css/font-awesome.css">
</head>

<body>
  <?php
  require_once './header.php';
  ?>
  <main class="view-box">
    <header>
      <div>
        <h1>책 대여 유저 조회</h1>
        <p>조회할 방법을 선택하세요.</p>
      </div>
    </header>
    <div class="choose-box">
      <div>
        <div>
        <i class="fa fa-calendar-o fa-2x"></i>
        <h3>캘린더</h3>
        <p>날짜 별 책 대여 유저를 <br> 조회하세요.</p>
        </div>
        <a href="./rentalUserCalendar.php" class="btn">조회하기</a>
      </div>
      <div>
        <div>
          <i class="fa fa-table fa-2x"></i>
          <h3>표</h3>
          <p>표 형식으로 책 대여 유저를 <br> 조회하세요.</p>
        </div>
        <a href="./rentalUserTable.php" class="btn">조회하기</a>
      </div>
    </div>
  </main>
</body>

</html>