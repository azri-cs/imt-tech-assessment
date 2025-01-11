import { ref, computed } from 'vue'
import { userService } from '@/services/api'

export default function useUsers() {
  const users = ref([])
  const searchQuery = ref('')
  const loading = ref(false)
  const error = ref(null)

  const fetchUsers = async () => {
    try {
      loading.value = true
      const response = await userService.getAllUsers()
      users.value = response.data
    } catch (err) {
      error.value = err.response?.data?.message || 'Error fetching users'
    } finally {
      loading.value = false
    }
  }

  const addUser = async (userData) => {
    try {
      loading.value = true
      await userService.addUser(userData)
      await fetchUsers()
    } catch (err) {
      error.value = err.response?.data?.message || 'Error adding user'
      throw error.value
    } finally {
      loading.value = false
    }
  }

  const updateUser = async (userData) => {
    try {
      loading.value = true
      await userService.updateUser(userData)
      await fetchUsers()
    } catch (err) {
      error.value = err.response?.data?.message || 'Error updating user'
      throw error.value
    } finally {
      loading.value = false
    }
  }

  const deleteUser = async (id) => {
    try {
      loading.value = true
      await userService.deleteUser(id)
      await fetchUsers()
    } catch (err) {
      error.value = err.response?.data?.message || 'Error deleting user'
      throw error.value
    } finally {
      loading.value = false
    }
  }

  const filteredUsers = computed(() => {
    return users.value.filter(user =>
      user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  })

  return {
    users,
    searchQuery,
    loading,
    error,
    filteredUsers,
    fetchUsers,
    addUser,
    updateUser,
    deleteUser
  }
}
