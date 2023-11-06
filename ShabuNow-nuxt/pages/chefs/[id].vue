<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>แก้ไขเมนู</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <DetailCard class="mb-12">
        <template v-slot:detail_title>สร้างเมนูอาหาร</template>
        <form @submit.prevent="updateMenu">
          <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>

            <!-- radio button added -->

            <input
              class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="text"
              name="name"
              v-model="menu.name"
            />
            <span class="text-red-500" v-if="errorList.name">{{
              this.errorList.name[0]
            }}</span>
          </label>
          <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>
            <input
              class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="number"
              name="category_id"
              v-model="menu.category_id"
            />
            <span class="text-red-500" v-if="errorList.category_id">{{
              this.errorList.category_id[0]
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
              name="status"
              v-model="menu.status"
            />
            <span class="text-red-500" v-if="errorList.status">{{
              this.errorList.status[0]
            }}</span>
          </label> -->
          <label class="relative block mt-4">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
              <slot name="icon"> </slot>
            </span>
            <input
              class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base"
              placeholder="placeholder"
              type="number"
              name="price"
              v-model="menu.price"
            />
            <span class="text-red-500" v-if="errorList.price">{{
              this.errorList.price[0]
            }}</span>

            <div class="flex items-center mb-4 mt-4">
              <input
                id="default-radio-1"
                type="radio"
                name="status"
                value="available"
                v-model="menu.status"
                :checked="menu.status === 'available'"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="default-radio-1"
                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >คงเหลือ</label
              >
            </div>
            <div class="flex items-center">
              <input
                checked
                id="default-radio-2"
                type="radio"
                name="status"
                value="outofstock"
                v-model="menu.status"
                :checked="menu.status === 'outofstock'"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              />
              <label
                for="default-radio-2"
                class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >หมด</label
              >
            </div>
          </label>
          <!-- <select
          class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
        >
          <option selected>เลือกหมวดหมู่</option>
          <option value="food">อาหาร</option>
          <option value="drink">เครื่องดื่ม</option>
          <option value="sweet">ของหวาน</option>
        </select> -->

          <textarea
            row="2"
            class="mt-4 text-base block p-2.5 w-full bg-white border border-slate-300 rounded-lg focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none"
            placeholder="คำอธิบายเพิ่มเติม"
            v-model="menu.description"
          ></textarea>
          <span class="text-red-500" v-if="errorList.description">{{
            this.errorList.description[0]
          }}</span>
          <h1>MenuId is : {{ menuId }}</h1>
          <h1>menusidid is : {{ menusidid }}</h1>

          <div class="mx-auto mt-2">
            <label class="mt-4 mb-1 block text-lg font-medium text-gray-700"
              >อัพโหลดรูปภาพ</label
            >
            <input
              id="example1"
              type="file"
              class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
            />
          </div>
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

export default {
  // just some data
  // definePageMeta({
  //   middleware:  ["auth"],
  name: "menuEdit",
  data() {
    // const auth = useAuthStore();
    // const token = useTokenStore();
    return {
      menusidid: "",
      menuId: 0,
      menu: {},
      errorList: {},
    };
  },
  mounted() {
    this.menuId = this.$route.params.id;
    alert(this.menuId);
    this.getMenu(this.menuId);
  },
  methods: {
    getMenu(menuId) {
      axios.get(`http://localhost/api/menu/show/${menuId}/edit`).then((res) => {
        console.log(res);
        this.menu = res.data.menu;
        this.menusidid = res.data.menu.id;
      });
    },
    updateMenu() {
      var myThis = this;

      //   alert(`update menu is worked:` + menuId);
      axios
        .put(`http://localhost/api/menu/show/${this.menusidid}/edit`, this.menu)
        .then((res) => {
          console.log(res, "res");
          alert(res.data.message);
          //   this.menu = res.data.menu;
          this.errorList = {};
        })
        .catch(function (error) {
          console.log(error, "errors");
          console.log(`update menu is worked:` + menuId);

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
