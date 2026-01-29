<?php
  $idx = $_POST['idx'];
  if(db::fetch("select * from stores where admin_idx = '$idx'")) {
    move("/userAdmin", "이미 서점 관리자로 등록된 유저입니다");
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
        <form class="store-btns" method="post" action="/userInsertAdmin">
          <input type="hidden" name="user_idx" value="<?=$idx?>">
          <input type="hidden" name="store_idx" value="<?=$store->idx?>">
          <button class="btn">선택</button>
        </form>
      </div>
    <?php } ?>
  </div>
</main>
