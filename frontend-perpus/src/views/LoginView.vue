<template>
  <div class="login-page">

    <!-- BACKGROUND DECORATION -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="grid-bg"></div>

    <div class="login-wrapper">

      <!-- ================= LEFT SIDE ================= -->
      <section class="visual-side">

        <div class="brand">
          <div class="brand-icon">
            <span>📚</span>
          </div>

          <div>
            <h2>Perpus<span>Ku</span></h2>
            <p>DIGITAL LIBRARY</p>
          </div>
        </div>

        <div class="visual-content">

          <div class="badge">
            <span class="badge-dot"></span>
            Perpustakaan Digital
          </div>

          <h1>
            Temukan dunia
            <span>melalui buku.</span>
          </h1>

          <p class="description">
            Akses koleksi buku, temukan bacaan favorit,
            dan perluas wawasanmu dalam satu tempat.
          </p>

          <!-- BOOK CARDS -->
          <div class="floating-books">

            <div class="book-card book-one">
              <div class="book-cover">
                <span>📖</span>
              </div>
              <div class="book-info">
                <strong>Atomic Habits</strong>
                <small>James Clear</small>
              </div>
            </div>

            <div class="book-card book-two">
              <div class="book-cover purple">
                <span>🧠</span>
              </div>
              <div class="book-info">
                <strong>Deep Work</strong>
                <small>Cal Newport</small>
              </div>
            </div>

            <div class="book-card book-three">
              <div class="book-cover green">
                <span>🚀</span>
              </div>
              <div class="book-info">
                <strong>Start With Why</strong>
                <small>Simon Sinek</small>
              </div>
            </div>

          </div>

          <div class="quote">
            <div class="quote-line"></div>
            <p>
              "Satu buku, satu ide, bisa mengubah
              cara kita melihat dunia."
            </p>
          </div>

        </div>

        <div class="visual-footer">
          <span>✦</span>
          Baca. Belajar. Berkembang.
        </div>

      </section>


      <!-- ================= RIGHT SIDE ================= -->
      <section class="form-side">

        <div class="login-card">

          <div class="mobile-logo">
            <div class="brand-icon">
              📚
            </div>
            <h2>Perpus<span>Ku</span></h2>
          </div>

          <div class="form-header">
            <div class="welcome-icon">
              👋
            </div>

            <div>
              <p class="small-title">SELAMAT DATANG KEMBALI</p>
              <h2>Masuk ke akunmu</h2>
              <p>
                Silakan masuk untuk melanjutkan.
              </p>
            </div>
          </div>


          <!-- FORM -->
          <form @submit.prevent="login">

            <!-- EMAIL -->
            <div class="form-group">
              <label>Email</label>

              <div class="input-wrapper">
                <span class="input-icon">✉</span>

                <input
                  v-model="email"
                  type="email"
                  placeholder="nama@email.com"
                  required
                />
              </div>
            </div>


            <!-- PASSWORD -->
            <div class="form-group">

              <div class="label-row">
                <label>Password</label>

                <a href="#" @click.prevent>
                  Lupa password?
                </a>
              </div>

              <div class="input-wrapper">

                <span class="input-icon">🔒</span>

                <input
                  v-model="password"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="Masukkan password"
                  required
                />

                <button
                  type="button"
                  class="password-toggle"
                  @click="showPassword = !showPassword"
                >
                  {{ showPassword ? '🙈' : '👁' }}
                </button>

              </div>
            </div>


            <!-- REMEMBER -->
            <div class="remember-row">

              <label class="checkbox">
                <input
                  v-model="remember"
                  type="checkbox"
                />

                <span class="checkmark"></span>

                <span>Ingat saya</span>
              </label>

            </div>


            <!-- LOGIN BUTTON -->
            <button class="login-button" type="submit">

              <span>Masuk ke PerpusKu</span>

              <span class="arrow">→</span>

            </button>


            <!-- DIVIDER -->
            <div class="divider">
              <span>atau</span>
            </div>


            <!-- DEMO LOGIN -->
            <button
              type="button"
              class="demo-button"
              @click="demoLogin"
            >
              <span class="demo-icon">⚡</span>
              Masuk dengan akun demo
            </button>


            <!-- REGISTER -->
            <div class="register-text">
              Belum punya akun?

              <a href="#" @click.prevent>
                Daftar sekarang
              </a>
            </div>

          </form>


          <!-- SECURITY -->
          <div class="security-info">

            <span>🔐</span>

            <div>
              <strong>Data kamu aman</strong>
              <p>Informasi akun terlindungi dengan sistem keamanan.</p>
            </div>

          </div>

        </div>

      </section>

    </div>

  </div>
</template>


<script setup>

import { ref } from 'vue'

const email = ref('')
const password = ref('')
const remember = ref(false)
const showPassword = ref(false)

function login() {

  console.log({
    email: email.value,
    password: password.value,
    remember: remember.value
  })

  alert(`Login berhasil!\n\nEmail: ${email.value}`)
}

function demoLogin() {

  email.value = 'admin@perpusku.com'
  password.value = 'password123'

}

</script>


<style scoped>

/* =========================
   RESET
========================= */

* {
  box-sizing: border-box;
}

.login-page {
  min-height: 100vh;
  width: 100%;
  position: relative;
  overflow: hidden;

  display: flex;
  align-items: center;
  justify-content: center;

  padding: 30px;

  font-family:
    Inter,
    ui-sans-serif,
    system-ui,
    -apple-system,
    BlinkMacSystemFont,
    "Segoe UI",
    sans-serif;

  background:
    radial-gradient(
      circle at 15% 15%,
      rgba(52, 104, 196, .28),
      transparent 32%
    ),
    radial-gradient(
      circle at 85% 85%,
      rgba(126, 72, 220, .20),
      transparent 30%
    ),
    #07101f;
}


/* =========================
   BACKGROUND
========================= */

.grid-bg {
  position: absolute;
  inset: 0;

  opacity: .18;

  background-image:
    linear-gradient(
      rgba(255,255,255,.05) 1px,
      transparent 1px
    ),
    linear-gradient(
      90deg,
      rgba(255,255,255,.05) 1px,
      transparent 1px
    );

  background-size: 55px 55px;
}

.orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(2px);
  pointer-events: none;
}

.orb-1 {
  width: 320px;
  height: 320px;

  top: -150px;
  left: -100px;

  background:
    radial-gradient(
      circle,
      rgba(65, 126, 239, .35),
      transparent 70%
    );
}

.orb-2 {
  width: 400px;
  height: 400px;

  bottom: -200px;
  right: -100px;

  background:
    radial-gradient(
      circle,
      rgba(139, 75, 226, .28),
      transparent 70%
    );
}


/* =========================
   MAIN WRAPPER
========================= */

.login-wrapper {
  width: min(1180px, 100%);

  min-height: 700px;

  display: grid;
  grid-template-columns: 1.08fr .92fr;

  position: relative;
  z-index: 2;

  overflow: hidden;

  border-radius: 30px;

  border: 1px solid rgba(255,255,255,.12);

  background:
    rgba(255,255,255,.055);

  backdrop-filter: blur(25px);

  box-shadow:
    0 40px 100px rgba(0,0,0,.45),
    0 0 80px rgba(45,100,200,.08);
}


/* =========================
   LEFT SIDE
========================= */

.visual-side {
  position: relative;

  padding: 46px;

  color: white;

  overflow: hidden;

  background:
    linear-gradient(
      145deg,
      #142d55 0%,
      #102849 45%,
      #0b1b34 100%
    );
}


/* decorative circle */

.visual-side::before {
  content: "";

  position: absolute;

  width: 500px;
  height: 500px;

  border-radius: 50%;

  right: -230px;
  top: -230px;

  border: 1px solid rgba(255,255,255,.08);

  box-shadow:
    0 0 0 70px rgba(255,255,255,.025),
    0 0 0 140px rgba(255,255,255,.018);
}

.visual-side::after {
  content: "";

  position: absolute;

  width: 280px;
  height: 280px;

  border-radius: 50%;

  left: -170px;
  bottom: -170px;

  background:
    rgba(50,110,220,.12);

  filter: blur(10px);
}


/* =========================
   BRAND
========================= */

.brand {
  display: flex;
  align-items: center;
  gap: 14px;

  position: relative;
  z-index: 3;
}

.brand-icon {
  width: 48px;
  height: 48px;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 15px;

  font-size: 24px;

  background:
    linear-gradient(
      135deg,
      #4d83df,
      #2856a0
    );

  box-shadow:
    0 10px 25px rgba(36,89,175,.35);
}

.brand h2 {
  margin: 0;

  font-size: 21px;
  font-weight: 800;
  letter-spacing: -.5px;
}

.brand h2 span {
  color: #79aaff;
}

.brand p {
  margin: 3px 0 0;

  font-size: 9px;
  letter-spacing: 3px;

  color: #7f95b7;
}


/* =========================
   VISUAL CONTENT
========================= */

.visual-content {
  position: relative;
  z-index: 3;

  margin-top: 90px;
}

.badge {
  display: inline-flex;
  align-items: center;
  gap: 9px;

  padding: 9px 14px;

  border-radius: 100px;

  font-size: 12px;

  color: #b8d2ff;

  border: 1px solid rgba(130,170,235,.25);

  background:
    rgba(255,255,255,.06);

  backdrop-filter: blur(10px);
}

.badge-dot {
  width: 7px;
  height: 7px;

  border-radius: 50%;

  background: #66e6b1;

  box-shadow:
    0 0 12px #66e6b1;
}


.visual-content h1 {
  max-width: 500px;

  margin: 22px 0 15px;

  font-size: clamp(42px, 4vw, 62px);

  line-height: .98;

  letter-spacing: -3px;

  font-weight: 800;
}

.visual-content h1 span {
  display: block;

  background:
    linear-gradient(
      90deg,
      #76aaff,
      #a9c8ff
    );

  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.description {
  max-width: 480px;

  margin: 0;

  line-height: 1.7;

  color: #9fb4d4;

  font-size: 15px;
}


/* =========================
   BOOK CARDS
========================= */

.floating-books {
  position: relative;

  height: 150px;

  margin-top: 38px;
}

.book-card {
  position: absolute;

  width: 215px;

  padding: 12px;

  display: flex;
  align-items: center;
  gap: 12px;

  border-radius: 16px;

  border: 1px solid rgba(255,255,255,.12);

  background:
    rgba(255,255,255,.075);

  backdrop-filter: blur(15px);

  box-shadow:
    0 15px 30px rgba(0,0,0,.18);
}

.book-one {
  left: 0;
  top: 10px;
  transform: rotate(-4deg);
}

.book-two {
  left: 175px;
  top: 40px;
  transform: rotate(4deg);
  z-index: 2;
}

.book-three {
  left: 350px;
  top: 0;
  transform: rotate(-3deg);
}

.book-cover {
  width: 43px;
  height: 58px;

  flex-shrink: 0;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 7px;

  font-size: 20px;

  background:
    linear-gradient(
      145deg,
      #4078d4,
      #1d4177
    );
}

.book-cover.purple {
  background:
    linear-gradient(
      145deg,
      #8056d9,
      #45237f
    );
}

.book-cover.green {
  background:
    linear-gradient(
      145deg,
      #27a88c,
      #126653
    );
}

.book-info {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.book-info strong {
  font-size: 12px;
  color: white;
}

.book-info small {
  color: #8298b9;
  font-size: 10px;
}


/* =========================
   QUOTE
========================= */

.quote {
  display: flex;

  gap: 14px;

  margin-top: 22px;

  max-width: 440px;
}

.quote-line {
  width: 3px;

  border-radius: 5px;

  background:
    linear-gradient(
      #65a0ff,
      transparent
    );
}

.quote p {
  margin: 0;

  color: #7189ab;

  font-size: 12px;

  font-style: italic;

  line-height: 1.6;
}


/* =========================
   FOOTER
========================= */

.visual-footer {
  position: absolute;

  bottom: 35px;
  left: 46px;

  z-index: 3;

  color: #647da2;

  font-size: 11px;

  letter-spacing: 1px;
}

.visual-footer span {
  color: #78aaff;
  margin-right: 7px;
}


/* =========================
   FORM SIDE
========================= */

.form-side {
  position: relative;

  display: flex;
  align-items: center;
  justify-content: center;

  padding: 55px;

  background:
    rgba(8,16,30,.78);
}


/* glass line */

.form-side::before {
  content: "";

  position: absolute;

  left: 0;
  top: 12%;
  bottom: 12%;

  width: 1px;

  background:
    linear-gradient(
      transparent,
      rgba(255,255,255,.12),
      transparent
    );
}


/* =========================
   LOGIN CARD
========================= */

.login-card {
  width: 100%;
  max-width: 410px;
}


/* =========================
   HEADER
========================= */

.form-header {
  display: flex;
  gap: 15px;

  margin-bottom: 38px;
}

.welcome-icon {
  width: 48px;
  height: 48px;

  display: flex;
  align-items: center;
  justify-content: center;

  flex-shrink: 0;

  border-radius: 14px;

  background:
    rgba(63,117,208,.12);

  border: 1px solid rgba(93,145,232,.16);

  font-size: 20px;
}

.small-title {
  margin: 0 0 6px;

  color: #6f9fe8;

  font-size: 9px;

  font-weight: 800;

  letter-spacing: 2px;
}

.form-header h2 {
  margin: 0;

  color: #f3f6fb;

  font-size: 28px;

  letter-spacing: -.8px;
}

.form-header > div:last-child > p:last-child {
  margin: 7px 0 0;

  color: #71829d;

  font-size: 12px;
}


/* =========================
   FORM
========================= */

.form-group {
  margin-bottom: 22px;
}

.form-group label,
.label-row label {
  display: block;

  margin-bottom: 9px;

  color: #b7c5d9;

  font-size: 12px;

  font-weight: 600;
}

.label-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.label-row label {
  margin-bottom: 9px;
}

.label-row a {
  color: #6699eb;

  font-size: 11px;

  text-decoration: none;
}

.label-row a:hover {
  color: #8bb7ff;
}


/* =========================
   INPUT
========================= */

.input-wrapper {
  height: 54px;

  position: relative;

  display: flex;
  align-items: center;

  border-radius: 13px;

  border: 1px solid rgba(135,158,190,.16);

  background:
    rgba(255,255,255,.045);

  transition: .25s;
}

.input-wrapper:focus-within {
  border-color: rgba(91,143,232,.7);

  background:
    rgba(60,105,180,.07);

  box-shadow:
    0 0 0 4px rgba(69,122,211,.09),
    0 10px 30px rgba(0,0,0,.1);
}

.input-icon {
  width: 50px;

  display: flex;
  align-items: center;
  justify-content: center;

  color: #6481aa;

  font-size: 15px;
}

.input-wrapper input {
  width: 100%;
  height: 100%;

  border: none;
  outline: none;

  background: transparent;

  color: #edf4ff;

  font-size: 13px;
}

.input-wrapper input::placeholder {
  color: #53647e;
}

.password-toggle {
  border: none;
  background: transparent;

  padding: 12px;

  cursor: pointer;

  opacity: .6;

  font-size: 14px;
}

.password-toggle:hover {
  opacity: 1;
}


/* =========================
   REMEMBER
========================= */

.remember-row {
  margin: 3px 0 24px;
}

.checkbox {
  display: inline-flex;

  align-items: center;

  gap: 9px;

  color: #71829d;

  font-size: 11px;

  cursor: pointer;
}

.checkbox input {
  display: none;
}

.checkmark {
  width: 16px;
  height: 16px;

  display: inline-block;

  border-radius: 5px;

  border: 1px solid #42546f;

  transition: .2s;
}

.checkbox input:checked + .checkmark {
  background: #477bd0;

  border-color: #477bd0;

  box-shadow:
    0 0 10px rgba(71,123,208,.3);
}


/* =========================
   LOGIN BUTTON
========================= */

.login-button {
  width: 100%;
  height: 55px;

  display: flex;
  align-items: center;
  justify-content: space-between;

  padding: 0 18px 0 21px;

  border: none;
  border-radius: 13px;

  cursor: pointer;

  color: white;

  font-size: 13px;
  font-weight: 700;

  background:
    linear-gradient(
      135deg,
      #4a7fd7,
      #315eae
    );

  box-shadow:
    0 12px 28px rgba(45,92,166,.28);

  transition: .25s;
}

.login-button:hover {
  transform: translateY(-2px);

  box-shadow:
    0 16px 35px rgba(45,92,166,.4);
}

.login-button:active {
  transform: translateY(0);
}

.arrow {
  width: 31px;
  height: 31px;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 9px;

  background: rgba(255,255,255,.13);

  font-size: 17px;
}


/* =========================
   DIVIDER
========================= */

.divider {
  display: flex;
  align-items: center;

  gap: 12px;

  margin: 27px 0;

  color: #53637c;

  font-size: 10px;
}

.divider::before,
.divider::after {
  content: "";

  flex: 1;

  height: 1px;

  background:
    rgba(255,255,255,.08);
}


/* =========================
   DEMO BUTTON
========================= */

.demo-button {
  width: 100%;
  height: 52px;

  display: flex;
  align-items: center;
  justify-content: center;

  gap: 9px;

  border-radius: 12px;

  border: 1px solid rgba(255,255,255,.09);

  background:
    rgba(255,255,255,.035);

  color: #aab9cf;

  cursor: pointer;

  font-size: 12px;
  font-weight: 600;

  transition: .25s;
}

.demo-button:hover {
  background:
    rgba(255,255,255,.065);

  border-color:
    rgba(255,255,255,.15);

  color: white;
}

.demo-icon {
  color: #e6b94e;
}


/* =========================
   REGISTER
========================= */

.register-text {
  text-align: center;

  margin-top: 26px;

  color: #64748b;

  font-size: 11px;
}

.register-text a {
  margin-left: 4px;

  color: #6ea0f2;

  text-decoration: none;

  font-weight: 700;
}

.register-text a:hover {
  text-decoration: underline;
}


/* =========================
   SECURITY
========================= */

.security-info {
  display: flex;
  align-items: center;

  gap: 10px;

  margin-top: 30px;

  padding: 13px;

  border-radius: 12px;

  border: 1px solid rgba(100,150,220,.08);

  background:
    rgba(80,120,190,.045);
}

.security-info > span {
  font-size: 15px;
}

.security-info strong {
  display: block;

  color: #8298b7;

  font-size: 10px;
}

.security-info p {
  margin: 2px 0 0;

  color: #53647d;

  font-size: 9px;
}


/* =========================
   MOBILE LOGO
========================= */

.mobile-logo {
  display: none;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 950px) {

  .login-page {
    padding: 18px;
  }

  .login-wrapper {
    grid-template-columns: 1fr;

    min-height: auto;

    max-width: 520px;
  }

  .visual-side {
    display: none;
  }

  .form-side {
    padding: 45px 35px;
  }

  .form-side::before {
    display: none;
  }

  .mobile-logo {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 10px;

    margin-bottom: 35px;
  }

  .mobile-logo .brand-icon {
    width: 42px;
    height: 42px;

    font-size: 19px;
  }

  .mobile-logo h2 {
    color: white;

    font-size: 20px;
  }

  .mobile-logo h2 span {
    color: #79aaff;
  }
}


@media (max-width: 480px) {

  .login-page {
    padding: 0;
  }

  .login-wrapper {
    border-radius: 0;

    min-height: 100vh;

    border: none;
  }

  .form-side {
    padding: 35px 22px;
  }

  .form-header h2 {
    font-size: 24px;
  }

}

</style>