<?php
get('/', function () {
  views('home');
});
get("/login", function () {
  views("auth/login");
});
get("/reg", function () {
  views("auth/reg");
});
get('/logout', function () {
  session_destroy();
  alert("로그아웃 성공");
  move("/");
});
get('/bookAdmin', function () {
  views("/book/list");
});
get('/rentalAdmin', function () {
  views("/rental/list");
});
get('/storeAdmin', function () {
  views("/store/adminList");
});
get('/userAdmin', function () {
  views("/user/list");
});
get('/storeList', function () {
  views("/store/list");
});
get('/profile', function () {
  views("/user/profile");
});
post("/store", function () {
  views("store/store");
});
post("/rental", function () {
  $user = $_SESSION['ss'];
  $book_idx = $_POST["book_idx"];
  $book = db::fetch("select * from book where idx = '$book_idx'");
  $store_idx = $_POST["store_idx"];
  if ($book->count < 1) {
    alert("재고가 없는 책입니다.");
    return;
  }
  if (db::fetch("select * from user_book where user_idx = '$user->idx' and book_idx = '$book_idx' and is_rental = '1'")) {
    move("/storeList", "이미 대여 중인 책입니다");
  } else {
    db::exec("insert into user_book(user_idx, book_idx, period, is_rental) values ('$user->idx', '$book_idx', '7', '1')");
    db::exec("update book set count = count - 1 where idx = '$book_idx'");
    move("/profile", "책 대여가 완료되었습니다");
  }
});
post("/return", function () {
  $book_idx = $_POST["book_idx"];
  $user = $_SESSION["ss"];
  db::exec("update user_book set is_rental = '0' where user_idx = '$user->idx' and book_idx = '$book_idx'");
  db::exec("update book set count = count + 1 where idx = '$book_idx'");
  move("/profile", "책 반납이 완료되었습니다");
});
post("/signUp", function () {
  extract($_POST);
  if (db::fetch("select * from user where id = '$id'")) {
    back("이미 존재하는 아이디입니다");
  } else {
    [$h_psw, $salt] = hashPsw($psw);
    db::exec("insert into user(id, psw, email, name, salt) values('$id', '$h_psw', '$email', '$name', '$salt')");
    move("/login", "회원가입 성공");
  }
});
post("/signIn", function () {
  extract($_POST);
  $user = db::fetch("select * from user where id = '$id'");
  if ($user) {
    $input_h_psw = hash("sha256", $psw . $user->salt);
    if ($input_h_psw == $user->psw) {
      $_SESSION["ss"] = $user;
      move("/", "로그인 성공");
    } else {
      back("비밀번호가 일치하지 않습니다");
    }
  } else {
    back("아이디가 일치하지 않습니다");
  }
});
post("/quit", function() {
$idx = $_POST["idx"];
db::exec("delete from user where idx = '$idx'");
back("탈퇴 처리 되었습니다");
});