<template>
  <section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5">
      <!-- form -->
      <div class="sm:w-1/2 px-8">
        <h1 class="font-bold text-2xl">Login</h1>
        <h1>{{ token.getStatus }}</h1>
        <p class="mt-4 text-sm">If you already a member,login in</p>

        {{ token.getToken }} {{ token.getStatus }}
        <h1>Auth: {{ auth.getUser.role }}</h1>
        <form @submit.prevent="handleSubmit" class="flex flex-col gap-4">
          <input
            class="p-2 mt-8 rounded-xl border"
            type="email"
            name="email"
            placeholder="email"
            v-model="form.email"
          />
          <span v-if="errors.email" class="text-red-500">{{
            errors.email[0]
          }}</span>
          <input
            class="p-2 rounded-xl border"
            type="password"
            name="password"
            placeholder="password"
            v-model="form.password"
          />
          <span v-if="errors.password" class="text-red-500">{{
            errors.password[0]
          }}</span>
          <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
          <Button type="submit">
            <slot name="button"> Login </slot>
          </Button>
          <br />
          <p>
            Don't have a account?
            <a href="/register" class="underline">Register</a>
          </p>
        </form>
        <Button type="submit" @click.prevent="token.removeToken()">
          <slot name="button"> Remove Token </slot>
        </Button>
      </div>
      <!-- image -->
      <div class="w-1/2 sm:block hidden">
        <img
          class="rounded-2xl"
          src="https://images.unsplash.com/photo-1493552152660-f915ab47ae9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2574&q=80"
          alt=""
        />
      </div>
    </div>
  </section>
</template>

<script setup>
definePageMeta({
  middleware: ["guest"],
  layout: "custom",
});

const auth = useAuthStore();
const token = useTokenStore();
const form = reactive({
  email: "test@example.com",
  password: "password",
});
const errors = ref([]);
const handleSubmit = async () => {
  try {
    await auth.login(form);
    // const { data } = await $fetch("http://localhost/api/login", {
    //   method: "POST",
    //   body: { ...form },
    // });
  } catch (error) {
    // console.log(error.data.errors.email[0]);
    errors.value = error.data.errors;
  }
};
</script>
