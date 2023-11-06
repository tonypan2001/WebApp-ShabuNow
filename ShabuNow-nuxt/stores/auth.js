import { defineStore } from "pinia";
import { useTokenStore } from "./token";
export const useAuthStore = defineStore("auth", {
  state: () => ({
    //Prompan
    user: {},
  }),
  persist: {
    paths: ["user"],
  },
  getters: {
    // Prompan
    // getUser: (state) => state.token !== "",
    getUser: (state) => state.user,
  },
  actions: {
    async login(formData) {
      const config = useRuntimeConfig()
      try {
//         const express = require('express');
//         const cors = require('cors');
//         const app = express();
//
// // Allow requests from all origins (be cautious in a production environment)
//         app.use(cors());
        const { data } = await $fetch( config.public.apiBaseURL + "login", {
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
      const config = useRuntimeConfig()
      try {
        const { data } = await $fetch(config.public.apiBaseURL + "register", {
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
      const config = useRuntimeConfig()
      const tokenStore = useTokenStore();
      try {
        const config = useRuntimeConfig()
        const res = await $fetch( config.public.apiBaseURL + "logout", {
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
    // setUser(name, email, role) {
    //   this.user.name = name
    //   this.user.email = email
    //   this.user.role = role
    // },
    commonSetter(data) {
      console.log(`commonSetter is worked!!`);
      const tokenStore = useTokenStore();
      tokenStore.setToken(data.token);
      this.user = data.user;
      console.log("userdetail: ", data.user.role);
      console.log("username", data.user.username);
      console.log("user_id", data.user.id);
        // return navigateTo("/");

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
