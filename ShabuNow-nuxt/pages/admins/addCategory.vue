<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>จัดการหมวดหมู่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>

      <!-- เปลี่ยนรหัสผ่าน -->
      <div class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8 ">
        <h1 class="text-2xl font-semibold text-red-600">
          สร้างหมวดหมู่อาหารที่ต้องการ
        </h1>

        <div class="flex flex-col justify-center items-start">
            <InputField
              class="mt-4 w-full"
              placeholder="ชื่อหมวดหมู่"
              type="text"
              name="confirm-password"/>
            <Button class="mt-4 w-full">
              <i class="bi bi-bookmark-plus-fill mr-2"></i>
              เพิ่มหมวดหมู่
            </Button>
          </div>
          <div class="border-t w-full mt-8 py-4">
            <h1 class="text-2xl">
              สร้างแล้ว: <span class="font-medium">10</span> หมวดหมู่
            </h1>
            <TableNoHeader :datas="tableData" :headers="tableHeaders" class="mt-8">

            </TableNoHeader>
          </div>
        </div>

    </ContentContainer>
  </MainContainer>
</template>

<script>
export default {
  data() {
    return {
      tableHeaders: ['ชื่อหมวดหมู่'],
      tableData: [
        ['Drink'],
        ['Sweet'],
        ['Ice Cream'],
      ]
    }
  }
}
</script>
