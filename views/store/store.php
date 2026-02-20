<?php
$idx = $_POST["idx"];
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
    <?php if (count($books) > 0) { ?>
      <?php foreach ($books as $book) {
        $userBook = db::fetchAll("select * from user_book where book_idx = $book->idx and is_rental = '1'"); ?>
        <div class="book">
          <?php if ($book->stock - count($userBook) > 0) { ?>
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
            <p class="book-stock">재고: <?= $book->stock - count($userBook) ?>/<?= $book->stock ?></p>
          </div>
          <?php if ($book->stock - count($userBook) > 0) { ?>
            <div class="book-btns">
              <form method="post" action="/rental" class="book-btns">
                <input type="hidden" name="book_idx" value="<?= $book->idx ?>">
                <input type="hidden" name="store_idx" value="<?= $store->idx ?>">
                <button class="btn">대여</button>
              </form>
              <button class="btn red-btn wish-btn" data-store-id="<?=$store->idx?>" data-book-id="<?=$book->idx?>">관심</button>
            </div>
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

<script>
  const wishBtns = document.querySelectorAll(".wish-btn");
  wishBtns.forEach(btn => {
    btn.onclick = async (e) => {
      const bookIdData = e.currentTarget.dataset.bookId;
      const storeIdData = e.currentTarget.dataset.storeId;
      /* dataset 변환 규칙 (카멜케이스) 
        data-id	-> dataset.id
        data-book-id ->	dataset.bookId
      */
      const response = await fetch("/wish", {
        method: "POST",
        body: JSON.stringify({ bookId: bookIdData, storeId: storeIdData }),
        headers: { 'Content-Type': 'application/json' },
      }).then(res => res.json());

      if (response.success) {
        alert(response.msg);
      } else  {
        alert(response.msg);
      }
    } 
  })
</script>