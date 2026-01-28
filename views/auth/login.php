<main class="form-box">
    <form action="/signIn" method="post">
      <h1 class="sign-title">로그인</h1>
      <input type="hidden" name="type" value="login">
      <div>
        <label for="id">아이디</label>
        <input type="text" name="id" id="id" placeholder="아이디를 입력해주세요" required>
      </div>
      <div>
        <label for="psw">비밀번호</label>
        <input type="password" name="psw" id="psw" placeholder="비밀번호를 입력해주세요" required>
      </div>
      <button type="submit">로그인</button>
    </form>
  </main>