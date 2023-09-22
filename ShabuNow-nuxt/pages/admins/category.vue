<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>จัดการหมวดหมู่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <!-- เปลี่ยนรหัสผ่าน -->
      <div class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8">
        <h1 class="text-2xl font-semibold text-red-600">
          สร้างหมวดหมู่ที่ต้องการ
        </h1>
        <InputField
          placeholder="ชื่อหมวดหมู่"
          type="text"
          name="confirm-password"
        />
        <div class="pt-4 flex justify-center items-center">
          <Button>
            <slot name="button">เพิ่ม</slot>
          </Button>
        </div>
      </div>
    </ContentContainer>
  </MainContainer>
</template>
