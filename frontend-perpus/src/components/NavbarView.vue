<template> 
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

          <a href="#koleksi">Koleksi</a>
          <a href="#kategori">Kategori</a>
          <a href="#tentang">Tentang</a>
        </nav>

        <div class="nav-actions">

          <button class="search-mini" @click="scrollToBooks">
            ⌕
          </button>

          <!-- BELUM LOGIN -->
          <router-link
            v-if="!isLoggedIn"
            to="/login"
            class="login-nav-btn"
          >
            Masuk
            <span>→</span>
          </router-link>

          <!-- SUDAH LOGIN -->
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
                  {{
                    user?.role === 'admin'
                      ? 'Administrator'
                      : 'Anggota'
                  }}
                </span>
              </div>

              <span
                class="profile-chevron"
                :class="{ open: profileOpen }"
              >
                ⌄
              </span>
            </button>

            <!-- DROPDOWN -->
            <div
              v-if="profileOpen"
              class="profile-dropdown"
            >

              <div class="dropdown-header">

                <div class="dropdown-avatar">
                  {{ userInitial }}
                </div>

                <div class="dropdown-user-info">

                  <strong>
                    {{ user?.name }}
                  </strong>

                  <span>
                    {{ user?.email }}
                  </span>

                  <small
                    :class="{
                      'admin-role':
                        user?.role === 'admin'
                    }"
                  >
                    {{
                      user?.role === 'admin'
                        ? 'ADMIN'
                        : 'ANGGOTA'
                    }}
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
                to="/admin/Dashboard"
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
</template>

<style>
.navbar {
  position: sticky;
  top: 0;
  z-index: 100;
  background: rgba(255, 255, 255, .82);
  backdrop-filter: blur(22px);
  -webkit-backdrop-filter: blur(22px);
  border-bottom: 1px solid rgba(26, 52, 91, .08);
  box-shadow: 0 10px 35px rgba(20, 40, 75, .06);
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
  background: linear-gradient(145deg, #3c72bd, #19345f);
  color: white;
  font-size: 22px;
  box-shadow: 0 10px 25px rgba(42, 89, 155, .28);
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


/* ================= MENU ================= */

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


/* ================= ACTION ================= */

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
  background: linear-gradient(135deg, #315f9e, #172d50);
  color: white;
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 10px 25px rgba(27,57,100,.18);
}


/* ================= PROFILE ================= */

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
  background: linear-gradient(145deg, #477fc7, #234d86);
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


/* ================= DROPDOWN ================= */

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
</style>
