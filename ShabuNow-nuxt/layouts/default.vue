<script lang="ts" setup>
  const tokenStore = useTokenStore();
  const auth = useAuthStore();
  const route = useRoute();
  if (!tokenStore.getStatus) {
    await navigateTo("/login");
  }
  const accessCustomerPath = ['/', '/menus/menu_[id]', '/accounts', '/bills']
  const accessStaffPath = ['/', '/orders', '/accounts']
  const accessAdminPath = ['/','/admins','/admins/staff','/admins/staff/create','/accounts']
  const accessChefPath = ['/','/admins','/admins/addCategory','/admins/createMenu','/admins/editMenu','/accounts']
  if (auth.getUser.role === "customer" && !accessCustomerPath.includes(route.path)) {
    await navigateTo("/");
  } else if (auth.getUser.role === "staff" && !accessStaffPath.includes(route.path)) {
    await navigateTo("/")
  } else if (auth.getUser.role === "admin" && !accessAdminPath.includes(route.path)) {
    await navigateTo("/admins")
  } else if (auth.getUser.role === "chef" && !accessChefPath.includes(route.path)) {
    await navigateTo("/")
  }
</script>

<template>
  <Navbar></Navbar>
  <!-- Add by pooh can delete just debug -->

  <section>
    <slot />
  </section>
</template>

<style scoped>
* {
  font-family: "Kanit", sans-serif;
}
</style>
