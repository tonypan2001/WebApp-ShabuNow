<script setup>
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
  } catch (error) {
    errors.value = console.log(error.response.errors);
  }
};
definePageMeta({
  middleware: ["guest"],
  layout: "custom",
});


definePageMeta({
  layout: "custom",
});
</script>
<template>
  <!-- testing -->

  <!-- testing -->
  <section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5">
      <!-- form -->
      <div class="sm:w-1/2 px-8">
        <h1 class="font-bold text-2xl">เข้าสู่ระบบ</h1>
        <p class="mt-4 text-sm">If you already a member, login in</p>
        {{ token.getToken }} {{ token.getStatus }}
        <form
          @submit.prevent="handleSubmit"
          action=""
          class="flex flex-col gap-4"
        >
          <InputField
            class="p-2 mt-4 rounded-xl"
            type="email"
            name="email"
            placeholder="อีเมล"
            v-model="form.email"
            required
          />
          <span v-if="errors.email" class="text-red-500">{{
            errors.email[0]
          }}</span>
          <InputField
            class="p-2 rounded-xl"
            type="password"
            name="password"
            placeholder="รหัสผ่าน"
            v-model="form.password"
            required
          />
          <span v-if="errors.password" class="text-red-500">{{
            errors.password[0]
          }}</span>
          <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
          <Button>
            <slot name="button"> เข้าสู่ระบบ </slot>
          </Button>

          <br />
          <p>
            ยังไม่ได้สร้างบัญชี?
            <a href="/register" class="underline">สมัครสมาชิก</a>
          </p>
        </form>
        <div class="mt-8 text-red-600 hover:text-red-500 hover:underline">
          <a href="/">
            <i class="bi bi-arrow-left-short"></i>
            Back To Menu
          </a>
        </div>
      </div>
      <!-- image -->
      <div class="w-1/2 sm:block hidden">
        <img
          class="rounded-2xl"
          src="https://images.unsplash.com/photo-1549048085-bab2f1f49f65?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2487&q=80"
          alt=""
        />
      </div>
    </div>
  </section>
</template>
