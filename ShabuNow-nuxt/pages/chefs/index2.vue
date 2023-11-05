<template>
    <MainContainer>
      <HeaderContainer>
        <h1 class="text-red-500">Chef page</h1>
        <HeaderText> โปรดเลือกเมนูสุดคุ้ม </HeaderText>
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
  
      <ContentContainer>
        <!-- menu container -->
        <!-- Category Tag -->
        <HeaderContainer class="w-full">
          <div
            class="text-2xl font-medium m-4 py-1.5 px-4 rounded-xl bg-red-600 text-white"
          >
            <h1>ประเภท : อาหารคาว</h1>
          </div>
        </HeaderContainer>
        <GridContainer>
          <!-- menu item card -->
          <MenuItemCard v-for="(menu, index) in menus" :key="index">
            <template v-slot:title>
              <!-- สลัดผักรวมมิตร -->
              {{ menu.title }}
            </template>
            <template v-slot:price>
              <!-- ราคา ฿55 บาท -->
              {{ menu.price }}
            </template>
            <template v-slot:button> เลือกเมนูนี้ </template>
          </MenuItemCard>
          <!-- end -->
        </GridContainer>
        <!-- end menu container -->
      </ContentContainer>
    </MainContainer>
  </template>
  
  <script>
  export default {
    // just some data
    // definePageMeta({
    //   middleware:  ["auth"],
    name: "menu",
    data() {
      return {
        menus: {},
      };
    },
    mounted() {
      this.getMenus();
    },
    methods: {
      getMenus() {
        axios.get(`http://localhost/api/menu`).then((res) => {
          console.log(res);
          this.menus = res.data;
        });
      },
    },
  };
  </script>
  