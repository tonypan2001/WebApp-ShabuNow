<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                ตะกร้าสินค้า
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>
            <!-- Ordered List -->
            <div v-for="order in orders"
            class="flex flex-col lg:flex-row justify-around items-center border-2 border-red-500 rounded-lg mt-8 py-4 w-full min-h-[150px] overflow-hidden">
              <div class="max-h-[250px] overflow-hidden object-center rounded-lg">
                <img class="object-cover" width="250" height="250" :src="getFullImageUrl(order.imgPath)" alt="">
              </div>
              <div class="mt-8 lg:mt-0">
                <h1 class="text-2xl">
                  {{ order.name}}
                </h1>
              </div>
              <!-- increment and decrement button-->
              <div class="text-2xl flex justify-center">
                <h1>จำนวน: </h1>
                <h1 class="ml-2">
                  {{ order.quantity }}
                </h1>
              </div>

              <div class="text-center w-40">
                <h1 class="text-2xl">
                  ราคา: ฿
                  {{ order.price*order.quantity }}
                </h1>
              </div>
            </div>

            <!-- Total Price -->
            <TotalPrice>
                <div class="flex justify-center items-center">
                    <h1 class="text-2xl text-gray-700 mr-2">รวมการสั่งซื้อ:</h1>
                    <span id="original_price" class="text-red-600 font-semibold text-3xl ease-linear duration-150">฿ {{ sum }}</span>
                </div>
                <hr>
                <!-- Add menu button -->
              <div class="flex gap-x-4">
                <NuxtLink v-if="auth.getUser.role === 'customer'"  :to="`/`">
                  <Button class="mt-8 py-4 w-full md:w-auto">
                    <i class="bi bi-plus-lg mr-1"></i>
                    เพิ่มเมนูอาหาร
                  </Button>
                </NuxtLink>
                <form @submit.prevent="onSubmit()" action="" v-if="auth.getUser.role === 'customer'" >
                  <Button class="mt-8 py-4 w-full md:w-auto">
                    <i class="bi bi-send-fill mr-1"></i>
                    ส่งรายการอาหาร
                  </Button>
                </form>
              </div>
            </TotalPrice>

        </ContentContainer>
    </MainContainer>
</template>

<script setup lang="ts">
import { Order} from "~/models/defineType";
import {navigateTo} from "#app";

definePageMeta({
  middleware: ['admin']
})

const route = useRoute()
const auth = useAuthStore();
const config = useRuntimeConfig()

async function useFetch<T>(url: string): Promise<{ data: T}> {
  const res = await fetch(url);
  const data = await res.json();
  return { data };
}

const { data: orders } = await useFetch<Order[]>(config.public.apiBaseURL + `order/checkPending/${route.params.id}`)
console.log(orders);

let sum = 0;
function sumPrice(orders: Order[]) {
  orders.forEach((order) => {
    sum += order.price*order.quantity;
  });
}

const totalPrice = sumPrice(orders);

async function onSubmit() {
  console.log(orders)
  try {
    const menu = await $fetch(config.public.apiBaseURL + `order/sendOrders/${route.params.id}`,{     method: "POST",
      method: "POST",
    })
    await navigateTo(`/bills/table_${route.params.id}`)
  } catch (error) {
    console.log("Error" + error)
    if (error.response) {
      console.log(error.response.data);
      console.log(error.response.status);
      console.log(error.response.headers);
    }
  }
}

const getFullImageUrl = (imageUrl) => {
  // Combine the base path with the image URL
  return `/_nuxt/public/images/chef_menus/${imageUrl}`;
};
</script>