<template>
  <aside class="sidebar">

    <div class="sidebar-brand">
      <div class="brand-icon">📚</div>

      <div>
        <strong>PerpusKu</strong>
        <span>ADMIN PANEL</span>
      </div>
    </div>

    <nav class="sidebar-menu">

      <p class="menu-title">MENU UTAMA</p>

      <router-link
        to="/admin/Dashboard"
        class="menu-item"
      >
        <span class="menu-icon">▦</span>
        <span>Dashboard</span>
      </router-link>

      <router-link
        to="/admin/buku"
        class="menu-item"
      >
        <span class="menu-icon">📚</span>
        <span>Data Buku</span>
      </router-link>

      <router-link
        to="/admin/anggota"
        class="menu-item"
      >
        <span class="menu-icon">👥</span>
        <span>Anggota</span>
      </router-link>

      <router-link
        to="/admin/peminjaman"
        class="menu-item"
      >
        <span class="menu-icon">📋</span>
        <span>Peminjaman</span>
      </router-link>

      <router-link
        to="/admin/kategori"
        class="menu-item"
      >
        <span class="menu-icon">🏷️</span>
        <span>Kategori</span>
      </router-link>

    </nav>

    <div class="sidebar-bottom">

      <button
        class="library-btn"
        @click="goToLibrary"
      >
        <span>↗</span>
        Tampilan Perpus
      </button>

      <button
        class="logout-btn"
        @click="logout"
      >
        <span>⇥</span>
        Logout
      </button>

    </div>

  </aside>
</template>

<script setup>
import { useRouter } from 'vue-router'
import api from '../utils/api'

const router = useRouter()

function goToLibrary() {
  router.push('/')
}

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
</script>

<style scoped>
.sidebar {
  position: fixed;
  top: 0;
  left: 0;
  width: 250px;
  height: 100vh;
  background: linear-gradient(180deg, #101827, #172033);
  color: white;
  padding: 24px 16px;
  display: flex;
  flex-direction: column;
  z-index: 1000;
  box-shadow: 10px 0 30px rgba(0, 0, 0, 0.15);
}

.sidebar-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 5px 10px 28px;
}

.brand-icon {
  width: 42px;
  height: 42px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(96, 165, 250, 0.15);
  font-size: 22px;
}

.sidebar-brand strong {
  display: block;
  font-size: 20px;
  font-weight: 700;
}

.sidebar-brand span {
  display: block;
  margin-top: 3px;
  font-size: 10px;
  letter-spacing: 1.5px;
  color: #94a3b8;
}

.sidebar-menu {
  flex: 1;
}

.menu-title {
  margin: 0 10px 10px;
  color: #64748b;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1.5px;
}

.menu-item {
  display: flex;
  align-items: center;
  gap: 13px;
  width: 100%;
  padding: 13px 14px;
  margin-bottom: 6px;
  border-radius: 12px;
  color: #94a3b8;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  transition: 0.25s ease;
}

.menu-icon {
  width: 22px;
  text-align: center;
  font-size: 17px;
}

.menu-item:hover {
  color: white;
  background: rgba(255, 255, 255, 0.07);
  transform: translateX(3px);
}

.menu-item.router-link-active {
  color: white;
  background: linear-gradient(
    135deg,
    rgba(59, 130, 246, 0.8),
    rgba(37, 99, 235, 0.55)
  );
  box-shadow: 0 8px 20px rgba(37, 99, 235, 0.2);
}

.sidebar-bottom {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.library-btn,
.logout-btn {
  width: 100%;
  border: 0;
  border-radius: 11px;
  padding: 12px 14px;
  display: flex;
  align-items: center;
  gap: 12px;
  cursor: pointer;
  font-size: 13px;
  transition: 0.25s ease;
}

.library-btn {
  color: #bfdbfe;
  background: rgba(59, 130, 246, 0.12);
}

.library-btn:hover {
  background: rgba(59, 130, 246, 0.22);
}

.logout-btn {
  color: #fca5a5;
  background: rgba(239, 68, 68, 0.08);
}

.logout-btn:hover {
  background: rgba(239, 68, 68, 0.16);
}

.library-btn span,
.logout-btn span {
  font-size: 18px;
}

@media (max-width: 768px) {
  .sidebar {
    width: 220px;
  }
}
</style>