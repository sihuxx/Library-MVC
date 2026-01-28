<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>상점 선택</title>
  <link rel="stylesheet" href="./style/style.css">
</head>

<body>
  <?php
  require_once './header.php';
  require_once './lib.php';
  $idx = $_GET['idx'];
  if(db::fetch("select * from stores where admin_idx = '$idx'")) {
    alert("이미 서점 관리자로 등록된 유저입니다");
    move("./userAdmin.php");
  }
  $stores = db::fetchAll("select * from stores");
  ?>
<main class="view-box">
    <div class="stores">
    <?php foreach ($stores as $store) { ?>
      <div class="store">
        <div class="store-content">
          <img src="<?= $store->img ?>" alt="<?= $store->title ?>">
          <div>
            <h3 class="store-title"><?= $store->title ?></h3>
            <p class="store-des"><?= $store->des ?></p>
            <p class="store-date"><?= $store->create_at ?></p>
          </div>
        </div>
        <form class="store-btns" method="post" action="./userAddAdminAction.php">
          <input type="hidden" name="user_idx" value="<?=$idx?>">
          <input type="hidden" name="store_idx" value="<?=$store->idx?>">
          <button class="btn">선택</button>
        </form>
      </div>
    <?php } ?>
  </div>
</main>
</body>

</html>