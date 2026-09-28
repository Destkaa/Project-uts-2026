<template>
  <div class="admin-page">

    <!-- BACKGROUND -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- SIDEBAR -->
    <SidebarAdmin />

    <!-- MAIN -->
    <main class="main-content">

      <!-- TOPBAR -->
      <header class="topbar">
        <div>
          <p class="welcome">Dashboard Admin / Data Buku</p>
          <h1>Data Buku</h1>
          <p class="subtitle">
            Kelola koleksi buku perpustakaan kamu.
          </p>
        </div>

        <div class="top-actions">
          <button class="top-library" @click="goToLibrary">
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

      <!-- STATISTIK -->
      <section class="stats">

        <div class="stat-card">
          <div class="stat-icon blue">📚</div>

          <div>
            <span>Total Buku</span>
            <h2>{{ books.length }}</h2>
            <small>Semua koleksi</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon green">✓</div>

          <div>
            <span>Buku Tersedia</span>
            <h2>{{ availableBooks }}</h2>
            <small>Stok tersedia</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon orange">⚠️</div>

          <div>
            <span>Stok Menipis</span>
            <h2>{{ lowStockBooks }}</h2>
            <small>Perlu diperhatikan</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon purple">🏷️</div>

          <div>
            <span>Kategori</span>
            <h2>{{ categories.length }}</h2>
            <small>Kategori buku</small>
          </div>
        </div>

      </section>

      <!-- DATA BUKU -->
      <section class="panel">

        <div class="panel-header">
          <div>
            <h3>Koleksi Buku</h3>
            <p>
              Daftar seluruh buku yang tersedia di perpustakaan.
            </p>
          </div>

          <button class="add-button" @click="openAddModal">
            <span>＋</span>
            Tambah Buku
          </button>
        </div>

        <!-- FILTER -->
        <div class="filter-area">

          <div class="search-box">
            <span>⌕</span>

            <input
              v-model="search"
              type="text"
              placeholder="Cari judul atau penulis..."
            />
          </div>

          <select
            v-model="selectedCategory"
            class="category-select"
          >
            <option value="">
              Semua Kategori
            </option>

            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.nama }}
            </option>
          </select>

        </div>

        <!-- TABLE -->
        <div class="table-wrapper">
          <table>

            <thead>
              <tr>
                <th>#</th>
                <th>BUKU</th>
                <th>PENULIS</th>
                <th>KATEGORI</th>
                <th>STOK</th>
                <th>STATUS</th>
                <th>AKSI</th>
              </tr>
            </thead>

            <tbody>

              <!-- LOADING -->
              <tr v-if="loading">
                <td colspan="7" class="empty">
                  <div class="empty-icon">⏳</div>
                  <strong>Memuat data buku...</strong>
                </td>
              </tr>

              <!-- DATA -->
              <tr
                v-for="(book, index) in filteredBooks"
                :key="book.id"
              >

                <td class="number">
                  {{ index + 1 }}
                </td>

                <td>
                  <div class="book-cell">

                    <div
                      class="book-cover"
                      :class="'cover-' + ((book.id % 4) + 1)"
                    >
                      <img
                        v-if="book.gambar"
                        :src="getImageUrl(book.gambar)"
                        alt="Cover buku"
                      />

                      <span v-else>📖</span>
                    </div>

                    <div class="book-title">
                      <strong>{{ book.judul }}</strong>
                      <span>ID #{{ book.id }}</span>
                    </div>

                  </div>
                </td>

                <td>
                  <span class="author">
                    {{ book.penulis }}
                  </span>
                </td>

                <td>
                  <span class="category-badge">
                    {{ book.kategori?.nama || '-' }}
                  </span>
                </td>

                <td>
                  <strong class="stock">
                    {{ book.stok }}
                  </strong>
                </td>

                <td>
                  <span
                    class="status"
                    :class="getStatusClass(book.stok)"
                  >
                    <i></i>
                    {{ getStatus(book.stok) }}
                  </span>
                </td>

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
              <tr
                v-if="!loading && filteredBooks.length === 0"
              >
                <td colspan="7" class="empty">

                  <div class="empty-icon">
                    📚
                  </div>

                  <strong>
                    Buku tidak ditemukan
                  </strong>

                  <span>
                    Belum ada data buku.
                  </span>

                </td>
              </tr>

            </tbody>

          </table>
        </div>

        <div class="table-footer">
          Menampilkan
          <strong>{{ filteredBooks.length }}</strong>
          dari
          <strong>{{ books.length }}</strong>
          buku
        </div>

      </section>

    </main>

    <!-- MODAL TAMBAH / EDIT -->
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
            <label>Judul Buku</label>

            <input
              v-model="form.judul"
              type="text"
              placeholder="Masukkan judul buku"
            />
          </div>

          <!-- PENULIS -->
          <div class="form-group">
            <label>Penulis</label>

            <input
              v-model="form.penulis"
              type="text"
              placeholder="Nama penulis"
            />
          </div>

          <!-- KATEGORI -->
          <div class="form-group">
            <label>Kategori</label>

            <select v-model="form.kategori_id">
              <option value="">
                Pilih kategori
              </option>

              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.nama }}
              </option>
            </select>
          </div>

          <!-- STOK -->
          <div class="form-group">
            <label>Stok</label>

            <input
              v-model="form.stok"
              type="number"
              min="0"
              placeholder="0"
            />
          </div>

          <!-- GAMBAR -->
          <div class="form-group">
            <label>Gambar Buku</label>

            <input
              type="file"
              accept="image/*"
              @change="form.gambar = $event.target.files[0]"
            />
          </div>

          <!-- DESKRIPSI -->
          <div class="form-group full">
            <label>Deskripsi</label>

            <textarea
              v-model="form.deskripsi"
              placeholder="Deskripsi buku..."
              rows="4"
            ></textarea>
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
            :disabled="saving"
          >
            {{
              saving
                ? 'Menyimpan...'
                : isEditing
                  ? 'Simpan Perubahan'
                  : 'Tambah Buku'
            }}
          </button>

        </div>

      </div>
    </div>

    <!-- MODAL DETAIL -->
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

          <img
            v-if="selectedBook?.gambar"
            :src="getImageUrl(selectedBook.gambar)"
            alt="Cover buku"
          />

          <span v-else>📖</span>

        </div>

        <span class="modal-label">
          DETAIL BUKU
        </span>

        <h2>
          {{ selectedBook?.judul }}
        </h2>

        <p class="detail-author">
          {{ selectedBook?.penulis }}
        </p>

        <div class="detail-info">

          <div>
            <span>Kategori</span>

            <strong>
              {{ selectedBook?.kategori?.nama || '-' }}
            </strong>
          </div>

          <div>
            <span>Stok</span>

            <strong>
              {{ selectedBook?.stok }}
            </strong>
          </div>

          <div>
            <span>Deskripsi</span>

            <strong>
              {{ selectedBook?.deskripsi || '-' }}
            </strong>
          </div>

          <div>
            <span>ID Buku</span>

            <strong>
              #{{ selectedBook?.id }}
            </strong>
          </div>

        </div>

      </div>

    </div>

  </div>
</template>


<script setup>
import { computed, onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import SidebarAdmin from '../../components/SidebarAdmin.vue'
import api from '../../utils/api'

const router = useRouter()

/* USER */
const user = JSON.parse(
  localStorage.getItem('user') || '{}'
)

const adminName = computed(() =>
  user.name || 'Administrator'
)

const adminInitial = computed(() =>
  adminName.value.charAt(0).toUpperCase()
)

/* DATA */
const books = ref([])
const categories = ref([])

const loading = ref(false)
const saving = ref(false)

const search = ref('')
const selectedCategory = ref('')

/* FILTER */
const filteredBooks = computed(() => {
  const keyword = search.value.toLowerCase().trim()

  return books.value.filter(book => {

    const matchSearch =
      (book.judul || '')
        .toLowerCase()
        .includes(keyword) ||
      (book.penulis || '')
        .toLowerCase()
        .includes(keyword)

    const matchCategory =
      !selectedCategory.value ||
      String(book.kategori_id) ===
      String(selectedCategory.value)

    return matchSearch && matchCategory
  })
})

/* STATISTIK */
const availableBooks = computed(() =>
  books.value.filter(
    book => Number(book.stok) > 0
  ).length
)

const lowStockBooks = computed(() =>
  books.value.filter(book => {
    const stok = Number(book.stok)

    return stok > 0 && stok <= 3
  }).length
)

/* STATUS */
function getStatus(stok) {
  stok = Number(stok)

  if (stok === 0) return 'Habis'
  if (stok <= 3) return 'Menipis'

  return 'Tersedia'
}

function getStatusClass(stok) {
  stok = Number(stok)

  if (stok === 0) return 'empty-status'
  if (stok <= 3) return 'low-status'

  return 'available-status'
}

/* GAMBAR */
function getImageUrl(gambar) {
  if (!gambar) return ''

  return `http://localhost:8000/storage/${gambar}`
}

/* AMBIL BUKU */
async function fetchBooks() {
  loading.value = true

  try {
    const res = await api.get('/buku')

    books.value = res.data.data?.data || []
  } catch (error) {
    console.error(error)

    alert(
      error.response?.data?.message ||
      'Gagal mengambil data buku.'
    )
  } finally {
    loading.value = false
  }
}

/* AMBIL KATEGORI */
async function fetchCategories() {
  try {
    const res = await api.get('/kategori')

    categories.value =
      res.data.data?.data ||
      res.data.data ||
      []
  } catch (error) {
    console.error(error)
  }
}

/* MODAL */
const showModal = ref(false)
const showDetail = ref(false)
const isEditing = ref(false)

const selectedBook = ref(null)

/* FORM */
const form = reactive({
  id: null,
  judul: '',
  penulis: '',
  kategori_id: '',
  stok: 0,
  deskripsi: '',
  gambar: null
})

function resetForm() {
  form.id = null
  form.judul = ''
  form.penulis = ''
  form.kategori_id = ''
  form.stok = 0
  form.deskripsi = ''
  form.gambar = null
}

/* TAMBAH */
function openAddModal() {
  resetForm()

  isEditing.value = false
  showModal.value = true
}

/* EDIT */
function editBook(book) {
  form.id = book.id
  form.judul = book.judul
  form.penulis = book.penulis
  form.kategori_id = book.kategori_id || ''
  form.stok = book.stok
  form.deskripsi = book.deskripsi || ''
  form.gambar = null

  isEditing.value = true
  showModal.value = true
}

/* SIMPAN */
async function saveBook() {

  if (
    !form.judul ||
    !form.penulis ||
    !form.kategori_id
  ) {
    alert(
      'Judul, penulis, dan kategori wajib diisi.'
    )

    return
  }

  saving.value = true

  try {

    const data = new FormData()

    data.append('judul', form.judul)
    data.append('penulis', form.penulis)
    data.append('kategori_id', form.kategori_id)
    data.append('stok', form.stok)
    data.append(
      'deskripsi',
      form.deskripsi || ''
    )

    if (form.gambar) {
      data.append('gambar', form.gambar)
    }

    if (isEditing.value) {

      data.append('_method', 'PUT')

      await api.post(
        `/buku/${form.id}`,
        data
      )

      alert('Buku berhasil diperbarui.')

    } else {

      await api.post('/buku', data)

      alert('Buku berhasil ditambahkan.')
    }

    closeModal()
    await fetchBooks()

  } catch (error) {

    console.error(error)

    alert(
      error.response?.data?.message ||
      'Gagal menyimpan buku.'
    )

  } finally {
    saving.value = false
  }
}

/* HAPUS */
async function deleteBook(id) {

  const book = books.value.find(
    book => book.id === id
  )

  if (!book) return

  if (
    !confirm(
      `Hapus buku "${book.judul}"?`
    )
  ) {
    return
  }

  try {

    await api.delete(`/buku/${id}`)

    alert('Buku berhasil dihapus.')

    await fetchBooks()

  } catch (error) {

    console.error(error)

    alert(
      error.response?.data?.message ||
      'Gagal menghapus buku.'
    )
  }
}

/* DETAIL */
async function viewBook(book) {

  try {

    const res = await api.get(
      `/buku/${book.id}`
    )

    selectedBook.value = res.data.data

    showDetail.value = true

  } catch (error) {

    console.error(error)

    alert(
      error.response?.data?.message ||
      'Gagal mengambil detail buku.'
    )
  }
}

/* TUTUP MODAL */
function closeModal() {
  showModal.value = false
}

/* KE HALAMAN PERPUSTAKAAN */
function goToLibrary() {
  router.push('/')
}

/* LOGOUT */
async function logout() {

  try {
    await api.post('/logout')
  } catch (error) {
    console.log(error)
  }

  localStorage.removeItem('token')
  localStorage.removeItem('user')

  router.push('/login')
}

/* LOAD DATA */
onMounted(() => {
  fetchBooks()
  fetchCategories()
})
</script>

<style scoped>
.admin-page {
  min-height: 100vh;
  display: flex;
  position: relative;
  overflow: hidden;
  background: #08111f;
  color: #e5eefc;
}

.orb {
  position: fixed;
  width: 350px;
  height: 350px;
  border-radius: 50%;
  filter: blur(100px);
  opacity: .15;
  pointer-events: none;
}

.orb-1 {
  background: #2563eb;
  top: -150px;
  right: -100px;
}

.orb-2 {
  background: #7c3aed;
  bottom: -150px;
  left: 250px;
}

.sidebar {
  width: 250px;
  min-height: 100vh;
  padding: 28px 18px;
  background: rgba(9, 20, 36, .88);
  border-right: 1px solid rgba(255,255,255,.08);
  backdrop-filter: blur(20px);
  position: fixed;
  left: 0;
  top: 0;
  z-index: 10;
}

.brand {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 40px;
}

.brand-icon {
  width: 45px;
  height: 45px;
  display: grid;
  place-items: center;
  border-radius: 14px;
  background: rgba(59,130,246,.18);
  font-size: 23px;
}

.brand-text h2 {
  margin: 0;
  font-size: 20px;
}

.brand-text span {
  font-size: 9px;
  color: #60a5fa;
  letter-spacing: 2px;
}

.menu {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.menu-item {
  width: 100%;
  padding: 13px 15px;
  border: 0;
  border-radius: 12px;
  background: transparent;
  color: #94a3b8;
  text-decoration: none;
  text-align: left;
  font-size: 14px;
  cursor: pointer;
  transition: .25s;
}

.menu-item span {
  margin-right: 10px;
}

.menu-item:hover,
.menu-item.active {
  color: white;
  background: rgba(59,130,246,.16);
}

.sidebar-bottom {
  position: absolute;
  bottom: 25px;
  left: 18px;
  right: 18px;
}

.library-button,
.logout-button {
  width: 100%;
  padding: 12px;
  border: 0;
  border-radius: 12px;
  background: transparent;
  color: #94a3b8;
  text-align: left;
  cursor: pointer;
  margin-top: 7px;
}

.library-button:hover,
.logout-button:hover {
  background: rgba(255,255,255,.06);
  color: white;
}

.library-button span,
.logout-button span {
  margin-right: 8px;
}

.main-content {
  width: calc(100% - 250px);
  margin-left: 250px;
  padding: 35px;
  position: relative;
  z-index: 1;
}

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 30px;
}

.welcome {
  margin: 0 0 5px;
  color: #60a5fa;
  font-size: 13px;
}

.topbar h1 {
  margin: 0;
  font-size: 34px;
}

.subtitle {
  margin: 7px 0 0;
  color: #64748b;
}

.top-actions {
  display: flex;
  align-items: center;
  gap: 15px;
}

.top-library {
  border: 1px solid rgba(255,255,255,.1);
  background: rgba(255,255,255,.05);
  color: white;
  padding: 11px 15px;
  border-radius: 12px;
  cursor: pointer;
}

.admin-profile {
  display: flex;
  align-items: center;
  gap: 10px;
}

.avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg,#2563eb,#7c3aed);
  font-weight: bold;
}

.admin-info {
  display: flex;
  flex-direction: column;
}

.admin-info span {
  color: #64748b;
  font-size: 11px;
}

.stats {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 18px;
  margin-bottom: 25px;
}

.stat-card {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 20px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 18px;
  background: rgba(15,29,48,.75);
  box-shadow: 0 15px 40px rgba(0,0,0,.15);
}

.stat-card span,
.stat-card small {
  color: #64748b;
}

.stat-card h2 {
  margin: 5px 0;
}

.stat-icon {
  width: 48px;
  height: 48px;
  display: grid;
  place-items: center;
  border-radius: 14px;
  font-size: 21px;
}

.stat-icon.blue {
  background: rgba(59,130,246,.15);
}

.stat-icon.green {
  background: rgba(34,197,94,.15);
}

.stat-icon.orange {
  background: rgba(249,115,22,.15);
}

.stat-icon.purple {
  background: rgba(168,85,247,.15);
}

.panel {
  background: rgba(12,25,42,.82);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 22px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0,0,0,.18);
}

.panel-header {
  padding: 25px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.panel-header h3 {
  margin: 0;
  font-size: 20px;
}

.panel-header p {
  margin: 6px 0 0;
  color: #64748b;
  font-size: 13px;
}

.add-button {
  border: 0;
  padding: 12px 17px;
  border-radius: 12px;
  background: linear-gradient(135deg,#2563eb,#3b82f6);
  color: white;
  cursor: pointer;
  font-weight: 600;
}

.filter-area {
  padding: 0 25px 20px;
  display: flex;
  gap: 12px;
}

.search-box {
  flex: 1;
  display: flex;
  align-items: center;
  gap: 10px;
  background: rgba(255,255,255,.04);
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 11px;
  padding: 0 13px;
}

.search-box input {
  width: 100%;
  padding: 12px 0;
  border: 0;
  outline: 0;
  background: transparent;
  color: white;
}

.category-select,
.form-group select,
.form-group input,
.form-group textarea {
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 10px;
  background: #101f34;
  color: white;
  outline: 0;
}

.category-select {
  padding: 12px;
  min-width: 180px;
}

.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th {
  padding: 13px 20px;
  color: #64748b;
  font-size: 11px;
  text-align: left;
  border-bottom: 1px solid rgba(255,255,255,.07);
}

td {
  padding: 16px 20px;
  border-bottom: 1px solid rgba(255,255,255,.05);
}

.number {
  color: #64748b;
}

.book-cell {
  display: flex;
  align-items: center;
  gap: 12px;
}

.book-cover {
  width: 45px;
  height: 58px;
  border-radius: 7px;
  display: grid;
  place-items: center;
  overflow: hidden;
  background: #172a46;
}

.book-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.book-title {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.book-title span {
  font-size: 11px;
  color: #64748b;
}

.author {
  color: #94a3b8;
}

.category-badge {
  padding: 5px 9px;
  border-radius: 8px;
  background: rgba(59,130,246,.12);
  color: #60a5fa;
  font-size: 11px;
}

.stock {
  color: white;
}

.status {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  font-size: 12px;
}

.status i {
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: currentColor;
}

.available-status {
  color: #4ade80;
}

.low-status {
  color: #fb923c;
}

.empty-status {
  color: #f87171;
}

.actions {
  display: flex;
  gap: 6px;
}

.action {
  width: 34px;
  height: 34px;
  border: 0;
  border-radius: 9px;
  cursor: pointer;
  background: rgba(255,255,255,.05);
}

.action.view {
  color: #60a5fa;
}

.action.edit {
  color: #fbbf24;
}

.action.delete {
  color: #f87171;
}

.action:hover {
  background: rgba(255,255,255,.1);
}

.empty {
  text-align: center;
  padding: 45px !important;
  color: #64748b;
}

.empty-icon {
  font-size: 30px;
  margin-bottom: 10px;
}

.empty strong,
.empty span {
  display: block;
}

.table-footer {
  padding: 17px 25px;
  color: #64748b;
  font-size: 12px;
}

/* MODAL */
.modal-overlay {
  position: fixed;
  inset: 0;
  z-index: 100;
  display: grid;
  place-items: center;
  padding: 20px;
  background: rgba(0,0,0,.7);
  backdrop-filter: blur(8px);
}

.modal {
  width: min(650px,100%);
  max-height: 90vh;
  overflow-y: auto;
  background: #0d1b2d;
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 20px;
  box-shadow: 0 30px 80px rgba(0,0,0,.4);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  padding: 23px 25px;
  border-bottom: 1px solid rgba(255,255,255,.08);
}

.modal-header h2 {
  margin: 5px 0 0;
}

.modal-label {
  color: #60a5fa;
  font-size: 10px;
  letter-spacing: 2px;
}

.close-button {
  width: 35px;
  height: 35px;
  border: 0;
  border-radius: 9px;
  background: rgba(255,255,255,.06);
  color: white;
  font-size: 22px;
  cursor: pointer;
}

.form {
  padding: 25px;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 17px;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 7px;
}

.form-group.full {
  grid-column: 1 / -1;
}

.form-group label {
  font-size: 12px;
  color: #94a3b8;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 12px;
  box-sizing: border-box;
}

.form-group textarea {
  resize: vertical;
}

.modal-footer {
  padding: 18px 25px;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  border-top: 1px solid rgba(255,255,255,.08);
}

.cancel-button,
.save-button {
  padding: 11px 17px;
  border: 0;
  border-radius: 10px;
  cursor: pointer;
}

.cancel-button {
  background: rgba(255,255,255,.07);
  color: white;
}

.save-button {
  background: linear-gradient(135deg,#2563eb,#3b82f6);
  color: white;
}

.save-button:disabled {
  opacity: .6;
  cursor: not-allowed;
}

/* DETAIL */
.detail-modal {
  width: min(500px,100%);
  padding: 30px;
  position: relative;
  background: #0d1b2d;
  border: 1px solid rgba(255,255,255,.1);
  border-radius: 22px;
  box-shadow: 0 30px 80px rgba(0,0,0,.4);
}

.detail-modal > .close-button {
  position: absolute;
  top: 18px;
  right: 18px;
}

.detail-cover {
  width: 130px;
  height: 175px;
  margin: 0 auto 22px;
  border-radius: 10px;
  overflow: hidden;
  display: grid;
  place-items: center;
  background: #172a46;
  font-size: 40px;
}

.detail-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.detail-modal h2 {
  margin: 7px 0;
}

.detail-author {
  color: #94a3b8;
}

.detail-info {
  display: grid;
  gap: 12px;
  margin-top: 20px;
}

.detail-info div {
  padding: 13px;
  border-radius: 10px;
  background: rgba(255,255,255,.04);
}

.detail-info span {
  display: block;
  color: #64748b;
  font-size: 11px;
  margin-bottom: 5px;
}

.detail-info strong {
  color: #e2e8f0;
  font-size: 13px;
}

/* RESPONSIVE */
@media (max-width: 1100px) {
  .stats {
    grid-template-columns: repeat(2,1fr);
  }
}

@media (max-width: 800px) {
  .sidebar {
    width: 70px;
    padding: 20px 10px;
  }

  .brand-text,
  .menu-item:not(.active) {
    display: none;
  }

  .menu-item {
    text-align: center;
  }

  .menu-item span {
    margin: 0;
  }

  .sidebar-bottom {
    left: 10px;
    right: 10px;
  }

  .library-button span:last-child,
  .logout-button span:last-child {
    display: none;
  }

  .main-content {
    width: calc(100% - 70px);
    margin-left: 70px;
    padding: 20px;
  }

  .topbar {
    align-items: flex-start;
    gap: 15px;
  }

  .top-actions {
    flex-direction: column;
    align-items: flex-end;
  }
}

@media (max-width: 600px) {
  .stats {
    grid-template-columns: 1fr;
  }

  .top-library {
    display: none;
  }

  .admin-info {
    display: none;
  }

  .filter-area {
    flex-direction: column;
  }

  .category-select {
    width: 100%;
  }

  .panel-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }

  .form {
    grid-template-columns: 1fr;
  }

  .form-group.full {
    grid-column: auto;
  }
}
</style>