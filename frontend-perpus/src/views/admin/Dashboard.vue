<template>
  <div class="dashboard-page">

    <!-- SIDEBAR -->
    <SidebarAdmin />

    <!-- MAIN -->
    <main class="main-content">

      <!-- TOPBAR -->
      <header class="topbar">
        <div class="page-title">
          <span class="eyebrow">ADMIN PANEL</span>
          <h1>Dashboard</h1>
          <p>Kelola perpustakaan dengan mudah.</p>
        </div>

        <div class="topbar-right">
          <button class="library-btn" @click="goToLibrary">
            ↗ Lihat Perpus
          </button>

          <div class="profile">
            <div class="avatar">
              {{ userInitial }}
            </div>

            <div class="profile-info">
              <strong>{{ userName }}</strong>
              <span>Administrator</span>
            </div>
          </div>
        </div>
      </header>

      <!-- LOADING -->
      <div v-if="loading" class="loading-box">
        <div class="loader"></div>
        <span>Memuat data dashboard...</span>
      </div>

      <template v-else>

        <!-- STATISTIK -->
        <section class="stats-grid">

          <!-- TOTAL BUKU -->
          <div class="stat-card">
            <div class="stat-icon blue">
              📚
            </div>

            <div class="stat-content">
              <span>Total Buku</span>
              <h2>{{ formatNumber(totalBooks) }}</h2>

              <small>
                <b>+{{ booksThisMonth }}</b> bulan ini
              </small>
            </div>
          </div>

          <!-- TOTAL ANGGOTA -->
          <div class="stat-card">
            <div class="stat-icon purple">
              👥
            </div>

            <div class="stat-content">
              <span>Total Anggota</span>
              <h2>{{ formatNumber(totalMembers) }}</h2>

              <small>
                Data dari database
              </small>
            </div>
          </div>

          <!-- TOTAL KATEGORI -->
          <div class="stat-card">
            <div class="stat-icon orange">
              🏷️
            </div>

            <div class="stat-content">
              <span>Total Kategori</span>
              <h2>{{ formatNumber(totalCategories) }}</h2>

              <small>
                Data dari database
              </small>
            </div>
          </div>

          <!-- SEDANG DIPINJAM -->
          <div class="stat-card">
            <div class="stat-icon green">
              📖
            </div>

            <div class="stat-content">
              <span>Sedang Dipinjam</span>
              <h2>{{ formatNumber(activeLoans) }}</h2>

              <small>
                Data dari database
              </small>
            </div>
          </div>

        </section>


        <!-- CONTENT -->
        <section class="dashboard-grid">

          <!-- AKTIVITAS TERBARU -->
          <div class="panel activity-panel">

            <div class="panel-header">
              <div>
                <span class="panel-label">AKTIVITAS</span>
                <h3>Aktivitas Terbaru</h3>
              </div>

              <router-link
                to="/admin/peminjaman"
                class="see-all"
              >
                Lihat Semua →
              </router-link>
            </div>

            <div
              v-if="activities.length"
              class="activity-list"
            >

              <div
                v-for="(activity, index) in activities"
                :key="activity.id || index"
                class="activity-item"
              >

                <div
                  class="activity-avatar"
                  :class="`avatar-${index % 4}`"
                >
                  {{ getInitial(activity.name) }}
                </div>

                <div class="activity-info">
                  <strong>
                    {{ activity.name }}
                  </strong>

                  <p>
                    {{ activity.action }}

                    <b v-if="activity.book">
                      "{{ activity.book }}"
                    </b>
                  </p>

                  <span>
                    {{ timeAgo(activity.date) }}
                  </span>
                </div>

                <div
                  class="activity-status"
                  :class="getStatusClass(activity.status)"
                >
                  {{ getStatusLabel(activity.status) }}
                </div>

              </div>

            </div>

            <div
              v-else
              class="empty-state"
            >
              <div class="empty-icon">
                📋
              </div>

              <h4>Belum ada aktivitas</h4>

              <p>
                Data aktivitas akan muncul ketika ada peminjaman.
              </p>
            </div>

          </div>


          <!-- KOLEKSI BUKU -->
          <div class="panel books-panel">

            <div class="panel-header">
              <div>
                <span class="panel-label">
                  KOLEKSI
                </span>

                <h3>
                  Koleksi Buku
                </h3>
              </div>

              <router-link
                to="/admin/buku"
                class="see-all"
              >
                Lihat Semua →
              </router-link>
            </div>


            <div
              v-if="popularBooks.length"
              class="book-list"
            >

              <div
                v-for="(book, index) in popularBooks"
                :key="book.id || index"
                class="book-item"
              >

                <div
                  class="book-cover"
                  :class="`cover-${index % 4}`"
                >

                  <img
                    v-if="book.gambar && !book.imageError"
                    :src="getImageUrl(book.gambar)"
                    :alt="book.judul"
                    @error="book.imageError = true"
                  />

                  <span
                    v-else
                  >
                    {{ getInitials(book.judul) }}
                  </span>

                </div>


                <div class="book-info">

                  <strong>
                    {{ book.judul }}
                  </strong>

                  <span>
                    {{ book.penulis || 'Penulis tidak diketahui' }}
                  </span>

                </div>


                <div class="book-stock">

                  <strong>
                    {{ book.stok ?? 0 }}
                  </strong>

                  <span>
                    stok
                  </span>

                </div>

              </div>

            </div>


            <div
              v-else
              class="empty-state"
            >

              <div class="empty-icon">
                📚
              </div>

              <h4>
                Belum ada buku
              </h4>

              <p>
                Tambahkan buku melalui menu Data Buku.
              </p>

            </div>

          </div>

        </section>


        <!-- QUICK ACTION -->
        <section class="quick-actions">

          <router-link
            to="/admin/buku"
            class="quick-card"
          >

            <div class="quick-icon blue">
              📚
            </div>

            <div>
              <strong>
                Kelola Buku
              </strong>

              <span>
                Tambah dan kelola koleksi buku
              </span>
            </div>

            <span class="arrow">
              →
            </span>

          </router-link>


          <router-link
            to="/admin/anggota"
            class="quick-card"
          >

            <div class="quick-icon purple">
              👥
            </div>

            <div>
              <strong>
                Kelola Anggota
              </strong>

              <span>
                Lihat data anggota perpustakaan
              </span>
            </div>

            <span class="arrow">
              →
            </span>

          </router-link>


          <router-link
            to="/admin/peminjaman"
            class="quick-card"
          >

            <div class="quick-icon green">
              📋
            </div>

            <div>
              <strong>
                Data Peminjaman
              </strong>

              <span>
                Kelola transaksi peminjaman
              </span>
            </div>

            <span class="arrow">
              →
            </span>

          </router-link>

        </section>

      </template>

    </main>
  </div>
</template>


<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import SidebarAdmin from '../../components/SidebarAdmin.vue'
import api from '../../utils/api'

const router = useRouter()

/* =========================
   DATA
========================= */

const loading = ref(true)

const totalBooks = ref(0)
const booksThisMonth = ref(0)

const totalMembers = ref(0)

const totalCategories = ref(0)

const activeLoans = ref(0)

const books = ref([])
const loans = ref([])

const activities = ref([])
const popularBooks = ref([])

const user = ref(
  JSON.parse(
    localStorage.getItem('user') || 'null'
  )
)


/* =========================
   USER
========================= */

const userName = computed(() => {
  return user.value?.name || 'Admin Perpustakaan'
})

const userInitial = computed(() => {
  return getInitial(userName.value)
})


/* =========================
   FORMAT
========================= */

function formatNumber(number) {
  return new Intl.NumberFormat('id-ID')
    .format(Number(number) || 0)
}


function getInitial(name) {
  if (!name) return 'A'

  return name
    .trim()
    .charAt(0)
    .toUpperCase()
}


function getInitials(title) {
  if (!title) return 'BK'

  const words = title
    .trim()
    .split(/\s+/)

  if (words.length === 1) {
    return words[0]
      .substring(0, 2)
      .toUpperCase()
  }

  return (
    words[0].charAt(0) +
    words[1].charAt(0)
  ).toUpperCase()
}


function getImageUrl(image) {
  if (!image) return ''

  if (image.startsWith('http')) {
    return image
  }

  return `http://localhost:8000/storage/${image}`
}


/* =========================
   DATE
========================= */

function isThisMonth(date) {
  if (!date) return false

  const d = new Date(date)

  if (isNaN(d.getTime())) {
    return false
  }

  const now = new Date()

  return (
    d.getMonth() === now.getMonth() &&
    d.getFullYear() === now.getFullYear()
  )
}


function timeAgo(date) {
  if (!date) {
    return 'Baru saja'
  }

  const d = new Date(date)

  if (isNaN(d.getTime())) {
    return 'Baru saja'
  }

  const now = new Date()

  const seconds = Math.floor(
    (now.getTime() - d.getTime()) / 1000
  )

  if (seconds < 60) {
    return 'Baru saja'
  }

  const minutes = Math.floor(seconds / 60)

  if (minutes < 60) {
    return `${minutes} menit lalu`
  }

  const hours = Math.floor(minutes / 60)

  if (hours < 24) {
    return `${hours} jam lalu`
  }

  const days = Math.floor(hours / 24)

  if (days < 7) {
    return `${days} hari lalu`
  }

  return d.toLocaleDateString(
    'id-ID',
    {
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    }
  )
}


/* =========================
   STATUS
========================= */

function normalizeStatus(status) {
  return String(status || '')
    .toLowerCase()
    .trim()
}


function getStatusLabel(status) {
  const value = normalizeStatus(status)

  if (value === 'dipinjam') {
    return 'Dipinjam'
  }

  if (value === 'dikembalikan') {
    return 'Dikembalikan'
  }

  if (value === 'pending') {
    return 'Pending'
  }

  if (value === 'ditolak') {
    return 'Ditolak'
  }

  return status || 'Tidak diketahui'
}


function getStatusClass(status) {
  const value = normalizeStatus(status)

  if (value === 'dipinjam') {
    return 'status-blue'
  }

  if (value === 'dikembalikan') {
    return 'status-green'
  }

  if (value === 'pending') {
    return 'status-orange'
  }

  if (value === 'ditolak') {
    return 'status-red'
  }

  return 'status-gray'
}


/* =========================
   API HELPER
========================= */

function getList(response) {
  const data = response?.data?.data

  if (Array.isArray(data)) {
    return data
  }

  if (Array.isArray(data?.data)) {
    return data.data
  }

  return []
}


/* =========================
   FETCH BUKU
========================= */

async function fetchBooks() {
  try {

    const response = await api.get('/buku', {
      params: {
        per_page: 1000
      }
    })

    const pagination =
      response?.data?.data

    const list = getList(response)

    books.value = list

    totalBooks.value =
      pagination?.total ??
      list.length

    booksThisMonth.value =
      list.filter(book =>
        isThisMonth(book.created_at)
      ).length

  } catch (error) {

    console.error(
      'Gagal mengambil data buku:',
      error
    )

    books.value = []
    totalBooks.value = 0
    booksThisMonth.value = 0
  }
}


/* =========================
   FETCH ANGGOTA
========================= */

async function fetchMembers() {
  try {

    const response = await api.get('/users', {
      params: {
        per_page: 1
      }
    })

    const pagination =
      response?.data?.data

    totalMembers.value =
      pagination?.total ?? 0

  } catch (error) {

    console.error(
      'Gagal mengambil data anggota:',
      error
    )

    totalMembers.value = 0
  }
}


/* =========================
   FETCH KATEGORI
========================= */

async function fetchCategories() {
  try {

    const response = await api.get('/kategori', {
      params: {
        per_page: 1000
      }
    })

    const pagination =
      response?.data?.data

    const list = getList(response)

    totalCategories.value =
      pagination?.total ??
      list.length

  } catch (error) {

    console.error(
      'Gagal mengambil kategori:',
      error
    )

    totalCategories.value = 0
  }
}


/* =========================
   FETCH PEMINJAMAN
========================= */

async function fetchLoans() {
  try {

    const response = await api.get('/peminjaman', {
      params: {
        per_page: 1000
      }
    })

    loans.value = getList(response)

    activeLoans.value =
      loans.value.filter(item =>
        normalizeStatus(item.status) === 'dipinjam'
      ).length

    buildActivities()

    buildPopularBooks()

  } catch (error) {

    console.error(
      'Gagal mengambil data peminjaman:',
      error
    )

    loans.value = []

    activeLoans.value = 0

    activities.value = []

    popularBooks.value = []
  }
}


/* =========================
   AKTIVITAS
========================= */

function buildActivities() {

  const sorted =
    [...loans.value]
      .sort((a, b) => {

        const dateA = new Date(
          a.created_at ||
          a.tanggal_request ||
          a.tanggal_pinjam ||
          0
        )

        const dateB = new Date(
          b.created_at ||
          b.tanggal_request ||
          b.tanggal_pinjam ||
          0
        )

        return dateB - dateA
      })
      .slice(0, 4)


  activities.value =
    sorted.map(item => {

      const name =
        item.user?.name ||
        item.nama_user ||
        item.user_name ||
        'Anggota'


      const book =
        item.buku?.judul ||
        item.judul_buku ||
        ''


      const status =
        normalizeStatus(item.status)


      let action =
        'Melakukan peminjaman'


      if (status === 'dipinjam') {

        action =
          'Meminjam buku'

      } else if (
        status === 'dikembalikan'
      ) {

        action =
          'Mengembalikan buku'

      } else if (
        status === 'pending'
      ) {

        action =
          'Mengajukan peminjaman'

      } else if (
        status === 'ditolak'
      ) {

        action =
          'Peminjaman ditolak'
      }


      return {
        id: item.id,
        name,
        book,
        action,
        status,

        date:
          item.created_at ||
          item.tanggal_request ||
          item.tanggal_pinjam
      }
    })
}


/* =========================
   KOLEKSI BUKU
========================= */

function buildPopularBooks() {

  const counts = {}


  loans.value.forEach(item => {

    const buku =
      item.buku || null

    const bukuId =
      item.buku_id ||
      buku?.id


    if (!bukuId) return


    if (!counts[bukuId]) {

      counts[bukuId] = {
        count: 0,
        buku
      }
    }


    counts[bukuId].count++
  })


  const result =
    Object.entries(counts)
      .sort((a, b) =>
        b[1].count - a[1].count
      )
      .slice(0, 4)
      .map(([bukuId, data]) => {

        const bukuApi =
          books.value.find(
            book =>
              String(book.id) ===
              String(bukuId)
          )


        const buku =
          data.buku ||
          bukuApi ||
          {}


        return {
          id:
            buku.id ||
            bukuId,

          judul:
            buku.judul ||
            'Buku',

          penulis:
            buku.penulis ||
            'Penulis tidak diketahui',

          stok:
            buku.stok ?? 0,

          gambar:
            buku.gambar || '',

          count:
            data.count,

          imageError: false
        }
      })


  /*
   * Kalau belum ada peminjaman,
   * tampilkan buku yang benar-benar
   * ada di database.
   */
  if (!result.length) {

    popularBooks.value =
      books.value
        .slice(0, 4)
        .map(book => ({

          id: book.id,

          judul:
            book.judul,

          penulis:
            book.penulis,

          stok:
            book.stok,

          gambar:
            book.gambar,

          count: 0,

          imageError: false

        }))

  } else {

    popularBooks.value = result
  }
}


/* =========================
   NAVIGASI
========================= */

function goToLibrary() {
  router.push('/')
}


/* =========================
   LOGOUT
========================= */

async function logout() {

  try {

    await api.post('/logout')

  } catch (error) {

    console.warn(
      'Logout API gagal:',
      error
    )

  } finally {

    localStorage.removeItem('token')

    localStorage.removeItem('user')

    router.push('/login')
  }
}


/* =========================
   LOAD DASHBOARD
========================= */

async function loadDashboard() {

  loading.value = true

  try {

    await Promise.all([
      fetchBooks(),
      fetchMembers(),
      fetchCategories(),
      fetchLoans()
    ])

  } finally {

    loading.value = false
  }
}


onMounted(() => {
  loadDashboard()
})
</script>


<style scoped>
.dashboard-page {
  min-height: 100vh;
  width: 100%;
  background:
    radial-gradient(
      circle at 80% 0%,
      rgba(37, 99, 235, 0.10),
      transparent 30%
    ),
    radial-gradient(
      circle at 50% 100%,
      rgba(79, 70, 229, 0.08),
      transparent 35%
    ),
    #080d19;
  color: #f8fafc;
}

.main-content {
  min-height: 100vh;
  margin-left: 280px;
  width: calc(100% - 280px);
  padding: 30px 36px 50px;
  box-sizing: border-box;
}

.topbar {
  min-height: 76px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 28px;
}

.page-title .eyebrow {
  display: block;
  margin-bottom: 6px;
  color: #60a5fa;
  font-size: 11px;
  font-weight: 800;
  letter-spacing: 2px;
}

.page-title h1 {
  margin: 0;
  font-size: 30px;
  line-height: 1.2;
  font-weight: 800;
}

.page-title p {
  margin: 7px 0 0;
  color: #64748b;
  font-size: 13px;
}

.topbar-right {
  display: flex;
  align-items: center;
  gap: 18px;
}

.library-btn {
  border: 1px solid rgba(96, 165, 250, 0.20);
  background: rgba(24, 45, 78, 0.65);
  color: #93c5fd;
  padding: 11px 17px;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: 0.25s;
}

.library-btn:hover {
  background: rgba(37, 99, 235, 0.25);
  border-color: rgba(96, 165, 250, 0.40);
  transform: translateY(-1px);
}

.profile {
  display: flex;
  align-items: center;
  gap: 11px;
}

.avatar {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background:
    linear-gradient(
      135deg,
      #2563eb,
      #7c3aed
    );
  color: white;
  font-weight: 800;
  box-shadow:
    0 8px 20px rgba(37, 99, 235, 0.22);
}

.profile-info {
  display: flex;
  flex-direction: column;
  gap: 3px;
}

.profile-info strong {
  font-size: 13px;
  white-space: nowrap;
}

.profile-info span {
  color: #64748b;
  font-size: 11px;
}

.loading-box {
  min-height: 400px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 15px;
  color: #64748b;
}

.loader {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  border: 3px solid rgba(96, 165, 250, 0.15);
  border-top-color: #3b82f6;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.stats-grid {
  display: grid;
  grid-template-columns:
    repeat(4, minmax(0, 1fr));
  gap: 16px;
  margin-bottom: 20px;
}

.stat-card {
  min-height: 142px;
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 20px;
  box-sizing: border-box;
  background:
    linear-gradient(
      145deg,
      rgba(17, 27, 44, 0.96),
      rgba(12, 20, 34, 0.96)
    );
  border: 1px solid rgba(148, 163, 184, 0.10);
  border-radius: 17px;
  box-shadow:
    0 15px 40px rgba(0, 0, 0, 0.12);
  transition: 0.25s;
}

.stat-card:hover {
  transform: translateY(-3px);
  border-color:
    rgba(96, 165, 250, 0.18);
}

.stat-icon {
  width: 50px;
  height: 50px;
  flex-shrink: 0;
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
}

.stat-icon.blue {
  background: rgba(37, 99, 235, 0.16);
}

.stat-icon.purple {
  background: rgba(124, 58, 237, 0.15);
}

.stat-icon.orange {
  background: rgba(245, 158, 11, 0.14);
}

.stat-icon.green {
  background: rgba(16, 185, 129, 0.14);
}

.stat-content {
  min-width: 0;
}

.stat-content > span {
  display: block;
  color: #7890ae;
  font-size: 12px;
  margin-bottom: 7px;
}

.stat-content h2 {
  margin: 0;
  font-size: 27px;
  font-weight: 800;
}

.stat-content small {
  display: block;
  margin-top: 6px;
  color: #536983;
  font-size: 10px;
}

.stat-content small b {
  color: #34d399;
}

.dashboard-grid {
  display: grid;
  grid-template-columns:
    minmax(0, 1.55fr)
    minmax(360px, 1fr);
  gap: 20px;
  margin-bottom: 20px;
}

.panel {
  min-width: 0;
  background:
    linear-gradient(
      145deg,
      rgba(13, 22, 37, 0.98),
      rgba(10, 17, 29, 0.98)
    );
  border: 1px solid rgba(148, 163, 184, 0.09);
  border-radius: 18px;
  padding: 24px;
  box-sizing: border-box;
  box-shadow:
    0 15px 45px rgba(0, 0, 0, 0.13);
}

.activity-panel,
.books-panel {
  min-height: 360px;
}

.panel-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 18px;
}

.panel-label {
  display: block;
  margin-bottom: 7px;
  color: #506783;
  font-size: 9px;
  font-weight: 800;
  letter-spacing: 2px;
}

.panel-header h3 {
  margin: 0;
  color: #f8fafc;
  font-size: 17px;
  font-weight: 800;
}

.see-all {
  flex-shrink: 0;
  color: #60a5fa;
  font-size: 11px;
  font-weight: 700;
  text-decoration: none;
  padding-top: 9px;
}

.see-all:hover {
  color: #93c5fd;
}

.activity-list,
.book-list {
  display: flex;
  flex-direction: column;
}

.activity-item {
  min-height: 68px;
  display: flex;
  align-items: center;
  gap: 12px;
  border-bottom:
    1px solid rgba(148, 163, 184, 0.07);
}

.activity-item:last-child,
.book-item:last-child {
  border-bottom: none;
}

.activity-avatar {
  width: 38px;
  height: 38px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 11px;
  color: white;
  font-size: 12px;
  font-weight: 800;
}

.avatar-0 {
  background:
    linear-gradient(135deg, #2563eb, #1d4ed8);
}

.avatar-1 {
  background:
    linear-gradient(135deg, #7c3aed, #5b21b6);
}

.avatar-2 {
  background:
    linear-gradient(135deg, #059669, #047857);
}

.avatar-3 {
  background:
    linear-gradient(135deg, #ea580c, #c2410c);
}

.activity-info {
  flex: 1;
  min-width: 0;
}

.activity-info strong {
  display: block;
  margin-bottom: 3px;
  color: #e2e8f0;
  font-size: 12px;
}

.activity-info p {
  margin: 0;
  color: #64748b;
  font-size: 10px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.activity-info p b {
  color: #94a3b8;
}

.activity-info > span {
  display: block;
  margin-top: 3px;
  color: #3f526a;
  font-size: 9px;
}

.activity-status {
  flex-shrink: 0;
  padding: 5px 8px;
  border-radius: 7px;
  font-size: 8px;
  font-weight: 700;
}

.status-blue {
  color: #60a5fa;
  background: rgba(37, 99, 235, 0.12);
}

.status-green {
  color: #34d399;
  background: rgba(16, 185, 129, 0.12);
}

.status-orange {
  color: #fbbf24;
  background: rgba(245, 158, 11, 0.12);
}

.status-red {
  color: #f87171;
  background: rgba(239, 68, 68, 0.12);
}

.status-gray {
  color: #94a3b8;
  background: rgba(148, 163, 184, 0.10);
}

.book-item {
  min-height: 73px;
  display: flex;
  align-items: center;
  gap: 12px;
  border-bottom:
    1px solid rgba(148, 163, 184, 0.07);
}

.book-cover {
  width: 42px;
  height: 53px;
  flex-shrink: 0;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  color: white;
  font-size: 10px;
  font-weight: 800;
}

.book-cover img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.cover-0 {
  background:
    linear-gradient(145deg, #2563eb, #1e3a8a);
}

.cover-1 {
  background:
    linear-gradient(145deg, #7c3aed, #4c1d95);
}

.cover-2 {
  background:
    linear-gradient(145deg, #059669, #065f46);
}

.cover-3 {
  background:
    linear-gradient(145deg, #ea580c, #9a3412);
}

.book-info {
  flex: 1;
  min-width: 0;
}

.book-info strong {
  display: block;
  margin-bottom: 6px;
  color: #e2e8f0;
  font-size: 11px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.book-info span {
  color: #526982;
  font-size: 9px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.book-stock {
  min-width: 35px;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 4px;
}

.book-stock strong {
  color: #e2e8f0;
  font-size: 12px;
}

.book-stock span {
  color: #41546c;
  font-size: 8px;
}

.empty-state {
  min-height: 240px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 20px;
}

.empty-icon {
  width: 50px;
  height: 50px;
  margin-bottom: 12px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(96, 165, 250, 0.08);
  font-size: 22px;
}

.empty-state h4 {
  margin: 0 0 6px;
  color: #94a3b8;
  font-size: 13px;
}

.empty-state p {
  max-width: 260px;
  margin: 0;
  color: #475a72;
  font-size: 10px;
  line-height: 1.6;
}

.quick-actions {
  display: grid;
  grid-template-columns:
    repeat(3, minmax(0, 1fr));
  gap: 14px;
}

.quick-card {
  min-height: 82px;
  display: flex;
  align-items: center;
  gap: 13px;
  padding: 15px;
  box-sizing: border-box;
  border-radius: 15px;
  border: 1px solid rgba(148, 163, 184, 0.08);
  background:
    linear-gradient(
      145deg,
      rgba(15, 25, 42, 0.95),
      rgba(10, 18, 31, 0.95)
    );
  text-decoration: none;
  transition: 0.25s;
}

.quick-card:hover {
  transform: translateY(-2px);
  border-color:
    rgba(96, 165, 250, 0.18);
}

.quick-icon {
  width: 42px;
  height: 42px;
  flex-shrink: 0;
  border-radius: 11px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.quick-icon.blue {
  background: rgba(37, 99, 235, 0.15);
}

.quick-icon.purple {
  background: rgba(124, 58, 237, 0.15);
}

.quick-icon.green {
  background: rgba(16, 185, 129, 0.13);
}

.quick-card > div:nth-child(2) {
  flex: 1;
  min-width: 0;
}

.quick-card strong {
  display: block;
  margin-bottom: 5px;
  color: #e2e8f0;
  font-size: 11px;
}

.quick-card span {
  color: #4f637b;
  font-size: 9px;
}

.quick-card .arrow {
  color: #536b86;
  font-size: 15px;
}

@media (max-width: 1200px) {
  .main-content {
    padding: 26px;
  }

  .stats-grid {
    grid-template-columns:
      repeat(2, minmax(0, 1fr));
  }

  .dashboard-grid {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 900px) {
  .main-content {
    margin-left: 0;
    width: 100%;
    padding: 22px 18px 40px;
  }

  .profile-info {
    display: none;
  }
}

@media (max-width: 650px) {
  .topbar {
    flex-direction: column;
    align-items: flex-start;
  }

  .topbar-right {
    width: 100%;
    justify-content: space-between;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }

  .quick-actions {
    grid-template-columns: 1fr;
  }

  .panel {
    padding: 18px;
  }

  .activity-status {
    display: none;
  }
}
</style>