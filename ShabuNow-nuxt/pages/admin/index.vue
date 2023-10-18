<script setup>
const auth = useAuthStore();
const token = useTokenStore();
definePageMeta({
  layout: "custom",
});
</script>

<template>
  <h2>it's admin page</h2>
  <h1>name is {{ auth.user.name }}</h1>
  <h1>role is {{ auth.user.role }}</h1>
  <h2>{{ token.getStatus }}</h2>
  <template v-if="token.getStatus">
    <button @click.prevent="auth.logout()">logout</button>
  </template>
</template>
