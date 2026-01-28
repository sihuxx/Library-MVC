<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>서점 관리</title>
  <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <?php
  require_once './header.php';
  $stores = db::fetchAll("select * from stores");
  ?>
  <main class="view-box">
    <header>
      <div>
        <h1>서점 관리</h1>
        <p>서점을 조회, 등록, 수정, 삭제하세요.</p>
      </div>
      <a href="./storeAdd.php">+ <span>서점 등록</span></a>
    </header>
    <div class="stores">
     <?php foreach($stores as $store) { ?>
       <div class="store">
        <div class="store-content">
          <img src="<?=$store->img?>" alt="<?=$store->title?>">
          <div>
            <h3 class="store-title"><?=$store->title?></h3>
            <p class="store-date">등록일:<?=$store->create_at?></p>
            <p class="store-des"><?=$store->des?></p>
            <?php
            if($store->admin_idx != 0) {
              $admin_user = db::fetch("select * from user where idx = '$store->admin_idx'"); ?>
              <p class="store-admin">관리자: <?=$admin_user->id?></p>
            <?php } ?>
          </div>
        </div>
        <div class="store-btns">
          <a href="./storeEdit.php?idx=<?=$store->idx?>" class="btn">수정</a>
          <a href="./storeDeleteAction.php?idx=<?=$store->idx?>" onclick="return confirm('정말 삭제하시겠습니까?')" class="red-btn btn">삭제</a>
        </div>
      </div>
     <?php } ?>
    </div>
  </main>
</body>
</html>