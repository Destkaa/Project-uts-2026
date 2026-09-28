<template>
  <div class="admin-page">
    <!-- BACKGROUND -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="brand">
        <div class="brand-icon">📚</div>

        <div class="brand-text">
          <h2>PerpusKu</h2>
          <span>ADMIN PANEL</span>
        </div>
      </div>

      <nav class="menu">
        <router-link to="/admin/Dashboard" class="menu-item">
          <span>📊</span>
          Dashboard
        </router-link>

        <router-link to="/admin/buku" class="menu-item">
          <span>📚</span>
          Data Buku
        </router-link>

        <router-link to="/admin/anggota" class="menu-item active">
          <span>👥</span>
          Anggota
        </router-link>

        <router-link to="/admin/peminjaman" class="menu-item">
          <span>📖</span>
          Peminjaman
        </router-link>

        <router-link to="/admin/kategori" class="menu-item">
          <span>🏷️</span>
          Kategori
        </router-link>
      </nav>

      <div class="sidebar-bottom">
        <button class="library-button" @click="goToLibrary">
          <span>🏠</span>
          <span>Tampilan Perpus</span>
        </button>

        <button class="logout-button" @click="logout">
          <span>🚪</span>
          <span>Logout</span>
        </button>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">

      <!-- TOPBAR -->
      <header class="topbar">
        <div>
          <p class="welcome">Dashboard Admin / Anggota</p>

          <h1>Anggota</h1>

          <p class="subtitle">
            Kelola data anggota perpustakaan kamu.
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
          <div class="stat-icon blue">👥</div>

          <div>
            <span>Total Anggota</span>
            <h2>{{ users.length }}</h2>
            <small>Semua anggota</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon green">✓</div>

          <div>
            <span>Anggota Aktif</span>
            <h2>{{ users.length }}</h2>
            <small>Terdaftar</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon purple">📅</div>

          <div>
            <span>Terdaftar Bulan Ini</span>
            <h2>{{ registeredThisMonth }}</h2>
            <small>Anggota baru</small>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon orange">🔎</div>

          <div>
            <span>Hasil Pencarian</span>
            <h2>{{ filteredUsers.length }}</h2>
            <small>Data ditemukan</small>
          </div>
        </div>

      </section>

      <!-- DATA ANGGOTA -->
      <section class="panel">

        <div class="panel-header">
          <div>
            <h3>Data Anggota</h3>
            <p>
              Daftar anggota yang terdaftar di perpustakaan.
            </p>
          </div>
        </div>

        <!-- SEARCH -->
        <div class="toolbar">
          <div class="search-box">
            <span>🔍</span>

            <input
              v-model="search"
              type="text"
              placeholder="Cari nama atau email anggota..."
            />
          </div>

          <button class="refresh-button" @click="fetchUsers">
            🔄 Refresh
          </button>
        </div>

        <!-- LOADING -->
        <div v-if="loading" class="loading">
          <div class="spinner"></div>
          <p>Memuat data anggota...</p>
        </div>

        <!-- ERROR -->
        <div v-else-if="error" class="error-box">
          <span>⚠️</span>
          <div>
            <strong>Gagal mengambil data anggota</strong>
            <p>{{ error }}</p>
          </div>
        </div>

        <!-- TABLE -->
        <div v-else class="table-wrapper">

          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>ANGGOTA</th>
                <th>EMAIL</th>
                <th>TERDAFTAR</th>
                <th>STATUS</th>
                <th>AKSI</th>
              </tr>
            </thead>

            <tbody>

              <tr
                v-for="(user, index) in filteredUsers"
                :key="user.id"
              >

                <td>
                  <span class="number">
                    {{ index + 1 }}
                  </span>
                </td>

                <td>
                  <div class="member-cell">

                    <div class="member-avatar">
                      {{ getInitial(user.name) }}
                    </div>

                    <div>
                      <strong>
                        {{ user.name }}
                      </strong>

                      <small>
                        ID Anggota #{{ user.id }}
                      </small>
                    </div>

                  </div>
                </td>

                <td>
                  <span class="email">
                    {{ user.email }}
                  </span>
                </td>

                <td>
                  <span class="date">
                    {{ formatDate(user.created_at) }}
                  </span>
                </td>

                <td>
                  <span class="status">
                    <i></i>
                    Aktif
                  </span>
                </td>

                <td>
                  <button
                    class="detail-button"
                    @click="showDetail(user)"
                  >
                    👁 Detail
                  </button>
                </td>

              </tr>

              <tr v-if="filteredUsers.length === 0">
                <td colspan="6">
                  <div class="empty">
                    <div>👥</div>
                    <h3>Anggota tidak ditemukan</h3>
                    <p>
                      Belum ada anggota yang sesuai dengan pencarian.
                    </p>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>

        </div>

      </section>

    </main>

    <!-- DETAIL MODAL -->
    <div
      v-if="selectedUser"
      class="modal-overlay"
      @click.self="selectedUser = null"
    >

      <div class="modal">

        <button
          class="close-button"
          @click="selectedUser = null"
        >
          ×
        </button>

        <div class="modal-icon">
          {{ getInitial(selectedUser.name) }}
        </div>

        <h2>{{ selectedUser.name }}</h2>

        <p class="modal-role">
          Anggota Perpustakaan
        </p>

        <div class="detail-list">

          <div class="detail-item">
            <span>🆔</span>

            <div>
              <small>ID Anggota</small>
              <strong>#{{ selectedUser.id }}</strong>
            </div>
          </div>

          <div class="detail-item">
            <span>📧</span>

            <div>
              <small>Email</small>
              <strong>{{ selectedUser.email }}</strong>
            </div>
          </div>

          <div class="detail-item">
            <span>📅</span>

            <div>
              <small>Tanggal Terdaftar</small>
              <strong>
                {{ formatDate(selectedUser.created_at) }}
              </strong>
            </div>
          </div>

          <div class="detail-item">
            <span>🟢</span>

            <div>
              <small>Status</small>
              <strong class="active-text">Aktif</strong>
            </div>
          </div>

        </div>

        <button
          class="close-modal"
          @click="selectedUser = null"
        >
          Tutup
        </button>

      </div>

    </div>

    <!-- TOAST -->
    <transition name="toast">
      <div v-if="toast.show" class="toast">
        <span>✓</span>
        {{ toast.message }}
      </div>
    </transition>

  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../../utils/api'

const router = useRouter()

// ==============================
// ADMIN
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
// DATA
// ==============================

const users = ref([])
const search = ref('')
const loading = ref(false)
const error = ref('')
const selectedUser = ref(null)

const toast = ref({
  show: false,
  message: ''
})

// ==============================
// FILTER
// ==============================

const filteredUsers = computed(() => {
  const keyword = search.value.toLowerCase().trim()

  if (!keyword) {
    return users.value
  }

  return users.value.filter(user => {
    return (
      (user.name || '')
        .toLowerCase()
        .includes(keyword) ||

      (user.email || '')
        .toLowerCase()
        .includes(keyword)
    )
  })
})

// ==============================
// STATISTIK
// ==============================

const registeredThisMonth = computed(() => {
  const now = new Date()

  return users.value.filter(user => {
    if (!user.created_at) return false

    const date = new Date(user.created_at)

    return (
      date.getMonth() === now.getMonth() &&
      date.getFullYear() === now.getFullYear()
    )
  }).length
})

// ==============================
// GET USERS
// ==============================

async function fetchUsers() {
  loading.value = true
  error.value = ''

  try {
    const res = await api.get('/users')

    users.value =
      res.data.data?.data ||
      res.data.data ||
      []
  } catch (err) {
    console.error(err)

    error.value =
      err.response?.data?.message ||
      'Pastikan API anggota sudah tersedia di backend.'
  } finally {
    loading.value = false
  }
}

// ==============================
// DETAIL
// ==============================

function showDetail(user) {
  selectedUser.value = user
}

// ==============================
// INITIAL
// ==============================

function getInitial(name) {
  return (name || 'A')
    .charAt(0)
    .toUpperCase()
}

// ==============================
// DATE
// ==============================

function formatDate(date) {
  if (!date) return '-'

  return new Date(date).toLocaleDateString(
    'id-ID',
    {
      day: '2-digit',
      month: 'short',
      year: 'numeric'
    }
  )
}

// ==============================
// NAVIGATION
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
  }

  localStorage.removeItem('token')
  localStorage.removeItem('user')

  router.push('/login')
}

// ==============================
// TOAST
// ==============================

function showToast(message) {
  toast.value = {
    show: true,
    message
  }

  setTimeout(() => {
    toast.value.show = false
  }, 2500)
}

// ==============================
// MOUNT
// ==============================

onMounted(() => {
  fetchUsers()
})
</script>

<style scoped>
* {
  box-sizing: border-box;
}

.admin-page {
  min-height: 100vh;
  display: flex;
  background:
    radial-gradient(
      circle at 20% 10%,
      rgba(59, 130, 246, 0.14),
      transparent 28%
    ),
    radial-gradient(
      circle at 90% 80%,
      rgba(139, 92, 246, 0.12),
      transparent 30%
    ),
    #080d18;
  color: #e5edf9;
  overflow: hidden;
  position: relative;
}

/* ==============================
   ORBS
============================== */

.orb {
  position: fixed;
  border-radius: 50%;
  filter: blur(90px);
  pointer-events: none;
  opacity: 0.25;
}

.orb-1 {
  width: 280px;
  height: 280px;
  background: #2563eb;
  top: -100px;
  right: 120px;
}

.orb-2 {
  width: 250px;
  height: 250px;
  background: #7c3aed;
  bottom: -100px;
  left: 250px;
}

/* ==============================
   SIDEBAR
============================== */

.sidebar {
  width: 255px;
  min-width: 255px;
  min-height: 100vh;
  padding: 28px 18px;
  display: flex;
  flex-direction: column;

  background: rgba(10, 17, 31, 0.82);
  border-right: 1px solid rgba(255,255,255,0.07);

  backdrop-filter: blur(25px);
  -webkit-backdrop-filter: blur(25px);

  position: relative;
  z-index: 5;
}

.brand {
  display: flex;
  align-items: center;
  gap: 13px;
  padding: 4px 10px 32px;
}

.brand-icon {
  width: 45px;
  height: 45px;
  display: grid;
  place-items: center;

  background: linear-gradient(
    135deg,
    #2563eb,
    #4f46e5
  );

  border-radius: 14px;
  font-size: 22px;

  box-shadow:
    0 10px 30px rgba(37, 99, 235, 0.35);
}

.brand-text h2 {
  margin: 0;
  font-size: 19px;
  color: #fff;
}

.brand-text span {
  display: block;
  margin-top: 3px;
  font-size: 9px;
  letter-spacing: 2px;
  color: #71809b;
}

/* MENU */

.menu {
  display: flex;
  flex-direction: column;
  gap: 7px;
}

.menu-item {
  width: 100%;
  min-height: 50px;

  display: flex;
  align-items: center;
  gap: 13px;

  padding: 0 15px;

  border: 1px solid transparent;
  border-radius: 13px;

  color: #8997ae;
  text-decoration: none;

  background: transparent;

  font-size: 14px;
  font-weight: 500;

  transition: 0.25s;
}

.menu-item span {
  width: 24px;
  text-align: center;
  font-size: 17px;
}

.menu-item:hover {
  color: #fff;
  background: rgba(255,255,255,0.05);
}

.menu-item.active {
  color: #fff;
  background:
    linear-gradient(
      135deg,
      rgba(37, 99, 235, 0.25),
      rgba(79, 70, 229, 0.16)
    );

  border-color: rgba(96, 165, 250, 0.15);

  box-shadow:
    inset 3px 0 0 #3b82f6,
    0 8px 25px rgba(0,0,0,0.12);
}

/* SIDEBAR BOTTOM */

.sidebar-bottom {
  margin-top: auto;
  display: flex;
  flex-direction: column;
  gap: 9px;
}

.library-button,
.logout-button {
  width: 100%;
  height: 47px;

  display: flex;
  align-items: center;
  gap: 11px;

  padding: 0 15px;

  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.06);

  color: #9ba9bf;
  background: rgba(255,255,255,0.035);

  cursor: pointer;
  transition: 0.25s;
}

.library-button:hover {
  color: #fff;
  background: rgba(59,130,246,0.12);
}

.logout-button:hover {
  color: #fca5a5;
  background: rgba(239,68,68,0.1);
}

/* ==============================
   MAIN
============================== */

.main-content {
  flex: 1;
  min-width: 0;
  padding: 34px 40px;
  overflow-y: auto;
  position: relative;
  z-index: 2;
}

/* ==============================
   TOPBAR
============================== */

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
  margin-bottom: 32px;
}

.welcome {
  margin: 0 0 7px;
  color: #5f78a0;
  font-size: 12px;
  font-weight: 600;
}

.topbar h1 {
  margin: 0;
  font-size: 32px;
  letter-spacing: -0.8px;
  color: #fff;
}

.subtitle {
  margin: 7px 0 0;
  color: #75849c;
  font-size: 14px;
}

.top-actions {
  display: flex;
  align-items: center;
  gap: 22px;
}

.top-library {
  border: 1px solid rgba(96,165,250,0.18);
  background: rgba(59,130,246,0.08);
  color: #93c5fd;

  padding: 11px 17px;
  border-radius: 11px;

  cursor: pointer;
  transition: 0.25s;
}

.top-library:hover {
  background: rgba(59,130,246,0.16);
}

.admin-profile {
  display: flex;
  align-items: center;
  gap: 11px;
}

.avatar {
  width: 43px;
  height: 43px;

  display: grid;
  place-items: center;

  border-radius: 50%;

  background: linear-gradient(
    135deg,
    #2563eb,
    #7c3aed
  );

  color: #fff;
  font-weight: 700;

  box-shadow:
    0 8px 25px rgba(37,99,235,0.3);
}

.admin-info strong {
  display: block;
  color: #eaf1fc;
  font-size: 13px;
}

.admin-info span {
  display: block;
  margin-top: 3px;
  color: #687892;
  font-size: 11px;
}

/* ==============================
   STATS
============================== */

.stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 24px;
}

.stat-card {
  min-height: 125px;

  display: flex;
  align-items: center;
  gap: 15px;

  padding: 20px;

  background: rgba(16, 25, 43, 0.65);
  border: 1px solid rgba(255,255,255,0.065);
  border-radius: 18px;

  backdrop-filter: blur(18px);

  box-shadow:
    0 15px 35px rgba(0,0,0,0.12);

  transition: 0.25s;
}

.stat-card:hover {
  transform: translateY(-3px);
  border-color: rgba(96,165,250,0.18);
}

.stat-icon {
  width: 49px;
  height: 49px;

  display: grid;
  place-items: center;

  border-radius: 14px;
  font-size: 20px;
}

.stat-icon.blue {
  background: rgba(59,130,246,0.13);
}

.stat-icon.green {
  background: rgba(34,197,94,0.12);
}

.stat-icon.purple {
  background: rgba(139,92,246,0.13);
}

.stat-icon.orange {
  background: rgba(249,115,22,0.12);
}

.stat-card span {
  color: #73829b;
  font-size: 11px;
}

.stat-card h2 {
  margin: 5px 0 2px;
  color: #fff;
  font-size: 26px;
}

.stat-card small {
  color: #53647e;
  font-size: 10px;
}

/* ==============================
   PANEL
============================== */

.panel {
  background: rgba(14, 23, 40, 0.72);
  border: 1px solid rgba(255,255,255,0.065);
  border-radius: 20px;

  backdrop-filter: blur(20px);

  box-shadow:
    0 20px 50px rgba(0,0,0,0.15);

  overflow: hidden;
}

.panel-header {
  padding: 25px 27px 18px;

  display: flex;
  justify-content: space-between;
  align-items: center;
}

.panel-header h3 {
  margin: 0;
  font-size: 17px;
  color: #f2f6fd;
}

.panel-header p {
  margin: 6px 0 0;
  color: #687993;
  font-size: 12px;
}

/* ==============================
   TOOLBAR
============================== */

.toolbar {
  padding: 0 27px 20px;

  display: flex;
  align-items: center;
  gap: 12px;
}

.search-box {
  flex: 1;
  max-width: 480px;

  height: 43px;

  display: flex;
  align-items: center;
  gap: 10px;

  padding: 0 14px;

  background: rgba(255,255,255,0.035);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 11px;
}

.search-box span {
  opacity: 0.6;
}

.search-box input {
  width: 100%;

  background: transparent;
  border: none;
  outline: none;

  color: #dce7f7;
  font-size: 12px;
}

.search-box input::placeholder {
  color: #52627b;
}

.refresh-button {
  height: 43px;
  padding: 0 16px;

  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 11px;

  background: rgba(255,255,255,0.035);
  color: #9aa8bc;

  cursor: pointer;
  transition: 0.25s;
}

.refresh-button:hover {
  color: #fff;
  background: rgba(59,130,246,0.1);
}

/* ==============================
   TABLE
============================== */

.table-wrapper {
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background: rgba(255,255,255,0.025);
}

th {
  padding: 13px 20px;

  color: #596a85;

  text-align: left;

  font-size: 9px;
  font-weight: 700;
  letter-spacing: 1px;

  white-space: nowrap;
}

td {
  padding: 16px 20px;

  border-top: 1px solid rgba(255,255,255,0.045);

  color: #9aa8bc;
  font-size: 12px;
}

tbody tr {
  transition: 0.2s;
}

tbody tr:hover {
  background: rgba(59,130,246,0.035);
}

.number {
  color: #596b87;
  font-size: 11px;
}

/* MEMBER */

.member-cell {
  display: flex;
  align-items: center;
  gap: 11px;
}

.member-avatar {
  width: 39px;
  height: 39px;

  display: grid;
  place-items: center;

  flex-shrink: 0;

  border-radius: 11px;

  background: linear-gradient(
    135deg,
    rgba(37,99,235,0.28),
    rgba(124,58,237,0.25)
  );

  color: #bfdbfe;
  font-weight: 700;
}

.member-cell strong {
  display: block;
  color: #dce6f5;
  font-size: 12px;
}

.member-cell small {
  display: block;
  margin-top: 3px;
  color: #566780;
  font-size: 9px;
}

.email {
  color: #8fa0b8;
}

.date {
  color: #7788a1;
}

/* STATUS */

.status {
  display: inline-flex;
  align-items: center;
  gap: 6px;

  padding: 6px 9px;

  border-radius: 20px;

  background: rgba(34,197,94,0.08);
  color: #86efac;

  font-size: 10px;
}

.status i {
  width: 6px;
  height: 6px;

  display: block;

  border-radius: 50%;
  background: #4ade80;

  box-shadow: 0 0 8px #4ade80;
}

/* DETAIL BUTTON */

.detail-button {
  padding: 7px 11px;

  border-radius: 8px;

  border: 1px solid rgba(96,165,250,0.12);

  background: rgba(59,130,246,0.08);
  color: #8dbcf7;

  cursor: pointer;
  font-size: 10px;

  transition: 0.2s;
}

.detail-button:hover {
  background: rgba(59,130,246,0.18);
  color: #fff;
}

/* ==============================
   EMPTY
============================== */

.empty {
  padding: 55px 20px;
  text-align: center;
}

.empty > div {
  font-size: 42px;
  opacity: 0.45;
}

.empty h3 {
  margin: 12px 0 5px;
  color: #9aa8bc;
  font-size: 15px;
}

.empty p {
  margin: 0;
  color: #53627a;
  font-size: 11px;
}

/* ==============================
   LOADING
============================== */

.loading {
  padding: 70px;
  text-align: center;
  color: #687993;
}

.spinner {
  width: 32px;
  height: 32px;

  margin: 0 auto 14px;

  border: 3px solid rgba(255,255,255,0.08);
  border-top-color: #3b82f6;

  border-radius: 50%;

  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* ==============================
   ERROR
============================== */

.error-box {
  margin: 20px 27px;
  padding: 17px;

  display: flex;
  align-items: flex-start;
  gap: 13px;

  border-radius: 12px;

  background: rgba(239,68,68,0.08);
  border: 1px solid rgba(239,68,68,0.14);

  color: #fca5a5;
}

.error-box strong {
  font-size: 12px;
}

.error-box p {
  margin: 5px 0 0;
  color: #9b6970;
  font-size: 10px;
}

/* ==============================
   MODAL
============================== */

.modal-overlay {
  position: fixed;
  inset: 0;

  display: grid;
  place-items: center;

  padding: 20px;

  background: rgba(2,6,15,0.72);

  backdrop-filter: blur(9px);

  z-index: 50;
}

.modal {
  width: min(430px, 100%);

  padding: 32px;

  position: relative;

  border: 1px solid rgba(255,255,255,0.09);
  border-radius: 22px;

  background:
    linear-gradient(
      145deg,
      rgba(20,31,52,0.98),
      rgba(10,17,31,0.98)
    );

  box-shadow:
    0 30px 80px rgba(0,0,0,0.45);
}

.close-button {
  position: absolute;
  top: 15px;
  right: 17px;

  width: 33px;
  height: 33px;

  border: none;
  border-radius: 50%;

  background: rgba(255,255,255,0.05);
  color: #8998ae;

  font-size: 22px;

  cursor: pointer;
}

.modal-icon {
  width: 68px;
  height: 68px;

  display: grid;
  place-items: center;

  margin: 0 auto 16px;

  border-radius: 19px;

  background: linear-gradient(
    135deg,
    #2563eb,
    #7c3aed
  );

  color: #fff;

  font-size: 24px;
  font-weight: 700;

  box-shadow:
    0 15px 35px rgba(37,99,235,0.3);
}

.modal h2 {
  margin: 0;

  text-align: center;

  color: #fff;
  font-size: 20px;
}

.modal-role {
  margin: 6px 0 25px;

  text-align: center;

  color: #697a94;
  font-size: 11px;
}

.detail-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.detail-item {
  display: flex;
  align-items: center;
  gap: 13px;

  padding: 13px;

  border-radius: 12px;

  background: rgba(255,255,255,0.035);
  border: 1px solid rgba(255,255,255,0.05);
}

.detail-item > span {
  width: 34px;
  height: 34px;

  display: grid;
  place-items: center;

  border-radius: 9px;

  background: rgba(59,130,246,0.09);
}

.detail-item small {
  display: block;
  color: #596a83;
  font-size: 9px;
}

.detail-item strong {
  display: block;
  margin-top: 3px;
  color: #dbe5f3;
  font-size: 11px;
}

.active-text {
  color: #86efac !important;
}

.close-modal {
  width: 100%;
  height: 43px;

  margin-top: 20px;

  border: none;
  border-radius: 11px;

  background: linear-gradient(
    135deg,
    #2563eb,
    #4f46e5
  );

  color: #fff;

  cursor: pointer;
  font-weight: 600;

  box-shadow:
    0 10px 25px rgba(37,99,235,0.25);
}

/* ==============================
   TOAST
============================== */

.toast {
  position: fixed;
  right: 28px;
  bottom: 28px;

  display: flex;
  align-items: center;
  gap: 10px;

  padding: 13px 17px;

  border-radius: 12px;

  background: rgba(20,31,52,0.95);
  border: 1px solid rgba(255,255,255,0.08);

  color: #dbeafe;

  box-shadow:
    0 15px 40px rgba(0,0,0,0.3);

  z-index: 100;
  font-size: 12px;
}

.toast > span {
  width: 22px;
  height: 22px;

  display: grid;
  place-items: center;

  border-radius: 50%;

  background: rgba(34,197,94,0.15);
  color: #86efac;
}

/* ==============================
   RESPONSIVE
============================== */

@media (max-width: 1100px) {
  .stats {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 800px) {
  .sidebar {
    width: 80px;
    min-width: 80px;
    padding: 20px 10px;
  }

  .brand-text,
  .menu-item:not(.active) {
    font-size: 0;
  }

  .brand {
    justify-content: center;
    padding-left: 0;
    padding-right: 0;
  }

  .menu-item {
    justify-content: center;
    padding: 0;
  }

  .menu-item span {
    font-size: 17px;
  }

  .sidebar-bottom button span:last-child {
    display: none;
  }

  .sidebar-bottom button {
    justify-content: center;
    padding: 0;
  }

  .main-content {
    padding: 25px 20px;
  }

  .topbar {
    align-items: flex-start;
  }

  .admin-info,
  .top-library {
    display: none;
  }
}

@media (max-width: 600px) {
  .stats {
    grid-template-columns: 1fr;
  }

  .topbar h1 {
    font-size: 25px;
  }

  .main-content {
    padding: 20px 14px;
  }

  .panel-header,
  .toolbar {
    padding-left: 17px;
    padding-right: 17px;
  }

  .toolbar {
    flex-direction: column;
    align-items: stretch;
  }

  .search-box {
    max-width: none;
  }
}
</style>