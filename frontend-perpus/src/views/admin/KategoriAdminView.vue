<template>
  <div class="admin-layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

      <div class="brand">
        <div class="brand-logo">📚</div>

        <div>
          <strong>PerpusKu</strong>
          <span>ADMIN PANEL</span>
        </div>
      </div>

      <div class="menu-title">
        MENU UTAMA
      </div>

      <nav class="menu">

        <router-link to="/admin" class="menu-item">
          <span class="menu-icon">⌂</span>
          <span>Dashboard</span>
        </router-link>

        <router-link to="/admin/buku" class="menu-item">
          <span class="menu-icon">📖</span>
          <span>Data Buku</span>
        </router-link>

        <router-link to="/admin/anggota" class="menu-item">
          <span class="menu-icon">👥</span>
          <span>Anggota</span>
        </router-link>

        <router-link to="/admin/peminjaman" class="menu-item">
          <span class="menu-icon">↔</span>
          <span>Peminjaman</span>
        </router-link>

        <router-link
          to="/admin/kategori"
          class="menu-item active"
        >
          <span class="menu-icon">▦</span>
          <span>Kategori</span>
        </router-link>

      </nav>

      <div class="sidebar-bottom">

        <router-link to="/" class="bottom-item">
          <span>🌐</span>
          Tampilan Perpus
        </router-link>

        <button
          class="bottom-item logout"
          @click="logout"
        >
          <span>↪</span>
          Logout
        </button>

      </div>

    </aside>


    <!-- MAIN -->
    <main class="main-content">

      <!-- TOPBAR -->
      <header class="topbar">

        <div>

          <div class="breadcrumb">
            Admin
            <span>/</span>
            Kategori
          </div>

          <h1>Data Kategori</h1>

          <p>
            Kelola kategori buku perpustakaan.
          </p>

        </div>


        <div class="top-actions">

          <button
            class="view-library"
            @click="goHome"
          >
            🌐 Lihat Perpus
          </button>


          <div class="admin-profile">

            <div class="profile-avatar">
              {{ userInitial }}
            </div>

            <div class="profile-info">

              <strong>
                {{ adminName }}
              </strong>

              <span>
                Administrator
              </span>

            </div>

          </div>

        </div>

      </header>


      <!-- ERROR API -->
      <div
        v-if="pageError"
        class="api-error"
      >
        <span>⚠️</span>

        <div>
          <strong>Gagal memuat data kategori</strong>
          <small>{{ pageError }}</small>
        </div>

        <button @click="getCategories">
          Coba Lagi
        </button>
      </div>


      <!-- STATISTICS -->
      <section class="stats-grid">

        <!-- TOTAL KATEGORI -->
        <div class="stat-card">

          <div class="stat-icon purple">
            ▦
          </div>

          <div>

            <span>
              Total Kategori
            </span>

            <strong>
              {{ loading ? '...' : categories.length }}
            </strong>

          </div>

        </div>


        <!-- TOTAL BUKU -->
        <div class="stat-card">

          <div class="stat-icon blue">
            📖
          </div>

          <div>

            <span>
              Total Buku
            </span>

            <strong>
              {{ loading ? '...' : totalBooks }}
            </strong>

          </div>

        </div>


        <!-- KATEGORI AKTIF -->
        <div class="stat-card">

          <div class="stat-icon green">
            ✓
          </div>

          <div>

            <span>
              Kategori Aktif
            </span>

            <strong>
              {{ loading ? '...' : activeCategories }}
            </strong>

          </div>

        </div>


        <!-- PALING POPULER -->
        <div class="stat-card">

          <div class="stat-icon orange">
            ★
          </div>

          <div>

            <span>
              Paling Populer
            </span>

            <strong class="popular-name">
              {{ loading ? '...' : mostPopular }}
            </strong>

          </div>

        </div>

      </section>


      <!-- CONTENT -->
      <section class="content-card">

        <!-- HEADER -->
        <div class="content-header">

          <div>

            <h2>
              Daftar Kategori
            </h2>

            <p>
              Kelola kategori yang digunakan pada koleksi buku.
            </p>

          </div>


          <button
            class="add-button"
            @click="openAddModal"
          >
            <span>＋</span>
            Tambah Kategori
          </button>

        </div>


        <!-- TOOLBAR -->
        <div class="toolbar">

          <div class="search-box">

            <span>⌕</span>

            <input
              v-model="search"
              type="text"
              placeholder="Cari kategori..."
            />

          </div>


          <div class="result-info">

            {{ filteredCategories.length }}
            kategori

          </div>

        </div>


        <!-- LOADING -->
        <div
          v-if="loading"
          class="loading-state"
        >

          <div class="loading-spinner"></div>

          <p>
            Memuat data kategori...
          </p>

        </div>


        <!-- TABLE -->
        <div
          v-else
          class="table-wrapper"
        >

          <table>

            <thead>

              <tr>

                <th width="70">
                  #
                </th>

                <th>
                  KATEGORI
                </th>

                <th width="180">
                  JUMLAH BUKU
                </th>

                <th width="150">
                  STATUS
                </th>

                <th width="180">
                  AKSI
                </th>

              </tr>

            </thead>


            <tbody>

              <tr
                v-for="(category, index) in filteredCategories"
                :key="category.id"
              >

                <!-- NUMBER -->
                <td>

                  <span class="number">
                    {{ index + 1 }}
                  </span>

                </td>


                <!-- CATEGORY -->
                <td>

                  <div class="category-cell">

                    <div class="category-icon">
                      {{ getCategoryIcon(category.nama) }}
                    </div>

                    <div>

                      <strong>
                        {{ category.nama }}
                      </strong>

                      <small>
                        ID #{{ category.id }}
                      </small>

                    </div>

                  </div>

                </td>


                <!-- BOOK COUNT -->
                <td>

                  <div class="book-count">

                    <strong>
                      {{ getBookCount(category) }}
                    </strong>

                    <span>
                      buku
                    </span>

                  </div>

                </td>


                <!-- STATUS -->
                <td>

                  <span class="status active">

                    <i></i>

                    Aktif

                  </span>

                </td>


                <!-- ACTION -->
                <td>

                  <div class="actions">

                    <button
                      class="action-btn edit"
                      title="Edit"
                      @click="openEditModal(category)"
                    >
                      ✎
                    </button>

                    <button
                      class="action-btn delete"
                      title="Hapus"
                      @click="confirmDelete(category)"
                    >
                      🗑
                    </button>

                  </div>

                </td>

              </tr>


              <!-- EMPTY -->
              <tr
                v-if="filteredCategories.length === 0"
              >

                <td colspan="5">

                  <div class="empty-state">

                    <div>🔎</div>

                    <h3>
                      Kategori tidak ditemukan
                    </h3>

                    <p>
                      Coba gunakan kata pencarian yang berbeda.
                    </p>

                  </div>

                </td>

              </tr>

            </tbody>

          </table>

        </div>

      </section>

    </main>


    <!-- ADD / EDIT MODAL -->
    <div
      v-if="showModal"
      class="modal-overlay"
      @click.self="closeModal"
    >

      <div class="modal">

        <!-- MODAL HEADER -->
        <div class="modal-header">

          <div>

            <span class="modal-label">
              {{ editMode ? 'EDIT DATA' : 'DATA BARU' }}
            </span>

            <h2>
              {{ editMode
                ? 'Edit Kategori'
                : 'Tambah Kategori'
              }}
            </h2>

          </div>


          <button
            class="close-btn"
            @click="closeModal"
          >
            ×
          </button>

        </div>


        <!-- MODAL BODY -->
        <div class="modal-body">

          <label>
            Nama Kategori
          </label>

          <div class="input-wrapper">

            <span>▦</span>

            <input
              v-model="form.nama"
              type="text"
              placeholder="Contoh: Pemrograman"
              @keyup.enter="saveCategory"
            />

          </div>


          <p
            v-if="formError"
            class="form-error"
          >
            ⚠ {{ formError }}
          </p>

        </div>


        <!-- MODAL FOOTER -->
        <div class="modal-footer">

          <button
            class="cancel-btn"
            @click="closeModal"
          >
            Batal
          </button>

          <button
            class="save-btn"
            :disabled="saving"
            @click="saveCategory"
          >

            <span v-if="saving">
              Menyimpan...
            </span>

            <span v-else>
              {{ editMode
                ? 'Simpan Perubahan'
                : 'Tambah Kategori'
              }}
            </span>

          </button>

        </div>

      </div>

    </div>


    <!-- DELETE MODAL -->
    <div
      v-if="showDeleteModal"
      class="modal-overlay"
      @click.self="showDeleteModal = false"
    >

      <div class="delete-modal">

        <div class="delete-icon">
          🗑
        </div>

        <h2>
          Hapus Kategori?
        </h2>

        <p>

          Apakah kamu yakin ingin menghapus kategori

          <strong>
            {{ selectedCategory?.nama }}
          </strong>?

        </p>

        <div class="delete-warning">

          ⚠ Data kategori akan dihapus dari database.

        </div>


        <div class="delete-actions">

          <button
            class="cancel-btn"
            @click="showDeleteModal = false"
          >
            Batal
          </button>

          <button
            class="delete-confirm"
            :disabled="deleting"
            @click="deleteCategory"
          >

            {{ deleting
              ? 'Menghapus...'
              : 'Ya, Hapus'
            }}

          </button>

        </div>

      </div>

    </div>


    <!-- SUCCESS NOTIFICATION -->
    <Transition name="toast">

      <div
        v-if="successMessage"
        class="success-toast"
      >

        <span class="toast-icon">
          ✓
        </span>

        <span>
          {{ successMessage }}
        </span>

      </div>

    </Transition>

  </div>
</template>


<script setup>
import {
  ref,
  computed,
  onMounted
} from 'vue'

import {
  useRouter
} from 'vue-router'

import api from '../../utils/api'


const router = useRouter()


// ==========================================
// USER
// ==========================================

const adminName = ref('Administrator')

const userInitial = computed(() => {
  return adminName.value
    .charAt(0)
    .toUpperCase()
})


function loadUser() {

  const savedUser =
    localStorage.getItem('user')

  if (!savedUser) {
    return
  }

  try {

    const user =
      JSON.parse(savedUser)

    if (user?.name) {
      adminName.value =
        user.name
    }

  } catch (error) {

    console.log(
      'User data tidak valid'
    )

  }

}


// ==========================================
// DATA KATEGORI
// ==========================================

const categories = ref([])

const loading = ref(false)

const pageError = ref('')


// ==========================================
// GET CATEGORY
// ==========================================

async function getCategories() {

  loading.value = true
  pageError.value = ''

  try {

    const response =
      await api.get('/kategori')

    const data =
      response.data?.data

    if (Array.isArray(data)) {

      categories.value =
        data.map(category => ({
          id: category.id,
          nama: category.nama,
          jumlah_buku:
            category.bukus_count ??
            category.jumlah_buku ??
            0
        }))

    } else {

      categories.value = []

    }

  } catch (error) {

    console.error(
      'Gagal mengambil data kategori:',
      error
    )

    pageError.value =
      error.response?.data?.message ||
      'Tidak dapat terhubung ke server.'

  } finally {

    loading.value = false

  }

}


// ==========================================
// SEARCH
// ==========================================

const search = ref('')


const filteredCategories =
  computed(() => {

    const keyword =
      search.value
        .toLowerCase()
        .trim()

    if (!keyword) {
      return categories.value
    }

    return categories.value.filter(
      category =>
        category.nama
          .toLowerCase()
          .includes(keyword)
    )

  })


// ==========================================
// STATISTICS
// ==========================================

const totalBooks =
  computed(() => {

    return categories.value.reduce(
      (total, category) =>
        total +
        Number(
          category.jumlah_buku || 0
        ),
      0
    )

  })


const activeCategories =
  computed(() => {

    return categories.value.length

  })


const mostPopular =
  computed(() => {

    if (!categories.value.length) {
      return '-'
    }

    const popular =
      categories.value.reduce(
        (prev, current) => {

          return Number(
            current.jumlah_buku || 0
          ) >
          Number(
            prev.jumlah_buku || 0
          )
            ? current
            : prev

        }
      )

    return popular.nama

  })


// ==========================================
// CATEGORY ICON
// ==========================================

function getCategoryIcon(nama) {

  const name =
    String(nama || '')
      .toLowerCase()

  if (
    name.includes('program') ||
    name.includes('coding') ||
    name.includes('teknologi')
  ) {
    return '💻'
  }

  if (
    name.includes('database') ||
    name.includes('data')
  ) {
    return '🗄️'
  }

  if (
    name.includes('desain') ||
    name.includes('design')
  ) {
    return '🎨'
  }

  if (
    name.includes('sejarah')
  ) {
    return '🏛️'
  }

  if (
    name.includes('sains') ||
    name.includes('science')
  ) {
    return '🔬'
  }

  if (
    name.includes('novel')
  ) {
    return '📚'
  }

  if (
    name.includes('komik')
  ) {
    return '💥'
  }

  if (
    name.includes('pendidikan')
  ) {
    return '🎓'
  }

  return '📚'

}


// ==========================================
// BOOK COUNT
// ==========================================

function getBookCount(category) {

  return Number(
    category.jumlah_buku || 0
  )

}


// ==========================================
// MODAL
// ==========================================

const showModal =
  ref(false)

const editMode =
  ref(false)

const formError =
  ref('')

const saving =
  ref(false)


const form =
  ref({
    id: null,
    nama: ''
  })


function openAddModal() {

  editMode.value = false

  formError.value = ''

  form.value = {
    id: null,
    nama: ''
  }

  showModal.value = true

}


function openEditModal(category) {

  editMode.value = true

  formError.value = ''

  form.value = {
    id: category.id,
    nama: category.nama
  }

  showModal.value = true

}


function closeModal() {

  if (saving.value) {
    return
  }

  showModal.value = false

  formError.value = ''

}


// ==========================================
// SAVE CATEGORY
// ==========================================

async function saveCategory() {

  const nama =
    form.value.nama.trim()


  if (!nama) {

    formError.value =
      'Nama kategori wajib diisi.'

    return

  }


  const duplicate =
    categories.value.some(
      category =>
        category.nama
          .toLowerCase() ===
        nama.toLowerCase() &&
        category.id !==
        form.value.id
    )


  if (duplicate) {

    formError.value =
      'Kategori tersebut sudah ada.'

    return

  }


  saving.value = true

  formError.value = ''


  try {

    // ==============================
    // EDIT
    // ==============================

    if (editMode.value) {

      const response =
        await api.put(
          `/kategori/${form.value.id}`,
          {
            nama: nama
          }
        )


      const updated =
        response.data?.data


      const index =
        categories.value.findIndex(
          category =>
            category.id ===
            form.value.id
        )


      if (index !== -1) {

        categories.value[index] = {

          ...categories.value[index],

          id:
            updated?.id ??
            form.value.id,

          nama:
            updated?.nama ??
            nama,

          jumlah_buku:
            updated?.bukus_count ??
            categories.value[index]
              .jumlah_buku ??
            0

        }

      }


      showSuccess(
        'Kategori berhasil diperbarui.'
      )

    }

    // ==============================
    // TAMBAH
    // ==============================

    else {

      const response =
        await api.post(
          '/kategori',
          {
            nama: nama
          }
        )


      const newCategory =
        response.data?.data


      if (newCategory) {

        categories.value.push({

          id:
            newCategory.id,

          nama:
            newCategory.nama,

          jumlah_buku:
            newCategory.bukus_count ??
            0

        })

      } else {

        await getCategories()

      }


      showSuccess(
        'Kategori berhasil ditambahkan.'
      )

    }


    closeModal()

  } catch (error) {

    console.error(
      'Gagal menyimpan kategori:',
      error
    )


    const errors =
      error.response?.data?.errors


    if (
      errors?.nama?.length
    ) {

      formError.value =
        errors.nama[0]

    } else {

      formError.value =
        error.response?.data?.message ||
        'Gagal menyimpan kategori.'

    }

  } finally {

    saving.value = false

  }

}


// ==========================================
// DELETE
// ==========================================

const showDeleteModal =
  ref(false)

const selectedCategory =
  ref(null)

const deleting =
  ref(false)


function confirmDelete(category) {

  selectedCategory.value =
    category

  showDeleteModal.value =
    true

}


async function deleteCategory() {

  if (
    !selectedCategory.value ||
    deleting.value
  ) {
    return
  }


  deleting.value = true


  try {

    await api.delete(
      `/kategori/${selectedCategory.value.id}`
    )


    categories.value =
      categories.value.filter(
        category =>
          category.id !==
          selectedCategory.value.id
      )


    showSuccess(
      'Kategori berhasil dihapus.'
    )


    selectedCategory.value =
      null

    showDeleteModal.value =
      false

  } catch (error) {

    console.error(
      'Gagal menghapus kategori:',
      error
    )


    alert(
      error.response?.data?.message ||
      'Kategori gagal dihapus.'
    )

  } finally {

    deleting.value = false

  }

}


// ==========================================
// SUCCESS TOAST
// ==========================================

const successMessage =
  ref('')


let toastTimer = null


function showSuccess(message) {

  successMessage.value =
    message


  clearTimeout(toastTimer)


  toastTimer =
    setTimeout(() => {

      successMessage.value = ''

    }, 3000)

}


// ==========================================
// NAVIGATION
// ==========================================

function goHome() {

  router.push('/')

}


async function logout() {

  try {

    await api.post('/logout')

  } catch (error) {

    console.log(
      'Logout API gagal.'
    )

  }


  localStorage.removeItem(
    'token'
  )

  localStorage.removeItem(
    'user'
  )


  router.push('/login')

}


// ==========================================
// ON MOUNTED
// ==========================================

onMounted(() => {

  loadUser()

  getCategories()

})

</script>


<style scoped>

* {
  box-sizing: border-box;
}


/* ==========================================
   LAYOUT
========================================== */

.admin-layout {

  min-height: 100vh;

  background:
    radial-gradient(
      circle at 80% 10%,
      rgba(79, 70, 229, .12),
      transparent 30%
    ),
    radial-gradient(
      circle at 10% 90%,
      rgba(59, 130, 246, .08),
      transparent 28%
    ),
    #080d18;

  color: #e8edf7;

  display: flex;

  font-family:
    Inter,
    ui-sans-serif,
    system-ui,
    -apple-system,
    BlinkMacSystemFont,
    "Segoe UI",
    sans-serif;

}


/* ==========================================
   SIDEBAR
========================================== */

.sidebar {

  width: 230px;
  min-width: 230px;
  min-height: 100vh;

  background:
    rgba(9, 15, 28, .92);

  border-right:
    1px solid rgba(255,255,255,.07);

  padding: 24px 14px;

  display: flex;
  flex-direction: column;

  position: sticky;

  top: 0;

  height: 100vh;

  backdrop-filter: blur(18px);

}


.brand {

  display: flex;
  align-items: center;

  gap: 11px;

  padding:
    6px 8px 28px;

}


.brand-logo {

  width: 42px;
  height: 42px;

  border-radius: 12px;

  display: grid;
  place-items: center;

  font-size: 21px;

  background:
    linear-gradient(
      135deg,
      rgba(96,165,250,.22),
      rgba(129,140,248,.14)
    );

  border:
    1px solid rgba(147,197,253,.15);

}


.brand strong {

  display: block;

  font-size: 16px;

  letter-spacing: -.3px;

}


.brand span {

  display: block;

  margin-top: 3px;

  font-size: 8px;

  letter-spacing: 1.7px;

  color: #64748b;

}


.menu-title {

  padding:
    0 11px 9px;

  font-size: 9px;

  font-weight: 700;

  letter-spacing: 1.3px;

  color: #475569;

}


.menu {

  display: flex;

  flex-direction: column;

  gap: 4px;

}


.menu-item,
.bottom-item {

  text-decoration: none;

  border-radius: 11px;

  padding: 11px 12px;

  display: flex;

  align-items: center;

  gap: 11px;

  color: #7f8da5;

  font-size: 13px;

  font-weight: 600;

  border: 1px solid transparent;

  transition: .2s ease;

}


.menu-item:hover {

  color: #e2e8f0;

  background:
    rgba(255,255,255,.035);

}


.menu-item.active {

  color: #dbeafe;

  background:
    linear-gradient(
      135deg,
      rgba(59,130,246,.16),
      rgba(99,102,241,.08)
    );

  border-color:
    rgba(96,165,250,.13);

  box-shadow:
    0 7px 24px rgba(0,0,0,.12);

}


.menu-icon {

  width: 20px;

  text-align: center;

  font-size: 15px;

}


.sidebar-bottom {

  margin-top: auto;

  padding-top: 16px;

  border-top:
    1px solid rgba(255,255,255,.06);

  display: flex;

  flex-direction: column;

  gap: 4px;

}


.bottom-item {

  width: 100%;

  background: transparent;

  border: 0;

  cursor: pointer;

  font-family: inherit;

  text-align: left;

}


.bottom-item:hover {

  background:
    rgba(255,255,255,.04);

  color: #dbeafe;

}


.logout:hover {

  color: #fca5a5;

}


/* ==========================================
   MAIN
========================================== */

.main-content {

  flex: 1;

  min-width: 0;

  padding:
    32px 34px 50px;

}


.topbar {

  display: flex;

  justify-content: space-between;

  align-items: center;

  gap: 20px;

  margin-bottom: 28px;

}


.breadcrumb {

  color: #475569;

  font-size: 11px;

  margin-bottom: 8px;

}


.breadcrumb span {

  margin: 0 6px;

  color: #334155;

}


.topbar h1 {

  margin: 0;

  font-size: 28px;

  letter-spacing: -.9px;

}


.topbar p {

  margin:
    7px 0 0;

  color: #64748b;

  font-size: 13px;

}


.top-actions {

  display: flex;

  align-items: center;

  gap: 16px;

}


.view-library {

  border:
    1px solid rgba(255,255,255,.08);

  background:
    rgba(255,255,255,.035);

  color: #cbd5e1;

  padding:
    10px 14px;

  border-radius: 10px;

  cursor: pointer;

  font-size: 12px;

  font-weight: 600;

  transition: .2s;

}


.view-library:hover {

  background:
    rgba(255,255,255,.07);

  border-color:
    rgba(147,197,253,.2);

}


.admin-profile {

  display: flex;

  align-items: center;

  gap: 10px;

  padding-left: 15px;

  border-left:
    1px solid rgba(255,255,255,.07);

}


.profile-avatar {

  width: 38px;
  height: 38px;

  border-radius: 50%;

  display: grid;

  place-items: center;

  background:
    linear-gradient(
      135deg,
      #3b82f6,
      #6366f1
    );

  color: white;

  font-size: 13px;

  font-weight: 800;

  box-shadow:
    0 5px 20px rgba(59,130,246,.22);

}


.profile-info strong {

  display: block;

  font-size: 12px;

}


.profile-info span {

  display: block;

  color: #64748b;

  font-size: 10px;

  margin-top: 2px;

}


/* ==========================================
   API ERROR
========================================== */

.api-error {

  margin-bottom: 18px;

  padding: 13px 15px;

  display: flex;

  align-items: center;

  gap: 11px;

  border-radius: 12px;

  background:
    rgba(239,68,68,.07);

  border:
    1px solid rgba(239,68,68,.14);

  color: #fca5a5;

}


.api-error > span {

  font-size: 18px;

}


.api-error div {

  flex: 1;

}


.api-error strong {

  display: block;

  font-size: 11px;

}


.api-error small {

  display: block;

  margin-top: 3px;

  color: #94a3b8;

  font-size: 9px;

}


.api-error button {

  padding:
    8px 11px;

  border:
    1px solid rgba(239,68,68,.2);

  border-radius: 8px;

  background:
    rgba(239,68,68,.08);

  color: #fca5a5;

  cursor: pointer;

  font-size: 10px;

  font-weight: 700;

}


/* ==========================================
   STATS
========================================== */

.stats-grid {

  display: grid;

  grid-template-columns:
    repeat(4, minmax(0, 1fr));

  gap: 13px;

  margin-bottom: 18px;

}


.stat-card {

  min-height: 94px;

  display: flex;

  align-items: center;

  gap: 13px;

  padding: 16px;

  border-radius: 15px;

  background:
    linear-gradient(
      145deg,
      rgba(255,255,255,.055),
      rgba(255,255,255,.018)
    );

  border:
    1px solid rgba(255,255,255,.07);

  box-shadow:
    0 12px 30px rgba(0,0,0,.12);

  transition: .2s;

}


.stat-card:hover {

  transform:
    translateY(-2px);

  border-color:
    rgba(147,197,253,.13);

}


.stat-icon {

  width: 42px;
  height: 42px;

  border-radius: 12px;

  display: grid;

  place-items: center;

  font-size: 18px;

  flex-shrink: 0;

}


.stat-icon.purple {

  background:
    rgba(139,92,246,.12);

  color: #a78bfa;

}


.stat-icon.blue {

  background:
    rgba(59,130,246,.12);

  color: #60a5fa;

}


.stat-icon.green {

  background:
    rgba(34,197,94,.10);

  color: #4ade80;

}


.stat-icon.orange {

  background:
    rgba(249,115,22,.10);

  color: #fb923c;

}


.stat-card span {

  display: block;

  color: #64748b;

  font-size: 10px;

  margin-bottom: 4px;

}


.stat-card strong {

  display: block;

  color: #f1f5f9;

  font-size: 20px;

  letter-spacing: -.4px;

}


.popular-name {

  max-width: 150px;

  overflow: hidden;

  text-overflow: ellipsis;

  white-space: nowrap;

}


/* ==========================================
   CONTENT
========================================== */

.content-card {

  background:
    linear-gradient(
      145deg,
      rgba(255,255,255,.045),
      rgba(255,255,255,.015)
    );

  border:
    1px solid rgba(255,255,255,.07);

  border-radius: 17px;

  overflow: hidden;

  box-shadow:
    0 18px 50px rgba(0,0,0,.14);

}


.content-header {

  padding:
    22px 23px;

  display: flex;

  justify-content: space-between;

  align-items: center;

  gap: 15px;

  border-bottom:
    1px solid rgba(255,255,255,.06);

}


.content-header h2 {

  margin: 0;

  font-size: 17px;

  letter-spacing: -.3px;

}


.content-header p {

  margin:
    5px 0 0;

  color: #64748b;

  font-size: 11px;

}


.add-button {

  border: 0;

  padding:
    11px 15px;

  border-radius: 10px;

  color: white;

  background:
    linear-gradient(
      135deg,
      #3b82f6,
      #6366f1
    );

  box-shadow:
    0 7px 22px rgba(59,130,246,.18);

  cursor: pointer;

  font-size: 11px;

  font-weight: 700;

  transition: .2s;

}


.add-button:hover {

  transform:
    translateY(-1px);

  box-shadow:
    0 10px 27px rgba(59,130,246,.25);

}


.add-button span {

  font-size: 15px;

  margin-right: 4px;

}


/* ==========================================
   TOOLBAR
========================================== */

.toolbar {

  display: flex;

  justify-content: space-between;

  align-items: center;

  padding:
    16px 23px;

  border-bottom:
    1px solid rgba(255,255,255,.05);

}


.search-box {

  width: 330px;

  display: flex;

  align-items: center;

  gap: 9px;

  padding:
    9px 12px;

  border-radius: 9px;

  background:
    rgba(255,255,255,.035);

  border:
    1px solid rgba(255,255,255,.07);

  transition: .2s;

}


.search-box:focus-within {

  border-color:
    rgba(96,165,250,.35);

}


.search-box span {

  color: #64748b;

  font-size: 17px;

}


.search-box input {

  width: 100%;

  background: transparent;

  border: 0;

  outline: 0;

  color: #e2e8f0;

  font-size: 11px;

}


.search-box input::placeholder {

  color: #475569;

}


.result-info {

  color: #64748b;

  font-size: 11px;

}


/* ==========================================
   LOADING
========================================== */

.loading-state {

  min-height: 250px;

  display: flex;

  flex-direction: column;

  align-items: center;

  justify-content: center;

  gap: 12px;

  color: #64748b;

}


.loading-state p {

  margin: 0;

  font-size: 11px;

}


.loading-spinner {

  width: 28px;
  height: 28px;

  border-radius: 50%;

  border:
    3px solid rgba(255,255,255,.08);

  border-top-color:
    #60a5fa;

  animation:
    spin .8s linear infinite;

}


@keyframes spin {

  to {
    transform: rotate(360deg);
  }

}


/* ==========================================
   TABLE
========================================== */

.table-wrapper {

  overflow-x: auto;

}


table {

  width: 100%;

  border-collapse: collapse;

  min-width: 700px;

}


thead {

  background:
    rgba(0,0,0,.12);

}


th {

  text-align: left;

  padding:
    13px 20px;

  color: #475569;

  font-size: 9px;

  font-weight: 800;

  letter-spacing: .8px;

}


td {

  padding:
    15px 20px;

  border-top:
    1px solid rgba(255,255,255,.045);

  font-size: 12px;

}


tbody tr {

  transition: .15s;

}


tbody tr:hover {

  background:
    rgba(255,255,255,.025);

}


.number {

  color: #475569;

  font-size: 11px;

}


.category-cell {

  display: flex;

  align-items: center;

  gap: 11px;

}


.category-icon {

  width: 38px;
  height: 38px;

  border-radius: 10px;

  display: grid;

  place-items: center;

  background:
    linear-gradient(
      135deg,
      rgba(96,165,250,.12),
      rgba(129,140,248,.07)
    );

  border:
    1px solid rgba(255,255,255,.06);

  font-size: 16px;

}


.category-cell strong {

  display: block;

  color: #dbe4f0;

  font-size: 12px;

}


.category-cell small {

  display: block;

  margin-top: 3px;

  color: #475569;

  font-size: 9px;

}


.book-count strong {

  color: #cbd5e1;

  font-size: 13px;

}


.book-count span {

  color: #475569;

  margin-left: 4px;

  font-size: 10px;

}


/* ==========================================
   STATUS
========================================== */

.status {

  display: inline-flex;

  align-items: center;

  gap: 6px;

  padding:
    5px 8px;

  border-radius: 7px;

  font-size: 9px;

  font-weight: 700;

}


.status i {

  width: 5px;
  height: 5px;

  border-radius: 50%;

}


.status.active {

  color: #4ade80;

  background:
    rgba(34,197,94,.08);

}


.status.active i {

  background:
    #4ade80;

}


/* ==========================================
   ACTION
========================================== */

.actions {

  display: flex;

  gap: 6px;

}


.action-btn {

  width: 31px;
  height: 31px;

  border-radius: 8px;

  border:
    1px solid rgba(255,255,255,.06);

  background:
    rgba(255,255,255,.025);

  cursor: pointer;

  transition: .2s;

  font-size: 13px;

}


.action-btn.edit {

  color: #60a5fa;

}


.action-btn.delete {

  color: #f87171;

}


.action-btn:hover {

  background:
    rgba(255,255,255,.07);

  transform:
    translateY(-1px);

}


/* ==========================================
   EMPTY
========================================== */

.empty-state {

  padding:
    50px 20px;

  text-align: center;

}


.empty-state > div {

  font-size: 35px;

  opacity: .5;

}


.empty-state h3 {

  margin:
    12px 0 5px;

  font-size: 14px;

}


.empty-state p {

  margin: 0;

  color: #64748b;

  font-size: 11px;

}


/* ==========================================
   MODAL
========================================== */

.modal-overlay {

  position: fixed;

  inset: 0;

  z-index: 100;

  display: grid;

  place-items: center;

  padding: 20px;

  background:
    rgba(2,6,23,.72);

  backdrop-filter:
    blur(8px);

}


.modal {

  width:
    min(460px, 100%);

  background:
    linear-gradient(
      145deg,
      #111827,
      #0b1220
    );

  border:
    1px solid rgba(255,255,255,.09);

  border-radius: 17px;

  box-shadow:
    0 30px 90px rgba(0,0,0,.5);

  overflow: hidden;

}


.modal-header {

  display: flex;

  justify-content: space-between;

  align-items: flex-start;

  padding: 23px;

  border-bottom:
    1px solid rgba(255,255,255,.06);

}


.modal-label {

  color: #60a5fa;

  font-size: 8px;

  font-weight: 800;

  letter-spacing: 1.5px;

}


.modal h2 {

  margin:
    6px 0 0;

  font-size: 19px;

}


.close-btn {

  width: 31px;
  height: 31px;

  border-radius: 8px;

  border:
    1px solid rgba(255,255,255,.07);

  background:
    rgba(255,255,255,.035);

  color: #94a3b8;

  cursor: pointer;

  font-size: 20px;

}


.modal-body {

  padding: 23px;

}


.modal-body label {

  display: block;

  margin-bottom: 8px;

  color: #94a3b8;

  font-size: 10px;

  font-weight: 700;

}


.input-wrapper {

  display: flex;

  align-items: center;

  gap: 9px;

  padding:
    11px 13px;

  background:
    rgba(255,255,255,.035);

  border:
    1px solid rgba(255,255,255,.07);

  border-radius: 9px;

}


.input-wrapper span {

  color: #64748b;

}


.input-wrapper input {

  flex: 1;

  background: transparent;

  border: 0;

  outline: 0;

  color: #e2e8f0;

  font-size: 12px;

}


.input-wrapper:focus-within {

  border-color:
    rgba(96,165,250,.35);

}


.form-error {

  margin:
    8px 0 0;

  color: #f87171;

  font-size: 10px;

}


.modal-footer {

  display: flex;

  justify-content: flex-end;

  gap: 8px;

  padding:
    16px 23px;

  border-top:
    1px solid rgba(255,255,255,.06);

}


.cancel-btn,
.save-btn,
.delete-confirm {

  border: 0;

  padding:
    10px 14px;

  border-radius: 9px;

  cursor: pointer;

  font-size: 11px;

  font-weight: 700;

}


.cancel-btn {

  color: #94a3b8;

  background:
    rgba(255,255,255,.045);

}


.save-btn {

  color: white;

  background:
    linear-gradient(
      135deg,
      #3b82f6,
      #6366f1
    );

}


.save-btn:disabled,
.delete-confirm:disabled {

  opacity: .6;

  cursor: not-allowed;

}


/* ==========================================
   DELETE MODAL
========================================== */

.delete-modal {

  width:
    min(390px, 100%);

  padding: 27px;

  text-align: center;

  background:
    linear-gradient(
      145deg,
      #111827,
      #0b1220
    );

  border:
    1px solid rgba(255,255,255,.08);

  border-radius: 17px;

  box-shadow:
    0 30px 90px rgba(0,0,0,.5);

}


.delete-icon {

  width: 54px;
  height: 54px;

  margin:
    0 auto 15px;

  display: grid;

  place-items: center;

  border-radius: 15px;

  background:
    rgba(239,68,68,.1);

  font-size: 22px;

}


.delete-modal h2 {

  margin: 0;

  font-size: 18px;

}


.delete-modal p {

  margin:
    9px 0 15px;

  color: #64748b;

  font-size: 11px;

  line-height: 1.6;

}


.delete-modal p strong {

  color: #cbd5e1;

}


.delete-warning {

  padding: 10px;

  border-radius: 8px;

  color: #fca5a5;

  background:
    rgba(239,68,68,.06);

  font-size: 9px;

}


.delete-actions {

  display: flex;

  justify-content: center;

  gap: 8px;

  margin-top: 18px;

}


.delete-confirm {

  color: white;

  background:
    #dc2626;

}


/* ==========================================
   TOAST
========================================== */

.success-toast {

  position: fixed;

  right: 25px;

  bottom: 25px;

  z-index: 300;

  display: flex;

  align-items: center;

  gap: 10px;

  padding:
    12px 15px;

  border-radius: 11px;

  background:
    rgba(15,23,42,.95);

  border:
    1px solid rgba(74,222,128,.2);

  box-shadow:
    0 15px 40px rgba(0,0,0,.35);

  color: #d1fae5;

  font-size: 11px;

  font-weight: 600;

  backdrop-filter:
    blur(12px);

}


.toast-icon {

  width: 25px;
  height: 25px;

  display: grid;

  place-items: center;

  border-radius: 50%;

  background:
    rgba(34,197,94,.12);

  color: #4ade80;

  font-weight: 900;

}


.toast-enter-active,
.toast-leave-active {

  transition:
    .25s ease;

}


.toast-enter-from,
.toast-leave-to {

  opacity: 0;

  transform:
    translateY(10px);

}


/* ==========================================
   RESPONSIVE
========================================== */

@media (max-width: 1050px) {

  .stats-grid {

    grid-template-columns:
      repeat(2, 1fr);

  }

}


@media (max-width: 800px) {

  .sidebar {

    width: 70px;

    min-width: 70px;

    padding:
      18px 9px;

  }


  .brand {

    justify-content: center;

    padding:
      5px 0 25px;

  }


  .brand > div:last-child,
  .menu-title,
  .menu-item span:last-child,
  .bottom-item {

    display: none;

  }


  .menu-item {

    justify-content: center;

    padding: 12px;

  }


  .main-content {

    padding:
      24px 18px 40px;

  }


  .top-actions {

    display: none;

  }

}


@media (max-width: 600px) {

  .topbar {

    align-items: flex-start;

  }


  .topbar h1 {

    font-size: 23px;

  }


  .stats-grid {

    grid-template-columns: 1fr;

  }


  .content-header {

    align-items: flex-start;

    flex-direction: column;

  }


  .add-button {

    width: 100%;

  }


  .toolbar {

    align-items: stretch;

    flex-direction: column;

    gap: 10px;

  }


  .search-box {

    width: 100%;

  }


  .api-error {

    align-items: flex-start;

  }

}

</style>