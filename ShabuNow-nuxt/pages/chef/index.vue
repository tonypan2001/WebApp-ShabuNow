<script setup>
const auth = useAuthStore();
const token = useTokenStore();
definePageMeta({
  layout: "custom",
});
</script>

<template>
  <h2>it's chef page</h2>
  <h1>{{ auth.user }}</h1>
  <template v-if="token.getStatus">
    <button @click.prevent="auth.logout()">logout</button>
  </template>
</template>
