<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>책 대여 유저 조회 (캘린더)</title>
  <link rel="stylesheet" href="./style/style.css">
</head>

<body>
  <?php
  require_once './header.php';
  $year = isset($_GET['year']) ? $_GET["year"] : date('Y');
  $month = isset($_GET['month']) ? $_GET["month"] : date('m');

  $date = "$year-$month-01";
  $time = strtotime($date);
  $start_week = date("w", $time);
  $total_day = date("t", $time);
  $total_week = ceil(($total_day + $start_week) / 7);
  $users = db::fetchAll("select u.*, ub.*, u.idx as user_id 
  from user u inner join user_book ub 
  on u.idx = ub.user_idx 
  where ub.rental_date like '$year-$month-%' 
  group by u.idx, ub.rental_date");
  ?>
  <div class="background">
    <div class="rental-user-modal">
      <div class="btn red-btn close-btn">닫기</div>
      <div class="title-date"></div>
      <div class="rental-user-content"></div>
    </div>
  </div>
  <main class="view-box" style="margin-bottom: 100px;">
    <header>
      <div>
        <h1>책 대여 유저 조회 (캘린더)</h1>
        <p>캘린더로 책 대여 유저를 조회하세요.</p>
      </div>
    </header>
    <div class="table-control" style="margin: 30px 0">
      <?php if ($month == 1) { ?>
        <a class="btn white-btn" href="?year=<?= $year - 1 ?>&month=12">&lt;</a>
      <?php } else { ?>
        <a class="btn white-btn" href="?year=<?= $year ?>&month=<?= $month - 1 ?>">&lt;</a>
      <?php } ?>

      <?php echo "$year 년 $month 월" ?>
      <?php if ($month == 12) { ?>
        <a class="btn white-btn" href="?year=<?= $year + 1 ?>&month=1">&lt;</a>
      <?php } else { ?>
        <a class="btn white-btn" href="?year=<?= $year ?>&month=<?= $month + 1 ?>">&gt;</a>
      <?php } ?>
    </div>
    <table class="calender-table">
      <thead>
        <th>일</th>
        <th>월</th>
        <th>화</th>
        <th>수</th>
        <th>목</th>
        <th>금</th>
        <th>토</th>
      </thead>
      <tbody>
        <?php for ($n = 1, $i = 0; $i < $total_week; $i++) { ?>
          <tr>
            <?php for ($k = 0; $k < 7; $k++) { ?>
              <td style="cursor:pointer;">
                <?php if (($n > 1 || $k >= $start_week) && ($total_day >= $n)) {
                  echo $n++;
                } ?>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>
</body>
<script>
  const userData = <?= json_encode($users) ?>;
  const closeBtn = document.querySelector(".close-btn");
  const modalContent = document.querySelector(".rental-user-content");
  const modal = document.querySelector(".rental-user-modal");
  const modalTitle = document.querySelector(".title-date")
  const background = document.querySelector(".background");
  const tds = document.querySelectorAll("table tbody td");
  const year = <?= $year ?>;
  const month = <?= $month ?>;

  closeBtn.addEventListener("click", () => {
    background.style.display = 'none';
  });

  function pad(number) {
    return number.toString().padStart(2, '0');
  }

  function rentalDate() {
    const rentalDates = userData.map(user => user.rental_date);

    tds.forEach(td => {
      const day = td.textContent.trim();
      if (!day) return;

      const targetDate = `${year}-${pad(month)}-${pad(day)}`;

      if (rentalDates.includes(targetDate)) {
        td.classList.add("is-rental");
      }
    })
  }

  function openRental() {
    console.log(userData);
    
    rentalDate();

    tds.forEach(td => {
      td.addEventListener('click', (event) => {

        const day = event.currentTarget.textContent.trim();

        if (!day) return;

        const targetDate = `${year}-${pad(month)}-${pad(day)}`;
        const filterData = userData.filter(user => user.rental_date == targetDate);

        let htmlContent = "";

        if (filterData.length > 0) {
          filterData.forEach(user => {
            htmlContent += `
           <div>
            <div>
              <span>${user.name}</span>
              <span>@${user.id}</span>
            </div>
            <a href="./profile.php?idx=${user.user_id}" class="btn">프로필 보기</a>
           </div>
          `;
          });
        } else {
          htmlContent += `
        <p>대여 기록이 없습니다.</p>
        `;
        };
        modalContent.innerHTML = htmlContent;
        background.style.display = 'flex';
        modalTitle.textContent = `${year}년 ${month}월 ${day}일 대여 기록`;
      });
    });
  };
  openRental();
</script>

</html>