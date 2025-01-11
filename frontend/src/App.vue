<script setup>
import { ref, onMounted } from 'vue'
import UserForm from './components/UserForm.vue'
import UserList from './components/UserList.vue'
import useUsers from './composables/useUsers'

const showUserForm = ref(false)

const toggleUserForm = () => {
  showUserForm.value = !showUserForm.value
  if (!showUserForm.value) {
    editingUser.value = null
  }
}

const editingUser = ref(null)
const {
  users,
  searchQuery,
  loading,
  error,
  filteredUsers,
  fetchUsers,
  addUser,
  updateUser,
  deleteUser
} = useUsers()

const handleSubmit = async (userData) => {
  try {
    if (editingUser.value) {
      await updateUser(userData)
    } else {
      await addUser(userData)
    }
    showUserForm.value = false
    editingUser.value = null
  } catch (err) {
  }
}

const handleEdit = (user) => {
  editingUser.value = user
  showUserForm.value = true
}

onMounted(fetchUsers)
</script>

<template>
  <div class="container">
    <h1>User Maintenance Application</h1>

    <button
      class="create-user-btn"
      @click="toggleUserForm"
      v-if="!showUserForm"
    >
      Create New User
    </button>

    <UserForm
      v-if="showUserForm"
      :editing-user="editingUser"
      @submit="handleSubmit"
      @cancel="toggleUserForm"
    />

    <UserList
      v-if="!showUserForm"
      :filtered-users="filteredUsers"
      v-model:search-query="searchQuery"
      :loading="loading"
      :error="error"
      @edit="handleEdit"
      @delete="deleteUser"
    />
  </div>
</template>

<style scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  color: white;
}

.create-user-btn {
  display: block;
  margin: 20px auto;
  padding: 10px 20px;
  background-color: #2196F3;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.create-user-btn:hover {
  background-color: #1976D2;
}
</style>
