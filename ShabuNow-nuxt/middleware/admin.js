export default defineNuxtRouteMiddleware((to, from) => {
  const tokenStore = useTokenStore();
  const authStore = useAuthStore();
  //   auth.getUser;

  if (authStore.getUser.role != "admin") {
    return navigateTo("/login");
  }
});
