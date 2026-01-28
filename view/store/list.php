<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>서점 조회</title>
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
       <h1>서점 조회</h1>
      <p>서점을 조회하고 책을 대여해보세요.</p>
     </div>
    </header>
    <div class="stores">
      <?php foreach ($stores as $store) {
        $books = db::fetchAll("select * from book where store_idx = '$store->idx'");
        ?>
        <div class="store">
          <div class="store-content">
            <img src="<?= $store->img ?>" alt="<?= $store->title ?>">
            <div>
              <h3 class="store-title"><?= $store->title ?></h3>
              <p class="store-date">등록일:<?= $store->create_at ?></p>
              <p class="store-des"><?= $store->des ?></p>
            </div>
          </div>
          <div class="store-btns">
            <a href="./store.php?idx=<?= $store->idx ?>" class="btn">구경하기</a>
            <p><?= count($books) ?>권의 책</p>
          </div>
        </div>
      <?php } ?>
    </div>
  </main>
</body>

</html>