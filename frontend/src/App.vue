<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav>
      <RouterLink to="/">Beranda</RouterLink> |
      <RouterLink to="/tentang">Tentang</RouterLink>
    </nav>
  </header>
  <RouterView />
</template>