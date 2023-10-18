<template>
  <section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5">
      <!-- form -->
      <div class="sm:w-1/2 px-8">
        <h1 class="font-bold text-2xl">Register</h1>
        <p class="mt-4 text-sm">Let's create your account</p>
        <form
          @submit.prevent="handleSubmit"
          action=""
          class="flex flex-col gap-4"
        >
          <input
            class="p-2 mt-8 rounded-xl border"
            type="text"
            name="name"
            placeholder="Name"
            v-model="form.name"
          />

          <input
            class="p-2 rounded-xl border"
            type="email"
            name="email"
            placeholder="Email"
            v-model="form.email"
          />
          <input
            class="p-2 rounded-xl border"
            type="password"
            name="password"
            placeholder="Password"
            v-model="form.password"
          />
          <input
            class="p-2 rounded-xl border"
            type="password"
            name="confirm-password"
            placeholder="Confirm password"
            v-model="form.password_confirmation"
          />
          <div class="mx-auto mt-2">
            <label
              for="example1"
              class="mb-1 block text-sm font-medium text-gray-700"
              >อัพโหลดรูปภาพ</label
            >
            <input
              id="example1"
              type="file"
              class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
            />
          </div>
          <!-- Register Button -->
          <Button>
            <slot name="button"> Register </slot>
          </Button>
          <br />
          <!-- Login Here -->
          <p>
            Already have account?
            <a href="/login" class="underline">Sign in</a>
          </p>
        </form>
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
const auth = useAuthStore();
const form = reactive({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
});
const errors = ref([]);
const handleSubmit = async () => {
  try {
    await auth.register(form);
  } catch (error) {
    errors.value = console.log(error.response.errors);
  }
};

definePageMeta({
  layout: "custom",
  middleware: ["guest"],
});
</script>
