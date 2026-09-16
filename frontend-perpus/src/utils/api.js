import axios from 'axios'

const api = axios.create({
  baseURL: 'http://10.39.148.41:8000/api',
  headers: {
    Accept: 'application/json',
  },
})

// Kalau ada token, otomatis dikirim
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')

  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config
})

export default api