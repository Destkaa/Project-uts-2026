<template>
  <div class="page">
    <SidebarAdmin />

    <main class="main">
      <!-- TOPBAR -->
      <header class="topbar">
        <button class="toggle-btn" @click="sidebarCollapsed = !sidebarCollapsed">
          <i class="bi bi-list"></i>
        </button>

        <div class="topbar-title">
          <span>Management</span>
          <h1>Peminjaman</h1>
        </div>

        <div class="profile">
          <div class="avatar">{{ userInitial }}</div>
          <div class="profile-info">
            <strong>{{ currentUser?.name || 'Admin' }}</strong>
            <span>Administrator</span>
          </div>
        </div>
      </header>

      <!-- CONTENT -->
      <section class="content">
        <div class="page-header">
          <div>
            <span class="eyebrow">
              <i class="bi bi-journal-check"></i>
              Library Management
            </span>

            <h2>Daftar Peminjaman</h2>
            <p>Kelola data peminjaman buku perpustakaan.</p>
          </div>

          <button class="primary-btn" @click="openCreateModal">
            <i class="bi bi-plus-lg"></i>
            Tambah Peminjaman
          </button>
        </div>

        <!-- STATS -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue">
              <i class="bi bi-journal-text"></i>
            </div>
            <div>
              <span>Total Peminjaman</span>
              <strong>{{ books.length }}</strong>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon orange">
              <i class="bi bi-hourglass-split"></i>
            </div>
            <div>
              <span>Menunggu</span>
              <strong>{{ countStatus('pending') }}</strong>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon purple">
              <i class="bi bi-book-half"></i>
            </div>
            <div>
              <span>Disetujui</span>
              <strong>{{ countStatus('disetujui') }}</strong>
            </div>
          </div>

          <div class="stat-card">
            <div class="stat-icon green">
              <i class="bi bi-check-circle"></i>
            </div>
            <div>
              <span>Dikembalikan</span>
              <strong>{{ countStatus('dikembalikan') }}</strong>
            </div>
          </div>
        </div>

        <!-- TABLE -->
        <div class="table-card">
          <div class="table-toolbar">
            <div class="toolbar-title">
              <h3>Data Peminjaman</h3>
              <span>{{ filteredPeminjaman.length }} data</span>
            </div>

            <div class="toolbar-actions">
              <div class="search-box">
                <i class="bi bi-search"></i>
                <input
                  v-model="search"
                  type="text"
                  placeholder="Cari anggota atau buku..."
                />
              </div>

              <select v-model="statusFilter" class="filter-select">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="disetujui">Disetujui</option>
                <option value="ditolak">Ditolak</option>
                <option value="dikembalikan">Dikembalikan</option>
              </select>

              <button class="refresh-btn" @click="fetchPeminjaman">
                <i class="bi bi-arrow-clockwise"></i>
              </button>
            </div>
          </div>

          <!-- LOADING -->
          <div v-if="loading" class="state-box">
            <div class="spinner"></div>
            <p>Memuat data peminjaman...</p>
          </div>

          <!-- ERROR -->
          <div v-else-if="error" class="state-box error-state">
            <div class="state-icon">
              <i class="bi bi-exclamation-triangle"></i>
            </div>

            <h3>Gagal mengambil data</h3>
            <p>{{ error }}</p>

            <button class="secondary-btn" @click="fetchPeminjaman">
              <i class="bi bi-arrow-repeat"></i>
              Coba Lagi
            </button>
          </div>

          <!-- EMPTY -->
          <div
            v-else-if="filteredPeminjaman.length === 0"
            class="state-box"
          >
            <div class="state-icon">
              <i class="bi bi-journal-x"></i>
            </div>

            <h3>Belum ada peminjaman</h3>
            <p>Data peminjaman belum tersedia.</p>
          </div>

          <!-- TABLE -->
          <div v-else class="table-wrapper">
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Anggota</th>
                  <th>Buku</th>
                  <th>Tanggal Request</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Kembali</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr
                  v-for="(item, index) in filteredPeminjaman"
                  :key="item.id"
                >
                  <td>
                    <span class="number">{{ index + 1 }}</span>
                  </td>

                  <td>
                    <div class="member">
                      <div class="member-avatar">
                        {{ getUserInitial(item) }}
                      </div>

                      <div class="member-info">
                        <strong>{{ getUserName(item) }}</strong>
                        <span>ID #{{ item.user_id }}</span>
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="book-info">
                      <div class="book-cover">
                        <img
                          v-if="item.buku?.gambar"
                          :src="getImageUrl(item.buku.gambar)"
                          alt="Cover"
                        />

                        <i v-else class="bi bi-book"></i>
                      </div>

                      <div>
                        <strong>{{ getBookTitle(item) }}</strong>
                        <span>
                          {{ item.buku?.penulis || 'Penulis tidak tersedia' }}
                        </span>
                      </div>
                    </div>
                  </td>

                  <td>
                    <span class="date">
                      <i class="bi bi-calendar3"></i>
                      {{ formatDate(item.tanggal_request) }}
                    </span>
                  </td>

                  <td>
                    <span class="date">
                      <i class="bi bi-calendar-check"></i>
                      {{ formatDate(item.tanggal_pinjam) }}
                    </span>
                  </td>

                  <td>
                    <span class="date">
                      <i class="bi bi-calendar-x"></i>
                      {{ formatDate(item.tanggal_kembali) }}
                    </span>
                  </td>

                  <td>
                    <span class="status" :class="statusClass(item.status)">
                      <span></span>
                      {{ statusLabel(item.status) }}
                    </span>
                  </td>

                  <td>
                    <div class="actions">
                      <button
                        class="icon-btn detail"
                        title="Detail"
                        @click="showDetail(item)"
                      >
                        <i class="bi bi-eye"></i>
                      </button>

                      <button
                        class="icon-btn edit"
                        title="Edit"
                        @click="openEditModal(item)"
                      >
                        <i class="bi bi-pencil"></i>
                      </button>

                      <button
                        class="icon-btn delete"
                        title="Hapus"
                        @click="deletePeminjaman(item)"
                      >
                        <i class="bi bi-trash3"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>

    <!-- MODAL TAMBAH / EDIT -->
    <div
      v-if="showFormModal"
      class="modal-backdrop"
      @click.self="closeFormModal"
    >
      <div class="modal">
        <div class="modal-header">
          <div>
            <span class="modal-eyebrow">
              {{ editing ? 'EDIT DATA' : 'DATA BARU' }}
            </span>

            <h3>
              {{ editing ? 'Edit Peminjaman' : 'Tambah Peminjaman' }}
            </h3>
          </div>

          <button class="close-btn" @click="closeFormModal">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <form @submit.prevent="savePeminjaman">
          <div class="form-body">
            <!-- ANGGOTA -->
            <div class="form-group">
              <label>
                Anggota <span>*</span>
              </label>

              <select v-model="form.user_id" required>
                <option value="">Pilih anggota</option>

                <option
                  v-for="user in users"
                  :key="user.id"
                  :value="user.id"
                >
                  {{ user.name }}
                </option>
              </select>
            </div>

            <!-- BUKU -->
            <div class="form-group">
              <label>
                Buku <span>*</span>
              </label>

              <select v-model="form.buku_id" required>
                <option value="">Pilih buku</option>

                <option
                  v-for="book in availableBooks"
                  :key="book.id"
                  :value="book.id"
                >
                  {{ book.judul }} — Stok {{ book.stok }}
                </option>
              </select>
            </div>

            <!-- TANGGAL -->
            <div class="form-grid">
              <div class="form-group">
                <label>Tanggal Request <span>*</span></label>

                <input
                  v-model="form.tanggal_request"
                  type="date"
                  required
                />
              </div>

              <div class="form-group">
                <label>Tanggal Pinjam</label>

                <input
                  v-model="form.tanggal_pinjam"
                  type="date"
                />
              </div>
            </div>

            <div class="form-group">
              <label>Tanggal Kembali</label>

              <input
                v-model="form.tanggal_kembali"
                type="date"
              />
            </div>

            <!-- STATUS -->
            <div class="form-group">
              <label>Status <span>*</span></label>

              <select v-model="form.status" required>
                <option value="pending">Pending</option>
                <option value="disetujui">Disetujui</option>
                <option value="ditolak">Ditolak</option>
                <option value="dikembalikan">Dikembalikan</option>
              </select>
            </div>

            <div v-if="formError" class="form-error">
              <i class="bi bi-exclamation-circle"></i>
              {{ formError }}
            </div>
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="cancel-btn"
              @click="closeFormModal"
            >
              Batal
            </button>

            <button
              type="submit"
              class="primary-btn"
              :disabled="saving"
            >
              <span v-if="saving" class="mini-spinner"></span>

              <i v-else class="bi bi-check2"></i>

              {{ saving ? 'Menyimpan...' : 'Simpan Data' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- DETAIL MODAL -->
    <div
      v-if="showDetailModal"
      class="modal-backdrop"
      @click.self="showDetailModal = false"
    >
      <div class="modal detail-modal">
        <div class="modal-header">
          <div>
            <span class="modal-eyebrow">DETAIL</span>
            <h3>Detail Peminjaman</h3>
          </div>

          <button
            class="close-btn"
            @click="showDetailModal = false"
          >
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <div v-if="selectedPeminjaman" class="detail-body">
          <div class="detail-book">
            <div class="large-cover">
              <img
                v-if="selectedPeminjaman.buku?.gambar"
                :src="getImageUrl(selectedPeminjaman.buku.gambar)"
                alt="Cover buku"
              />

              <i v-else class="bi bi-book"></i>
            </div>

            <div>
              <span class="detail-label">BUKU</span>

              <h4>{{ getBookTitle(selectedPeminjaman) }}</h4>

              <p>
                {{
                  selectedPeminjaman.buku?.penulis ||
                  'Penulis tidak tersedia'
                }}
              </p>

              <span
                class="status"
                :class="statusClass(selectedPeminjaman.status)"
              >
                <span></span>
                {{ statusLabel(selectedPeminjaman.status) }}
              </span>
            </div>
          </div>

          <div class="detail-grid">
            <div class="detail-item">
              <span>Anggota</span>
              <strong>{{ getUserName(selectedPeminjaman) }}</strong>
            </div>

            <div class="detail-item">
              <span>User ID</span>
              <strong>{{ selectedPeminjaman.user_id }}</strong>
            </div>

            <div class="detail-item">
              <span>Tanggal Request</span>
              <strong>
                {{ formatDate(selectedPeminjaman.tanggal_request) }}
              </strong>
            </div>

            <div class="detail-item">
              <span>Tanggal Pinjam</span>
              <strong>
                {{ formatDate(selectedPeminjaman.tanggal_pinjam) }}
              </strong>
            </div>

            <div class="detail-item">
              <span>Tanggal Kembali</span>
              <strong>
                {{ formatDate(selectedPeminjaman.tanggal_kembali) }}
              </strong>
            </div>

            <div class="detail-item">
              <span>Dibuat</span>
              <strong>
                {{ formatDateTime(selectedPeminjaman.created_at) }}
              </strong>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button
            class="cancel-btn"
            @click="showDetailModal = false"
          >
            Tutup
          </button>

          <button
            class="primary-btn"
            @click="openEditModal(selectedPeminjaman)"
          >
            <i class="bi bi-pencil"></i>
            Edit
          </button>
        </div>
      </div>
    </div>

    <!-- TOAST -->
    <Transition name="toast">
      <div
        v-if="toast.show"
        class="toast-box"
        :class="toast.type"
      >
        <div class="toast-icon">
          <i
            :class="
              toast.type === 'success'
                ? 'bi bi-check-lg'
                : 'bi bi-exclamation-lg'
            "
          ></i>
        </div>

        <div>
          <strong>
            {{ toast.type === 'success' ? 'Berhasil' : 'Error' }}
          </strong>

          <p>{{ toast.message }}</p>
        </div>

        <button @click="toast.show = false">
          <i class="bi bi-x"></i>
        </button>
      </div>
    </Transition>
  </div>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue'
import SidebarAdmin from '../../components/SidebarAdmin.vue'
import api from '../../utils/api'

const sidebarCollapsed = ref(false)
const loading = ref(false)
const saving = ref(false)
const error = ref('')
const formError = ref('')
const search = ref('')
const statusFilter = ref('')

const books = ref([])
const users = ref([])
const availableBooks = ref([])

const selectedPeminjaman = ref(null)

const showFormModal = ref(false)
const showDetailModal = ref(false)
const editing = ref(false)

const currentUser = ref(null)

const toast = reactive({
  show: false,
  type: 'success',
  message: ''
})

const form = reactive({
  user_id: '',
  buku_id: '',
  tanggal_request: '',
  tanggal_pinjam: '',
  tanggal_kembali: '',
  status: 'pending'
})

const userInitial = computed(() => {
  return (currentUser.value?.name || 'Admin')
    .charAt(0)
    .toUpperCase()
})

const filteredPeminjaman = computed(() => {
  let data = [...books.value]

  if (statusFilter.value) {
    data = data.filter(
      item =>
        String(item.status || '').toLowerCase() ===
        statusFilter.value.toLowerCase()
    )
  }

  if (search.value.trim()) {
    const keyword = search.value.toLowerCase().trim()

    data = data.filter(item => {
      const userName = getUserName(item).toLowerCase()
      const bookTitle = getBookTitle(item).toLowerCase()

      return (
        userName.includes(keyword) ||
        bookTitle.includes(keyword) ||
        String(item.id).includes(keyword)
      )
    })
  }

  return data
})

/* =========================
   API PEMINJAMAN
========================= */

async function fetchPeminjaman() {
  loading.value = true
  error.value = ''

  try {
    const res = await api.get('/peminjaman')
    const result = res.data?.data

    if (Array.isArray(result)) {
      books.value = result
    } else if (Array.isArray(result?.data)) {
      books.value = result.data
    } else {
      books.value = []
    }
  } catch (err) {
    console.error('Fetch peminjaman error:', err)

    error.value =
      err.response?.data?.message ||
      'Data peminjaman gagal diambil dari server.'
  } finally {
    loading.value = false
  }
}

/* =========================
   API USER
========================= */

async function fetchUsers() {
  try {
    const res = await api.get('/users')
    const result = res.data?.data

    if (Array.isArray(result)) {
      users.value = result
    } else if (Array.isArray(result?.data)) {
      users.value = result.data
    } else {
      users.value = []
    }
  } catch (err) {
    console.error('Gagal mengambil anggota:', err)
    users.value = []
  }
}

/* =========================
   API BUKU
========================= */

async function fetchBooks() {
  try {
    const res = await api.get('/buku')
    const result = res.data?.data

    if (Array.isArray(result)) {
      availableBooks.value = result
    } else if (Array.isArray(result?.data)) {
      availableBooks.value = result.data
    } else {
      availableBooks.value = []
    }
  } catch (err) {
    console.error('Gagal mengambil buku:', err)
    availableBooks.value = []
  }
}

/* =========================
   SIMPAN
========================= */

async function savePeminjaman() {
  saving.value = true
  formError.value = ''

  try {
    const payload = {
      user_id: Number(form.user_id),
      buku_id: Number(form.buku_id),
      tanggal_request: form.tanggal_request,
      tanggal_pinjam: form.tanggal_pinjam || null,
      tanggal_kembali: form.tanggal_kembali || null,
      status: form.status
    }

    let res

    if (editing.value) {
      res = await api.put(
        `/peminjaman/${selectedPeminjaman.value.id}`,
        payload
      )
    } else {
      res = await api.post('/peminjaman', payload)
    }

    showToast(
      'success',
      res.data?.message ||
        (editing.value
          ? 'Peminjaman berhasil diperbarui.'
          : 'Peminjaman berhasil ditambahkan.')
    )

    closeFormModal()
    await fetchPeminjaman()
  } catch (err) {
    console.error('Save peminjaman error:', err)

    const errors = err.response?.data?.errors

    if (errors) {
      const firstError = Object.values(errors).flat()[0]
      formError.value = firstError || 'Data tidak valid.'
    } else {
      formError.value =
        err.response?.data?.message ||
        'Peminjaman gagal disimpan.'
    }
  } finally {
    saving.value = false
  }
}

/* =========================
   DETAIL
========================= */

async function showDetail(item) {
  try {
    const res = await api.get(`/peminjaman/${item.id}`)

    selectedPeminjaman.value =
      res.data?.data ||
      res.data?.peminjaman ||
      item
  } catch (err) {
    selectedPeminjaman.value = item
  }

  showDetailModal.value = true
}

/* =========================
   DELETE
========================= */

async function deletePeminjaman(item) {
  const name = getUserName(item)
  const book = getBookTitle(item)

  if (!window.confirm(`Hapus peminjaman ${name} - ${book}?`)) {
    return
  }

  try {
    const res = await api.delete(`/peminjaman/${item.id}`)

    showToast(
      'success',
      res.data?.message || 'Peminjaman berhasil dihapus.'
    )

    await fetchPeminjaman()
  } catch (err) {
    showToast(
      'error',
      err.response?.data?.message ||
        'Peminjaman gagal dihapus.'
    )
  }
}

/* =========================
   MODAL
========================= */

function openCreateModal() {
  editing.value = false
  formError.value = ''

  resetForm()

  form.tanggal_request = getToday()
  form.status = 'pending'

  fetchUsers()
  fetchBooks()

  showFormModal.value = true
}

function openEditModal(item) {
  if (!item) return

  showDetailModal.value = false
  editing.value = true
  formError.value = ''

  selectedPeminjaman.value = item

  form.user_id =
    item.user_id ||
    item.user?.id ||
    ''

  form.buku_id =
    item.buku_id ||
    item.buku?.id ||
    ''

  form.tanggal_request =
    normalizeDate(item.tanggal_request)

  form.tanggal_pinjam =
    normalizeDate(item.tanggal_pinjam)

  form.tanggal_kembali =
    normalizeDate(item.tanggal_kembali)

  form.status = item.status || 'pending'

  fetchUsers()
  fetchBooks()

  showFormModal.value = true
}

function closeFormModal() {
  showFormModal.value = false
  formError.value = ''
}

function resetForm() {
  form.user_id = ''
  form.buku_id = ''
  form.tanggal_request = ''
  form.tanggal_pinjam = ''
  form.tanggal_kembali = ''
  form.status = 'pending'
}

/* =========================
   USER
========================= */

function getUserName(item) {
  return (
    item?.user?.name ||
    item?.user_name ||
    item?.nama_user ||
    findUserName(item?.user_id) ||
    `User #${item?.user_id || '-'}`
  )
}

function findUserName(userId) {
  if (!userId) return ''

  const user = users.value.find(
    item => String(item.id) === String(userId)
  )

  return user?.name || ''
}

function getUserInitial(item) {
  return getUserName(item)
    .charAt(0)
    .toUpperCase()
}

/* =========================
   BUKU
========================= */

function getBookTitle(item) {
  return (
    item?.buku?.judul ||
    item?.judul_buku ||
    findBookTitle(item?.buku_id) ||
    `Buku #${item?.buku_id || '-'}`
  )
}

function findBookTitle(bookId) {
  if (!bookId) return ''

  const book = availableBooks.value.find(
    item => String(item.id) === String(bookId)
  )

  return book?.judul || ''
}

/* =========================
   IMAGE
========================= */

function getImageUrl(image) {
  if (!image) return ''

  if (String(image).startsWith('http')) {
    return image
  }

  return `http://localhost:8000/storage/${image}`
}

/* =========================
   DATE
========================= */

function formatDate(date) {
  if (!date) return '-'

  const value = String(date).split('T')[0]
  const parts = value.split('-')

  if (parts.length !== 3) {
    return date
  }

  return `${parts[2]}/${parts[1]}/${parts[0]}`
}

function formatDateTime(date) {
  if (!date) return '-'

  const d = new Date(date)

  if (Number.isNaN(d.getTime())) {
    return formatDate(date)
  }

  return d.toLocaleString('id-ID', {
    dateStyle: 'medium',
    timeStyle: 'short'
  })
}

function normalizeDate(date) {
  if (!date) return ''
  return String(date).split('T')[0]
}

function getToday() {
  const date = new Date()

  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')

  return `${year}-${month}-${day}`
}

/* =========================
   STATUS
========================= */

function statusLabel(status) {
  const value = String(status || '').toLowerCase()

  const labels = {
    pending: 'Pending',
    disetujui: 'Disetujui',
    ditolak: 'Ditolak',
    dikembalikan: 'Dikembalikan'
  }

  return labels[value] || status || '-'
}

function statusClass(status) {
  const value = String(status || '').toLowerCase()

  if (value === 'pending') return 'pending'
  if (value === 'disetujui') return 'approved'
  if (value === 'ditolak') return 'rejected'
  if (value === 'dikembalikan') return 'returned'

  return 'other'
}

function countStatus(status) {
  return books.value.filter(
    item =>
      String(item.status || '').toLowerCase() === status
  ).length
}

/* =========================
   TOAST
========================= */

function showToast(type, message) {
  toast.type = type
  toast.message = message
  toast.show = true

  setTimeout(() => {
    toast.show = false
  }, 3500)
}

/* =========================
   INIT
========================= */

onMounted(async () => {
  try {
    const res = await api.get('/me')
    currentUser.value =
      res.data?.data ||
      res.data?.user ||
      res.data
  } catch {
    currentUser.value = null
  }

  await Promise.all([
    fetchPeminjaman(),
    fetchBooks(),
    fetchUsers()
  ])
})
</script>

<style scoped>
@import url('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');

* {
  box-sizing: border-box;
}

.page {
  min-height: 100vh;
  display: flex;
  background:
    radial-gradient(circle at 15% 15%, rgba(59,130,246,.08), transparent 30%),
    radial-gradient(circle at 85% 80%, rgba(96,165,250,.06), transparent 30%),
    #07111f;
  color: #e8f0fb;
  font-family: Inter, system-ui, sans-serif;
}

.main {
  width: calc(100% - 250px);
  margin-left: 250px;
  min-height: 100vh;
}

.topbar {
  height: 82px;
  padding: 0 32px;
  display: flex;
  align-items: center;
  gap: 20px;
  position: sticky;
  top: 0;
  z-index: 30;
  background: rgba(7,17,31,.72);
  border-bottom: 1px solid rgba(255,255,255,.06);
  backdrop-filter: blur(20px);
}

.toggle-btn,
.refresh-btn,
.close-btn,
.cancel-btn {
  cursor: pointer;
}

.toggle-btn {
  width: 42px;
  height: 42px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.07);
  background: rgba(255,255,255,.05);
  color: #b9c9db;
  font-size: 19px;
}

.topbar-title {
  flex: 1;
}

.topbar-title span,
.modal-eyebrow,
.eyebrow {
  text-transform: uppercase;
  letter-spacing: .12em;
}

.topbar-title span {
  color: #64778e;
  font-size: 11px;
}

.topbar-title h1 {
  margin: 3px 0 0;
  font-size: 17px;
}

.profile {
  display: flex;
  align-items: center;
  gap: 10px;
}

.avatar,
.member-avatar {
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg,#2563eb,#60a5fa);
}

.profile-info {
  display: flex;
  flex-direction: column;
}

.profile-info strong {
  font-size: 13px;
}

.profile-info span {
  color: #697c92;
  font-size: 11px;
}

.content {
  padding: 32px;
  max-width: 1700px;
  margin: auto;
}

.page-header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 28px;
}

.eyebrow {
  display: inline-flex;
  gap: 7px;
  color: #60a5fa;
  font-size: 11px;
  font-weight: 700;
}

.page-header h2 {
  margin: 8px 0 5px;
  font-size: 30px;
}

.page-header p {
  margin: 0;
  color: #708399;
  font-size: 14px;
}

.primary-btn {
  border: 0;
  border-radius: 12px;
  padding: 12px 18px;
  color: #fff;
  background: linear-gradient(135deg,#2563eb,#3b82f6);
  box-shadow: 0 10px 25px rgba(37,99,235,.2);
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-weight: 600;
}

.primary-btn:hover {
  transform: translateY(-1px);
}

.primary-btn:disabled {
  opacity: .6;
  cursor: not-allowed;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 16px;
  margin-bottom: 22px;
}

.stat-card {
  padding: 20px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 17px;
  background: rgba(14,28,47,.72);
  backdrop-filter: blur(18px);
  display: flex;
  align-items: center;
  gap: 15px;
}

.stat-icon {
  width: 46px;
  height: 46px;
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 19px;
}

.stat-icon.blue { background: rgba(59,130,246,.12); color:#60a5fa; }
.stat-icon.orange { background: rgba(245,158,11,.12); color:#fbbf24; }
.stat-icon.purple { background: rgba(139,92,246,.12); color:#a78bfa; }
.stat-icon.green { background: rgba(34,197,94,.12); color:#4ade80; }

.stat-card span {
  display: block;
  color: #718399;
  font-size: 11px;
  margin-bottom: 5px;
}

.stat-card strong {
  font-size: 23px;
}

.table-card {
  overflow: hidden;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 20px;
  background: rgba(12,26,43,.76);
  box-shadow: 0 20px 60px rgba(0,0,0,.16);
  backdrop-filter: blur(18px);
}

.table-toolbar {
  min-height: 82px;
  padding: 17px 20px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 15px;
  border-bottom: 1px solid rgba(255,255,255,.06);
}

.toolbar-title,
.toolbar-actions {
  display: flex;
  align-items: center;
  gap: 10px;
}

.toolbar-title h3 {
  margin: 0;
  font-size: 15px;
}

.toolbar-title span {
  padding: 4px 8px;
  border-radius: 7px;
  background: rgba(255,255,255,.05);
  color: #718399;
  font-size: 10px;
}

.search-box {
  height: 40px;
  min-width: 260px;
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 0 12px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 10px;
  background: rgba(255,255,255,.035);
}

.search-box i {
  color: #65788f;
}

.search-box input {
  width: 100%;
  border: 0;
  outline: 0;
  background: transparent;
  color: #dbe7f4;
  font-size: 12px;
}

.search-box input::placeholder {
  color: #5d6e83;
}

.filter-select,
.form-group select,
.form-group input {
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 10px;
  background: rgba(255,255,255,.035);
  color: #dbe7f4;
  outline: none;
}

.filter-select {
  height: 40px;
  padding: 0 10px;
  font-size: 12px;
}

.filter-select option,
.form-group select option {
  background: #0c1a2b;
}

.refresh-btn {
  width: 40px;
  height: 40px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 10px;
  background: rgba(255,255,255,.035);
  color: #8da1b8;
}

.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  min-width: 1050px;
  border-collapse: collapse;
}

thead {
  background: rgba(255,255,255,.018);
}

th {
  padding: 14px 16px;
  color: #62768e;
  text-align: left;
  font-size: 10px;
  text-transform: uppercase;
  letter-spacing: .08em;
}

td {
  padding: 14px 16px;
  border-top: 1px solid rgba(255,255,255,.045);
  font-size: 12px;
  vertical-align: middle;
}

tbody tr:hover {
  background: rgba(255,255,255,.025);
}

.number {
  width: 27px;
  height: 27px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  background: rgba(255,255,255,.045);
  color: #718399;
}

.member,
.book-info {
  display: flex;
  align-items: center;
  gap: 10px;
}

.member-avatar {
  width: 34px;
  height: 34px;
  flex: 0 0 34px;
  border-radius: 10px;
  background: linear-gradient(135deg,rgba(37,99,235,.8),rgba(96,165,250,.7));
  color: #fff;
  font-size: 12px;
}

.member-info,
.book-info > div:last-child {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.member-info strong,
.book-info strong {
  max-width: 180px;
  overflow: hidden;
  color: #dce8f5;
  font-size: 12px;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.member-info span,
.book-info span {
  color: #5f738a;
  font-size: 10px;
}

.book-cover {
  width: 34px;
  height: 44px;
  flex: 0 0 34px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  background: linear-gradient(135deg,#152b47,#243f63);
  color: #68809b;
}

.book-cover img,
.large-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.date {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: #9badbf;
  white-space: nowrap;
}

.date i {
  color: #59718d;
}

.status {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  padding: 6px 9px;
  border-radius: 8px;
  font-size: 10px;
  font-weight: 600;
  white-space: nowrap;
}

.status > span {
  width: 5px;
  height: 5px;
  border-radius: 50%;
}

.status.pending {
  color: #fbbf24;
  background: rgba(245,158,11,.09);
}

.status.pending > span {
  background: #fbbf24;
}

.status.approved {
  color: #60a5fa;
  background: rgba(59,130,246,.09);
}

.status.approved > span {
  background: #60a5fa;
}

.status.rejected {
  color: #fb7185;
  background: rgba(244,63,94,.09);
}

.status.rejected > span {
  background: #fb7185;
}

.status.returned {
  color: #4ade80;
  background: rgba(34,197,94,.09);
}

.status.returned > span {
  background: #4ade80;
}

.status.other {
  color: #94a3b8;
  background: rgba(148,163,184,.08);
}

.status.other > span {
  background: #94a3b8;
}

.actions {
  display: flex;
  justify-content: center;
  gap: 6px;
}

.icon-btn {
  width: 31px;
  height: 31px;
  border: 1px solid rgba(255,255,255,.06);
  border-radius: 8px;
  background: rgba(255,255,255,.035);
  cursor: pointer;
}

.icon-btn.detail { color:#60a5fa; }
.icon-btn.edit { color:#a78bfa; }
.icon-btn.delete { color:#fb7185; }

.state-box {
  min-height: 330px;
  padding: 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.state-box p {
  color: #65788f;
  font-size: 13px;
}

.state-icon {
  width: 60px;
  height: 60px;
  margin-bottom: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 18px;
  background: rgba(255,255,255,.04);
  color: #60758d;
  font-size: 25px;
}

.state-box h3 {
  margin: 0;
  font-size: 16px;
}

.error-state .state-icon {
  color: #fb7185;
}

.secondary-btn {
  margin-top: 8px;
  padding: 9px 14px;
  border: 1px solid rgba(255,255,255,.07);
  border-radius: 9px;
  background: rgba(255,255,255,.05);
  color: #9fb2c6;
  cursor: pointer;
}

.spinner,
.mini-spinner {
  border-radius: 50%;
  animation: spin .8s linear infinite;
}

.spinner {
  width: 32px;
  height: 32px;
  margin-bottom: 12px;
  border: 3px solid rgba(255,255,255,.08);
  border-top-color: #60a5fa;
}

.mini-spinner {
  width: 13px;
  height: 13px;
  border: 2px solid rgba(255,255,255,.35);
  border-top-color: #fff;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.modal-backdrop {
  position: fixed;
  inset: 0;
  z-index: 100;
  padding: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0,0,0,.65);
  backdrop-filter: blur(9px);
}

.modal {
  width: min(540px,100%);
  max-height: 90vh;
  overflow-y: auto;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 22px;
  background: #0c1a2b;
  box-shadow: 0 30px 100px rgba(0,0,0,.5);
}

.detail-modal {
  width: min(650px,100%);
}

.modal-header,
.modal-footer {
  padding: 20px 22px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgba(255,255,255,.06);
}

.modal-footer {
  border-top: 1px solid rgba(255,255,255,.06);
  border-bottom: 0;
}

.modal-eyebrow {
  color: #60a5fa;
  font-size: 10px;
  font-weight: 700;
}

.modal-header h3 {
  margin: 6px 0 0;
  font-size: 19px;
}

.close-btn {
  width: 35px;
  height: 35px;
  border: 0;
  border-radius: 9px;
  background: rgba(255,255,255,.05);
  color: #8194a9;
}

.form-body,
.detail-body {
  padding: 22px;
}

.form-group {
  margin-bottom: 17px;
}

.form-group label {
  display: block;
  margin-bottom: 7px;
  color: #9db0c4;
  font-size: 11px;
  font-weight: 600;
}

.form-group label span {
  color: #fb7185;
}

.form-group input,
.form-group select {
  width: 100%;
  height: 43px;
  padding: 0 12px;
  font-size: 12px;
}

.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
}

.form-error {
  padding: 11px 13px;
  display: flex;
  gap: 8px;
  border: 1px solid rgba(244,63,94,.12);
  border-radius: 10px;
  background: rgba(244,63,94,.08);
  color: #fb7185;
  font-size: 11px;
}

.cancel-btn {
  padding: 11px 16px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 10px;
  background: rgba(255,255,255,.04);
  color: #94a7ba;
}

.detail-book {
  display: flex;
  gap: 18px;
  margin-bottom: 18px;
  padding: 17px;
  border-radius: 15px;
  background: rgba(255,255,255,.035);
}

.large-cover {
  width: 80px;
  height: 105px;
  flex: 0 0 80px;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 9px;
  background: linear-gradient(135deg,#142943,#234568);
  color: #68809b;
  font-size: 28px;
}

.detail-book h4 {
  margin: 5px 0;
  font-size: 18px;
}

.detail-book p {
  margin: 0 0 12px;
  color: #718399;
  font-size: 12px;
}

.detail-label {
  color: #5f738a;
  font-size: 9px;
  letter-spacing: .1em;
}

.detail-grid {
  display: grid;
  grid-template-columns: repeat(2,1fr);
  gap: 10px;
}

.detail-item {
  padding: 14px;
  border: 1px solid rgba(255,255,255,.045);
  border-radius: 12px;
  background: rgba(255,255,255,.025);
}

.detail-item span {
  display: block;
  margin-bottom: 6px;
  color: #61758d;
  font-size: 10px;
}

.detail-item strong {
  color: #cbd9e8;
  font-size: 12px;
}

.toast-box {
  position: fixed;
  right: 24px;
  bottom: 24px;
  z-index: 200;
  width: 330px;
  padding: 14px;
  display: flex;
  align-items: center;
  gap: 11px;
  border: 1px solid rgba(255,255,255,.08);
  border-radius: 15px;
  background: rgba(12,26,43,.95);
  box-shadow: 0 20px 60px rgba(0,0,0,.35);
  backdrop-filter: blur(18px);
}

.toast-icon {
  width: 35px;
  height: 35px;
  flex: 0 0 35px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 9px;
}

.toast-box.success .toast-icon {
  color: #4ade80;
  background: rgba(34,197,94,.1);
}

.toast-box.error .toast-icon {
  color: #fb7185;
  background: rgba(244,63,94,.1);
}

.toast-box strong {
  font-size: 12px;
}

.toast-box p {
  margin: 3px 0 0;
  color: #718399;
  font-size: 10px;
}

.toast-box button {
  margin-left: auto;
  border: 0;
  background: transparent;
  color: #65788f;
  cursor: pointer;
}

.toast-enter-active,
.toast-leave-active {
  transition: .3s ease;
}

.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateY(15px);
}

@media (max-width:1100px) {
  .stats-grid {
    grid-template-columns: repeat(2,1fr);
  }

  .table-toolbar {
    align-items: flex-start;
    flex-direction: column;
  }

  .toolbar-actions {
    width: 100%;
  }

  .search-box {
    flex: 1;
  }
}

@media (max-width:800px) {
  .main {
    width: calc(100% - 82px);
    margin-left: 82px;
  }

  .content {
    padding: 20px;
  }

  .page-header {
    align-items: flex-start;
    flex-direction: column;
  }

  .profile-info {
    display: none;
  }
}

@media (max-width:600px) {
  .topbar {
    padding: 0 18px;
  }

  .content {
    padding: 16px;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }

  .toolbar-actions {
    flex-wrap: wrap;
  }

  .search-box {
    width: 100%;
    flex: none;
  }

  .filter-select {
    flex: 1;
  }

  .form-grid,
  .detail-grid {
    grid-template-columns: 1fr;
  }

  .toast-box {
    left: 16px;
    right: 16px;
    bottom: 16px;
    width: auto;
  }
}
</style>