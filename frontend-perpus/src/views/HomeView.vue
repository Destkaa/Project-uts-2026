<template>
  <div class="library-page">

    <!-- NAVBAR -->
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
          <router-link to="/" class="active">
            Beranda
          </router-link>

          <router-link to="/koleksi">Koleksi</router-link>
          <router-link to="/kategori">Kategori</router-link>
          <router-link to="/tentang">Tentang</router-link>
        </nav>

        <div class="nav-actions">
          <button class="search-mini" @click="scrollToBooks">⌕</button>

          <router-link
            v-if="!isLoggedIn"
            to="/login"
            class="login-nav-btn"
          >
            Masuk
            <span>→</span>
          </router-link>

          <div v-else class="profile-wrapper">
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
                  {{ user?.role === 'admin' ? 'Administrator' : 'Anggota' }}
                </span>
              </div>

              <span
                class="profile-chevron"
                :class="{ open: profileOpen }"
              >
                ⌄
              </span>
            </button>

            <div
              v-if="profileOpen"
              class="profile-dropdown"
            >
              <div class="dropdown-header">
                <div class="dropdown-avatar">
                  {{ userInitial }}
                </div>

                <div class="dropdown-user-info">
                  <strong>{{ user?.name }}</strong>
                  <span>{{ user?.email }}</span>

                  <small
                    :class="{ 'admin-role': user?.role === 'admin' }"
                  >
                    {{ user?.role === 'admin' ? 'ADMIN' : 'ANGGOTA' }}
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

    <!-- HERO -->
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

          <div class="search-box">
            <div class="search-icon">⌕</div>

            <input
              v-model="search"
              type="text"
              placeholder="Cari judul buku atau nama penulis..."
              @keyup.enter="searchBooks"
            />

            <button @click="searchBooks">
              Cari Buku
              <span>→</span>
            </button>
          </div>

          <div class="popular-search">
            <span>Pencarian populer</span>

            <div class="tags">
              <span
                v-for="item in popularTags"
                :key="item"
                @click="searchByTag(item)"
              >
                {{ item }}
              </span>
            </div>
          </div>
        </div>

        <!-- HERO BOOK -->
        <div class="hero-visual">

          <div class="floating-card rating-card">
            <span>★</span>

            <strong>
              {{ books.length }}
            </strong>

            <small>
              Buku tersedia
            </small>
          </div>

          <div class="floating-card book-count">
            <strong>
              {{ formatNumber(totalBooks) }}
            </strong>

            <small>
              Koleksi buku
            </small>
          </div>

          <div class="book-glow"></div>

          <div class="book">
            <div class="book-top">
              PERPUSTAKAAN
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

    <!-- STATS -->
    <section class="stats">

      <div class="stat-item">
        <div class="stat-icon">📚</div>

        <strong>
          {{ formatNumber(totalBooks) }}
        </strong>

        <p>Koleksi Buku</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">👥</div>

        <strong>
          {{ formatNumber(totalMembers) }}
        </strong>

        <p>Anggota</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">↗</div>

        <strong>
          {{ formatNumber(totalLoans) }}
        </strong>

        <p>Peminjaman</p>
      </div>

      <div class="stat-item">
        <div class="stat-icon">★</div>

        <strong>
          {{ totalCategories }}
        </strong>

        <p>Kategori Buku</p>
      </div>

    </section>

    <!-- CATEGORY -->
    <section
      id="kategori"
      class="section categories-section"
    >
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

        <a href="#kategori">
          Semua kategori
          <span>→</span>
        </a>

      </div>

      <div
        v-if="categories.length"
        class="category-grid"
      >
        <div
          v-for="(category, index) in categories"
          :key="category.id"
          class="category-card"
          @click="filterCategory(category.id)"
        >
          <div
            class="category-icon"
            :class="categoryColors[index % categoryColors.length]"
          >
            {{ categoryIcons[index % categoryIcons.length] }}
          </div>

          <div class="category-info">
            <h3>
              {{ category.nama }}
            </h3>

            <p>
              {{ countBooksByCategory(category.id) }} buku
            </p>
          </div>

          <span class="category-arrow">
            →
          </span>
        </div>
      </div>

      <div
        v-else
        class="empty-state"
      >
        Belum ada kategori buku.
      </div>
    </section>

    <!-- BOOKS -->
    <section
      id="koleksi"
      class="section books-section"
    >
      <div class="section-heading">

        <div>
          <div class="section-label">
            KOLEKSI BUKU
          </div>

          <h2>
            Buku
            <span>tersedia</span>
          </h2>

          <p>
            Koleksi buku yang tersedia di perpustakaan.
          </p>
        </div>

        <router-link to="/koleksi">
          Lihat semua buku
          <span>→</span>
        </router-link>

      </div>

      <div
        v-if="loadingBooks"
        class="loading-state"
      >
        Memuat koleksi buku...
      </div>

      <div
        v-else-if="displayBooks.length"
        class="book-grid"
      >
        <div
          v-for="(book, index) in displayBooks"
          :key="book.id"
          class="book-card"
          @click="openBook(book)"
        >

          <div
            class="book-cover"
            :class="bookColors[index % bookColors.length]"
          >

            <img
              v-if="book.gambar"
              :src="getImageUrl(book.gambar)"
              :alt="book.judul"
              @error="imageError"
            />

            <div
              v-else
              class="cover-placeholder"
            >
              📚
            </div>

            <div class="cover-overlay"></div>

            <span>
              {{ book.kategori?.nama || 'BUKU' }}
            </span>

            <strong>
              {{ book.judul }}
            </strong>

            <small>
              PERPUSTAKAAN DIGITAL
            </small>

          </div>

          <div class="book-details">

            <h3>
              {{ book.judul }}
            </h3>

            <p>
              {{ book.penulis }}
            </p>

            <div class="book-meta">
              <span>
                📚 Stok {{ book.stok ?? 0 }}
              </span>

              <span>
                {{ book.kategori?.nama || 'Umum' }}
              </span>
            </div>

          </div>

        </div>
      </div>

      <div
        v-else
        class="empty-state"
      >
        <div>📚</div>

        <strong>
          Buku tidak ditemukan
        </strong>

        <span>
          Coba gunakan judul atau nama penulis lain.
        </span>
      </div>

    </section>

    <!-- CTA -->
    <section
      id="tentang"
      class="cta-section"
    >
      <div class="cta-glow"></div>

      <div class="cta-content">

        <div class="cta-icon">
          📚
        </div>

        <div>
          <span class="section-label">
            PERPUSTAKAAN DIGITAL
          </span>

          <h2>
            Siap menemukan buku
            <span>favoritmu?</span>
          </h2>

          <p>
            Jelajahi koleksi buku yang tersedia di PerpusKu.
          </p>
        </div>

        <button
          class="cta-button"
          @click="scrollToBooks"
        >
          Jelajahi Koleksi
          <span>→</span>
        </button>

      </div>
    </section>

    <!-- FOOTER -->
    <footer>
      <div class="footer-inner">

        <div class="footer-brand">
          <div class="brand-logo">
            📚
          </div>

          <div>
            <strong>
              PerpusKu
            </strong>

            <p>
              Digital Library
            </p>
          </div>
        </div>

        <p class="copyright">
          © 2026 PerpusKu. Perpustakaan digital untuk semua.
        </p>

        <div class="footer-links">
          <a href="#">Beranda</a>
          <a href="#koleksi">Koleksi</a>
          <a href="#tentang">Tentang</a>
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

// USER
const user = ref(null)
const profileOpen = ref(false)

// DATA
const books = ref([])
const categories = ref([])

const totalBooks = ref(0)
const totalMembers = ref(0)
const totalLoans = ref(0)

const loadingBooks = ref(true)
const search = ref('')

// COLORS
const categoryColors = [
  'blue',
  'purple',
  'cyan',
  'pink',
  'gold',
  'orange'
]

const categoryIcons = [
  '💻',
  '🎓',
  '🔬',
  '📕',
  '🏛️',
  '🎨'
]

const bookColors = [
  'cover-blue',
  'cover-green',
  'cover-purple',
  'cover-orange'
]

const popularTags = [
  'Laravel',
  'Vue.js',
  'Database',
  'Programming'
]

// LOGIN
const isLoggedIn = computed(() => {
  return !!localStorage.getItem('token')
})

// USER INITIAL
const userInitial = computed(() => {
  if (!user.value?.name) {
    return '?'
  }

  return user.value.name
    .charAt(0)
    .toUpperCase()
})

// TOTAL CATEGORY
const totalCategories = computed(() => {
  return categories.value.length
})

// DISPLAY BOOK
const displayBooks = computed(() => {
  if (!search.value.trim()) {
    return books.value.slice(0, 8)
  }

  const keyword = search.value
    .toLowerCase()
    .trim()

  return books.value
    .filter(book => {
      return (
        book.judul?.toLowerCase().includes(keyword) ||
        book.penulis?.toLowerCase().includes(keyword) ||
        book.kategori?.nama?.toLowerCase().includes(keyword)
      )
    })
    .slice(0, 8)
})

// LOAD USER
function loadUser() {
  const storedUser = localStorage.getItem('user')

  if (!storedUser) {
    user.value = null
    return
  }

  try {
    user.value = JSON.parse(storedUser)
  } catch (error) {
    console.error('Data user tidak valid:', error)
    localStorage.removeItem('user')
    user.value = null
  }
}

// LOAD BUKU
async function fetchBooks() {
  loadingBooks.value = true

  try {
    const response = await api.get('/buku', {
      params: {
        per_page: 1000
      }
    })

    const payload = response.data?.data

    books.value =
      payload?.data ||
      (Array.isArray(payload) ? payload : [])

    totalBooks.value =
      payload?.total ??
      books.value.length

  } catch (error) {
    console.error('Gagal mengambil buku:', error)

    books.value = []
    totalBooks.value = 0
  } finally {
    loadingBooks.value = false
  }
}

// LOAD KATEGORI
async function fetchCategories() {
  try {
    const response = await api.get('/kategori', {
      params: {
        per_page: 1000
      }
    })

    const payload = response.data?.data

    categories.value =
      payload?.data ||
      (Array.isArray(payload) ? payload : [])

  } catch (error) {
    console.error('Gagal mengambil kategori:', error)
    categories.value = []
  }
}

// LOAD ANGGOTA
async function fetchMembers() {
  try {
    const response = await api.get('/users', {
      params: {
        per_page: 1
      }
    })

    /*
     * Endpoint /users:
     *
     * {
     *   status: true,
     *   message: "...",
     *   data: {
     *     total: ...
     *   }
     * }
     */

    const payload = response.data?.data

    totalMembers.value =
      payload?.total ?? 0

  } catch (error) {
    console.error('Gagal mengambil anggota:', error)
    totalMembers.value = 0
  }
}

// LOAD PEMINJAMAN
async function fetchLoans() {
  try {
    const response = await api.get('/peminjaman', {
      params: {
        per_page: 1
      }
    })

    /*
     * PENTING:
     * Endpoint /peminjaman mengembalikan paginator
     * secara langsung.
     *
     * Jadi:
     *
     * response.data.total
     *
     * BUKAN:
     *
     * response.data.data.total
     */

    const payload = response.data

    totalLoans.value =
      payload?.total ?? 0

    console.log(
      'TOTAL PEMINJAMAN:',
      totalLoans.value
    )

  } catch (error) {
    console.error(
      'Gagal mengambil peminjaman:',
      error
    )

    totalLoans.value = 0
  }
}

// HITUNG BUKU PER KATEGORI
function countBooksByCategory(categoryId) {
  return books.value.filter(book => {
    return Number(book.kategori_id) === Number(categoryId)
  }).length
}

// SEARCH
function searchBooks() {
  scrollToBooks()
}

// SEARCH TAG
function searchByTag(tag) {
  search.value = tag
  scrollToBooks()
}

// FILTER KATEGORI
function filterCategory(categoryId) {
  const category = categories.value.find(
    item =>
      Number(item.id) === Number(categoryId)
  )

  if (!category) return

  search.value = category.nama
  scrollToBooks()
}

// DETAIL BUKU
function openBook(book) {
  router.push(`/buku/${book.id}`)
}

// IMAGE URL
function getImageUrl(image) {
  if (!image) {
    return ''
  }

  if (
    image.startsWith('http://') ||
    image.startsWith('https://')
  ) {
    return image
  }

  return `http://localhost:8000/storage/${image}`
}

// IMAGE ERROR
function imageError(event) {
  event.target.style.display = 'none'
}

// FORMAT NUMBER
function formatNumber(number) {
  return new Intl.NumberFormat('id-ID')
    .format(number || 0)
}

// SCROLL
function scrollToBooks() {
  document
    .getElementById('koleksi')
    ?.scrollIntoView({
      behavior: 'smooth'
    })
}

// PROFILE
function toggleProfile() {
  profileOpen.value =
    !profileOpen.value
}

// LOGOUT
async function logout() {
  try {
    await api.post('/logout')
  } catch (error) {
    console.log('Logout API:', error)
  } finally {
    localStorage.removeItem('token')
    localStorage.removeItem('user')

    user.value = null
    profileOpen.value = false

    router.push('/login')
  }
}

// CLICK OUTSIDE
function closeProfile(event) {
  if (
    !event.target.closest('.profile-wrapper')
  ) {
    profileOpen.value = false
  }
}

// MOUNT
onMounted(async () => {
  loadUser()

  document.addEventListener(
    'click',
    closeProfile
  )

  await Promise.all([
    fetchBooks(),
    fetchCategories(),
    fetchMembers(),
    fetchLoans()
  ])
})

// UNMOUNT
onBeforeUnmount(() => {
  document.removeEventListener(
    'click',
    closeProfile
  )
})
</script>

<style scoped>
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

/* NAVBAR */
.navbar {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(255,255,255,.82);
  backdrop-filter: blur(22px);
  -webkit-backdrop-filter: blur(22px);
  border-bottom: 1px solid rgba(26,52,91,.08);
  box-shadow: 0 10px 35px rgba(20,40,75,.06);
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
  background: linear-gradient(145deg,#3c72bd,#19345f);
  color: white;
  font-size: 22px;
  box-shadow: 0 10px 25px rgba(42,89,155,.28);
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
  transform: translateX(-50%);
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
  border: 1px solid #e1e7f0;
  border-radius: 13px;
  background: rgba(255,255,255,.75);
  font-size: 24px;
  color: #315f9f;
  cursor: pointer;
  transition: .25s;
}

.search-mini:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(36,72,120,.12);
}

.login-nav-btn {
  height: 47px;
  padding: 0 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  border-radius: 13px;
  background: linear-gradient(135deg,#315f9e,#172d50);
  color: white;
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 10px 25px rgba(27,57,100,.18);
}

/* PROFILE */
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
  border: 1px solid rgba(47,83,130,.12);
  border-radius: 15px;
  background: rgba(255,255,255,.78);
  backdrop-filter: blur(18px);
  box-shadow: 0 8px 25px rgba(28,55,90,.08);
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
  background: linear-gradient(145deg,#477fc7,#234d86);
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
  transform: rotate(180deg);
}

/* DROPDOWN */
.profile-dropdown {
  position: absolute;
  top: calc(100% + 12px);
  right: 0;
  width: 280px;
  padding: 10px;
  border: 1px solid rgba(45,82,128,.12);
  border-radius: 18px;
  background: rgba(255,255,255,.95);
  backdrop-filter: blur(25px);
  box-shadow:
    0 25px 60px rgba(21,48,80,.18),
    0 5px 15px rgba(21,48,80,.08);
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

/* HERO */
.hero {
  position: relative;
  min-height: 625px;
  overflow: hidden;
  background:
    radial-gradient(
      circle at 78% 45%,
      rgba(71,133,220,.35),
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
  opacity: .12;
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
}

.glow {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
}

.glow-one {
  width: 450px;
  height: 450px;
  right: -120px;
  top: -170px;
  background: rgba(100,169,255,.18);
}

.glow-two {
  width: 300px;
  height: 300px;
  left: -130px;
  bottom: -170px;
  background: rgba(73,116,205,.2);
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
  box-shadow: 0 0 12px #65a6ff;
}

.hero h1 {
  margin: 28px 0 20px;
  font-size: clamp(50px,5vw,78px);
  line-height: .99;
  letter-spacing: -3px;
  color: #fff;
}

.hero h1 span {
  display: block;
  color: #a8c9f8;
}

.hero-description {
  max-width: 590px;
  color: #b8cbe6;
  font-size: 16px;
  line-height: 1.8;
}

/* SEARCH */
.search-box {
  width: min(650px,100%);
  height: 62px;
  margin-top: 32px;
  display: flex;
  align-items: center;
  padding: 6px;
  border: 1px solid rgba(255,255,255,.2);
  border-radius: 17px;
  background: rgba(255,255,255,.12);
  backdrop-filter: blur(20px);
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
  background: linear-gradient(135deg,#477fc6,#2c5d9c);
  color: white;
  font-weight: 700;
  cursor: pointer;
}

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
  cursor: pointer;
}

/* HERO BOOK */
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
  background: rgba(94,165,255,.25);
  filter: blur(70px);
}

.book {
  position: relative;
  z-index: 3;
  width: 275px;
  height: 370px;
  padding: 38px 30px;
  border-radius: 9px 22px 22px 9px;
  transform: rotate(7deg) perspective(700px) rotateY(-8deg);
  background: linear-gradient(145deg,#315e99,#17345f);
  border: 1px solid rgba(255,255,255,.18);
  box-shadow:
    -20px 25px 45px rgba(4,17,38,.4),
    20px 20px 55px rgba(2,15,35,.3);
}

.book-top {
  color: #bdd7f8;
  font-size: 8px;
  letter-spacing: 3px;
}

.book-icon {
  margin-top: 58px;
  font-size: 45px;
}

.book h3 {
  margin-top: 28px;
  color: white;
  font-size: 31px;
  line-height: 1.05;
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
  background: rgba(255,255,255,.13);
  backdrop-filter: blur(18px);
  color: white;
}

.rating-card {
  right: 35px;
  top: 85px;
}

.rating-card span {
  color: #ffd45b;
}

.rating-card small,
.book-count small {
  color: #bcd0e8;
  font-size: 10px;
}

.book-count {
  left: 20px;
  bottom: 75px;
  flex-direction: column;
  align-items: flex-start;
}

/* STATS */
.stats {
  position: relative;
  z-index: 5;
  width: min(1400px,calc(100% - 80px));
  margin: -1px auto 0;
  display: grid;
  grid-template-columns: repeat(4,1fr);
  overflow: hidden;
  border: 1px solid rgba(31,65,108,.08);
  border-radius: 0 0 20px 20px;
  background: rgba(255,255,255,.92);
  box-shadow: 0 20px 55px rgba(23,48,85,.1);
}

.stat-item {
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
}

.stat-item p {
  margin: 4px 0 0;
  color: #8996aa;
  font-size: 11px;
}

/* SECTION */
.section {
  width: min(1400px,calc(100% - 80px));
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
  color: #3169ad;
  font-size: 13px;
  font-weight: 700;
}

/* CATEGORY */
.category-grid {
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 17px;
}

.category-card {
  position: relative;
  min-height: 125px;
  display: flex;
  align-items: center;
  padding: 20px;
  border: 1px solid rgba(31,64,106,.1);
  border-radius: 20px;
  background: white;
  box-shadow: 0 10px 30px rgba(35,65,105,.055);
  transition: .25s;
  cursor: pointer;
}

.category-card:hover {
  transform: translateY(-7px);
  box-shadow: 0 20px 45px rgba(35,75,125,.14);
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
}

/* BOOK */
.book-grid {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 20px;
}

.book-card {
  overflow: hidden;
  border: 1px solid rgba(31,64,106,.1);
  border-radius: 20px;
  background: white;
  box-shadow: 0 12px 35px rgba(27,57,95,.07);
  cursor: pointer;
  transition: .3s;
}

.book-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 25px 50px rgba(27,57,95,.15);
}

.book-cover {
  position: relative;
  height: 245px;
  padding: 25px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  color: white;
}

.book-cover img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.cover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to bottom,
    rgba(0,0,0,.05),
    rgba(0,0,0,.65)
  );
}

.book-cover > *:not(img):not(.cover-overlay) {
  position: relative;
  z-index: 2;
}

.book-cover span {
  font-size: 8px;
  letter-spacing: 2px;
  opacity: .9;
}

.book-cover strong {
  margin-top: auto;
  font-size: 24px;
  line-height: 1.05;
}

.book-cover small {
  margin-top: 12px;
  font-size: 7px;
  letter-spacing: 2px;
  opacity: .8;
}

.cover-placeholder {
  position: absolute !important;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 55px;
  background: linear-gradient(145deg,#3675bf,#172f56);
}

.cover-blue {
  background: linear-gradient(145deg,#3675bf,#172f56);
}

.cover-green {
  background: linear-gradient(145deg,#299b82,#146051);
}

.cover-purple {
  background: linear-gradient(145deg,#8060b9,#43316f);
}

.cover-orange {
  background: linear-gradient(145deg,#df8051,#8b3f25);
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
  gap: 10px;
  color: #718197;
  font-size: 10px;
}

/* EMPTY */
.empty-state,
.loading-state {
  padding: 60px 20px;
  text-align: center;
  color: #8a98aa;
}

.empty-state div {
  font-size: 45px;
  margin-bottom: 10px;
}

.empty-state strong,
.empty-state span {
  display: block;
}

.empty-state strong {
  color: #25364e;
  margin-bottom: 5px;
}

/* CTA */
.cta-section {
  position: relative;
  width: min(1400px,calc(100% - 80px));
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
  box-shadow: 0 30px 70px rgba(27,61,105,.2);
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
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  background: rgba(255,255,255,.12);
  font-size: 30px;
}

.cta-content .section-label {
  color: #8dbdff;
}

.cta-content h2 {
  margin: 0;
  color: white;
  font-size: 29px;
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
  font-weight: 800;
  cursor: pointer;
}

/* FOOTER */
footer {
  border-top: 1px solid #e3e8f0;
  background: #fff;
}

.footer-inner {
  width: min(1400px,calc(100% - 80px));
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

/* RESPONSIVE */
@media (max-width:1100px) {
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
    grid-template-columns: repeat(2,1fr);
  }
}

@media (max-width:800px) {
  .nav-inner,
  .hero-inner,
  .section,
  .stats,
  .cta-section,
  .footer-inner {
    width: min(100% - 32px,1400px);
  }

  .nav-menu {
    display: none;
  }

  .hero h1 {
    font-size: 48px;
  }

  .stats {
    grid-template-columns: repeat(2,1fr);
    border-radius: 18px;
  }

  .stat-item:nth-child(2) {
    border-right: 0;
  }

  .category-grid {
    grid-template-columns: 1fr;
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

@media (max-width:550px) {
  .nav-inner {
    height: 70px;
  }

  .search-mini {
    display: none;
  }

  .hero h1 {
    font-size: 42px;
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

  .profile-dropdown {
    position: fixed;
    top: 76px;
    right: 16px;
    width: calc(100vw - 32px);
  }
}
</style>