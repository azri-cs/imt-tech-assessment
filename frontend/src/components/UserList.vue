<script setup>
defineProps({
  filteredUsers: {
    type: Array,
    required: true
  },
  searchQuery: {
    type: String,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: null
  }
})

const emit = defineEmits(['edit', 'delete', 'update:searchQuery'])

const handleDelete = (id) => {
  if (confirm('Are you sure you want to delete this user?')) {
    emit('delete', id)
  }
}
</script>

<template>
  <div class="user-list">
    <div class="search-box">
      <input
        :value="searchQuery"
        @input="$emit('update:searchQuery', $event.target.value)"
        type="text"
        placeholder="Search users..."
      >
    </div>

    <div v-if="loading" class="loading">Loading...</div>
    <div v-else-if="error" class="error">{{ error }}</div>

    <table v-else-if="filteredUsers.length">
      <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in filteredUsers" :key="user.id">
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.phone }}</td>
        <td>
          <button @click="$emit('edit', user)">Edit</button>
          <button @click="handleDelete(user.id)" class="delete">Delete</button>
        </td>
      </tr>
      </tbody>
    </table>
    <p v-else>No users found</p>
  </div>
</template>

<style scoped>
.user-list {
  margin: 20px 0;
}

.search-box {
  margin-bottom: 20px;
}

.search-box input {
  width: 100%;
  padding: 8px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  font-weight: bold;
}

.delete {
  background-color: #ff4444;
  margin-left: 8px;
}

.delete:hover {
  background-color: #cc0000;
}

.loading {
  text-align: center;
  padding: 20px;
}

.error {
  color: red;
  text-align: center;
  padding: 20px;
}
</style>
