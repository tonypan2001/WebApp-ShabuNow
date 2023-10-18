type User = {
  id: number;
  name: string;
  email: string;
  role: string;
};
type FormData = {
  email: string;
  password: string;
};

export const useCounterStore = defineStore("counter", () => {
  const user = ref<User | null>(null);

  async function login(formData: FormData) {
    const token = useTokenStore();
    const userPermissions = useCookie("permissions");
    const userRoles = useCookie("roles");
    try {
      console.log("YOu Clicked it");
      const login = await $fetch("http://localhost/api/auth/login", {
        method: "POST",
        body: { ...formData },
      });
      console.log("TYPE!!", typeof data.email);
      console.log("auth_store", data);
      token.setToken(data.token);
      user.value = data.value as User;
      return navigateTo("/");
    } catch (error) {
      throw error;
    }
  }
  return { user, login };
});
