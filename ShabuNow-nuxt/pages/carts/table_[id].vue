<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                ตะกร้าสินค้า
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>
          <Table :datas="FilteredOrder" :headers="tableHeaders" class="mt-8">
            <template v-slot:title>
              โต๊ะที่ #{{ route.params.id }}
            </template>
          </Table>
<!--            &lt;!&ndash; Ordered List &ndash;&gt;-->
<!--            <CartListCard v-for="order in orders">-->
<!--              <div class="w-60 mt-4 text-center">-->
<!--                <h1 class="text-2xl">-->
<!--                  {{ order.name}}-->
<!--                </h1>-->
<!--              </div>-->
<!--              &lt;!&ndash; increment and decrement button&ndash;&gt;-->
<!--                  {{ order.quantity }}-->

<!--              <div class="mt-4 text-center w-40">-->
<!--                <h1 class="text-2xl">-->
<!--                  ราคา: ฿-->
<!--                  {{ order.price*order.quantity }}-->
<!--                </h1>-->
<!--              </div>-->
<!--            </CartListCard>-->

            <!-- Total Price -->
            <TotalPrice>
                <div class="flex justify-center items-center">
                    <h1 class="text-2xl text-gray-700 mr-2">รวมการสั่งซื้อ:</h1>
                    <span id="original_price" class="text-red-600 font-semibold text-3xl ease-linear duration-150">฿ {{ sum }}</span>
                </div>
                <hr>
                <!-- Add menu button -->
              <NuxtLink v-if="auth.getUser.role === 'customer'"  :to="`/`">
                <Button class="mt-8 py-4 w-full md:w-auto">
                  <i class="bi bi-plus-lg mr-1"></i>
                  เพิ่มเมนูอาหาร
                </Button>
              </NuxtLink>
              <form @submit.prevent="onSubmit()" action="" v-if="auth.getUser.role === 'customer'" >
                <Button class="mt-8 py-4 w-full md:w-auto">
                  <i class="bi bi-plus-lg mr-1"></i>
                  ส่งรายการอาหาร
                </Button>
              </form>
            </TotalPrice>

        </ContentContainer>
    </MainContainer>
</template>

<script setup lang="ts">
import { Order} from "~/models/defineType";
const route = useRoute()
const auth = useAuthStore();

async function useFetch<T>(url: string): Promise<{ data: T}> {
  const res = await fetch(url);
  const data = await res.json();
  return { data };
}

const { data: orders } = await useFetch<Order[]>(`http://localhost/api/order/checkPending/${route.params.id}`)

const tableHeaders = [
  'ลำดับ',
  'รายการอาหาร',
  'จำนวน',
  'ราคา']
console.log(tableHeaders)

// const FilteredOrder = orders.map((order) => {
//   return {
//     name: order.name,
//     quantity: order.quantity,
//     price: order.price
//   }
// })

let sum = 0
function filterOrder(orders: Order[])
{
  const orderList: Order[] = [];

  let i = 1
  orders.forEach((order) => {
    orderList.push({
      id: i++,
      name: order.name,
      quantity: order.quantity,
      price: order.price * order.quantity,
    })
    sum += order.price * order.quantity
  })
  return orderList
}

const FilteredOrder = filterOrder(orders)

async function onSubmit() {
  console.log(orders)
  try {
    const menu = await $fetch(`http://localhost/api/order/sendOrders/${route.params.id}`,{     method: "POST",
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

</script>