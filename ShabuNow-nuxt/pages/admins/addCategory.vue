<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>จัดการหมวดหมู่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>

      <!-- category header -->
      <div class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8 ">
        <div class="overflow-hidden border h-[150px] flex flex-col lg:flex-row justify-around items-center rounded-xl bg-cover-category object-cover bg-center bg-no-repeat">
          <h1 class="text-xl lg:text-3xl font-semibold text-white z-10">
            เพิ่มหมวดหมู่อาหาร
          </h1>
          <div class="z-10 text-white text-6xl lg:text-8xl">
            <i class="bi bi-book-half"></i>
          </div>
          <div class="bg-cover-overlay"></div>
        </div>

        <div class="flex flex-col justify-center items-start">
          <form @submit="addCategory" class="w-full m-0">
            <input
              v-model="name"
              class="mt-4 w-full"
              placeholder="ชื่อหมวดหมู่"
              type="text"
              id="name"/>
            <Button type="submit" class="mt-4 w-full">
              <i class="bi bi-bookmark-plus-fill mr-2"></i>
              เพิ่มหมวดหมู่
            </Button>
          </form>
          </div>
          <div class="border-t w-full mt-8 py-4">
            <h1 class="text-2xl">
              สร้างแล้ว: <span class="font-medium">10</span> หมวดหมู่
            </h1>
            <TableNoHeader :datas="categorys" :headers="tableHeaders" class="mt-8">

            </TableNoHeader>
          </div>
        </div>

    </ContentContainer>
  </MainContainer>
</template>

<script setup lang="ts">
const name = ref('');

async function useFetch<T>(url: string): Promise<{ data: T }> {
  const response = await fetch(url);
  const data = await response.json();
  return { data };
}
async function addCategory() {
  const categoryName = name.value;
  console.log("Category Name:", categoryName);
  const { data:response, error } = await useMyFetch<any>(
      "http://localhost/api/category/store",
      {
        method: "POST",
        body: { name }
      }
  )
  console.log("response" ,response);
  console.log(error.value)

  if (error.value=== null) {
    console.log("response", response);
    const { data: newCategory } = await useFetch<Category[]>('http://localhost/api/category');
    categorys.push(newCategory.pop())
    console.log("Updated categories", categorys);
  }
}
type Category = {
  id: number;
  created_at: string;
  updated_at: string;
  name: string;
}

const {data: categorys} = await useFetch<Category[]>('http://localhost/api/category')

</script>>

<style>
.bg-cover-category {
  position: relative;
  background-image: url('../../assets/img/cover1.jpg');
}
.bg-cover-overlay {
  background-color: rgba(0, 0, 0, .35);
  width: 100%;
  height: 100%;
  position: absolute;
}
</style>
