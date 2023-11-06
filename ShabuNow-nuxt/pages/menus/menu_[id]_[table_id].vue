<template>
<MainContainer>
    <HeaderContainer>
        <HeaderText>
            เมนู : {{menu.name}}
        </HeaderText>
    </HeaderContainer>
    <hr>
    <ContentContainer>
        <div class="my-8 w-full flex flex-col lg:flex-row justify-start items-center lg:items-start">
            <div class="flex flex-col justify-around items-center w-full">
                <div class="w-full flex flex-col lg:flex-row justify-between items-center lg:items-start">
                    <div class="max-w-[800px] h-[500px] overflow-hidden border-2 border-red-500 rounded-lg">
                      <img
                      width="800"
                      height="500"
                      :src="getFullImageUrl(menu.imgPath)"
                      alt="Salad"
                      class="object-cover">
                    </div>
                    <div class="px-4 w-full">
                        <div class="text-2xl mt-4 font-medium py-1.5 px-4 rounded-lg border-2 text-red-600 border-red-600">
                            <h1>ราคา ฿ {{menu.price}} บาท</h1>
                        </div>
                        <hr class="my-4">
                        <h1 class="text-xl font-medium mt-2">รายละเอียดเมนู</h1>
                        <p class="my-4 text-lg text-gray-800">
                            {{ menu.description }}
                        </p>
                        <div class="px-4 py-4 mt-8 w-full border-t">
                            <!-- status menu option for chef role -->
                            <div v-if="auth.getUser.role === 'chef'" class="flex flex-col justify-start items-start text-lg">
                                <h1 class="text-xl lg:text-2xl text-red-600">ปรับเปลี่ยนสถานะของเมนู</h1>
                                <select
                                class="mt-4 text-base focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
                                >
                                  <option value="available">พร้อมเสิร์ฟ (READY)</option>
                                  <option value="canceled">ยกเลิกชั่วคราว (NOT READY)</option>
                                </select>
                                <Button class="mt-4 w-full">
                                    ยืนยันเปลี่ยนสถานะ
                                </Button>
                            </div>

                            <!-- for customer -->
                            <counter-button class="w-full" title="จำนวน" v-if="table_id !== `0` && auth.getUser.role === 'customer'">

                            </counter-button>
                            <div v-if="auth.getUser.role === 'customer' && table_id !== `0`" class="flex flex-col justify-start items-start text-lg">
                                <Button @click="addMenu()" class="mt-4 w-full">
                                    <i class="bi bi-cart-plus mr-2"></i>
                                    เพิ่มเข้าตะกร้า
                                </Button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </ContentContainer>
</MainContainer>
</template>

<script setup lang="js">
definePageMeta({
  middleware: ['admin']
})
import {useRoute} from "vue-router";
import {useAuthStore} from "~/stores/auth";

const auth = useAuthStore();
const route = useRoute();
const menu = await $fetch(`http://localhost/api/menu/show/${route.params.id}`)
let table_id = 0;
if(route.params.table_id)
{
  table_id = route.params.table_id;
}

async function addMenu() {
  if (auth.getUser.role !== 'customer') {
    return
  }
  const menu_id = route.params.id;
  const quantity = document.getElementsByName('custom-input-number')[0].value
  console.log(menu_id, quantity)
  const response = await $fetch(`http://localhost/api/order/store/${route.params.table_id}`, {
    method: 'POST',
    body: { menu_id, quantity }
  });
  console.log(response)
  window.location.href = '/'
}
const getFullImageUrl = (imageUrl) => {
  // Combine the base path with the image URL
  return `/_nuxt/public/images/chef_menus/${imageUrl}`;
};
</script>