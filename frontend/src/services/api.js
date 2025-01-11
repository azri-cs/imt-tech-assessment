import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost/api',
  withCredentials: true,
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
})

export const userService = {
  async getAllUsers() {
    const response = await api.post('/user/all')
    return response.data
  },

  async addUser(userData) {
    const response = await api.post('/user/add', userData)
    return response.data
  },

  async updateUser(userData) {
    const response = await api.post('/user/edit', userData)
    return response.data
  },

  async deleteUser(id) {
    const response = await api.post('/user/delete', { id })
    return response.data
  }
}
