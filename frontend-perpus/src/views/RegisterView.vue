<template>
  <div class="register-page">

    <!-- BACKGROUND -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="grid-bg"></div>

    <div class="register-wrapper">

      <!-- ================= LEFT : FORM ================= -->
      <section class="form-side">

        <div class="register-card">

          <!-- MOBILE LOGO -->
          <div class="mobile-logo">
            <div class="brand-icon">
              📚
            </div>

            <h2>
              Perpus<span>Ku</span>
            </h2>
          </div>


          <!-- HEADER -->
          <div class="form-header">

            <div class="welcome-icon">
              ✨
            </div>

            <div>
              <p class="small-title">
                MULAI PERJALANANMU
              </p>

              <h2>Buat akun baru</h2>

              <p>
                Daftar dan mulai menjelajahi koleksi buku.
              </p>
            </div>

          </div>


          <!-- ================= FORM ================= -->
          <form @submit.prevent="register">

            <!-- ERROR -->
            <div
              v-if="errorMessage"
              class="register-error"
            >
              <span>⚠️</span>
              <span>{{ errorMessage }}</span>
            </div>


            <!-- SUCCESS -->
            <div
              v-if="successMessage"
              class="register-success"
            >
              <span>✓</span>
              <span>{{ successMessage }}</span>
            </div>


            <!-- NAMA -->
            <div class="form-group">

              <label>Nama Lengkap</label>

              <div class="input-wrapper">

                <span class="input-icon">
                  👤
                </span>

                <input
                  v-model="name"
                  type="text"
                  placeholder="Masukkan nama lengkap"
                  required
                  autocomplete="name"
                />

              </div>

            </div>


            <!-- EMAIL -->
            <div class="form-group">

              <label>Email</label>

              <div class="input-wrapper">

                <span class="input-icon">
                  ✉
                </span>

                <input
                  v-model="email"
                  type="email"
                  placeholder="nama@email.com"
                  required
                  autocomplete="email"
                />

              </div>

            </div>


            <!-- PASSWORD -->
            <div class="form-group">

              <label>Password</label>

              <div class="input-wrapper">

                <span class="input-icon">
                  🔒
                </span>

                <input
                  v-model="password"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="Minimal 8 karakter"
                  required
                  minlength="8"
                  autocomplete="new-password"
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


            <!-- KONFIRMASI PASSWORD -->
            <div class="form-group">

              <label>Konfirmasi Password</label>

              <div class="input-wrapper">

                <span class="input-icon">
                  🔐
                </span>

                <input
                  v-model="passwordConfirmation"
                  :type="showConfirmation ? 'text' : 'password'"
                  placeholder="Ulangi password"
                  required
                  minlength="8"
                  autocomplete="new-password"
                />

                <button
                  type="button"
                  class="password-toggle"
                  @click="showConfirmation = !showConfirmation"
                >
                  {{ showConfirmation ? '🙈' : '👁' }}
                </button>

              </div>

            </div>


            <!-- PASSWORD MATCH -->
            <div
              v-if="passwordConfirmation"
              class="password-status"
              :class="passwordsMatch ? 'match' : 'not-match'"
            >

              <span>
                {{ passwordsMatch ? '✓' : '!' }}
              </span>

              <span>
                {{
                  passwordsMatch
                    ? 'Password cocok'
                    : 'Password belum cocok'
                }}
              </span>

            </div>


            <!-- REGISTER BUTTON -->
            <button
              class="register-button"
              type="submit"
              :disabled="loading"
            >

              <span>
                {{
                  loading
                    ? 'Membuat akun...'
                    : 'Buat Akun'
                }}
              </span>

              <span class="arrow">
                {{ loading ? '•••' : '→' }}
              </span>

            </button>


            <!-- LOGIN -->
            <div class="login-text">

              Sudah punya akun?

              <a
                href="#"
                @click.prevent="goToLogin"
              >
                Masuk sekarang
              </a>

            </div>

          </form>


          <!-- SECURITY -->
          <div class="security-info">

            <span>🔐</span>

            <div>

              <strong>
                Data kamu aman
              </strong>

              <p>
                Informasi akun terlindungi dengan sistem keamanan.
              </p>

            </div>

          </div>

        </div>

      </section>


      <!-- ================= RIGHT : VISUAL ================= -->
      <section class="visual-side">

        <!-- BRAND -->
        <div class="brand">

          <div class="brand-icon">
            <span>📚</span>
          </div>

          <div>

            <h2>
              Perpus<span>Ku</span>
            </h2>

            <p>
              DIGITAL LIBRARY
            </p>

          </div>

        </div>


        <!-- CONTENT -->
        <div class="visual-content">

          <div class="badge">

            <span class="badge-dot"></span>

            Bergabung bersama kami

          </div>


          <h1>

            Satu akun,
            <span>ribuan cerita.</span>

          </h1>


          <p class="description">

            Buat akun PerpusKu dan nikmati pengalaman
            membaca yang lebih mudah, cepat, dan menyenangkan.

          </p>


          <!-- FEATURES -->
          <div class="features">

            <div class="feature-card">

              <div class="feature-icon">
                📖
              </div>

              <div>

                <strong>
                  Koleksi Buku
                </strong>

                <p>
                  Jelajahi berbagai macam buku.
                </p>

              </div>

            </div>


            <div class="feature-card">

              <div class="feature-icon purple">
                ❤️
              </div>

              <div>

                <strong>
                  Simpan Favorit
                </strong>

                <p>
                  Tandai buku yang ingin kamu baca.
                </p>

              </div>

            </div>


            <div class="feature-card">

              <div class="feature-icon green">
                🚀
              </div>

              <div>

                <strong>
                  Pengalaman Mudah
                </strong>

                <p>
                  Akses perpustakaan dengan praktis.
                </p>

              </div>

            </div>

          </div>


          <!-- QUOTE -->
          <div class="quote">

            <div class="quote-line"></div>

            <p>
              "Membaca adalah cara sederhana
              untuk menjelajahi dunia."
            </p>

          </div>

        </div>


        <!-- FOOTER -->
        <div class="visual-footer">

          <span>✦</span>

          Baca. Belajar. Berkembang.

        </div>

      </section>

    </div>

  </div>
</template>


<script setup>

import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import api from '../utils/api'

const router = useRouter()


// =========================
// FORM
// =========================

const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')


// =========================
// STATE
// =========================

const loading = ref(false)

const errorMessage = ref('')
const successMessage = ref('')

const showPassword = ref(false)
const showConfirmation = ref(false)


// =========================
// PASSWORD MATCH
// =========================

const passwordsMatch = computed(() => {

  return (
    password.value !== '' &&
    passwordConfirmation.value !== '' &&
    password.value === passwordConfirmation.value
  )

})


// =========================
// REGISTER
// =========================

async function register() {

  errorMessage.value = ''
  successMessage.value = ''


  if (loading.value) {
    return
  }


  // =========================
  // CEK PASSWORD
  // =========================

  if (password.value.length < 8) {

    errorMessage.value =
      'Password minimal 8 karakter.'

    return

  }


  if (password.value !== passwordConfirmation.value) {

    errorMessage.value =
      'Konfirmasi password tidak cocok.'

    return

  }


  loading.value = true


  try {

    console.log('Mengirim register...')
    console.log('Nama:', name.value)
    console.log('Email:', email.value)


    // =========================
    // REQUEST LARAVEL
    // =========================

    const response = await api.post('/register', {

      name: name.value,

      email: email.value,

      password: password.value,

      password_confirmation:
        passwordConfirmation.value

    })


    console.log('REGISTER RESPONSE:')
    console.log(response.data)


    const data = response.data


    // =========================
    // SIMPAN TOKEN
    // =========================

    if (data.token) {

      localStorage.setItem(
        'token',
        data.token
      )

    }


    // =========================
    // SIMPAN USER
    // =========================

    if (data.user) {

      localStorage.setItem(
        'user',
        JSON.stringify(data.user)
      )

    }


    successMessage.value =
      'Akun berhasil dibuat! Mengarahkan ke halaman utama...'


    // =========================
    // REDIRECT
    // =========================

    setTimeout(() => {

      router.push('/')

    }, 1200)


  } catch (error) {

    console.error(
      'REGISTER ERROR:',
      error
    )


    // =========================
    // ERROR LARAVEL
    // =========================

    if (error.response) {

      console.log(
        'Status:',
        error.response.status
      )

      console.log(
        'Data:',
        error.response.data
      )


      if (
        error.response.status === 422
      ) {

        const errors =
          error.response.data?.errors


        if (errors?.name) {

          errorMessage.value =
            errors.name[0]

        }

        else if (errors?.email) {

          errorMessage.value =
            errors.email[0]

        }

        else if (errors?.password) {

          errorMessage.value =
            errors.password[0]

        }

        else {

          errorMessage.value =
            'Data yang dimasukkan tidak valid.'

        }

      }

      else if (
        error.response.data?.message
      ) {

        errorMessage.value =
          error.response.data.message

      }

      else {

        errorMessage.value =
          'Terjadi kesalahan pada server.'

      }

    }

    else if (error.request) {

      errorMessage.value =
        'Tidak dapat terhubung ke server Laravel. Pastikan php artisan serve sedang berjalan.'

    }

    else {

      errorMessage.value =
        'Terjadi kesalahan. Silakan coba lagi.'

    }

  } finally {

    loading.value = false

  }

}


// =========================
// LOGIN
// =========================

function goToLogin() {

  router.push('/login')

}

</script>


<style scoped>

/* =========================
   RESET
========================= */

* {
  box-sizing: border-box;
}


/* =========================
   PAGE
========================= */

.register-page {

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

  pointer-events: none;

  filter: blur(2px);
}


.orb-1 {

  width: 340px;
  height: 340px;

  top: -160px;
  left: -100px;

  background:
    radial-gradient(
      circle,
      rgba(65,126,239,.35),
      transparent 70%
    );
}


.orb-2 {

  width: 420px;
  height: 420px;

  right: -130px;
  bottom: -210px;

  background:
    radial-gradient(
      circle,
      rgba(139,75,226,.28),
      transparent 70%
    );
}


/* =========================
   WRAPPER
========================= */

.register-wrapper {

  width: min(1180px, 100%);

  min-height: 700px;

  display: grid;

  grid-template-columns:
    .92fr 1.08fr;

  position: relative;

  z-index: 2;

  overflow: hidden;

  border-radius: 30px;

  border:
    1px solid rgba(255,255,255,.12);

  background:
    rgba(255,255,255,.055);

  backdrop-filter: blur(25px);

  box-shadow:
    0 40px 100px rgba(0,0,0,.45),
    0 0 80px rgba(45,100,200,.08);
}


/* =========================
   FORM SIDE
========================= */

.form-side {

  position: relative;

  display: flex;

  align-items: center;

  justify-content: center;

  padding: 48px 55px;

  background:
    rgba(8,16,30,.80);
}


.form-side::after {

  content: "";

  position: absolute;

  right: 0;

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
   CARD
========================= */

.register-card {

  width: 100%;

  max-width: 420px;
}


/* =========================
   HEADER
========================= */

.form-header {

  display: flex;

  gap: 15px;

  margin-bottom: 27px;
}


.welcome-icon {

  width: 48px;
  height: 48px;

  flex-shrink: 0;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 14px;

  background:
    rgba(63,117,208,.12);

  border:
    1px solid rgba(93,145,232,.16);

  font-size: 20px;
}


.small-title {

  margin: 0 0 5px;

  color: #6f9fe8;

  font-size: 9px;

  font-weight: 800;

  letter-spacing: 2px;
}


.form-header h2 {

  margin: 0;

  color: #f3f6fb;

  font-size: 27px;

  letter-spacing: -.8px;
}


.form-header > div:last-child > p:last-child {

  margin: 6px 0 0;

  color: #71829d;

  font-size: 11px;
}


/* =========================
   ERROR
========================= */

.register-error {

  display: flex;

  align-items: center;

  gap: 9px;

  margin-bottom: 17px;

  padding: 11px 13px;

  border-radius: 11px;

  border:
    1px solid rgba(255,100,100,.20);

  background:
    rgba(255,70,70,.08);

  color: #ff9b9b;

  font-size: 11px;
}


/* =========================
   SUCCESS
========================= */

.register-success {

  display: flex;

  align-items: center;

  gap: 9px;

  margin-bottom: 17px;

  padding: 11px 13px;

  border-radius: 11px;

  border:
    1px solid rgba(80,220,160,.20);

  background:
    rgba(50,200,140,.08);

  color: #72e3b2;

  font-size: 11px;
}


/* =========================
   FORM GROUP
========================= */

.form-group {

  margin-bottom: 15px;
}


.form-group label {

  display: block;

  margin-bottom: 7px;

  color: #b7c5d9;

  font-size: 11px;

  font-weight: 600;
}


/* =========================
   INPUT
========================= */

.input-wrapper {

  height: 48px;

  position: relative;

  display: flex;

  align-items: center;

  border-radius: 12px;

  border:
    1px solid rgba(135,158,190,.16);

  background:
    rgba(255,255,255,.045);

  transition: .25s;
}


.input-wrapper:focus-within {

  border-color:
    rgba(91,143,232,.7);

  background:
    rgba(60,105,180,.07);

  box-shadow:
    0 0 0 4px rgba(69,122,211,.09),
    0 10px 30px rgba(0,0,0,.1);
}


.input-icon {

  width: 47px;

  display: flex;

  align-items: center;

  justify-content: center;

  color: #6481aa;

  font-size: 14px;
}


.input-wrapper input {

  width: 100%;

  height: 100%;

  border: none;

  outline: none;

  background: transparent;

  color: #edf4ff;

  font-size: 12px;
}


.input-wrapper input::placeholder {
  color: #53647e;
}


/* =========================
   PASSWORD TOGGLE
========================= */

.password-toggle {

  border: none;

  background: transparent;

  padding: 10px;

  cursor: pointer;

  opacity: .6;

  font-size: 13px;
}


.password-toggle:hover {
  opacity: 1;
}


/* =========================
   PASSWORD STATUS
========================= */

.password-status {

  display: flex;

  align-items: center;

  gap: 7px;

  margin-top: -6px;

  margin-bottom: 13px;

  font-size: 10px;
}


.password-status.match {
  color: #68dca9;
}


.password-status.not-match {
  color: #ef9292;
}


.password-status span:first-child {

  width: 15px;
  height: 15px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 50%;

  font-size: 9px;

  background: rgba(255,255,255,.06);
}


/* =========================
   REGISTER BUTTON
========================= */

.register-button {

  width: 100%;

  height: 52px;

  display: flex;

  align-items: center;

  justify-content: space-between;

  padding:
    0 17px
    0 20px;

  border: none;

  border-radius: 13px;

  cursor: pointer;

  color: white;

  font-size: 12px;

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


.register-button:hover:not(:disabled) {

  transform:
    translateY(-2px);

  box-shadow:
    0 16px 35px rgba(45,92,166,.4);
}


.register-button:active {
  transform: translateY(0);
}


.register-button:disabled {

  opacity: .65;

  cursor: not-allowed;

  transform: none;
}


.arrow {

  min-width: 30px;
  height: 30px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 9px;

  background:
    rgba(255,255,255,.13);

  font-size: 14px;
}


/* =========================
   LOGIN TEXT
========================= */

.login-text {

  text-align: center;

  margin-top: 20px;

  color: #64748b;

  font-size: 10px;
}


.login-text a {

  margin-left: 4px;

  color: #6ea0f2;

  text-decoration: none;

  font-weight: 700;
}


.login-text a:hover {
  text-decoration: underline;
}


/* =========================
   SECURITY
========================= */

.security-info {

  display: flex;

  align-items: center;

  gap: 10px;

  margin-top: 20px;

  padding: 11px;

  border-radius: 12px;

  border:
    1px solid rgba(100,150,220,.08);

  background:
    rgba(80,120,190,.045);
}


.security-info > span {
  font-size: 14px;
}


.security-info strong {

  display: block;

  color: #8298b7;

  font-size: 9px;
}


.security-info p {

  margin: 2px 0 0;

  color: #53647d;

  font-size: 8px;
}


/* =========================
   VISUAL SIDE
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


.visual-side::before {

  content: "";

  position: absolute;

  width: 500px;
  height: 500px;

  right: -230px;
  top: -230px;

  border-radius: 50%;

  border:
    1px solid rgba(255,255,255,.08);

  box-shadow:
    0 0 0 70px rgba(255,255,255,.025),
    0 0 0 140px rgba(255,255,255,.018);
}


.visual-side::after {

  content: "";

  position: absolute;

  width: 300px;
  height: 300px;

  left: -180px;
  bottom: -180px;

  border-radius: 50%;

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

  margin-top: 100px;
}


.badge {

  display: inline-flex;

  align-items: center;

  gap: 9px;

  padding: 9px 14px;

  border-radius: 100px;

  font-size: 11px;

  color: #b8d2ff;

  border:
    1px solid rgba(130,170,235,.25);

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

  margin: 23px 0 15px;

  font-size:
    clamp(42px, 4vw, 60px);

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

  max-width: 470px;

  margin: 0;

  line-height: 1.7;

  color: #9fb4d4;

  font-size: 14px;
}


/* =========================
   FEATURES
========================= */

.features {

  display: flex;

  flex-direction: column;

  gap: 11px;

  margin-top: 38px;

  max-width: 420px;
}


.feature-card {

  display: flex;

  align-items: center;

  gap: 13px;

  padding: 13px;

  border-radius: 14px;

  border:
    1px solid rgba(255,255,255,.09);

  background:
    rgba(255,255,255,.055);

  backdrop-filter: blur(12px);

  transition: .25s;
}


.feature-card:hover {

  transform:
    translateX(5px);

  background:
    rgba(255,255,255,.08);
}


.feature-icon {

  width: 42px;
  height: 42px;

  flex-shrink: 0;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 11px;

  font-size: 18px;

  background:
    linear-gradient(
      145deg,
      #4078d4,
      #1d4177
    );
}


.feature-icon.purple {

  background:
    linear-gradient(
      145deg,
      #8056d9,
      #45237f
    );
}


.feature-icon.green {

  background:
    linear-gradient(
      145deg,
      #27a88c,
      #126653
    );
}


.feature-card strong {

  display: block;

  color: #dce8fa;

  font-size: 11px;
}


.feature-card p {

  margin: 4px 0 0;

  color: #7085a5;

  font-size: 9px;
}


/* =========================
   QUOTE
========================= */

.quote {

  display: flex;

  gap: 14px;

  margin-top: 28px;

  max-width: 430px;
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

  font-size: 11px;

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

  font-size: 10px;

  letter-spacing: 1px;
}


.visual-footer span {

  color: #78aaff;

  margin-right: 7px;
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

  .register-page {
    padding: 18px;
  }


  .register-wrapper {

    grid-template-columns: 1fr;

    max-width: 520px;

    min-height: auto;
  }


  .visual-side {
    display: none;
  }


  .form-side {

    padding: 45px 35px;
  }


  .form-side::after {
    display: none;
  }


  .mobile-logo {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;

    margin-bottom: 30px;
  }


  .mobile-logo .brand-icon {

    width: 42px;
    height: 42px;

    font-size: 19px;
  }


  .mobile-logo h2 {

    color: white;

    font-size: 20px;

    margin: 0;
  }


  .mobile-logo h2 span {
    color: #79aaff;
  }

}


@media (max-width: 480px) {

  .register-page {
    padding: 0;
  }


  .register-wrapper {

    min-height: 100vh;

    border-radius: 0;

    border: none;
  }


  .form-side {

    padding: 30px 22px;
  }


  .form-header h2 {

    font-size: 23px;
  }

}

</style>