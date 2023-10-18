<script lang="ts" setup>
const authStore = useAuthStore();
</script>

<template>
  <div>
    <ul>
      <li>
        <h1>
          <h2 class="text-3xl bg-red-500">{{ authStore.user.role }}</h2>
        </h1>
        <NuxtLink to="/">Home</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/register">Register</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/login">Login</NuxtLink>
      </li>

      <li>
        <NuxtLink to="/guest">Guest only</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/chef">Chef only</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/staff">Staff only</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/customer">Customer only</NuxtLink>
      </li>
      <li>
        <NuxtLink to="/admin">Admin only</NuxtLink>
      </li>
    </ul>
  </div>
  <section>
    <slot />
  </section>
</template>

<style scoped>
* {
  font-family: "Kanit", sans-serif;
}
</style>

<!-- <template>
  <section>
    <slot />
  </section>
</template>

<style scoped>
* {
  font-family: "Kanit", sans-serif;
}
</style> -->

<!-- <script lang="ts" setup>
import { useAuthStore } from "~/stores/useAuthStore";

const auth = useAuthStore();

async function handleLogout() {
  await auth.logout();
}
</script> -->
