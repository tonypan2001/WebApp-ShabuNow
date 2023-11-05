<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>
        รายการอาหารที่สั่ง
      </HeaderText>
    </HeaderContainer>
    <hr>
    <ContentContainer>
      <Table :datas="FilteredOrder" :headers="tableHeaders" class="mt-8">
        <template v-slot:title>
          โต๊ะที่ #{{ route.params.id }}
        </template>
      </Table>

      <!-- Total Price -->
      <TotalPrice>
        <div class="flex justify-center items-center">
          <h1 class="text-2xl text-gray-700 mr-2">ยอดรวมทั้งหมด:</h1>
          <span id="discount_price" class="text-red-600 font-semibold text-3xl ml-2 ease-in duration-150">฿ {{ sum }}</span>
        </div>

        <!--        <p class="ml-3 font-normal text-lg text-gray-700 mt-2">-->
        <!--          <i class="bi bi-coin mr-2 text-yellow-500"></i>-->
        <!--          แต้มที่ใช้ไปทั้งหมด : 50 คะแนน-->
        <!--        </p>-->

        <!-- Add menu button -->
        <!--        <NuxtLink :to="`/bills/table_${route.params.id}`">-->
        <NuxtLink :to="`/bills`">
          <Button class="mt-8 py-4 w-full md:w-auto" v-if ="auth.getUser.role === 'staff'">
            <i class="bi bi-cash mr-1"></i>
            ยืนยันการชำระเงิน
          </Button>
        </NuxtLink>
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

const { data: orders } = await useFetch<Order[]>(`http://localhost/api/order/${route.params.id}`)

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

// export default {
//   data() {
//     return {
//       tableHeaders: [
//         'รายการอาหาร',
//         'จำนวน',
//         'ราคา',
//       ],
//       tableDatas: [
//         ['Spaghetti', '3', '450'],
//         ['Energy Drink', '3', '80'],
//         ['Ice Cream Chocolate', '1', '70'],
//       ]
//     }
//   }
// }
</script>