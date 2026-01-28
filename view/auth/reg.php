<main class="form-box">
    <form action="./userAction.php" method="post">
      <h1 class="form-title">회원가입</h1>
      <input type="hidden" name="type" value="reg">
      <div>
        <label for="id">아이디</label>
        <input type="text" name="id" id="id" placeholder="아이디를 입력해주세요" required>
      </div>
      <div>
        <label for="psw">비밀번호</label>
        <input type="password" name="psw" id="psw" placeholder="비밀번호를 입력해주세요" required>
      </div>
      <div>
        <label for="email">이메일</label>
        <input type="email" name="email" id="email" placeholder="이메일을 입력해주세요" required>
      </div>
      <div>
        <label for="name">이름</label>
        <input type="text" name="name" id="name" placeholder="이름을 입력해주세요" required>
      </div>
      <button type="submit">회원가입</button>
    </form>
  </main>

<script>
  const form = document.querySelector(".form-box");

  form.addEventListener("submit", (e) => {
    const id = document.querySelector("input[name='id']")
    const psw = document.querySelector("input[name='psw']")

    // test(): 자바스크립트에서 정규표현식(패턴)이 특정 문자열에 들어맞는지 확인하는 함수
    if (!/(?=.*[a-zA-Z]).{6,}/.test(id.value)) {
      e.preventDefault()
      id.focus()
      return alert("아이디는 영문 포함 6자 이상이여야 합니다")
    }

    if (!/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*?_~]).{8,}$/.test(psw.value)) {
      e.preventDefault()
      psw.focus()
      return alert("비밀번호는 영문, 숫자, 특수문자 포함 8자 이상이여야 합니다")
    }
  })
</script>