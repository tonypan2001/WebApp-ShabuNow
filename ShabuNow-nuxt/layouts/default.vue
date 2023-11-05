<script lang="ts" setup>
  // const tokenStore = useTokenStore();
  // const auth = useAuthStore();
  // const route = useRoute();
  // if (!tokenStore.getStatus) {
  //   await navigateTo("/login");
  // }
  // const accessCustomerPath = ['/home','/', '/menus/menu_[id]_[table_id]', '/accounts', '/bills', '/carts/table_[id]','/[category_id]', '/orders/table_[id]']
  // const accessStaffPath = ['/home','/', '/orders', '/accounts', '/orders/table_[id]','/[category_id]']
  // const accessAdminPath = ['/home','/','/admins','/admins/staff','/admins/staff/create','/accounts','/[category_id]']
  // const accessChefPath = ['/home','/', '/menus/menu_[id]_[table_id]', '/admins','/admins/addCategory','/admins/createMenu','/admins/editMenu','/accounts','/[category_id]']
  // if (auth.getUser.role === "customer" && !accessCustomerPath.includes(route.path)) {
  //   await navigateTo("/");
  // } else if (auth.getUser.role === "staff" && !accessStaffPath.includes(route.path)) {
  //   await navigateTo("/")
  // } else if (auth.getUser.role === "admin" && !accessAdminPath.includes(route.path)) {
  //   await navigateTo("/")
  // } else if (auth.getUser.role === "chef" && !accessChefPath.includes(route.path)) {
  //   await navigateTo("/")
  // }
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
