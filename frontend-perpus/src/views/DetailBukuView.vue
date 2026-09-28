<template>
  <div class="detail-page">
    <NavbarView />

    <!-- LOADING -->
    <div v-if="loading" class="state-box">
      <div class="spinner"></div>
      <p>Memuat detail buku...</p>
    </div>

    <!-- ERROR -->
    <div v-else-if="error" class="state-box error">
      <div class="state-icon">⚠️</div>
      <h2>Gagal memuat buku</h2>
      <p>{{ error }}</p>
      <button @click="loadBook">Coba Lagi</button>
    </div>

    <!-- DETAIL -->
    <main v-else-if="book" class="main-content">
      <div class="breadcrumb">
        <router-link to="/">Beranda</router-link>
        <span>›</span>
        <span>Detail Buku</span>
      </div>

      <section class="book-detail">

        <!-- COVER -->
        <div class="cover-section">
          <div
            class="book-cover"
            :class="{ 'has-image': book.gambar }"
            :style="coverStyle"
          >
            <div class="cover-overlay"></div>

            <div v-if="!book.gambar" class="cover-content">
              <div class="cover-icon">📚</div>
              <div class="cover-category">{{ categoryName }}</div>
              <h2>{{ book.judul }}</h2>
              <p>{{ book.penulis }}</p>
            </div>
          </div>

          <div class="stock-status" :class="stockClass">
            <span class="stock-dot"></span>
            {{ stockText }}
          </div>
        </div>

        <!-- INFO -->
        <div class="book-info">
          <div class="category-badge">
            {{ categoryName }}
          </div>

          <!-- WARNA JUDUL DIPAKSA GELAP -->
          <h1>{{ book.judul }}</h1>

          <div class="author">
            <span>Penulis</span>
            <strong>{{ book.penulis }}</strong>
          </div>

          <div class="info-grid">
            <div class="info-card">
              <span>📦</span>
              <div>
                <small>Stok</small>
                <strong>{{ book.stok }}</strong>
              </div>
            </div>

            <div class="info-card">
              <span>📚</span>
              <div>
                <small>Status</small>
                <strong>{{ book.stok > 0 ? 'Tersedia' : 'Habis' }}</strong>
              </div>
            </div>
          </div>

          <div class="description">
            <h3>Deskripsi Buku</h3>
            <p>
              {{ book.deskripsi || 'Belum ada deskripsi untuk buku ini.' }}
            </p>
          </div>

          <button
            class="borrow-btn"
            :disabled="book.stok <= 0"
            @click="openBorrowModal"
          >
            <span>📖</span>
            {{ book.stok > 0 ? 'Ajukan Peminjaman' : 'Stok Habis' }}
          </button>
        </div>
      </section>
    </main>

    <!-- MODAL PINJAM -->
    <div
      v-if="showModal"
      class="modal-backdrop"
      @click.self="closeBorrowModal"
    >
      <div class="modal">
        <button class="modal-close" @click="closeBorrowModal">×</button>

        <div class="modal-icon">📚</div>

        <h2>Ajukan Peminjaman</h2>
        <p class="modal-subtitle">
          {{ book?.judul }}
        </p>

        <div class="user-box">
          <div class="user-avatar">
            {{ userInitial }}
          </div>
          <div>
            <strong>{{ user?.name || 'Pengguna' }}</strong>
            <span>{{ user?.email || '' }}</span>
          </div>
        </div>

        <div class="form-group">
          <label>Tanggal Pinjam</label>
          <input
            v-model="form.tanggal_pinjam"
            type="date"
            :min="today"
          />
        </div>

        <div class="form-group">
          <label>Tanggal Kembali</label>
          <input
            v-model="form.tanggal_kembali"
            type="date"
            :min="form.tanggal_pinjam || today"
          />
        </div>

        <div v-if="borrowError" class="form-error">
          {{ borrowError }}
        </div>

        <button
          class="submit-btn"
          :disabled="borrowing"
          @click="borrowBook"
        >
          {{ borrowing ? 'Mengirim...' : 'Kirim Pengajuan' }}
        </button>
      </div>
    </div>

    <!-- FOOTER -->
    <footer>
      <div>
        <strong>📚 PerpusKu</strong>
        <p>Digital Library untuk membaca dan belajar.</p>
      </div>
      <span>© 2026 PerpusKu</span>
    </footer>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import api from '../utils/api'
import NavbarView from '../components/NavbarView.vue'

const route = useRoute()
const router = useRouter()

const book = ref(null)
const user = ref(null)

const loading = ref(true)
const error = ref('')
const showModal = ref(false)
const borrowing = ref(false)
const borrowError = ref('')

const today = new Date().toISOString().split('T')[0]

const form = ref({
  tanggal_pinjam: today,
  tanggal_kembali: ''
})

/* =========================
   TOKEN
========================= */

function getToken() {
  return (
    localStorage.getItem('token') ||
    localStorage.getItem('access_token') ||
    localStorage.getItem('auth_token')
  )
}

/* =========================
   USER LOGIN
========================= */

async function loadUser() {
  const token = getToken()

  if (!token) {
    user.value = null
    return false
  }

  // Samakan key token agar api.js yang membaca "token"
  // tetap mendapatkan token
  if (!localStorage.getItem('token')) {
    localStorage.setItem('token', token)
  }

  try {
    const res = await api.get('/me')

    const data =
      res.data?.data ||
      res.data?.user ||
      res.data

    if (data?.id) {
      user.value = data

      // Simpan user supaya halaman lain konsisten
      localStorage.setItem('user', JSON.stringify(data))

      return true
    }
  } catch (err) {
    // Kalau hanya error jaringan, jangan hapus login
    if (err.response?.status === 401) {
      user.value = null
    }
  }

  // Fallback ke user yang tersimpan
  try {
    const savedUser = localStorage.getItem('user')

    if (savedUser) {
      const parsed = JSON.parse(savedUser)

      if (parsed?.id) {
        user.value = parsed
        return true
      }
    }
  } catch {
    // abaikan
  }

  return false
}

/* =========================
   BOOK
========================= */

async function loadBook() {
  loading.value = true
  error.value = ''

  try {
    const res = await api.get(`/buku/${route.params.id}`)

    book.value =
      res.data?.data ||
      res.data

    if (!book.value) {
      error.value = 'Data buku tidak ditemukan.'
    }
  } catch (err) {
    console.error(err)

    error.value =
      err.response?.data?.message ||
      'Tidak dapat mengambil data buku.'
  } finally {
    loading.value = false
  }
}

/* =========================
   DATA BUKU
========================= */

const categoryName = computed(() => {
  return (
    book.value?.kategori?.nama ||
    book.value?.kategori?.kategori ||
    'Umum'
  )
})

const coverStyle = computed(() => {
  if (!book.value?.gambar) return {}

  return {
    backgroundImage:
      `url("http://localhost:8000/storage/${book.value.gambar}")`
  }
})

const stockClass = computed(() => {
  const stok = Number(book.value?.stok || 0)

  if (stok <= 0) return 'empty'
  if (stok <= 3) return 'low'

  return 'available'
})

const stockText = computed(() => {
  const stok = Number(book.value?.stok || 0)

  if (stok <= 0) return 'Stok habis'
  if (stok <= 3) return `Tersisa ${stok} buku`

  return `${stok} buku tersedia`
})

const userInitial = computed(() => {
  return (
    user.value?.name?.charAt(0)?.toUpperCase() ||
    'U'
  )
})

/* =========================
   MODAL
========================= */

async function openBorrowModal() {
  borrowError.value = ''

  const loggedIn = await loadUser()

  if (!loggedIn || !user.value?.id) {
    router.push({
      path: '/login',
      query: {
        redirect: route.fullPath
      }
    })

    return
  }

  showModal.value = true
}

function closeBorrowModal() {
  if (borrowing.value) return

  showModal.value = false
  borrowError.value = ''
}

/* =========================
   PINJAM BUKU
========================= */

async function borrowBook() {
  borrowError.value = ''

  if (!form.value.tanggal_pinjam) {
    borrowError.value = 'Tanggal pinjam wajib diisi.'
    return
  }

  if (!form.value.tanggal_kembali) {
    borrowError.value = 'Tanggal kembali wajib diisi.'
    return
  }

  if (!user.value?.id) {
    const loggedIn = await loadUser()

    if (!loggedIn || !user.value?.id) {
      router.push({
        path: '/login',
        query: {
          redirect: route.fullPath
        }
      })

      return
    }
  }

  borrowing.value = true

  try {
    await api.post('/peminjaman', {
      user_id: user.value.id,
      buku_id: book.value.id,
      tanggal_request: today,
      tanggal_pinjam: form.value.tanggal_pinjam,
      tanggal_kembali: form.value.tanggal_kembali,
      status: 'pending'
    })

    alert('Pengajuan peminjaman berhasil dikirim!')

    showModal.value = false

    await loadBook()

    form.value = {
      tanggal_pinjam: today,
      tanggal_kembali: ''
    }

  } catch (err) {
    console.error(err)

    const errors = err.response?.data?.errors

    if (errors) {
      borrowError.value = Object.values(errors)
        .flat()
        .join(' ')
    } else {
      borrowError.value =
        err.response?.data?.message ||
        'Pengajuan peminjaman gagal.'
    }
  } finally {
    borrowing.value = false
  }
}

/* =========================
   START
========================= */

onMounted(async () => {
  await loadUser()
  await loadBook()
})
</script>

<style scoped>
.detail-page {
  min-height: 100vh;
  background:
    radial-gradient(circle at top right, rgba(79,129,189,.12), transparent 35%),
    #f5f8fc;
  color: #172033;
}

/* CONTENT */

.main-content {
  width: min(1200px, calc(100% - 50px));
  margin: auto;
  padding: 35px 0 80px;
}

.breadcrumb {
  display: flex;
  gap: 10px;
  margin-bottom: 28px;
  color: #8a97aa;
  font-size: 13px;
}

.breadcrumb a {
  color: #356db5;
  text-decoration: none;
}

/* DETAIL */

.book-detail {
  display: grid;
  grid-template-columns: 400px 1fr;
  gap: 60px;
  align-items: start;
}

.cover-section {
  position: sticky;
  top: 110px;
}

.book-cover {
  position: relative;
  min-height: 540px;
  overflow: hidden;
  border-radius: 28px;
  background:
    linear-gradient(145deg, #315f9e, #172d50);
  background-size: cover;
  background-position: center;
  box-shadow: 0 30px 70px rgba(28,55,90,.2);
}

.book-cover.has-image {
  background-color: #172d50;
}

.cover-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(10,25,48,.7),
    transparent 60%
  );
}

.cover-content {
  position: absolute;
  left: 35px;
  right: 35px;
  bottom: 35px;
  color: white;
}

.cover-icon {
  font-size: 45px;
  margin-bottom: 18px;
}

.cover-category {
  font-size: 11px;
  letter-spacing: 2px;
  text-transform: uppercase;
  opacity: .8;
}

.cover-content h2 {
  margin: 10px 0 7px;
  color: white !important;
  font-size: 30px;
}

.cover-content p {
  margin: 0;
  color: rgba(255,255,255,.8);
}

/* STOCK */

.stock-status {
  display: flex;
  align-items: center;
  gap: 8px;
  width: fit-content;
  margin: 15px auto 0;
  padding: 9px 15px;
  border-radius: 30px;
  font-size: 12px;
  font-weight: 700;
}

.stock-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.stock-status.available {
  background: #e7f8ef;
  color: #218653;
}

.stock-status.available .stock-dot {
  background: #2ca86b;
}

.stock-status.low {
  background: #fff4df;
  color: #b77917;
}

.stock-status.low .stock-dot {
  background: #e5a52d;
}

.stock-status.empty {
  background: #ffe8e8;
  color: #c34848;
}

.stock-status.empty .stock-dot {
  background: #d65454;
}

/* INFO */

.book-info {
  padding-top: 15px;
  color: #172033;
}

.category-badge {
  display: inline-flex;
  padding: 8px 14px;
  border-radius: 20px;
  background: #e7f0fb;
  color: #356db5;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.book-info h1 {
  margin: 18px 0 25px;
  color: #172033 !important;
  font-size: clamp(35px, 5vw, 58px);
  line-height: 1.05;
  letter-spacing: -2px;
  font-weight: 800;
}

.author {
  display: flex;
  flex-direction: column;
  gap: 5px;
  padding-bottom: 25px;
  border-bottom: 1px solid #e2e8f0;
}

.author span {
  color: #8b98aa;
  font-size: 12px;
}

.author strong {
  color: #172033 !important;
  font-size: 17px;
}

/* INFO GRID */

.info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin: 25px 0;
}

.info-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 17px;
  border: 1px solid rgba(44,76,116,.08);
  border-radius: 16px;
  background: rgba(255,255,255,.7);
  box-shadow: 0 10px 30px rgba(30,55,90,.05);
}

.info-card > span {
  font-size: 23px;
}

.info-card div {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.info-card small {
  color: #8c99aa;
  font-size: 10px;
}

.info-card strong {
  color: #172033;
  font-size: 14px;
}

/* DESCRIPTION */

.description {
  margin-top: 28px;
}

.description h3 {
  margin-bottom: 10px;
  color: #172033;
}

.description p {
  color: #65738a;
  font-size: 14px;
  line-height: 1.8;
}

/* BUTTON */

.borrow-btn,
.submit-btn {
  width: 100%;
  height: 54px;
  border: 0;
  border-radius: 15px;
  background: linear-gradient(135deg, #356db5, #172d50);
  color: white;
  font-weight: 700;
  cursor: pointer;
  box-shadow: 0 12px 30px rgba(38,79,132,.2);
  transition: .25s;
}

.borrow-btn {
  margin-top: 25px;
}

.borrow-btn:hover,
.submit-btn:hover {
  transform: translateY(-2px);
}

.borrow-btn:disabled,
.submit-btn:disabled {
  opacity: .55;
  cursor: not-allowed;
  transform: none;
}

/* MODAL */

.modal-backdrop {
  position: fixed;
  inset: 0;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: rgba(10,25,45,.55);
  backdrop-filter: blur(8px);
}

.modal {
  position: relative;
  width: min(440px, 100%);
  padding: 30px;
  border-radius: 24px;
  background: white;
  box-shadow: 0 30px 80px rgba(0,0,0,.2);
}

.modal-close {
  position: absolute;
  top: 15px;
  right: 18px;
  border: 0;
  background: transparent;
  font-size: 28px;
  color: #8b98aa;
  cursor: pointer;
}

.modal-icon {
  font-size: 35px;
}

.modal h2 {
  margin: 10px 0 5px;
  color: #172033;
}

.modal-subtitle {
  margin-bottom: 20px;
  color: #7c899c;
}

.user-box {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
  padding: 13px;
  border-radius: 14px;
  background: #f3f7fb;
}

.user-avatar {
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 11px;
  background: linear-gradient(145deg, #477fc7, #234d86);
  color: white;
  font-weight: 800;
}

.user-box div:last-child {
  display: flex;
  flex-direction: column;
}

.user-box strong {
  color: #172033;
  font-size: 13px;
}

.user-box span {
  margin-top: 2px;
  color: #8997aa;
  font-size: 10px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 7px;
  color: #40516a;
  font-size: 12px;
  font-weight: 700;
}

.form-group input {
  width: 100%;
  height: 45px;
  padding: 0 12px;
  border: 1px solid #dce4ee;
  border-radius: 11px;
  outline: none;
  color: #172033;
  background: white;
  box-sizing: border-box;
}

.form-group input:focus {
  border-color: #477fc7;
}

.form-error {
  margin: 10px 0;
  padding: 11px;
  border-radius: 10px;
  background: #fff0f0;
  color: #c34848;
  font-size: 12px;
}

.submit-btn {
  margin-top: 8px;
}

/* STATE */

.state-box {
  min-height: 65vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #65738a;
  text-align: center;
}

.state-box h2 {
  color: #172033;
}

.state-box button {
  margin-top: 15px;
  padding: 11px 20px;
  border: 0;
  border-radius: 10px;
  background: #315f9e;
  color: white;
  cursor: pointer;
}

.state-icon {
  font-size: 40px;
}

.spinner {
  width: 35px;
  height: 35px;
  border: 4px solid #dce6f2;
  border-top-color: #356db5;
  border-radius: 50%;
  animation: spin .8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* FOOTER */

footer {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 35px max(25px, calc((100% - 1200px) / 2));
  background: #172d50;
  color: white;
}

footer strong {
  font-size: 17px;
}

footer p {
  margin: 7px 0 0;
  color: #aebed2;
  font-size: 12px;
}

footer span {
  align-self: center;
  color: #aebed2;
  font-size: 11px;
}

/* RESPONSIVE */

@media (max-width: 850px) {
  .book-detail {
    grid-template-columns: 1fr;
    gap: 35px;
  }

  .cover-section {
    position: static;
  }

  .book-cover {
    min-height: 450px;
  }
}

@media (max-width: 600px) {
  .main-content {
    width: min(100% - 30px, 1200px);
  }

  .info-grid {
    grid-template-columns: 1fr;
  }

  footer {
    flex-direction: column;
  }
}
</style>