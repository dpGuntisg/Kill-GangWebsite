<script setup>
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <header>


      <nav>
        <RouterLink to="/"></RouterLink>
        <RouterLink to="/about"></RouterLink>
        <RouterLink to="/home"></RouterLink>
        <RouterLink to="/awards"></RouterLink>
        <RouterLink to="/signup"></RouterLink>
      </nav>
  </header>

  <RouterView />
</template>

<style scoped>

</style>
