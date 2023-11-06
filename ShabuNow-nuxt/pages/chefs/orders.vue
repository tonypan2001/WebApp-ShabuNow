<template>
  <MainContainer>
    <HeaderContainer>
      <h1 class="text-red-500">Chef page</h1>
      <HeaderText> Incomming Order </HeaderText>
      <!-- debug by pooh -->
      <!-- <h1>email : {{ auth.getUser?.email }}</h1>
        <h1>password :{{ auth.getUser?.surname }}</h1>
        <h1>all :{{ auth.getUser }}</h1>
        <template v-if="token.getStatus">
          <button @click.prevent="auth.logout()">Logout</button>
          <h1>{{ token.getStatus }}</h1>
        </template> -->

      <!-- category dropdown button -->
      <ButtonDropdown title="หมวดหมู่อาหาร" :items="categories" class="mb-4" />
      <!-- end -->
    </HeaderContainer>
    <hr />

    <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead
          class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
        >
          <tr>
            <th scope="col" class="px-6 py-3">Order No.</th>
            <th scope="col" class="px-6 py-3">Menu name</th>
            <th scope="col" class="px-6 py-3">status</th>
            <th scope="col" class="px-6 py-3">Quiaty</th>
          </tr>
        </thead>
        <tbody>
          <tr
            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
            v-for="(order, index) in orders"
            :key="index"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
            >
              {{ order.id }}
            </th>
            <td class="px-6 py-4">{{ order.name }}</td>
            <td class="px-6 py-4">{{ order.status }}</td>
            <td class="px-6 py-4">{{ order.quantity }}</td>
            <td class="px-6 py-4">
              <NuxtLink :to="`/chefs/order-${order.id}`">แก้ไข</NuxtLink>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </MainContainer>
</template>
<!-- $table->id(); $table->timestamps(); $table->string('name');
$table->foreignIdFor(\App\Models\Menu::class); //menu_id (fk)
$table->string('detail')->nullable(); $table->integer('quantity');
$table->enum('status', ['pending','ordered','ready','served']);
$table->foreignIdFor(\App\Models\Table::class); //table_id (fk) -->
<script>
import axios from "axios";
const config = useRuntimeConfig()

export default {
  // just some data
  // definePageMeta({
  //   middleware:  ["auth"],
  name: "order",
  data() {
    // const auth = useAuthStore();
    // const token = useTokenStore();
    return {
      orders: {},
    };
  },
  mounted() {
    this.getOrders();
  },
  methods: {
    getOrders() {
      axios.get(config.public.apiBaseURL + `order/checkOrdered/1/`).then((res) => {
        console.log(res.data);
        this.orders = res.data;
      });
    },
  },
};
</script>
