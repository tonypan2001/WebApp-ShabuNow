<template>
  <section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5">
      <!-- form -->
      <div class="sm:w-1/2 px-8">
        <h1 class="font-bold text-2xl">Login</h1>
        <p class="mt-4 text-sm">If you already a member,login in</p>
        <form action="" class="flex flex-col gap-4">
          <InputField
            class="p-2 mt-8 rounded-xl"
            type="email"
            name="email"
            placeholder="Email"
          />
          <InputField
            class="p-2 rounded-xl"
            type="password"
            name="password"
            placeholder="Password"
          />
          <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
          <Button>
            เข้าสู่ระบบ
          </Button>
          <br />
          <p>
            Don't have a account?
            <a href="/register" class="underline">Register</a>
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

<script>

definePageMeta({
  layout: "custom",
});
</script>
