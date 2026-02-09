<?php
$user = $_SESSION["ss"];
$store = db::fetch("select * from stores where admin_idx = $user->idx");
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
        <a href="/calendar/<?=$store->idx?>" class="btn">조회하기</a>
      </div>
    </div>
    <div>
      <div>
        <i class="fa fa-table fa-2x"></i>
        <h3>표</h3>
        <p>표 형식으로 책 대여 유저를 <br> 조회하세요.</p>
      </div>
      <a href="/table/<?=$store->idx?>" class="btn">조회하기</a>
    </div>
  </div>
</main>
