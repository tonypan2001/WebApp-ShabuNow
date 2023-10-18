export const useAuthStore = defineStore("auth", {
  state: () => ({ user: {}, role: null }),
  persist: ["user"],
  getters: {
    getUser: (state) => state.count * 2,
  },
  actions: {
    async login(formData) {
      const token = useTokenStore();
      try {
        console.log("YOu Clicked it");
        const { data } = await $fetch("http://localhost/api/auth/login", {
          method: "POST",
          body: { ...formData },
        });
        console.log("auth_store", data);
        token.setToken(data.token);
        this.user = data.user;
        return navigateTo("/");
      } catch (error) {
        throw error;
      }
    },
    async register(formData) {
      const token = useTokenStore();
      try {
        console.log("YOu Clicked it");
        const { data } = await $fetch("http://localhost/api/auth/register", {
          method: "POST",
          body: { ...formData },
        });
        console.log("auth_store", data);
        token.setToken(data.token);
        this.user = data.user;
        return navigateTo("/login");
      } catch (error) {
        throw error;
      }
    },
    async logout() {
      const tokenStore = useTokenStore();
      try {
        console.log("YOu Clicked it");
        const res = await $fetch("http://localhost/api/logout", {
          method: "POST",
          headers: {
            Accept: "application/json",
            Authorization: `Bearer ${tokenStore.getToken}`,
          },
          //   body: { ...formData },
        });
        tokenStore.removeToken();
        console.log(res);
        return navigateTo("/login");
      } catch (error) {
        throw error;
      }
    },
  },
});
