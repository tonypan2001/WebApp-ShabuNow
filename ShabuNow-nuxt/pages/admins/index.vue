<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText><i class="bi bi-house-gear-fill"></i> ระบบจัดการหลังบ้าน </HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <!-- menu management section -->
      <HeaderContainer class="w-full">
        <div
        class="text-2xl font-medium m-4 py-1.5 px-4 rounded-xl bg-gray-600 text-white"
        >
          <h1 class="flex justify-center items-center"><i class="bi bi-cup-hot-fill mr-2"></i>การจัดการอาหาร</h1>
        </div>

      </HeaderContainer>

      <!-- menu management -->
      <div class="flex justify-center items-center border-b py-6 w-full">
        <div class="flex flex-col w-full max-w-xl">
          <a href="/admins/addCategory">
            <ButtonBorder class="w-full">
              <i class="bi bi-bookmark-plus-fill mr-2"></i>
              เพิ่มหมวดหมูอาหาร
            </ButtonBorder>
          </a>
          <a href="/admins/createMenu" class="mt-4">
          <ButtonBorder class="w-full">
            <i class="fa-solid fa-bowl-food mr-2"></i>
            เพิ่มเมนูอาหาร
            </ButtonBorder>
          </a>
        </div>
      </div>

      <hr>
      <!-- staff management section -->
      <HeaderContainer class="w-full">
        <div
        class="text-2xl font-medium m-4 py-1.5 px-4 rounded-xl bg-gray-600 text-white"
        >
          <h1 class="flex justify-center items-center"><i class="bi bi-people-fill mr-2"></i>การจัดการพนักงาน</h1>
        </div>
      </HeaderContainer>

      <!-- staff management -->
      <div class="flex justify-center items-center border-b py-6 w-full">
        <div class="flex flex-col w-full max-w-xl">
          <a href="/admins/createStaff">
            <ButtonBorder class="w-full">
              <i class="bi bi-person-plus-fill mr-2"></i>
              เพิ่มพนักงานสตาฟ
            </ButtonBorder>
          </a>
          <a href="/admins/staffList" class="mt-4">
            <ButtonBorder class="w-full">
              <i class="fa-solid fa-list mr-2"></i>
              ดูรายชื่อพนักงานสตาฟ
            </ButtonBorder>
          </a>
        </div>
      </div>

    </ContentContainer>
  </MainContainer>
</template>

<script>
export default {
  // just some data
  data() {
    definePageMeta({
      middleware: ["admin"],
      layout: "custom",
    });
  },
};

</script>
