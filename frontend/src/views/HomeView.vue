<script setup>
import { ref, onMounted, computed } from 'vue'
import { ringkasan } from '../lib/todos'

const apiUrl = import.meta.env.VITE_API_URL
const todos = ref([])
const memuat = ref(true)
const galat = ref('')

onMounted(async () => {
  try {
    const respons = await fetch(`${apiUrl}/api/todos`)
    if (!respons.ok) throw new Error(`Status ${respons.status}`)
    todos.value = await respons.json()
  } catch (e) {
    galat.value = `Gagal memuat data: ${e.message}`
  } finally {
    memuat.value = false
  }
})

const teksRingkasan = computed(() => ringkasan(todos.value))
</script>

<template>
  <main>
    <h1>Daftar To Do</h1>
    <p v-if="memuat">Memuat data...</p>
    <p v-else-if="galat">{{ galat }}</p>
    <template v-else>
      <p>{{ teksRingkasan }}</p>
      <ul>
        <li v-for="todo in todos" :key="todo.id" :class="{ selesai: todo.is_done }">
          {{ todo.title }}
        </li>
      </ul>
    </template>
  </main>
</template>

<style scoped>
.selesai {
  text-decoration: line-through;
  color: gray;
}
</style>