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
post("/signUp", function () {
  extract($_POST);
  if (db::fetch("select * from user where id = '$id'")) {
    alert("이미 존재하는 아이디입니다");
    back();
  } else {
    [$h_psw, $salt] = hashPsw($psw);
    db::exec("insert into user(id, psw, email, name, salt) values('$id', '$h_psw', '$email', '$name', '$salt')");
    alert("회원가입 성공");
    move("/login");
  }
});
post("/signIn", function () {
  extract($_POST);
  $user = db::fetch("select * from user where id = '$id'");
  if ($user) {
    $input_h_psw = hash("sha256", $psw . $user->salt);
    if ($input_h_psw == $user->psw) {
      $_SESSION["ss"] = $user;
      alert("로그인 성공");
      move("/");
    } else {
      alert("비밀번호가 일치하지 않습니다");
      back();
    }
  } else {
    alert("아이디가 일치하지 않습니다");
    back();
  }
});