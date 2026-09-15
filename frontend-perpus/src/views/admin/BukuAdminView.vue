<template>
  <div class="admin-page">

    <!-- BACKGROUND -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- ================= SIDEBAR ================= -->
    <aside class="sidebar">

      <!-- BRAND -->
      <div class="brand">
        <div class="brand-icon">📚</div>

        <div class="brand-text">
          <h2>PerpusKu</h2>
          <span>ADMIN PANEL</span>
        </div>
      </div>

      <!-- MENU -->
      <nav class="menu">

        <router-link
          to="/admin/Dashboard"
          class="menu-item"
        >
          <span>📊</span>
          Dashboard
        </router-link>

        <router-link
          to="/admin/buku"
          class="menu-item active"
        >
          <span>📚</span>
          Data Buku
        </router-link>

        <button class="menu-item">
          <span>👥</span>
          Anggota
        </button>

        <button class="menu-item">
          <span>📖</span>
          Peminjaman
        </button>

        <button class="menu-item">
          <span>🏷️</span>
          Kategori
        </button>

      </nav>

      <!-- SIDEBAR BOTTOM -->
      <div class="sidebar-bottom">

        <button
          class="library-button"
          @click="goToLibrary"
        >
          <span>🏠</span>
          <span>Tampilan Perpus</span>
        </button>

        <button
          class="logout-button"
          @click="logout"
        >
          <span>🚪</span>
          <span>Logout</span>
        </button>

      </div>

    </aside>


    <!-- ================= MAIN CONTENT ================= -->
    <main class="main-content">

      <!-- HEADER -->
      <header class="topbar">

        <div>
          <p class="welcome">
            Dashboard Admin / Data Buku
          </p>

          <h1>Data Buku</h1>

          <p class="subtitle">
            Kelola koleksi buku perpustakaan kamu.
          </p>
        </div>

        <div class="top-actions">

          <button
            class="top-library"
            @click="goToLibrary"
          >
            🏠 Lihat Perpus
          </button>

          <div class="admin-profile">

            <div class="avatar">
              {{ adminInitial }}
            </div>

            <div class="admin-info">
              <strong>{{ adminName }}</strong>
              <span>Administrator</span>
            </div>

          </div>

        </div>

      </header>


      <!-- ================= STATISTIK ================= -->
      <section class="stats">

        <div class="stat-card">

          <div class="stat-icon blue">
            📚
          </div>

          <div>
            <span>Total Buku</span>
            <h2>{{ books.length }}</h2>
            <small>Semua koleksi</small>
          </div>

        </div>


        <div class="stat-card">

          <div class="stat-icon green">
            ✓
          </div>

          <div>
            <span>Buku Tersedia</span>
            <h2>{{ availableBooks }}</h2>
            <small>Stok tersedia</small>
          </div>

        </div>


        <div class="stat-card">

          <div class="stat-icon orange">
            ⚠️
          </div>

          <div>
            <span>Stok Menipis</span>
            <h2>{{ lowStockBooks }}</h2>
            <small>Perlu diperhatikan</small>
          </div>

        </div>


        <div class="stat-card">

          <div class="stat-icon purple">
            🏷️
          </div>

          <div>
            <span>Kategori</span>
            <h2>{{ categories.length }}</h2>
            <small>Kategori buku</small>
          </div>

        </div>

      </section>


      <!-- ================= DATA PANEL ================= -->
      <section class="panel">

        <!-- PANEL HEADER -->
        <div class="panel-header">

          <div>
            <h3>Koleksi Buku</h3>

            <p>
              Daftar seluruh buku yang tersedia di perpustakaan.
            </p>
          </div>

          <button
            class="add-button"
            @click="openAddModal"
          >
            <span>＋</span>
            Tambah Buku
          </button>

        </div>


        <!-- FILTER -->
        <div class="filter-area">

          <!-- SEARCH -->
          <div class="search-box">

            <span>⌕</span>

            <input
              v-model="search"
              type="text"
              placeholder="Cari judul atau penulis..."
            />

          </div>


          <!-- CATEGORY -->
          <select
            v-model="selectedCategory"
            class="category-select"
          >
            <option value="">
              Semua Kategori
            </option>

            <option
              v-for="category in categories"
              :key="category"
              :value="category"
            >
              {{ category }}
            </option>
          </select>

        </div>


        <!-- ================= TABLE ================= -->
        <div class="table-wrapper">

          <table>

            <thead>
              <tr>
                <th>#</th>
                <th>BUKU</th>
                <th>PENULIS</th>
                <th>KATEGORI</th>
                <th>TAHUN</th>
                <th>STOK</th>
                <th>STATUS</th>
                <th>AKSI</th>
              </tr>
            </thead>


            <tbody>

              <tr
                v-for="(book, index) in filteredBooks"
                :key="book.id"
              >

                <!-- NO -->
                <td class="number">
                  {{ index + 1 }}
                </td>


                <!-- BUKU -->
                <td>

                  <div class="book-cell">

                    <div
                      class="book-cover"
                      :class="'cover-' + ((book.id % 4) + 1)"
                    >
                      📖
                    </div>

                    <div class="book-title">

                      <strong>
                        {{ book.title }}
                      </strong>

                      <span>
                        {{ book.isbn }}
                      </span>

                    </div>

                  </div>

                </td>


                <!-- PENULIS -->
                <td>
                  <span class="author">
                    {{ book.author }}
                  </span>
                </td>


                <!-- KATEGORI -->
                <td>
                  <span class="category-badge">
                    {{ book.category }}
                  </span>
                </td>


                <!-- TAHUN -->
                <td>
                  <span class="year">
                    {{ book.year }}
                  </span>
                </td>


                <!-- STOK -->
                <td>
                  <strong class="stock">
                    {{ book.stock }}
                  </strong>
                </td>


                <!-- STATUS -->
                <td>

                  <span
                    class="status"
                    :class="getStatusClass(book.stock)"
                  >
                    <i></i>
                    {{ getStatus(book.stock) }}
                  </span>

                </td>


                <!-- AKSI -->
                <td>

                  <div class="actions">

                    <button
                      class="action view"
                      title="Lihat"
                      @click="viewBook(book)"
                    >
                      👁
                    </button>

                    <button
                      class="action edit"
                      title="Edit"
                      @click="editBook(book)"
                    >
                      ✏️
                    </button>

                    <button
                      class="action delete"
                      title="Hapus"
                      @click="deleteBook(book.id)"
                    >
                      🗑️
                    </button>

                  </div>

                </td>

              </tr>


              <!-- KOSONG -->
              <tr v-if="filteredBooks.length === 0">

                <td
                  colspan="8"
                  class="empty"
                >
                  <div class="empty-icon">
                    📚
                  </div>

                  <strong>
                    Buku tidak ditemukan
                  </strong>

                  <span>
                    Coba gunakan kata pencarian lain.
                  </span>
                </td>

              </tr>

            </tbody>

          </table>

        </div>


        <!-- FOOTER -->
        <div class="table-footer">

          <span>
            Menampilkan
            <strong>{{ filteredBooks.length }}</strong>
            dari
            <strong>{{ books.length }}</strong>
            buku
          </span>

        </div>

      </section>

    </main>


    <!-- ================= MODAL TAMBAH / EDIT ================= -->
    <div
      v-if="showModal"
      class="modal-overlay"
      @click.self="closeModal"
    >

      <div class="modal">

        <div class="modal-header">

          <div>
            <span class="modal-label">
              {{ isEditing ? 'EDIT DATA' : 'KOLEKSI BARU' }}
            </span>

            <h2>
              {{ isEditing ? 'Edit Buku' : 'Tambah Buku' }}
            </h2>
          </div>

          <button
            class="close-button"
            @click="closeModal"
          >
            ×
          </button>

        </div>


        <div class="form">

          <!-- JUDUL -->
          <div class="form-group full">

            <label>
              Judul Buku
            </label>

            <input
              v-model="form.title"
              type="text"
              placeholder="Masukkan judul buku"
            />

          </div>


          <!-- PENULIS -->
          <div class="form-group">

            <label>
              Penulis
            </label>

            <input
              v-model="form.author"
              type="text"
              placeholder="Nama penulis"
            />

          </div>


          <!-- KATEGORI -->
          <div class="form-group">

            <label>
              Kategori
            </label>

            <select v-model="form.category">

              <option value="">
                Pilih kategori
              </option>

              <option
                v-for="category in categories"
                :key="category"
                :value="category"
              >
                {{ category }}
              </option>

            </select>

          </div>


          <!-- TAHUN -->
          <div class="form-group">

            <label>
              Tahun Terbit
            </label>

            <input
              v-model="form.year"
              type="number"
              placeholder="2026"
            />

          </div>


          <!-- STOK -->
          <div class="form-group">

            <label>
              Stok
            </label>

            <input
              v-model="form.stock"
              type="number"
              min="0"
              placeholder="0"
            />

          </div>


          <!-- ISBN -->
          <div class="form-group full">

            <label>
              ISBN
            </label>

            <input
              v-model="form.isbn"
              type="text"
              placeholder="Contoh: ISBN 978-602-1234"
            />

          </div>

        </div>


        <div class="modal-footer">

          <button
            class="cancel-button"
            @click="closeModal"
          >
            Batal
          </button>

          <button
            class="save-button"
            @click="saveBook"
          >
            {{ isEditing ? 'Simpan Perubahan' : 'Tambah Buku' }}
          </button>

        </div>

      </div>

    </div>


    <!-- ================= MODAL DETAIL ================= -->
    <div
      v-if="showDetail"
      class="modal-overlay"
      @click.self="showDetail = false"
    >

      <div class="detail-modal">

        <button
          class="close-button"
          @click="showDetail = false"
        >
          ×
        </button>

        <div class="detail-cover">
          📖
        </div>

        <span class="modal-label">
          DETAIL BUKU
        </span>

        <h2>
          {{ selectedBook?.title }}
        </h2>

        <p class="detail-author">
          {{ selectedBook?.author }}
        </p>

        <div class="detail-info">

          <div>
            <span>Kategori</span>
            <strong>{{ selectedBook?.category }}</strong>
          </div>

          <div>
            <span>Tahun</span>
            <strong>{{ selectedBook?.year }}</strong>
          </div>

          <div>
            <span>Stok</span>
            <strong>{{ selectedBook?.stock }}</strong>
          </div>

          <div>
            <span>ISBN</span>
            <strong>{{ selectedBook?.isbn }}</strong>
          </div>

        </div>

      </div>

    </div>

  </div>
</template>


<script setup>
import { computed, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../../utils/api'

const router = useRouter()

// ==============================
// USER ADMIN
// ==============================

const user = JSON.parse(
  localStorage.getItem('user') || '{}'
)

const adminName = computed(() => {
  return user.name || 'Administrator'
})

const adminInitial = computed(() => {
  return (user.name || 'A')
    .charAt(0)
    .toUpperCase()
})


// ==============================
// DATA DUMMY
// ==============================

const books = ref([
  {
    id: 1,
    title: 'Laravel From Zero',
    author: 'Muhammad Rizky',
    category: 'Pemrograman',
    year: 2025,
    stock: 12,
    isbn: 'ISBN 978-602-1111'
  },
  {
    id: 2,
    title: 'Modern JavaScript',
    author: 'Andi Pratama',
    category: 'Pemrograman',
    year: 2024,
    stock: 8,
    isbn: 'ISBN 978-602-2222'
  },
  {
    id: 3,
    title: 'Database Mastery',
    author: 'Budi Santoso',
    category: 'Database',
    year: 2023,
    stock: 4,
    isbn: 'ISBN 978-602-3333'
  },
  {
    id: 4,
    title: 'UI/UX Design',
    author: 'Sarah Putri',
    category: 'Desain',
    year: 2025,
    stock: 7,
    isbn: 'ISBN 978-602-4444'
  },
  {
    id: 5,
    title: 'Belajar Vue.js',
    author: 'Dimas Saputra',
    category: 'Pemrograman',
    year: 2025,
    stock: 2,
    isbn: 'ISBN 978-602-5555'
  },
  {
    id: 6,
    title: 'Algoritma & Pemrograman',
    author: 'Fajar Nugroho',
    category: 'Pemrograman',
    year: 2022,
    stock: 0,
    isbn: 'ISBN 978-602-6666'
  },
  {
    id: 7,
    title: 'Sejarah Indonesia',
    author: 'Siti Rahma',
    category: 'Sejarah',
    year: 2021,
    stock: 9,
    isbn: 'ISBN 978-602-7777'
  },
  {
    id: 8,
    title: 'Dasar-Dasar Sains',
    author: 'Agus Wijaya',
    category: 'Sains',
    year: 2023,
    stock: 5,
    isbn: 'ISBN 978-602-8888'
  }
])


// ==============================
// CATEGORY
// ==============================

const categories = computed(() => {
  return [...new Set(
    books.value.map(book => book.category)
  )]
})


// ==============================
// SEARCH & FILTER
// ==============================

const search = ref('')
const selectedCategory = ref('')

const filteredBooks = computed(() => {

  const keyword = search.value
    .toLowerCase()
    .trim()

  return books.value.filter(book => {

    const matchSearch =
      book.title.toLowerCase().includes(keyword) ||
      book.author.toLowerCase().includes(keyword)

    const matchCategory =
      !selectedCategory.value ||
      book.category === selectedCategory.value

    return matchSearch && matchCategory
  })
})


// ==============================
// STATISTIK
// ==============================

const availableBooks = computed(() => {
  return books.value.filter(book => book.stock > 0).length
})

const lowStockBooks = computed(() => {
  return books.value.filter(
    book => book.stock > 0 && book.stock <= 3
  ).length
})


// ==============================
// STATUS
// ==============================

function getStatus(stock) {

  if (stock === 0) {
    return 'Habis'
  }

  if (stock <= 3) {
    return 'Menipis'
  }

  return 'Tersedia'
}

function getStatusClass(stock) {

  if (stock === 0) {
    return 'empty-status'
  }

  if (stock <= 3) {
    return 'low-status'
  }

  return 'available-status'
}


// ==============================
// MODAL
// ==============================

const showModal = ref(false)
const showDetail = ref(false)
const isEditing = ref(false)

const selectedBook = ref(null)

const form = reactive({
  id: null,
  title: '',
  author: '',
  category: '',
  year: '',
  stock: 0,
  isbn: ''
})


// ==============================
// TAMBAH BUKU
// ==============================

function openAddModal() {

  isEditing.value = false

  form.id = null
  form.title = ''
  form.author = ''
  form.category = ''
  form.year = ''
  form.stock = 0
  form.isbn = ''

  showModal.value = true
}


// ==============================
// EDIT BUKU
// ==============================

function editBook(book) {

  isEditing.value = true

  form.id = book.id
  form.title = book.title
  form.author = book.author
  form.category = book.category
  form.year = book.year
  form.stock = book.stock
  form.isbn = book.isbn

  showModal.value = true
}


// ==============================
// SIMPAN
// ==============================

function saveBook() {

  if (
    !form.title ||
    !form.author ||
    !form.category
  ) {
    alert('Judul, penulis, dan kategori wajib diisi.')
    return
  }

  if (isEditing.value) {

    const index = books.value.findIndex(
      book => book.id === form.id
    )

    if (index !== -1) {
      books.value[index] = {
        ...form
      }
    }

  } else {

    const newId =
      Math.max(...books.value.map(book => book.id)) + 1

    books.value.unshift({
      id: newId,
      title: form.title,
      author: form.author,
      category: form.category,
      year: form.year || 2026,
      stock: Number(form.stock) || 0,
      isbn: form.isbn || '-'
    })

  }

  closeModal()
}


// ==============================
// HAPUS
// ==============================

function deleteBook(id) {

  const book = books.value.find(
    book => book.id === id
  )

  if (!book) return

  const confirmDelete = window.confirm(
    `Hapus buku "${book.title}"?`
  )

  if (!confirmDelete) return

  books.value = books.value.filter(
    book => book.id !== id
  )
}


// ==============================
// DETAIL
// ==============================

function viewBook(book) {

  selectedBook.value = book
  showDetail.value = true

}


// ==============================
// CLOSE MODAL
// ==============================

function closeModal() {
  showModal.value = false
}


// ==============================
// KE PERPUSTAKAAN
// ==============================

function goToLibrary() {
  router.push('/')
}


// ==============================
// LOGOUT
// ==============================

async function logout() {

  try {
    await api.post('/logout')
  } catch (error) {
    console.log('Logout API:', error)
  } finally {

    localStorage.removeItem('token')
    localStorage.removeItem('user')

    router.push('/login')
  }
}
</script>


<style scoped>
* {
  box-sizing: border-box;
}

/* =========================
   PAGE
========================= */

.admin-page {
  min-height: 100vh;
  display: flex;
  position: relative;
  overflow: hidden;
  color: #e8eefc;
  background:
    radial-gradient(
      circle at 85% 5%,
      rgba(59,130,246,.12),
      transparent 25%
    ),
    #080d18;
}

/* =========================
   ORB
========================= */

.orb {
  position: fixed;
  width: 240px;
  height: 240px;
  border-radius: 50%;
  filter: blur(80px);
  opacity: .1;
  pointer-events: none;
}

.orb-1 {
  top: -120px;
  right: 10%;
  background: #2563eb;
}

.orb-2 {
  bottom: -150px;
  left: 20%;
  background: #7c3aed;
}

/* =========================
   SIDEBAR
========================= */

.sidebar {
  width: 230px;
  min-height: 100vh;
  padding: 24px 15px;
  display: flex;
  flex-direction: column;
  position: relative;
  z-index: 2;
  background: rgba(10,17,30,.92);
  border-right: 1px solid rgba(255,255,255,.06);
}

.brand {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 0 8px 28px;
}

.brand-icon {
  width: 42px;
  height: 42px;
  display: grid;
  place-items: center;
  border-radius: 12px;
  background: linear-gradient(
    135deg,
    #2563eb,
    #7c3aed
  );
  box-shadow:
    0 7px 20px rgba(37,99,235,.18);
}

.brand h2 {
  margin: 0;
  font-size: 18px;
}

.brand span {
  color: #687791;
  font-size: 8px;
  letter-spacing: 1.5px;
}

/* MENU */

.menu {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.menu-item {
  width: 100%;
  border: 0;
  border-radius: 10px;
  padding: 11px 13px;
  display: flex;
  align-items: center;
  gap: 11px;
  background: transparent;
  color: #8290aa;
  text-decoration: none;
  font: inherit;
  font-size: 12px;
  text-align: left;
  cursor: pointer;
  transition: .2s;
}

.menu-item:hover,
.menu-item.active {
  color: #fff;
  background: rgba(79,117,255,.12);
}

.menu-item.active {
  box-shadow: inset 3px 0 #5b7cff;
}

.menu-item span {
  width: 22px;
  text-align: center;
}

/* BOTTOM */

.sidebar-bottom {
  margin-top: auto;
  display: grid;
  gap: 8px;
}

.library-button,
.logout-button {
  width: 100%;
  border-radius: 10px;
  padding: 11px;
  display: flex;
  align-items: center;
  gap: 9px;
  border: 1px solid;
  cursor: pointer;
  font-size: 11px;
  transition: .2s;
}

.library-button {
  color: #9fc3ff;
  background: rgba(59,130,246,.08);
  border-color: rgba(59,130,246,.18);
}

.logout-button {
  color: #ff9b9b;
  background: rgba(239,68,68,.07);
  border-color: rgba(239,68,68,.14);
}

.library-button:hover,
.logout-button:hover {
  transform: translateY(-2px);
}

/* =========================
   MAIN
========================= */

.main-content {
  flex: 1;
  min-width: 0;
  padding: 30px 35px;
  overflow-y: auto;
}

/* =========================
   TOPBAR
========================= */

.topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 25px;
}

.welcome {
  margin: 0 0 5px;
  color: #71809d;
  font-size: 10px;
}

.topbar h1 {
  margin: 0;
  font-size: 27px;
  letter-spacing: -.5px;
}

.subtitle {
  margin: 5px 0 0;
  color: #697793;
  font-size: 12px;
}

.top-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}

.top-library {
  border: 1px solid rgba(96,165,250,.2);
  background: rgba(96,165,250,.07);
  color: #a9caff;
  border-radius: 9px;
  padding: 9px 13px;
  cursor: pointer;
  font-size: 11px;
}

.admin-profile {
  display: flex;
  align-items: center;
  gap: 9px;
}

.avatar {
  width: 38px;
  height: 38px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  background: linear-gradient(
    135deg,
    #2563eb,
    #7c3aed
  );
  font-weight: 700;
}

.admin-info {
  display: flex;
  flex-direction: column;
}

.admin-info strong {
  font-size: 11px;
}

.admin-info span {
  margin-top: 2px;
  color: #697793;
  font-size: 9px;
}

/* =========================
   STATISTICS
========================= */

.stats {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 13px;
  margin-bottom: 18px;
}

.stat-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 16px;
  border: 1px solid rgba(255,255,255,.06);
  border-radius: 15px;
  background: rgba(17,25,43,.7);
}

.stat-icon {
  width: 40px;
  height: 40px;
  display: grid;
  place-items: center;
  border-radius: 11px;
  font-size: 16px;
}

.blue {
  background: rgba(59,130,246,.12);
}

.green {
  background: rgba(34,197,94,.12);
}

.orange {
  background: rgba(249,115,22,.12);
}

.purple {
  background: rgba(139,92,246,.12);
}

.stat-card span {
  color: #71809d;
  font-size: 10px;
}

.stat-card h2 {
  margin: 3px 0;
  font-size: 22px;
}

.stat-card small {
  color: #66738c;
  font-size: 8px;
}

/* =========================
   PANEL
========================= */

.panel {
  padding: 20px;
  border: 1px solid rgba(255,255,255,.06);
  border-radius: 16px;
  background: rgba(14,22,38,.78);
}

.panel-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 15px;
  margin-bottom: 18px;
}

.panel-header h3 {
  margin: 0;
  font-size: 15px;
}

.panel-header p {
  margin: 5px 0 0;
  color: #687691;
  font-size: 9px;
}

/* =========================
   ADD BUTTON
========================= */

.add-button {
  border: 0;
  border-radius: 9px;
  padding: 10px 14px;
  display: flex;
  align-items: center;
  gap: 6px;
  background: linear-gradient(
    135deg,
    #2563eb,
    #4f46e5
  );
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  cursor: pointer;
}

.add-button span {
  font-size: 16px;
}

/* =========================
   FILTER
========================= */

.filter-area {
  display: flex;
  gap: 10px;
  margin-bottom: 15px;
}

.search-box {
  flex: 1;
  height: 38px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 0 12px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 9px;
  background: rgba(255,255,255,.025);
}

.search-box span {
  color: #71809d;
  font-size: 18px;
}

.search-box input {
  width: 100%;
  border: 0;
  outline: 0;
  background: transparent;
  color: #fff;
  font-size: 11px;
}

.search-box input::placeholder {
  color: #596780;
}

.category-select {
  width: 170px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 9px;
  padding: 0 10px;
  outline: 0;
  background: #111a2b;
  color: #aab7cc;
  font-size: 10px;
}

/* =========================
   TABLE
========================= */

.table-wrapper {
  width: 100%;
  overflow-x: auto;
}

table {
  width: 100%;
  min-width: 850px;
  border-collapse: collapse;
}

thead {
  background: rgba(255,255,255,.025);
}

th {
  padding: 11px 10px;
  color: #66738c;
  font-size: 8px;
  font-weight: 600;
  text-align: left;
  letter-spacing: .5px;
}

td {
  padding: 12px 10px;
  border-top: 1px solid rgba(255,255,255,.04);
  font-size: 10px;
}

tbody tr {
  transition: .15s;
}

tbody tr:hover {
  background: rgba(255,255,255,.02);
}

.number {
  color: #596780;
}

/* BOOK CELL */

.book-cell {
  display: flex;
  align-items: center;
  gap: 9px;
}

.book-cover {
  width: 35px;
  height: 44px;
  display: grid;
  place-items: center;
  border-radius: 5px;
  font-size: 13px;
}

.cover-1 {
  background: linear-gradient(145deg,#2563eb,#111827);
}

.cover-2 {
  background: linear-gradient(145deg,#7c3aed,#111827);
}

.cover-3 {
  background: linear-gradient(145deg,#059669,#111827);
}

.cover-4 {
  background: linear-gradient(145deg,#ea580c,#111827);
}

.book-title {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.book-title strong {
  color: #edf2ff;
  font-size: 10px;
}

.book-title span {
  color: #596780;
  font-size: 7px;
}

.author {
  color: #a0abc0;
}

.category-badge {
  padding: 5px 8px;
  border-radius: 6px;
  background: rgba(96,165,250,.08);
  color: #8fbaff;
  font-size: 8px;
}

.year {
  color: #8290aa;
}

.stock {
  color: #dce6f8;
}

/* STATUS */

.status {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 5px 8px;
  border-radius: 20px;
  font-size: 8px;
}

.status i {
  width: 5px;
  height: 5px;
  border-radius: 50%;
}

.available-status {
  color: #70df9a;
  background: rgba(34,197,94,.08);
}

.available-status i {
  background: #22c55e;
}

.low-status {
  color: #ffc56b;
  background: rgba(249,115,22,.08);
}

.low-status i {
  background: #f97316;
}

.empty-status {
  color: #ff8c8c;
  background: rgba(239,68,68,.08);
}

.empty-status i {
  background: #ef4444;
}

/* ACTION */

.actions {
  display: flex;
  gap: 5px;
}

.action {
  width: 27px;
  height: 27px;
  border: 1px solid rgba(255,255,255,.06);
  border-radius: 7px;
  display: grid;
  place-items: center;
  background: rgba(255,255,255,.025);
  cursor: pointer;
  font-size: 10px;
}

.action:hover {
  background: rgba(255,255,255,.08);
}

.delete:hover {
  border-color: rgba(239,68,68,.3);
}

/* EMPTY */

.empty {
  padding: 45px 20px;
  text-align: center;
}

.empty-icon {
  font-size: 30px;
  margin-bottom: 8px;
}

.empty strong {
  display: block;
  font-size: 12px;
}

.empty span {
  display: block;
  margin-top: 5px;
  color: #687691;
  font-size: 9px;
}

/* FOOTER */

.table-footer {
  padding-top: 14px;
  color: #596780;
  font-size: 9px;
}

.table-footer strong {
  color: #8da0bd;
}

/* =========================
   MODAL
========================= */

.modal-overlay {
  position: fixed;
  inset: 0;
  z-index: 20;
  display: grid;
  place-items: center;
  padding: 20px;
  background: rgba(2,6,15,.75);
}

.modal,
.detail-modal {
  width: min(560px,100%);
  max-height: 90vh;
  overflow-y: auto;
  padding: 22px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 18px;
  background: #101827;
  box-shadow: 0 25px 70px rgba(0,0,0,.4);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 20px;
}

.modal-label {
  color: #6fa5ff;
  font-size: 8px;
  letter-spacing: 1.5px;
}

.modal h2,
.detail-modal h2 {
  margin: 5px 0 0;
  font-size: 20px;
}

.close-button {
  width: 30px;
  height: 30px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 8px;
  background: rgba(255,255,255,.04);
  color: #9aa9c2;
  font-size: 19px;
  cursor: pointer;
}

/* FORM */

.form {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 13px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.form-group.full {
  grid-column: 1 / -1;
}

.form-group label {
  color: #8190aa;
  font-size: 9px;
}

.form-group input,
.form-group select {
  height: 38px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 8px;
  outline: none;
  padding: 0 10px;
  background: rgba(255,255,255,.035);
  color: #fff;
  font-size: 10px;
}

.form-group input:focus,
.form-group select:focus {
  border-color: rgba(96,165,250,.4);
}

.form-group input::placeholder {
  color: #53617a;
}

/* MODAL FOOTER */

.modal-footer {
  display: flex;
  justify-content: flex-end;
  gap: 8px;
  margin-top: 20px;
}

.cancel-button,
.save-button {
  border-radius: 8px;
  padding: 10px 15px;
  cursor: pointer;
  font-size: 10px;
}

.cancel-button {
  border: 1px solid rgba(255,255,255,.07);
  background: transparent;
  color: #8997ae;
}

.save-button {
  border: 0;
  background: linear-gradient(
    135deg,
    #2563eb,
    #4f46e5
  );
  color: #fff;
}

/* =========================
   DETAIL
========================= */

.detail-modal {
  width: min(400px,100%);
  position: relative;
  text-align: center;
}

.detail-modal .close-button {
  position: absolute;
  top: 15px;
  right: 15px;
}

.detail-cover {
  width: 90px;
  height: 115px;
  display: grid;
  place-items: center;
  margin: 5px auto 18px;
  border-radius: 10px;
  background: linear-gradient(
    145deg,
    #2563eb,
    #312e81
  );
  font-size: 35px;
  box-shadow:
    0 15px 30px rgba(37,99,235,.2);
}

.detail-author {
  margin: 5px 0 20px;
  color: #71809d;
  font-size: 11px;
}

.detail-info {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
  text-align: left;
}

.detail-info div {
  padding: 11px;
  border-radius: 9px;
  background: rgba(255,255,255,.03);
}

.detail-info span,
.detail-info strong {
  display: block;
}

.detail-info span {
  color: #66738c;
  font-size: 8px;
}

.detail-info strong {
  margin-top: 4px;
  color: #dce6f8;
  font-size: 10px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1050px) {

  .stats {
    grid-template-columns: repeat(2,1fr);
  }

}

@media (max-width: 800px) {

  .sidebar {
    width: 65px;
    padding: 20px 8px;
  }

  .brand {
    justify-content: center;
    padding-left: 0;
    padding-right: 0;
  }

  .brand-text {
    display: none;
  }

  .menu-item {
    justify-content: center;
    padding: 12px;
    font-size: 0;
  }

  .menu-item span {
    font-size: 17px;
  }

  .library-button,
  .logout-button {
    justify-content: center;
  }

  .library-button span:last-child,
  .logout-button span:last-child {
    display: none;
  }

  .main-content {
    padding: 22px 17px;
  }

  .admin-info {
    display: none;
  }

  .form {
    grid-template-columns: 1fr;
  }

  .form-group.full {
    grid-column: auto;
  }

}

@media (max-width: 600px) {

  .stats {
    grid-template-columns: 1fr;
  }

  .top-actions {
    display: none;
  }

  .topbar h1 {
    font-size: 23px;
  }

  .panel-header {
    align-items: flex-start;
    flex-direction: column;
  }

  .add-button {
    width: 100%;
    justify-content: center;
  }

  .filter-area {
    flex-direction: column;
  }

  .category-select {
    width: 100%;
    height: 38px;
  }

}
</style>