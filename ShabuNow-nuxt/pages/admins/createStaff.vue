<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>สร้างเจ้าหน้าที่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <form action="" class="flex flex-col gap-4">
        <input
          class="p-2 mt-8 rounded-xl border"
          type="text"
          name="firstname"
          placeholder="Firstname"
        />
        <input
          class="p-2 rounded-xl border"
          type="text"
          name="lastname"
          placeholder="Lastname"
        />
        <input
          class="p-2 rounded-xl border"
          type="email"
          name="email"
          placeholder="Email"
        />
        <input
          class="p-2 rounded-xl border"
          type="password"
          name="password"
          placeholder="Password"
        />
        <input
          class="p-2 rounded-xl border"
          type="password"
          name="confirm-password"
          placeholder="Confirm password"
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
        <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
        <Button>
          <slot name="button"> สมัครสมาชิก </slot>
        </Button>
        <br />
      </form>
    </ContentContainer>
  </MainContainer>
</template>
