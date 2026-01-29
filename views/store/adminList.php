<?php
  $stores = db::fetchAll("select * from stores");
  ?>
  <main class="view-box">
    <header>
      <div>
        <h1>서점 관리</h1>
        <p>서점을 조회, 등록, 수정, 삭제하세요.</p>
      </div>
      <a href="/storeAdd">+ <span>서점 등록</span></a>
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
            if ($store->admin_idx != 0) {
              $admin_user = db::fetch("select * from user where idx = '$store->admin_idx'"); ?>
              <p class="store-admin">관리자: <?=$admin_user->id?></p>
            <?php } ?>
          </div>
        </div>
          <form method="post" class="store-btns">
            <input type="hidden" name="idx" value="<?=$store->idx?>">
            <button formaction="/storeEdit" class="btn">수정</button>
            <button formaction="/storeDel" class="btn red-btn" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</button>
          </form>
      </div>
     <?php } ?>
    </div>
  </main>