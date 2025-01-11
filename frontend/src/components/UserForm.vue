<script setup>
import { reactive, watch, computed } from 'vue'

const props = defineProps({
  editingUser: {
    type: Object,
    default: null
  }
})

const emit = defineEmits(['submit', 'cancel'])

const formErrors = reactive({
  name: '',
  email: '',
  phone: '',
  password: ''
})

const validateForm = () => {
  let isValid = true

  // Name validation
  if (!formData.name) {
    formErrors.name = 'Name is required'
    isValid = false
  } else {
    formErrors.name = ''
  }

  // Email validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!formData.email) {
    formErrors.email = 'Email is required'
    isValid = false
  } else if (!emailRegex.test(formData.email)) {
    formErrors.email = 'Invalid email format'
    isValid = false
  } else {
    formErrors.email = ''
  }

  // Phone validation
  const phoneRegex = /^\+?[\d\s-]{10,}$/
  if (!formData.phone) {
    formErrors.phone = 'Phone is required'
    isValid = false
  } else if (!phoneRegex.test(formData.phone)) {
    formErrors.phone = 'Invalid phone format'
    isValid = false
  } else {
    formErrors.phone = ''
  }

  // Password validation
  const MIN_PASSWORD_LENGTH = 6;
  formErrors.password = '';
  if (!isEditing.value && !formData.password) {
    formErrors.password = 'Password is required';
    isValid = false;
  }
  if (formData.password && formData.password.length < MIN_PASSWORD_LENGTH) {
    formErrors.password = 'Password must be at least 6 characters';
    isValid = false;
  }

  return isValid
}

const formData = reactive({
  name: '',
  email: '',
  phone: '',
  password: ''
})

const isEditing = computed(() => !!props.editingUser)

watch(() => props.editingUser, (newValue) => {
  if (newValue) {
    Object.assign(formData, {
      ...newValue,
      password: ''
    })
  } else {
    resetForm()
  }
}, { immediate: true })

const resetForm = () => {
  formData.name = ''
  formData.email = ''
  formData.phone = ''
  formData.password = ''
}

const handleSubmit = () => {
  if (!validateForm()) return

  emit('submit', {
    ...formData,
    ...(isEditing.value && { id: props.editingUser.id })
  })

  if (!isEditing.value) {
    resetForm()
  }
}
</script>

<template>
  <h3>User Form</h3>
  <form @submit.prevent="handleSubmit" class="user-form">
    <div class="form-group">
      <label for="name">Name:</label>
      <input
        id="name"
        v-model="formData.name"
        type="text"
        required
        placeholder="Enter name"
      >
      <span class="error-message" v-if="formErrors.name">{{ formErrors.name }}</span>
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input
        id="email"
        v-model="formData.email"
        type="email"
        required
        placeholder="Enter email"
      >
      <span class="error-message" v-if="formErrors.email">{{ formErrors.email }}</span>
    </div>

    <div class="form-group">
      <label for="phone">Phone:</label>
      <input
        id="phone"
        v-model="formData.phone"
        type="tel"
        required
        placeholder="Enter phone number"
      >
      <span class="error-message" v-if="formErrors.phone">{{ formErrors.phone }}</span>
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input
        id="password"
        v-model="formData.password"
        type="password"
        :required="!isEditing"
        placeholder="Enter password"
      >
      <span class="error-message" v-if="formErrors.password">{{ formErrors.password }}</span>
    </div>

    <button type="submit">
      {{ isEditing ? 'Update' : 'Add' }} User
    </button>
    <button type="button" class="cancel-btn" @click="$emit('cancel')">
      Cancel
    </button>
  </form>
</template>

<style scoped>
h3 {
  text-align: center;
  color: white;
}

.user-form {
  margin: 20px 0;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
}

button {
  padding: 8px 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

.error-message {
  color: #dc3545;
  font-size: 0.8rem;
  margin-top: 4px;
}

.form-actions {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.submit-btn {
  background-color: #4CAF50;
}

.cancel-btn {
  background-color: #6c757d;
}

.submit-btn:hover {
  background-color: #45a049;
}

.cancel-btn:hover {
  background-color: #5a6268;
}
</style>
