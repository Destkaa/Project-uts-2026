<template>
  <div class="library-page">

    <!-- ================= NAVBAR ================= -->
    <header class="navbar">
      <div class="nav-inner">

        <router-link to="/" class="brand">
          <div class="brand-logo">
            📚
          </div>

          <div class="brand-text">
            <strong>PerpusKu</strong>
            <span>DIGITAL LIBRARY</span>
          </div>
        </router-link>

        <nav class="nav-menu">
          <router-link to="/" class="active">Beranda</router-link>
          <a href="#koleksi">Koleksi</a>
          <a href="#kategori">Kategori</a>
          <a href="#tentang">Tentang</a>
        </nav>

        <div class="nav-actions">
          <button class="search-mini">⌕</button>

          <router-link to="/admin" class="admin-btn">
            Dashboard Admin
            <span>→</span>
          </router-link>
        </div>

      </div>
    </header>


    <!-- ================= HERO ================= -->
    <section class="hero">

      <div class="hero-grid"></div>

      <div class="glow glow-one"></div>
      <div class="glow glow-two"></div>

      <div class="hero-inner">

        <div class="hero-content">

          <div class="eyebrow">
            <span class="eyebrow-dot"></span>
            PERPUSTAKAAN DIGITAL
          </div>

          <h1>
            Temukan buku.
            <span>Perluas wawasan.</span>
          </h1>

          <p class="hero-description">
            Jelajahi koleksi buku pilihan dan temukan bacaan
            yang sesuai dengan minatmu.
          </p>

          <!-- SEARCH -->
          <div class="search-box">

            <div class="search-icon">
              ⌕
            </div>

            <input
              type="text"
              placeholder="Cari judul buku, penulis, atau kategori..."
            />

            <button>
              Cari Buku
              <span>→</span>
            </button>

          </div>

          <div class="popular-search">
            <span>Pencarian populer</span>

            <div class="tags">
              <span>Laravel</span>
              <span>Vue.js</span>
              <span>Database</span>
              <span>Programming</span>
            </div>
          </div>

        </div>


        <!-- HERO BOOK -->
        <div class="hero-visual">

          <div class="floating-card rating-card">
            <span>★</span>
            <strong>4.9</strong>
            <small>Rating</small>
          </div>

          <div class="floating-card book-count">
            <strong>1.2K+</strong>
            <small>Koleksi buku</small>
          </div>

          <div class="book-glow"></div>

          <div class="book">

            <div class="book-top">
              <span>PERPUSTAKAAN</span>
            </div>

            <div class="book-icon">
              📚
            </div>

            <h3>
              Knowledge
              <br />
              Starts Here
            </h3>

            <div class="book-line"></div>

            <small>
              DIGITAL LIBRARY
            </small>

          </div>

        </div>

      </div>
    </section>


    <!-- ================= STATS ================= -->
    <section class="stats">

      <div class="stat-item">
        <div class="stat-icon">📚</div>
        <strong>1,250<span>+</span></strong>
        <p>Koleksi Buku</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">👥</div>
        <strong>480<span>+</span></strong>
        <p>Anggota Aktif</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">↗</div>
        <strong>320<span>+</span></strong>
        <p>Peminjaman</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">★</div>
        <strong>98<span>%</span></strong>
        <p>Kepuasan Anggota</p>
      </div>

    </section>


    <!-- ================= CATEGORY ================= -->
    <section id="kategori" class="section categories-section">

      <div class="section-heading">

        <div>
          <div class="section-label">
            JELAJAHI
          </div>

          <h2>
            Temukan berdasarkan
            <span>kategori</span>
          </h2>

          <p>
            Pilih kategori yang paling sesuai dengan minatmu.
          </p>
        </div>

        <a href="#">
          Semua kategori
          <span>→</span>
        </a>

      </div>


      <div class="category-grid">

        <div class="category-card">
          <div class="category-icon blue">💻</div>

          <div class="category-info">
            <h3>Teknologi</h3>
            <p>124 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>


        <div class="category-card">
          <div class="category-icon purple">🎓</div>

          <div class="category-info">
            <h3>Pendidikan</h3>
            <p>86 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>


        <div class="category-card">
          <div class="category-icon cyan">🔬</div>

          <div class="category-info">
            <h3>Sains</h3>
            <p>73 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>


        <div class="category-card">
          <div class="category-icon pink">📕</div>

          <div class="category-info">
            <h3>Novel</h3>
            <p>156 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>


        <div class="category-card">
          <div class="category-icon gold">🏛️</div>

          <div class="category-info">
            <h3>Sejarah</h3>
            <p>64 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>


        <div class="category-card">
          <div class="category-icon orange">🎨</div>

          <div class="category-info">
            <h3>Seni & Desain</h3>
            <p>58 buku</p>
          </div>

          <span class="category-arrow">→</span>
        </div>

      </div>

    </section>


    <!-- ================= BOOKS ================= -->
    <section id="koleksi" class="section books-section">

      <div class="section-heading">

        <div>
          <div class="section-label">
            KOLEKSI PILIHAN
          </div>

          <h2>
            Buku <span>populer</span> minggu ini
          </h2>

          <p>
            Buku yang paling banyak dibaca oleh anggota kami.
          </p>
        </div>

        <a href="#">
          Lihat semua buku
          <span>→</span>
        </a>

      </div>


      <div class="book-grid">

        <div class="book-card">

          <div class="book-cover cover-blue">
            <span>PROGRAMMING</span>
            <strong>
              Laravel
              <br />
              From Zero
            </strong>
            <small>MODERN WEB DEVELOPMENT</small>
          </div>

          <div class="book-details">
            <h3>Laravel From Zero</h3>
            <p>Andi Pratama</p>

            <div class="book-meta">
              <span>⭐ 4.9</span>
              <span>📖 320 halaman</span>
            </div>
          </div>

        </div>


        <div class="book-card">

          <div class="book-cover cover-green">
            <span>JAVASCRIPT</span>
            <strong>
              Modern
              <br />
              JavaScript
            </strong>
            <small>COMPLETE GUIDE</small>
          </div>

          <div class="book-details">
            <h3>Modern JavaScript</h3>
            <p>Budi Santoso</p>

            <div class="book-meta">
              <span>⭐ 4.8</span>
              <span>📖 280 halaman</span>
            </div>
          </div>

        </div>


        <div class="book-card">

          <div class="book-cover cover-purple">
            <span>DATABASE</span>
            <strong>
              Database
              <br />
              Mastery
            </strong>
            <small>MYSQL & SQL</small>
          </div>

          <div class="book-details">
            <h3>Database Mastery</h3>
            <p>Rizky Maulana</p>

            <div class="book-meta">
              <span>⭐ 4.7</span>
              <span>📖 250 halaman</span>
            </div>
          </div>

        </div>


        <div class="book-card">

          <div class="book-cover cover-orange">
            <span>DESIGN</span>
            <strong>
              UI/UX
              <br />
              Design
            </strong>
            <small>DESIGN THINKING</small>
          </div>

          <div class="book-details">
            <h3>UI/UX Design</h3>
            <p>Sinta Ramadhani</p>

            <div class="book-meta">
              <span>⭐ 4.9</span>
              <span>📖 210 halaman</span>
            </div>
          </div>

        </div>

      </div>

    </section>


    <!-- ================= CTA ================= -->
    <section id="tentang" class="cta-section">

      <div class="cta-glow"></div>

      <div class="cta-content">

        <div class="cta-icon">
          📚
        </div>

        <div>
          <span class="section-label">PERPUSTAKAAN DIGITAL</span>

          <h2>
            Siap menemukan buku
            <span>favoritmu?</span>
          </h2>

          <p>
            Mulai jelajahi ribuan koleksi buku yang tersedia.
          </p>
        </div>

        <button class="cta-button">
          Jelajahi Koleksi
          <span>→</span>
        </button>

      </div>

    </section>


    <!-- ================= FOOTER ================= -->
    <footer>

      <div class="footer-inner">

        <div class="footer-brand">
          <div class="brand-logo">
            📚
          </div>

          <div>
            <strong>PerpusKu</strong>
            <p>Digital Library</p>
          </div>
        </div>

        <p class="copyright">
          © 2026 PerpusKu. Perpustakaan digital untuk semua.
        </p>

        <div class="footer-links">
          <a href="#">Beranda</a>
          <a href="#">Koleksi</a>
          <a href="#">Tentang</a>
        </div>

      </div>

    </footer>

  </div>
</template>


<style scoped>

/* =====================================================
   GLOBAL
===================================================== */

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


/* =====================================================
   NAVBAR
===================================================== */

.navbar {
  position: sticky;
  top: 0;
  z-index: 100;

  background: rgba(255, 255, 255, 0.82);
  backdrop-filter: blur(22px);
  -webkit-backdrop-filter: blur(22px);

  border-bottom: 1px solid rgba(26, 52, 91, 0.08);

  box-shadow:
    0 10px 35px rgba(20, 40, 75, 0.06);
}

.nav-inner {
  width: min(1400px, calc(100% - 80px));
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
    0 10px 25px rgba(42, 89, 155, 0.28);
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

  transition: 0.25s ease;
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

  transform: translateX(-50%);

  border-radius: 20px;

  background: #356db5;
}

.nav-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.search-mini {
  width: 45px;
  height: 45px;

  border: 1px solid #e1e7f0;
  border-radius: 13px;

  background: rgba(255, 255, 255, 0.75);

  font-size: 24px;
  color: #315f9f;

  cursor: pointer;

  transition: 0.25s;
}

.search-mini:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(36, 72, 120, 0.12);
}

.admin-btn {
  height: 47px;
  padding: 0 20px;

  display: flex;
  align-items: center;
  gap: 12px;

  border-radius: 13px;

  background: #17243a;
  color: white;

  font-size: 13px;
  font-weight: 700;

  box-shadow:
    0 10px 25px rgba(15, 31, 55, 0.18);

  transition: 0.25s;
}

.admin-btn:hover {
  transform: translateY(-2px);
  background: #243b5f;
}

.admin-btn span {
  color: #8fb9ff;
  font-size: 18px;
}


/* =====================================================
   HERO
===================================================== */

.hero {
  position: relative;
  min-height: 625px;

  overflow: hidden;

  background:
    radial-gradient(
      circle at 78% 45%,
      rgba(71, 133, 220, 0.35),
      transparent 30%
    ),
    linear-gradient(
      135deg,
      #142442 0%,
      #1c3762 48%,
      #315e9b 100%
    );
}

.hero-grid {
  position: absolute;
  inset: 0;

  opacity: 0.12;

  background-image:
    linear-gradient(
      rgba(255,255,255,.15) 1px,
      transparent 1px
    ),
    linear-gradient(
      90deg,
      rgba(255,255,255,.15) 1px,
      transparent 1px
    );

  background-size: 55px 55px;

  mask-image:
    linear-gradient(
      to right,
      transparent,
      black 25%,
      black 75%,
      transparent
    );
}

.glow {
  position: absolute;
  border-radius: 50%;
  filter: blur(4px);
  pointer-events: none;
}

.glow-one {
  width: 450px;
  height: 450px;

  right: -120px;
  top: -170px;

  background: rgba(100, 169, 255, 0.18);
}

.glow-two {
  width: 300px;
  height: 300px;

  left: -130px;
  bottom: -170px;

  background: rgba(73, 116, 205, 0.2);
}

.hero-inner {
  position: relative;
  z-index: 2;

  width: min(1400px, calc(100% - 80px));
  min-height: 625px;

  margin: auto;

  display: grid;
  grid-template-columns: 1.05fr .95fr;
  align-items: center;
}

.hero-content {
  max-width: 690px;
}

.eyebrow {
  width: fit-content;

  display: flex;
  align-items: center;
  gap: 9px;

  padding: 9px 15px;

  border: 1px solid rgba(255,255,255,.16);
  border-radius: 30px;

  background: rgba(255,255,255,.09);

  backdrop-filter: blur(12px);

  color: #dceaff;

  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.3px;
}

.eyebrow-dot {
  width: 7px;
  height: 7px;

  border-radius: 50%;

  background: #65a6ff;

  box-shadow:
    0 0 12px #65a6ff;
}

.hero h1 {
  margin: 28px 0 20px;

  font-size: clamp(50px, 5vw, 78px);
  line-height: .99;
  letter-spacing: -3px;

  color: #ffffff;

  font-weight: 800;
}

.hero h1 span {
  display: block;

  background:
    linear-gradient(
      90deg,
      #8ab9ff,
      #d7e7ff
    );

  -webkit-background-clip: text;
  background-clip: text;

  color: transparent;
}

.hero-description {
  max-width: 590px;

  color: #b8cbe6;

  font-size: 16px;
  line-height: 1.8;
}


/* SEARCH */

.search-box {
  width: min(650px, 100%);
  height: 62px;

  margin-top: 32px;

  display: flex;
  align-items: center;

  padding: 6px;

  border: 1px solid rgba(255,255,255,.2);
  border-radius: 17px;

  background: rgba(255,255,255,.12);

  backdrop-filter: blur(20px);

  box-shadow:
    0 20px 50px rgba(0,0,0,.18),
    inset 0 1px 0 rgba(255,255,255,.15);
}

.search-icon {
  width: 50px;

  display: flex;
  justify-content: center;

  color: #9ec6ff;
  font-size: 25px;
}

.search-box input {
  flex: 1;

  min-width: 0;

  border: 0;
  outline: 0;

  background: transparent;

  color: white;

  font-size: 14px;
}

.search-box input::placeholder {
  color: #afbed3;
}

.search-box button {
  height: 50px;

  padding: 0 22px;

  border: 0;
  border-radius: 12px;

  background:
    linear-gradient(
      135deg,
      #477fc6,
      #2c5d9c
    );

  color: white;

  font-size: 13px;
  font-weight: 700;

  cursor: pointer;

  box-shadow:
    0 8px 20px rgba(25, 66, 120, .35);
}

.search-box button span {
  margin-left: 8px;
}


/* POPULAR */

.popular-search {
  display: flex;
  align-items: center;
  gap: 14px;

  margin-top: 15px;

  font-size: 11px;
  color: #9fb5d4;
}

.tags {
  display: flex;
  gap: 7px;
  flex-wrap: wrap;
}

.tags span {
  padding: 6px 10px;

  border-radius: 7px;

  background: rgba(255,255,255,.09);

  border: 1px solid rgba(255,255,255,.08);

  color: #d4e2f5;

  font-size: 11px;
}


/* BOOK VISUAL */

.hero-visual {
  position: relative;

  height: 480px;

  display: flex;
  align-items: center;
  justify-content: center;
}

.book-glow {
  position: absolute;

  width: 320px;
  height: 320px;

  border-radius: 50%;

  background: rgba(94, 165, 255, .25);

  filter: blur(70px);
}

.book {
  position: relative;
  z-index: 3;

  width: 275px;
  height: 370px;

  padding: 38px 30px;

  border-radius: 9px 22px 22px 9px;

  transform:
    rotate(7deg)
    perspective(700px)
    rotateY(-8deg);

  background:
    linear-gradient(
      145deg,
      #315e99,
      #17345f
    );

  border: 1px solid rgba(255,255,255,.18);

  box-shadow:
    -20px 25px 45px rgba(4,17,38,.4),
    20px 20px 55px rgba(2,15,35,.3),
    inset 0 1px 1px rgba(255,255,255,.2);
}

.book::before {
  content: "";

  position: absolute;

  left: 0;
  top: 0;
  bottom: 0;

  width: 9px;

  border-radius: 8px 0 0 8px;

  background:
    linear-gradient(
      to right,
      rgba(255,255,255,.22),
      transparent
    );
}

.book-top {
  color: #bdd7f8;

  font-size: 8px;
  letter-spacing: 3px;
}

.book-icon {
  margin-top: 58px;

  font-size: 45px;

  filter:
    drop-shadow(
      0 8px 10px rgba(0,0,0,.2)
    );
}

.book h3 {
  margin-top: 28px;

  color: white;

  font-size: 31px;
  line-height: 1.05;
  letter-spacing: -1px;
}

.book-line {
  width: 65px;
  height: 4px;

  margin-top: 25px;

  border-radius: 20px;

  background: #9fc7ff;
}

.book > small {
  position: absolute;
  bottom: 25px;

  color: #b8d3f3;

  font-size: 7px;
  letter-spacing: 4px;
}


/* FLOATING */

.floating-card {
  position: absolute;
  z-index: 10;

  display: flex;
  align-items: center;
  gap: 8px;

  padding: 14px 17px;

  border-radius: 16px;

  border: 1px solid rgba(255,255,255,.22);

  background:
    rgba(255,255,255,.13);

  backdrop-filter: blur(18px);

  box-shadow:
    0 20px 40px rgba(0,0,0,.2);

  color: white;
}

.rating-card {
  right: 35px;
  top: 85px;
}

.rating-card span {
  color: #ffd45b;
}

.rating-card strong {
  font-size: 14px;
}

.rating-card small {
  color: #bcd0e8;
  font-size: 10px;
}

.book-count {
  left: 20px;
  bottom: 75px;

  flex-direction: column;
  align-items: flex-start;
}

.book-count strong {
  font-size: 18px;
}

.book-count small {
  color: #bcd0e8;
  font-size: 10px;
}


/* =====================================================
   STATS
===================================================== */

.stats {
  position: relative;
  z-index: 5;

  width: min(1400px, calc(100% - 80px));

  margin: -1px auto 0;

  display: grid;
  grid-template-columns: repeat(4, 1fr);

  overflow: hidden;

  border: 1px solid rgba(31, 65, 108, .08);
  border-radius: 0 0 20px 20px;

  background: rgba(255,255,255,.92);

  box-shadow:
    0 20px 55px rgba(23,48,85,.1);

  backdrop-filter: blur(18px);
}

.stat-item {
  position: relative;

  padding: 30px 20px;

  text-align: center;

  border-right: 1px solid #e8edf4;
}

.stat-item:last-child {
  border-right: 0;
}

.stat-icon {
  margin-bottom: 7px;

  font-size: 16px;
}

.stat-item strong {
  display: block;

  color: #17253b;

  font-size: 32px;
  letter-spacing: -1px;
}

.stat-item strong span {
  color: #3975bf;
}

.stat-item p {
  margin: 4px 0 0;

  color: #8996aa;

  font-size: 11px;
}


/* =====================================================
   SECTIONS
===================================================== */

.section {
  width: min(1400px, calc(100% - 80px));

  margin: auto;
  padding: 100px 0;
}

.categories-section {
  padding-bottom: 75px;
}

.section-heading {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;

  margin-bottom: 35px;
}

.section-label {
  margin-bottom: 11px;

  color: #3975be;

  font-size: 10px;
  font-weight: 800;
  letter-spacing: 2px;
}

.section-heading h2 {
  margin: 0;

  color: #17253b;

  font-size: 36px;
  line-height: 1.15;
  letter-spacing: -1.4px;
}

.section-heading h2 span {
  color: #3975be;
}

.section-heading p {
  margin: 10px 0 0;

  color: #8997ab;

  font-size: 14px;
}

.section-heading > a {
  display: flex;
  gap: 8px;
  align-items: center;

  color: #3169ad;

  font-size: 13px;
  font-weight: 700;
}

.section-heading > a span {
  font-size: 17px;
}


/* =====================================================
   CATEGORY CARDS
===================================================== */

.category-grid {
  display: grid;

  grid-template-columns: repeat(3, 1fr);

  gap: 17px;
}

.category-card {
  position: relative;

  min-height: 125px;

  display: flex;
  align-items: center;

  padding: 20px;

  border: 1px solid rgba(31, 64, 106, .1);
  border-radius: 20px;

  background:
    linear-gradient(
      145deg,
      rgba(255,255,255,.9),
      rgba(245,249,255,.72)
    );

  box-shadow:
    0 10px 30px rgba(35,65,105,.055);

  transition:
    transform .25s ease,
    box-shadow .25s ease,
    border-color .25s ease;

  overflow: hidden;
}

.category-card::after {
  content: "";

  position: absolute;

  width: 120px;
  height: 120px;

  right: -60px;
  top: -60px;

  border-radius: 50%;

  background: rgba(61, 119, 190, .06);
}

.category-card:hover {
  transform: translateY(-7px);

  border-color: rgba(55, 112, 182, .2);

  box-shadow:
    0 20px 45px rgba(35,75,125,.14);
}

.category-icon {
  width: 58px;
  height: 58px;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 16px;

  margin-right: 18px;

  font-size: 25px;
}

.category-icon.blue {
  background: #e7f0ff;
}

.category-icon.purple {
  background: #eeeaff;
}

.category-icon.cyan {
  background: #e2f7f8;
}

.category-icon.pink {
  background: #ffe9f1;
}

.category-icon.gold {
  background: #fff5dc;
}

.category-icon.orange {
  background: #ffede1;
}

.category-info h3 {
  margin: 0 0 7px;

  color: #18263d;

  font-size: 16px;
}

.category-info p {
  margin: 0;

  color: #93a0b3;

  font-size: 12px;
}

.category-arrow {
  position: absolute;
  right: 22px;

  color: #91a4bd;

  font-size: 19px;

  transition: .25s;
}

.category-card:hover .category-arrow {
  right: 17px;
  color: #3975bd;
}


/* =====================================================
   BOOK SECTION
===================================================== */

.books-section {
  padding-top: 55px;
}

.book-grid {
  display: grid;

  grid-template-columns: repeat(4, 1fr);

  gap: 20px;
}

.book-card {
  overflow: hidden;

  border: 1px solid rgba(31,64,106,.1);
  border-radius: 20px;

  background: rgba(255,255,255,.85);

  box-shadow:
    0 12px 35px rgba(27,57,95,.07);

  transition: .3s;
}

.book-card:hover {
  transform: translateY(-8px);

  box-shadow:
    0 25px 50px rgba(27,57,95,.15);
}

.book-cover {
  position: relative;

  height: 245px;

  padding: 25px;

  overflow: hidden;

  display: flex;
  flex-direction: column;

  color: white;

  box-shadow:
    inset 0 -40px 70px rgba(0,0,0,.12);
}

.book-cover::after {
  content: "";

  position: absolute;

  width: 180px;
  height: 180px;

  right: -70px;
  bottom: -80px;

  border: 1px solid rgba(255,255,255,.15);
  border-radius: 50%;
}

.book-cover span {
  font-size: 8px;
  letter-spacing: 2px;
  opacity: .8;
}

.book-cover strong {
  margin-top: auto;

  font-size: 28px;
  line-height: 1;
  letter-spacing: -1px;
}

.book-cover small {
  margin-top: 12px;

  font-size: 7px;
  letter-spacing: 2px;

  opacity: .7;
}

.cover-blue {
  background:
    linear-gradient(145deg,#3675bf,#172f56);
}

.cover-green {
  background:
    linear-gradient(145deg,#299b82,#146051);
}

.cover-purple {
  background:
    linear-gradient(145deg,#8060b9,#43316f);
}

.cover-orange {
  background:
    linear-gradient(145deg,#df8051,#8b3f25);
}

.book-details {
  padding: 19px;
}

.book-details h3 {
  margin: 0;

  color: #18263c;

  font-size: 15px;
}

.book-details p {
  margin: 6px 0 15px;

  color: #8d99aa;

  font-size: 12px;
}

.book-meta {
  display: flex;
  justify-content: space-between;

  color: #718197;

  font-size: 10px;
}


/* =====================================================
   CTA
===================================================== */

.cta-section {
  position: relative;

  width: min(1400px, calc(100% - 80px));

  margin: 20px auto 80px;

  padding: 55px 65px;

  overflow: hidden;

  border-radius: 28px;

  background:
    radial-gradient(
      circle at 85% 20%,
      rgba(107,170,255,.32),
      transparent 30%
    ),
    linear-gradient(
      135deg,
      #172b4c,
      #28558c
    );

  box-shadow:
    0 30px 70px rgba(27,61,105,.2);
}

.cta-section::before {
  content: "";

  position: absolute;
  inset: 0;

  background-image:
    linear-gradient(
      rgba(255,255,255,.07) 1px,
      transparent 1px
    ),
    linear-gradient(
      90deg,
      rgba(255,255,255,.07) 1px,
      transparent 1px
    );

  background-size: 40px 40px;

  opacity: .4;
}

.cta-glow {
  position: absolute;

  width: 250px;
  height: 250px;

  right: 50px;
  top: -150px;

  border-radius: 50%;

  background: rgba(114,180,255,.2);

  filter: blur(40px);
}

.cta-content {
  position: relative;
  z-index: 2;

  display: flex;
  align-items: center;
  gap: 24px;
}

.cta-icon {
  width: 70px;
  height: 70px;

  flex-shrink: 0;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 20px;

  background: rgba(255,255,255,.12);

  border: 1px solid rgba(255,255,255,.18);

  backdrop-filter: blur(15px);

  font-size: 30px;
}

.cta-content .section-label {
  color: #8dbdff;
}

.cta-content h2 {
  margin: 0;

  color: white;

  font-size: 29px;
  letter-spacing: -1px;
}

.cta-content h2 span {
  color: #9fc6ff;
}

.cta-content p {
  margin: 7px 0 0;

  color: #b8cce5;

  font-size: 13px;
}

.cta-button {
  margin-left: auto;

  padding: 15px 20px;

  border: 0;
  border-radius: 12px;

  background: white;

  color: #1c3960;

  font-size: 12px;
  font-weight: 800;

  cursor: pointer;

  box-shadow:
    0 12px 25px rgba(0,0,0,.15);
}

.cta-button span {
  margin-left: 10px;
}


/* =====================================================
   FOOTER
===================================================== */

footer {
  border-top: 1px solid #e3e8f0;

  background: #ffffff;
}

.footer-inner {
  width: min(1400px, calc(100% - 80px));

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
  color: #1a2940;
}

.footer-brand p {
  margin: 2px 0 0;

  color: #99a4b4;

  font-size: 9px;
  text-transform: uppercase;
  letter-spacing: 1px;
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

.footer-links a:hover {
  color: #2e66aa;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 1100px) {

  .nav-menu {
    gap: 20px;
  }

  .hero-inner {
    grid-template-columns: 1fr;
    padding: 70px 0;
  }

  .hero {
    min-height: auto;
  }

  .hero-visual {
    display: none;
  }

  .book-grid {
    grid-template-columns: repeat(2, 1fr);
  }

}

@media (max-width: 800px) {

  .nav-inner,
  .hero-inner,
  .section,
  .stats,
  .cta-section,
  .footer-inner {
    width: min(100% - 32px, 1400px);
  }

  .nav-menu {
    display: none;
  }

  .admin-btn {
    padding: 0 13px;
  }

  .admin-btn span {
    display: none;
  }

  .hero h1 {
    font-size: 48px;
  }

  .stats {
    grid-template-columns: repeat(2, 1fr);
    border-radius: 18px;
  }

  .stat-item:nth-child(2) {
    border-right: 0;
  }

  .stat-item:nth-child(-n+2) {
    border-bottom: 1px solid #e8edf4;
  }

  .category-grid {
    grid-template-columns: 1fr;
  }

  .book-grid {
    grid-template-columns: 1fr 1fr;
  }

  .section-heading {
    align-items: flex-start;
    gap: 20px;
    flex-direction: column;
  }

  .cta-section {
    padding: 40px 28px;
  }

  .cta-content {
    align-items: flex-start;
    flex-direction: column;
  }

  .cta-button {
    margin-left: 0;
  }

  .footer-inner {
    padding: 25px 0;
    flex-direction: column;
    gap: 15px;
  }

}

@media (max-width: 550px) {

  .nav-inner {
    height: 70px;
  }

  .search-mini {
    display: none;
  }

  .hero {
    padding: 20px 0;
  }

  .hero h1 {
    font-size: 42px;
    letter-spacing: -2px;
  }

  .search-box {
    height: auto;
    padding: 7px;
  }

  .search-box button {
    padding: 0 13px;
  }

  .search-box button span {
    display: none;
  }

  .popular-search {
    align-items: flex-start;
    flex-direction: column;
  }

  .stats {
    grid-template-columns: 1fr 1fr;
  }

  .stat-item {
    padding: 23px 10px;
  }

  .stat-item strong {
    font-size: 25px;
  }

  .section {
    padding: 70px 0;
  }

  .section-heading h2 {
    font-size: 29px;
  }

  .book-grid {
    grid-template-columns: 1fr;
  }

  .book-cover {
    height: 270px;
  }

  .cta-content h2 {
    font-size: 24px;
  }

  .footer-links {
    display: none;
  }

}

</style>