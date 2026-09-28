<template>
  <div class="library-page">

    <!-- ================= NAVBAR ================= -->
    <header class="navbar">
      <div class="nav-inner">

        <router-link to="/" class="brand">
          <div class="brand-logo">📚</div>

          <div class="brand-text">
            <strong>PerpusKu</strong>
            <span>DIGITAL LIBRARY</span>
          </div>
        </router-link>

        <nav class="nav-menu">
          <router-link to="/">
            Beranda
          </router-link>

          <router-link to="/koleksi">
            Koleksi
          </router-link>

          <router-link to="/kategori">
            Kategori
          </router-link>

          <router-link to="/tentang" class="active">
            Tentang
          </router-link>
        </nav>

        <div class="nav-actions">

          <button
            class="search-mini"
            @click="goToCollection"
          >
            ⌕
          </button>

          <!-- BELUM LOGIN -->
          <router-link
            v-if="!isLoggedIn"
            to="/login"
            class="login-nav-btn"
          >
            Masuk
            <span>→</span>
          </router-link>

          <!-- SUDAH LOGIN -->
          <div
            v-else
            class="profile-wrapper"
          >

            <button
              class="profile-button"
              @click.stop="toggleProfile"
            >
              <div class="profile-avatar">
                {{ userInitial }}
              </div>

              <div class="profile-name">
                <strong>{{ user?.name }}</strong>

                <span>
                  {{
                    user?.role === 'admin'
                      ? 'Administrator'
                      : 'Anggota'
                  }}
                </span>
              </div>

              <span
                class="profile-chevron"
                :class="{ open: profileOpen }"
              >
                ⌄
              </span>
            </button>

            <!-- DROPDOWN -->
            <div
              v-if="profileOpen"
              class="profile-dropdown"
            >

              <div class="dropdown-header">

                <div class="dropdown-avatar">
                  {{ userInitial }}
                </div>

                <div class="dropdown-user-info">
                  <strong>
                    {{ user?.name }}
                  </strong>

                  <span>
                    {{ user?.email }}
                  </span>

                  <small
                    :class="{
                      'admin-role':
                        user?.role === 'admin'
                    }"
                  >
                    {{
                      user?.role === 'admin'
                        ? 'ADMIN'
                        : 'ANGGOTA'
                    }}
                  </small>
                </div>

              </div>

              <div class="dropdown-divider"></div>

              <router-link
                to="/profile"
                class="dropdown-item"
                @click="profileOpen = false"
              >
                <span class="dropdown-icon">👤</span>
                <span>Profil Saya</span>
              </router-link>

              <router-link
                to="/"
                class="dropdown-item"
                @click="profileOpen = false"
              >
                <span class="dropdown-icon">🏠</span>
                <span>Beranda</span>
              </router-link>

              <router-link
                v-if="user?.role === 'admin'"
                to="/admin/dashboard"
                class="dropdown-item admin-item"
                @click="profileOpen = false"
              >
                <span class="dropdown-icon">⚡</span>
                <span>Dashboard Admin</span>
              </router-link>

              <div class="dropdown-divider"></div>

              <button
                class="dropdown-item logout-item"
                @click="logout"
              >
                <span class="dropdown-icon">🚪</span>
                <span>Logout</span>
              </button>

            </div>
          </div>

        </div>
      </div>
    </header>


    <!-- ================= MAIN ================= -->
    <main class="dashboard-container">

      <!-- PAGE HEADER -->
      <section class="page-header">

        <div>
          <div class="breadcrumb">
            Dashboard
            <span>›</span>
            Tentang
          </div>

          <h1>Tentang PerpusKu</h1>

          <p>
            Mengenal lebih dekat PerpusKu dan layanan
            perpustakaan digital yang kami hadirkan.
          </p>
        </div>

        <div class="header-icon">
          📚
        </div>

      </section>


      <!-- ================= INTRO CARD ================= -->
      <section class="intro-card">

        <div class="intro-icon">
          📖
        </div>

        <div class="intro-content">

          <span class="section-label">
            PERPUSTAKAAN DIGITAL
          </span>

          <h2>
            Selamat datang di
            <span>PerpusKu</span>
          </h2>

          <p>
            PerpusKu merupakan platform perpustakaan digital
            yang dirancang untuk membantu pengguna menemukan,
            menjelajahi, dan mendapatkan informasi mengenai
            koleksi buku dengan lebih mudah.
          </p>

          <p>
            Dengan tampilan yang sederhana dan modern,
            PerpusKu memberikan pengalaman membaca dan
            menjelajahi koleksi perpustakaan secara lebih
            praktis.
          </p>

        </div>

      </section>


      <!-- ================= INFO CARDS ================= -->
      <section class="section">

        <div class="section-title">
          <div>
            <span>INFORMASI</span>
            <h2>Tentang Perpustakaan</h2>
          </div>
        </div>


        <div class="info-grid">

          <!-- VISI -->
          <div class="info-card">

            <div class="info-icon blue">
              👁️
            </div>

            <div class="info-number">
              01
            </div>

            <h3>Visi</h3>

            <p>
              Menjadi perpustakaan digital yang mudah
              digunakan dan membantu pengguna mendapatkan
              akses terhadap berbagai sumber pengetahuan.
            </p>

          </div>


          <!-- MISI -->
          <div class="info-card">

            <div class="info-icon purple">
              🎯
            </div>

            <div class="info-number">
              02
            </div>

            <h3>Misi</h3>

            <p>
              Menyediakan layanan perpustakaan yang
              terorganisir, informatif, dan nyaman digunakan
              oleh seluruh anggota perpustakaan.
            </p>

          </div>


          <!-- TUJUAN -->
          <div class="info-card">

            <div class="info-icon cyan">
              🚀
            </div>

            <div class="info-number">
              03
            </div>

            <h3>Tujuan</h3>

            <p>
              Membantu pengguna menemukan buku yang sesuai
              dengan kebutuhan serta meningkatkan kemudahan
              dalam mengakses informasi perpustakaan.
            </p>

          </div>

        </div>

      </section>


      <!-- ================= SERVICES ================= -->
      <section class="section service-section">

        <div class="section-title">

          <div>
            <span>LAYANAN</span>

            <h2>
              Apa yang tersedia di
              <strong>PerpusKu?</strong>
            </h2>

            <p>
              Beberapa layanan utama yang dapat digunakan
              melalui perpustakaan digital.
            </p>
          </div>

        </div>


        <div class="service-grid">

          <div class="service-card">

            <div class="service-icon">
              📚
            </div>

            <div>
              <h3>Koleksi Buku</h3>

              <p>
                Menampilkan berbagai koleksi buku yang
                tersedia di perpustakaan.
              </p>
            </div>

            <span class="service-arrow">
              →
            </span>

          </div>


          <div class="service-card">

            <div class="service-icon">
              🔎
            </div>

            <div>
              <h3>Pencarian Buku</h3>

              <p>
                Memudahkan pengguna mencari buku berdasarkan
                judul, penulis, atau kategori.
              </p>
            </div>

            <span class="service-arrow">
              →
            </span>

          </div>


          <div class="service-card">

            <div class="service-icon">
              🗂️
            </div>

            <div>
              <h3>Kategori Buku</h3>

              <p>
                Koleksi buku dikelompokkan berdasarkan
                kategori agar lebih mudah ditemukan.
              </p>
            </div>

            <span class="service-arrow">
              →
            </span>

          </div>


          <div class="service-card">

            <div class="service-icon">
              📋
            </div>

            <div>
              <h3>Peminjaman</h3>

              <p>
                Pengguna dapat melakukan proses peminjaman
                buku melalui sistem perpustakaan.
              </p>
            </div>

            <span class="service-arrow">
              →
            </span>

          </div>

        </div>

      </section>


      <!-- ================= HOW IT WORKS ================= -->
      <section class="section">

        <div class="section-title">

          <div>
            <span>CARA MENGGUNAKAN</span>

            <h2>
              Mulai dari sini
            </h2>

            <p>
              Nikmati pengalaman menggunakan PerpusKu
              hanya dengan beberapa langkah.
            </p>
          </div>

        </div>


        <div class="steps">

          <div class="step">

            <div class="step-number">
              01
            </div>

            <div class="step-line"></div>

            <div class="step-content">
              <h3>Jelajahi Koleksi</h3>

              <p>
                Buka halaman koleksi dan lihat buku yang
                tersedia di perpustakaan.
              </p>
            </div>

          </div>


          <div class="step">

            <div class="step-number">
              02
            </div>

            <div class="step-line"></div>

            <div class="step-content">
              <h3>Pilih Buku</h3>

              <p>
                Pilih buku yang menarik dan lihat informasi
                lengkap mengenai buku tersebut.
              </p>
            </div>

          </div>


          <div class="step">

            <div class="step-number">
              03
            </div>

            <div class="step-line"></div>

            <div class="step-content">
              <h3>Lakukan Peminjaman</h3>

              <p>
                Jika buku tersedia, pengguna dapat melanjutkan
                proses peminjaman melalui sistem.
              </p>
            </div>

          </div>

        </div>

      </section>


      <!-- ================= TECHNOLOGY CARD ================= -->
      <section class="technology-card">

        <div class="technology-left">

          <div class="technology-icon">
            ⚡
          </div>

          <div>

            <span>
              DIGITAL LIBRARY SYSTEM
            </span>

            <h2>
              Dibangun dengan teknologi modern
            </h2>

            <p>
              PerpusKu menggunakan teknologi web modern
              untuk memberikan pengalaman perpustakaan
              yang cepat, nyaman, dan responsif.
            </p>

          </div>

        </div>


        <div class="tech-stack">

          <div class="tech-item">
            <strong>Vue</strong>
            <span>Frontend</span>
          </div>

          <div class="tech-item">
            <strong>Laravel</strong>
            <span>Backend</span>
          </div>

          <div class="tech-item">
            <strong>API</strong>
            <span>Integration</span>
          </div>

        </div>

      </section>


      <!-- ================= CTA ================= -->
      <section class="bottom-cta">

        <div>

          <span>
            MULAI MENJELAJAH
          </span>

          <h2>
            Temukan buku yang
            <strong>sesuai untukmu.</strong>
          </h2>

          <p>
            Jelajahi koleksi buku PerpusKu sekarang.
          </p>

        </div>

        <router-link
          to="/"
          class="cta-button"
        >
          Kembali ke Beranda
          <span>→</span>
        </router-link>

      </section>

    </main>


    <!-- ================= FOOTER ================= -->
    <footer>

      <div class="footer-inner">

        <div class="footer-brand">

          <div class="brand-logo">
            📚
          </div>

          <div>
            <strong>PerpusKu</strong>

            <p>
              Digital Library
            </p>
          </div>

        </div>

        <p class="copyright">
          © 2026 PerpusKu.
          Perpustakaan digital untuk semua.
        </p>

        <div class="footer-links">

          <router-link to="/">
            Beranda
          </router-link>

          <router-link to="/tentang">
            Tentang
          </router-link>

        </div>

      </div>

    </footer>

  </div>
</template>


<script setup>

import {
  ref,
  computed,
  onMounted,
  onBeforeUnmount
} from 'vue'

import { useRouter } from 'vue-router'

import api from '../utils/api'

const router = useRouter()


/* ================= USER ================= */

const user = ref(null)

const profileOpen = ref(false)


const isLoggedIn = computed(() => {
  return !!localStorage.getItem('token')
})


const userInitial = computed(() => {

  if (!user.value?.name) {
    return '?'
  }

  return user.value.name
    .charAt(0)
    .toUpperCase()

})


/* ================= LOAD USER ================= */

function loadUser() {

  const storedUser =
    localStorage.getItem('user')

  if (!storedUser) {

    user.value = null

    return

  }

  try {

    user.value =
      JSON.parse(storedUser)

  } catch (error) {

    console.error(
      'Data user tidak valid:',
      error
    )

    localStorage.removeItem('user')

    user.value = null

  }

}


/* ================= PROFILE ================= */

function toggleProfile() {

  profileOpen.value =
    !profileOpen.value

}


/* ================= LOGOUT ================= */

async function logout() {

  try {

    await api.post('/logout')

  } catch (error) {

    console.log(
      'Logout API:',
      error
    )

  } finally {

    localStorage.removeItem('token')

    localStorage.removeItem('user')

    user.value = null

    profileOpen.value = false

    router.push('/login')

  }

}


/* ================= SEARCH ================= */

function goToCollection() {

  router.push('/koleksi')

}


/* ================= CLICK OUTSIDE ================= */

function closeProfile(event) {

  if (
    !event.target.closest(
      '.profile-wrapper'
    )
  ) {

    profileOpen.value = false

  }

}


/* ================= MOUNT ================= */

onMounted(() => {

  loadUser()

  document.addEventListener(
    'click',
    closeProfile
  )

})


/* ================= UNMOUNT ================= */

onBeforeUnmount(() => {

  document.removeEventListener(
    'click',
    closeProfile
  )

})

</script>


<style scoped>

/* =========================
   BASE
========================= */

* {
  box-sizing: border-box;
}

.library-page {
  min-height: 100vh;

  background: #f4f7fc;

  color: #172033;

  font-family:
    Inter,
    ui-sans-serif,
    system-ui,
    -apple-system,
    BlinkMacSystemFont,
    "Segoe UI",
    sans-serif;

  overflow-x: hidden;
}

a {
  text-decoration: none;
  color: inherit;
}


/* =========================
   NAVBAR
========================= */

.navbar {
  position: sticky;
  top: 0;
  z-index: 100;

  background: rgba(255,255,255,.86);

  backdrop-filter: blur(22px);
  -webkit-backdrop-filter: blur(22px);

  border-bottom:
    1px solid rgba(26,52,91,.08);

  box-shadow:
    0 10px 35px rgba(20,40,75,.06);
}

.nav-inner {
  width: min(
    1400px,
    calc(100% - 80px)
  );

  height: 82px;

  margin: auto;

  display: flex;

  align-items: center;

  justify-content: space-between;
}

.brand {
  display: flex;

  align-items: center;

  gap: 13px;
}

.brand-logo {
  width: 46px;
  height: 46px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 14px;

  background:
    linear-gradient(
      145deg,
      #3c72bd,
      #19345f
    );

  color: white;

  font-size: 22px;

  box-shadow:
    0 10px 25px
    rgba(42,89,155,.28);
}

.brand-text {
  display: flex;
  flex-direction: column;
}

.brand-text strong {
  font-size: 18px;
  color: #16233a;
}

.brand-text span {
  margin-top: 3px;

  font-size: 9px;

  letter-spacing: 2px;

  color: #8794aa;
}


/* MENU */

.nav-menu {
  display: flex;

  align-items: center;

  gap: 38px;
}

.nav-menu a {
  position: relative;

  font-size: 14px;

  font-weight: 600;

  color: #7b879b;

  transition: .25s ease;
}

.nav-menu a:hover,
.nav-menu a.active {
  color: #285a9f;
}

.nav-menu a.active::after {
  content: "";

  position: absolute;

  left: 50%;
  bottom: -31px;

  width: 22px;
  height: 3px;

  transform:
    translateX(-50%);

  border-radius: 20px;

  background: #356db5;
}


/* ACTION */

.nav-actions {
  display: flex;

  align-items: center;

  gap: 12px;
}

.search-mini {
  width: 45px;
  height: 45px;

  border:
    1px solid #e1e7f0;

  border-radius: 13px;

  background:
    rgba(255,255,255,.75);

  font-size: 24px;

  color: #315f9f;

  cursor: pointer;

  transition: .25s;
}

.search-mini:hover {
  transform: translateY(-2px);

  box-shadow:
    0 8px 20px
    rgba(36,72,120,.12);
}

.login-nav-btn {
  height: 47px;

  padding: 0 20px;

  display: flex;

  align-items: center;

  gap: 10px;

  border-radius: 13px;

  background:
    linear-gradient(
      135deg,
      #315f9e,
      #172d50
    );

  color: white;

  font-size: 13px;

  font-weight: 700;

  box-shadow:
    0 10px 25px
    rgba(27,57,100,.18);
}


/* =========================
   PROFILE
========================= */

.profile-wrapper {
  position: relative;
}

.profile-button {
  min-width: 190px;
  height: 55px;

  display: flex;

  align-items: center;

  gap: 10px;

  padding: 5px 10px 5px 6px;

  border:
    1px solid
    rgba(47,83,130,.12);

  border-radius: 15px;

  background:
    rgba(255,255,255,.78);

  backdrop-filter: blur(18px);

  box-shadow:
    0 8px 25px
    rgba(28,55,90,.08);

  cursor: pointer;
}

.profile-avatar,
.dropdown-avatar {
  width: 42px;
  height: 42px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 12px;

  background:
    linear-gradient(
      145deg,
      #477fc7,
      #234d86
    );

  color: white;

  font-size: 15px;

  font-weight: 800;
}

.profile-name {
  flex: 1;

  display: flex;

  flex-direction: column;

  align-items: flex-start;
}

.profile-name strong {
  max-width: 105px;

  overflow: hidden;

  text-overflow: ellipsis;

  white-space: nowrap;

  color: #1a2b44;

  font-size: 12px;
}

.profile-name span {
  margin-top: 2px;

  color: #8795aa;

  font-size: 9px;
}

.profile-chevron {
  color: #7890ad;

  transition: .25s;
}

.profile-chevron.open {
  transform:
    rotate(180deg);
}


/* DROPDOWN */

.profile-dropdown {
  position: absolute;

  top: calc(100% + 12px);

  right: 0;

  width: 280px;

  padding: 10px;

  border:
    1px solid
    rgba(45,82,128,.12);

  border-radius: 18px;

  background:
    rgba(255,255,255,.96);

  backdrop-filter: blur(25px);

  box-shadow:
    0 25px 60px
    rgba(21,48,80,.18),
    0 5px 15px
    rgba(21,48,80,.08);

  z-index: 999;
}

.dropdown-header {
  display: flex;

  gap: 12px;

  padding: 12px;

  border-radius: 13px;

  background: #f2f6fb;
}

.dropdown-user-info {
  min-width: 0;

  display: flex;

  flex-direction: column;
}

.dropdown-header strong {
  font-size: 12px;
}

.dropdown-header span {
  margin-top: 3px;

  color: #8997aa;

  font-size: 9px;
}

.dropdown-header small {
  width: fit-content;

  margin-top: 5px;

  padding: 3px 7px;

  border-radius: 5px;

  background: #edf3fa;

  color: #53708f;

  font-size: 7px;

  font-weight: 800;
}

.admin-role {
  background: #e5efff !important;
  color: #3169ad !important;
}

.dropdown-divider {
  height: 1px;

  margin: 8px 5px;

  background: #e8edf4;
}

.dropdown-item {
  width: 100%;

  min-height: 44px;

  display: flex;

  align-items: center;

  gap: 11px;

  padding: 0 12px;

  border: 0;

  border-radius: 11px;

  background: transparent;

  color: #52647d;

  font-family: inherit;

  font-size: 12px;

  font-weight: 600;

  cursor: pointer;
}

.dropdown-item:hover {
  background: #f0f5fb;
}

.dropdown-icon {
  width: 30px;
  height: 30px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 9px;

  background: #edf3fa;
}

.admin-item {
  color: #315f99;
}

.logout-item {
  color: #d65b5b;
}


/* =========================
   DASHBOARD CONTAINER
========================= */

.dashboard-container {
  width: min(
    1400px,
    calc(100% - 80px)
  );

  margin: auto;

  padding: 45px 0 80px;
}


/* =========================
   PAGE HEADER
========================= */

.page-header {
  min-height: 175px;

  display: flex;

  align-items: center;

  justify-content: space-between;

  padding: 35px 40px;

  margin-bottom: 25px;

  border-radius: 24px;

  background:
    linear-gradient(
      135deg,
      #ffffff,
      #edf4fc
    );

  border:
    1px solid
    rgba(42,79,125,.08);

  box-shadow:
    0 15px 45px
    rgba(28,57,96,.07);
}

.breadcrumb {
  display: flex;

  align-items: center;

  gap: 9px;

  margin-bottom: 12px;

  color: #8a98ab;

  font-size: 11px;

  font-weight: 600;
}

.breadcrumb span {
  color: #b1bccb;
}

.page-header h1 {
  margin: 0;

  color: #17253b;

  font-size: 35px;

  letter-spacing: -1px;
}

.page-header p {
  margin: 9px 0 0;

  color: #8795a9;

  font-size: 13px;
}

.header-icon {
  width: 100px;
  height: 100px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 28px;

  background:
    linear-gradient(
      145deg,
      #e4efff,
      #cfe2fc
    );

  font-size: 45px;

  box-shadow:
    0 15px 30px
    rgba(44,91,150,.1);
}


/* =========================
   INTRO
========================= */

.intro-card {
  display: grid;

  grid-template-columns:
    100px 1fr;

  gap: 30px;

  padding: 35px 40px;

  margin-bottom: 70px;

  border-radius: 24px;

  background:
    linear-gradient(
      135deg,
      #172e51,
      #315e9a
    );

  box-shadow:
    0 25px 60px
    rgba(27,60,104,.18);

  overflow: hidden;

  position: relative;
}

.intro-card::after {
  content: "";

  position: absolute;

  width: 300px;
  height: 300px;

  right: -100px;
  top: -150px;

  border-radius: 50%;

  background:
    rgba(126,180,255,.13);
}

.intro-icon {
  position: relative;
  z-index: 2;

  width: 90px;
  height: 90px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 25px;

  background:
    rgba(255,255,255,.1);

  border:
    1px solid
    rgba(255,255,255,.14);

  font-size: 42px;
}

.intro-content {
  position: relative;
  z-index: 2;
}

.intro-content .section-label {
  color: #91bdff;
}

.intro-content h2 {
  margin: 8px 0 15px;

  color: white;

  font-size: 31px;
}

.intro-content h2 span {
  color: #9bc5ff;
}

.intro-content p {
  max-width: 850px;

  margin: 8px 0;

  color: #c1d1e6;

  font-size: 13px;

  line-height: 1.8;
}


/* =========================
   SECTION
========================= */

.section {
  margin-bottom: 75px;
}

.section-title {
  display: flex;

  align-items: flex-end;

  justify-content: space-between;

  margin-bottom: 28px;
}

.section-title > div > span {
  color: #3975be;

  font-size: 10px;

  font-weight: 800;

  letter-spacing: 2px;
}

.section-title h2 {
  margin: 7px 0 0;

  color: #17253b;

  font-size: 30px;

  letter-spacing: -.8px;
}

.section-title h2 strong {
  color: #3975be;
}

.section-title p {
  margin: 8px 0 0;

  color: #8a98aa;

  font-size: 13px;
}


/* =========================
   INFO GRID
========================= */

.info-grid {
  display: grid;

  grid-template-columns:
    repeat(3, 1fr);

  gap: 20px;
}

.info-card {
  position: relative;

  min-height: 265px;

  padding: 30px;

  border:
    1px solid
    rgba(31,64,106,.08);

  border-radius: 22px;

  background: white;

  box-shadow:
    0 12px 35px
    rgba(27,57,95,.055);

  transition: .3s;
}

.info-card:hover {
  transform:
    translateY(-7px);

  box-shadow:
    0 25px 55px
    rgba(27,57,95,.12);
}

.info-icon {
  width: 55px;
  height: 55px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 16px;

  font-size: 24px;

  margin-bottom: 25px;
}

.info-icon.blue {
  background: #e6f0ff;
}

.info-icon.purple {
  background: #eeeaff;
}

.info-icon.cyan {
  background: #e3f8f8;
}

.info-number {
  position: absolute;

  top: 28px;
  right: 28px;

  color: #dbe4ef;

  font-size: 12px;

  font-weight: 800;
}

.info-card h3 {
  margin: 0 0 10px;

  color: #1c2b41;

  font-size: 18px;
}

.info-card p {
  margin: 0;

  color: #8492a5;

  font-size: 13px;

  line-height: 1.75;
}


/* =========================
   SERVICES
========================= */

.service-section {
  padding: 35px;

  border-radius: 26px;

  background:
    #edf3fa;

  border:
    1px solid
    rgba(35,67,107,.06);
}

.service-grid {
  display: grid;

  grid-template-columns:
    repeat(2, 1fr);

  gap: 15px;
}

.service-card {
  position: relative;

  display: flex;

  align-items: center;

  gap: 18px;

  min-height: 120px;

  padding: 20px;

  border-radius: 18px;

  background: white;

  border:
    1px solid
    rgba(31,64,106,.07);

  box-shadow:
    0 8px 25px
    rgba(30,60,100,.045);

  transition: .3s;
}

.service-card:hover {
  transform:
    translateY(-5px);

  box-shadow:
    0 18px 35px
    rgba(30,60,100,.1);
}

.service-icon {
  flex-shrink: 0;

  width: 55px;
  height: 55px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 15px;

  background: #eaf2fd;

  font-size: 23px;
}

.service-card h3 {
  margin: 0 0 6px;

  color: #1d2c42;

  font-size: 15px;
}

.service-card p {
  max-width: 390px;

  margin: 0;

  color: #8997aa;

  font-size: 11px;

  line-height: 1.6;
}

.service-arrow {
  position: absolute;

  right: 20px;

  color: #8da1ba;

  font-size: 18px;
}


/* =========================
   STEPS
========================= */

.steps {
  display: grid;

  grid-template-columns:
    repeat(3, 1fr);

  gap: 20px;
}

.step {
  position: relative;

  padding: 28px;

  border-radius: 20px;

  background: white;

  border:
    1px solid
    rgba(31,64,106,.08);

  box-shadow:
    0 10px 30px
    rgba(27,57,95,.055);
}

.step-number {
  color: #3975be;

  font-size: 13px;

  font-weight: 900;

  letter-spacing: 1px;
}

.step-line {
  width: 45px;
  height: 3px;

  margin: 17px 0;

  border-radius: 20px;

  background: #dcecff;
}

.step-content h3 {
  margin: 0 0 9px;

  color: #1d2c42;

  font-size: 16px;
}

.step-content p {
  margin: 0;

  color: #8997aa;

  font-size: 12px;

  line-height: 1.7;
}


/* =========================
   TECHNOLOGY
========================= */

.technology-card {
  display: flex;

  align-items: center;

  justify-content: space-between;

  gap: 30px;

  padding: 35px 40px;

  margin-bottom: 35px;

  border-radius: 24px;

  background:
    linear-gradient(
      135deg,
      #1b355b,
      #315e9b
    );

  box-shadow:
    0 20px 55px
    rgba(28,60,104,.16);
}

.technology-left {
  display: flex;

  align-items: center;

  gap: 22px;
}

.technology-icon {
  flex-shrink: 0;

  width: 65px;
  height: 65px;

  display: flex;

  align-items: center;
  justify-content: center;

  border-radius: 19px;

  background:
    rgba(255,255,255,.11);

  font-size: 28px;
}

.technology-left span {
  color: #8dbaff;

  font-size: 9px;

  font-weight: 800;

  letter-spacing: 1.5px;
}

.technology-left h2 {
  margin: 7px 0;

  color: white;

  font-size: 23px;
}

.technology-left p {
  max-width: 650px;

  margin: 0;

  color: #b7cbe4;

  font-size: 12px;

  line-height: 1.7;
}

.tech-stack {
  display: flex;

  gap: 10px;
}

.tech-item {
  min-width: 85px;

  padding: 14px;

  text-align: center;

  border-radius: 12px;

  background:
    rgba(255,255,255,.09);

  border:
    1px solid
    rgba(255,255,255,.1);
}

.tech-item strong {
  display: block;

  color: white;

  font-size: 12px;
}

.tech-item span {
  color: #a9bfdb;

  font-size: 8px;
}


/* =========================
   CTA
========================= */

.bottom-cta {
  display: flex;

  align-items: center;

  justify-content: space-between;

  gap: 25px;

  padding: 38px 40px;

  margin-bottom: 20px;

  border-radius: 22px;

  background: white;

  border:
    1px solid
    rgba(31,64,106,.08);

  box-shadow:
    0 12px 35px
    rgba(27,57,95,.06);
}

.bottom-cta > div > span {
  color: #3975be;

  font-size: 9px;

  font-weight: 800;

  letter-spacing: 2px;
}

.bottom-cta h2 {
  margin: 8px 0 5px;

  color: #17253b;

  font-size: 25px;
}

.bottom-cta h2 strong {
  color: #3975be;
}

.bottom-cta p {
  margin: 0;

  color: #8997aa;

  font-size: 12px;
}

.cta-button {
  display: flex;

  align-items: center;

  gap: 12px;

  padding: 14px 20px;

  border-radius: 12px;

  background:
    linear-gradient(
      135deg,
      #315f9e,
      #172d50
    );

  color: white;

  font-size: 12px;

  font-weight: 700;

  box-shadow:
    0 10px 25px
    rgba(27,57,100,.18);

  transition: .25s;
}

.cta-button:hover {
  transform:
    translateY(-3px);

  box-shadow:
    0 15px 30px
    rgba(27,57,100,.25);
}


/* =========================
   FOOTER
========================= */

footer {
  border-top:
    1px solid #e3e8f0;

  background: white;
}

.footer-inner {
  width: min(
    1400px,
    calc(100% - 80px)
  );

  min-height: 90px;

  margin: auto;

  display: flex;

  align-items: center;

  justify-content: space-between;
}

.footer-brand {
  display: flex;

  align-items: center;

  gap: 11px;
}

.footer-brand .brand-logo {
  width: 38px;
  height: 38px;

  border-radius: 11px;

  font-size: 17px;
}

.footer-brand strong {
  font-size: 14px;
}

.footer-brand p {
  margin: 2px 0 0;

  color: #99a4b4;

  font-size: 9px;

  text-transform: uppercase;
}

.copyright {
  color: #9aa5b4;

  font-size: 11px;
}

.footer-links {
  display: flex;

  gap: 20px;

  color: #778499;

  font-size: 11px;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1100px) {

  .nav-menu {
    gap: 20px;
  }

  .dashboard-container {
    width:
      min(
        100% - 40px,
        1400px
      );
  }

  .info-grid {
    grid-template-columns:
      repeat(2, 1fr);
  }

  .technology-card {
    align-items: flex-start;

    flex-direction: column;
  }

}


@media (max-width: 800px) {

  .nav-inner,
  .dashboard-container,
  .footer-inner {
    width:
      min(
        100% - 32px,
        1400px
      );
  }

  .nav-menu {
    display: none;
  }

  .page-header {
    padding: 28px;

    min-height: 150px;
  }

  .page-header h1 {
    font-size: 28px;
  }

  .header-icon {
    width: 75px;
    height: 75px;

    font-size: 32px;
  }

  .intro-card {
    grid-template-columns: 1fr;

    padding: 28px;
  }

  .intro-icon {
    width: 70px;
    height: 70px;

    font-size: 32px;
  }

  .info-grid {
    grid-template-columns: 1fr;
  }

  .service-grid {
    grid-template-columns: 1fr;
  }

  .steps {
    grid-template-columns: 1fr;
  }

  .bottom-cta {
    align-items: flex-start;

    flex-direction: column;
  }

  .footer-inner {
    padding: 25px 0;

    flex-direction: column;

    gap: 15px;
  }

  .profile-button {
    min-width: auto;

    width: 48px;

    padding: 3px;

    justify-content: center;
  }

  .profile-name,
  .profile-chevron {
    display: none;
  }

  .profile-dropdown {
    right: 0;

    width: 270px;
  }

}


@media (max-width: 550px) {

  .nav-inner {
    height: 70px;
  }

  .search-mini {
    display: none;
  }

  .dashboard-container {
    padding-top: 25px;
  }

  .page-header {
    align-items: flex-start;

    padding: 25px;

    flex-direction: column;

    gap: 20px;
  }

  .header-icon {
    width: 60px;
    height: 60px;

    border-radius: 17px;

    font-size: 27px;
  }

  .intro-content h2 {
    font-size: 25px;
  }

  .section-title h2 {
    font-size: 25px;
  }

  .service-section {
    padding: 22px;
  }

  .service-card {
    align-items: flex-start;
  }

  .technology-card {
    padding: 28px 22px;
  }

  .technology-left {
    align-items: flex-start;

    flex-direction: column;
  }

  .tech-stack {
    width: 100%;
  }

  .tech-item {
    flex: 1;
    min-width: 0;
  }

  .bottom-cta {
    padding: 28px 25px;
  }

  .bottom-cta h2 {
    font-size: 22px;
  }

  .footer-links {
    display: none;
  }

  .profile-dropdown {
    position: fixed;

    top: 76px;

    right: 16px;

    width:
      calc(100vw - 32px);
  }

}

</style>