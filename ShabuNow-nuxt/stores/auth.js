import { defineStore } from "pinia";
import { useTokenStore } from "./token";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    user: {},
  }),
  persist: {
    paths: ["user"],
  },
  getters: {
    getUser: (state) => state.user,
  },
  actions: {
    async login(formData) {
      try {
        const { data } = await $fetch("http://localhost/api/login", {
          method: "POST",
          body: { ...formData },
        });

        console.log(`auth_store`, data);
        this.commonSetter(data);
      } catch (error) {
        throw error;
      }
    },
    async register(formData) {
      try {
        const { data } = await $fetch("http://localhost/api/register ", {
          method: "POST",
          body: { ...formData },
        });

        console.log(`auth_store_register`, data);
        this.commonSetter(data);
      } catch (error) {
        throw error;
      }
    },
    async logout() {
      const tokenStore = useTokenStore();
      try {
        const res = await $fetch("http://localhost/api/logout ", {
          method: "POST",
          headers: {
            Accept: "application/json",
            Authorization: `Bearer ${tokenStore.getToken}`, //when authorize 401
          },
        });
        tokenStore.removeToken();
        console.log(res);
      } catch (error) {
        throw error;
      }
    },
    commonSetter(data) {
      console.log(`commonSetter is worked!!`);
      const tokenStore = useTokenStore();
      tokenStore.setToken(data.token);
      this.user = data.user;
      console.log("userdetail: ", data.user.role);
      //   return navigateTo("/");

      if (data.user.role == "admin") {
        return navigateTo("/admins");
      }
      if (data.user.role == "customer") {
        return navigateTo("/");
      }
      if (data.user.role == "chef") {
        return navigateTo("/chefs");
      }
    },
  },
});
