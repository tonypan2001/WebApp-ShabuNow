export default defineNuxtRouteMiddleware((to, from) => {
  const tokenStore = useTokenStore();
  const auth = useAuthStore();
  const route = useRoute();
  if (!tokenStore.getStatus) {
    return navigateTo("/login");
  }
  const accessCustomerPath = ['/','/menu/menu_[id]','/accounts','bills']
  const accessStaffPath = ['/','/orders','/accounts']
  if (auth.getUser.role === "customer" && !accessCustomerPath.includes(route.path)) {
    return navigateTo("/");
  } else if (auth.getUser.role === "staff" && !accessStaffPath.includes(route.path)) {
    return navigateTo("/")
  }
});
