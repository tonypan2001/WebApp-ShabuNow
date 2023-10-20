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

<script lang="ts">
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

</script>
