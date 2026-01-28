<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="./style/style.css">
</head>

<body>
  <?php
  require_once './header.php';
  $idx = $_GET["idx"];
  $store = db::fetch("select * from stores where idx = '$idx'");
  $books = db::fetchAll("select * from book where store_idx = '$store->idx'");
  ?>
  <main class="view-box">
    <header>
      <div class="row">
        <img src="<?= $store->img ?>" alt="">
        <div>
          <h1><?= $store->title ?></h1>
          <p><?= $store->des ?></p>
        </div>
      </div>
    </header>
    <div class="title-box">
      <h3>도서 목록</h3>
    </div>
    <div class="books">
     <?php if(count($books) > 0) { ?>
       <?php foreach ($books as $book) { ?>
        <div class="book">
          <?php if($book->count > 0) { ?>
          <div class="book-img">
            <img src="<?= $book->img ?>" alt="<?= $book->title ?>">
          </div>
          <?php } else { ?>
          <div class="no-stock-img">
            <div class="book-background">✖</div>
            <img src="<?= $book->img ?>" alt="<?= $book->title ?>">
          </div>
          <?php } ?>
          <div class="book-content">
            <h3 class="book-title"><?= $book->title ?></h3>
            <p class="book-des"><?= $book->des ?></p>
            <p class="book-stock">재고: <?= $book->count ?>/<?= $book->stock ?></p>
          </div>
         <?php if($book->count > 0) { ?>
           <form method="post" action="bookRental.php" class="book-btns">
            <input type="hidden" name="book_idx" value="<?= $book->idx ?>">
            <input type="hidden" name="store_idx" value="<?= $store->idx ?>">
            <button class="btn" >대여</button>
          </form>
        <?php } else { ?>
           <div class="book-btns">
            <button class="btn white-btn" onclick="alert('재고가 없는 책입니다.')">대여</button>
           </div>
         <?php } ?>
        </div>
      <?php } ?>
     <?php } else { ?>
      <p class="no-book-msg">도서가 존재하지 않습니다.</p>
     <?php } ?>
    </div>
  </main>
</body>

</html>