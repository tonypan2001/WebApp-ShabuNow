export default defineNuxtRouteMiddleware((to, from) => {
  const tokenStore = useTokenStore();
  const authStore = useAuthStore();

  if (!tokenStore.getStatus) {
    return navigateTo("/login");
  }
});
