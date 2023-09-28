
import { Input } from 'postcss';
<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>สร้างเจ้าหน้าที่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <DetailCard class="mb-12">
        <template v-slot:detail_title>สร้างบัญชีพนักงานสตาฟ</template>
        <form action="">
          <InputField
            class="mt-4"
            type="text"
            name="firstname"
            placeholder="Firstname"
          />
          <InputField
            class="mt-4"
            type="text"
            name="lastname"
            placeholder="Lastname"
          />
          <InputField
            class="mt-4"
            type="email"
            name="email"
            placeholder="Email"
          />
          <InputField
            class="mt-4"
            type="password"
            name="password"
            placeholder="Password"
          />
          <InputField
            class="mt-4"
            type="password"
            name="confirm-password"
            placeholder="Confirm password"
          />
          <div class="mx-auto mt-2">
            <label
              for="example1"
              class="mt-4 mb-1 block text-lg font-medium text-gray-700"
              >อัพโหลดรูปภาพ</label
            >
            <input
              id="example1"
              type="file"
              class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
            />
          </div>
          <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
          <Button class="mt-4 w-full">
            <slot name="button"> สร้างบัญชีพนักงานสตาฟ </slot>
          </Button>
        </form>
      </DetailCard>
    </ContentContainer>
  </MainContainer>
</template>
