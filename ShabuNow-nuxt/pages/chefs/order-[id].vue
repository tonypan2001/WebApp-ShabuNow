<!-- <h2 class="text-red-500">{{ $route.params.id }}</h2> -->
<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>แก้ไขออเดอร์</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <DetailCard class="mb-12">
        <form @submit.prevent="updateOrder">
          <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>

            <!-- radio button added -->

            <input
              class="cursor-not-allowed bg-gray-100 border border-gray-300 text-gray-900 placeholder:text-slate-400 block rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="text"
              name="name"
              disabled
              v-model="order.name"
            />
            <span class="text-red-500" v-if="errorList.name">{{
              this.errorList.name[0]
            }}</span>
          </label>
          <!-- <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>
            <input
              class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="text"
              name="category_id"
              v-model="order.status"
            />
            <span class="text-red-500" v-if="errorList.status">{{
              this.errorList.status[0]
            }}</span>
          </label> -->

          <!-- $table->enum('status', ['pending','ordered','ready','served']); -->

          <div class="flex items-center mb-4 mt-4">
            <input
              id="default-radio-1"
              type="radio"
              name="status"
              value="ordered"
              v-model="order.status"
              :checked="order.status === 'ordered'"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label
              for="default-radio-1"
              class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
              >ได้รับออเดอร์</label
            >
          </div>
          <div class="flex items-center">
            <input
              checked
              id="default-radio-2"
              type="radio"
              name="status"
              value="served"
              v-model="order.status"
              :checked="order.status === 'served'"
              class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            />
            <label
              for="default-radio-2"
              class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
              >พร้อมเสริฟ</label
            >
          </div>

          <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>
            <input
              class="cursor-not-allowed bg-gray-100 border border-gray-300 text-gray-900 placeholder:text-slate-400 block rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="number"
              name="quantity"
              disabled
              v-model="order.quantity"
            />
            <span class="text-red-500" v-if="errorList.quantity">{{
              this.errorList.quantity[0]
            }}</span>
          </label>
          <Button type="submit" class="mt-4 w-full">
            <slot name="button">ยืนยันการแก้ไข</slot>
          </Button>
        </form>
      </DetailCard>
    </ContentContainer>
  </MainContainer>
</template>
<script>
import axios from "axios";
import {navigateTo} from "#app";

export default {
  // just some data
  // definePageMeta({
  //   middleware:  ["auth"],
  name: "orderEdit",
  data() {
    // const auth = useAuthStore();
    // const token = useTokenStore();
    return {
      // menusidid: "",
      orderId: "",
      order: {},
      errorList: {},
    };
  },
  mounted() {
    this.orderId = this.$route.params.id;
    // alert(this.orderId);
    this.getOrder(this.orderId);
  },
  methods: {
    getOrder(orderId) {
      axios.get(`http://localhost/api/order/show/${orderId}`).then((res) => {
        console.log(`axios คำตอบ ของ res คือ status:` + res.data.status);
        this.order = res.data;
        // this.menusidid = res.data.menu.id;
      });
    },
    updateOrder() {
      var myThis = this;

      // served/{order}
      //   alert(`update menu is worked:` + menuId);
      axios
        .put(`http://localhost/api/order/served/${this.orderId}`, this.order)
        .then((res) => {
          console.log(res, "res");
          // alert(res.data);
          //   this.menu = res.data.menu;
          this.errorList = {};
          navigateTo ("/chefs/orders");
        })
        .catch(function (error) {
          console.log(error, "errors");
          console.log(`update order is worked:` + orderId);

          if (error.response) {
            if (error.response.status == 422) {
              myThis.errorList = error.response.data.errors;
            }
          }
        });
    },
  },
};
</script>
