<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText> โปรดเลือกเมนูสุดคุ้ม </HeaderText>
      <!-- debug by pooh -->
      <!-- <h1>email : {{ auth.getUser?.email }}</h1>
      <h1>password :{{ auth.getUser?.surname }}</h1> -->
      <!--      <h1>all :{{ auth.getUser }}</h1>-->
      <!-- <template v-if="token.getStatus">
        <button class="text-red-500" @click.prevent="auth.logout()">Logout</button>
        <h1>{{ token.getStatus }}</h1>
      </template> -->

      <!-- category dropdown button -->
      <div class="block flex justify-center items-center">
        <!-- end -->
        <!--        <ButtonBorder v-if="auth.getUser.role === 'admin'">+ เพิ่มเมนู</ButtonBorder>-->
        <!--        <ButtonBorder v-if="auth.getUser.role === 'admin'" href="/admins/createMenu">+ เพิ่มหมวดหมู่</ButtonBorder>-->
<!--        <ButtonDropdown-->
<!--          title="หมวดหมู่อาหาร"-->
<!--          :items="categories"-->
<!--          class="mx-4"-->
<!--        />-->
      </div>
    </HeaderContainer>
    <hr />

    <ContentContainer v-for="categoryMenu in categorizedMenus">
      <!-- menu container -->
      <!-- Category Tag -->
      <HeaderContainer class="w-full">
        <div
          class="text-2xl font-medium m-4 py-1.5 px-4 rounded-lg bg-red-600 text-white"
        >
          <h1>
            ประเภท : {{ categories[categoryMenu[0].category_id - 1].name }}
          </h1>
        </div>
      </HeaderContainer>
      <GridContainer>
        <!-- menu item card -->
        <MenuItemCard
          v-for="menu in categoryMenu"
          :imageUrl="menu.imgPath"
          :edit_menu="auth.getUser.role === 'chef' ? '/admins/editMenu_' + menu.id : null"
          :to="`/menus/menu_${menu.id}_${table_id}`"
        >
          <template v-slot:title>
            <!-- สลัดผักรวมมิตร -->
            {{ menu.name }}
          </template>
          <template v-slot:price>
            <!-- ราคา ฿55 บาท -->
            {{ menu.price }}
          </template>
          <!-- <NuxtLink :to="`/chefs/${menu.id}`"> -->
          <template v-slot:button>
            <NuxtLink :to="`/chefs/${menu.id}`"
              >แก้ไขหรือเปลี่ยนสถานะเมนู</NuxtLink
            >
          </template>
          <!-- </NuxtLink> -->
        </MenuItemCard>
        <!-- end -->
      </GridContainer>
      <!-- end menu container -->
    </ContentContainer>
  </MainContainer>
</template>

<script setup lang="js">
import { ref, onMounted } from "vue";
const router = useRouter()

const editChef = (id) => {
  // ทำการ routing ไปยังหน้าแก้ไขเชฟ (chef)
  $router.push(`/chefs/${id}`);
};

const auth = useAuthStore();
console.log(auth.getUser.id)
let table_id = 0;
const tokenStore = useTokenStore();
if (tokenStore.getStatus) {
  const user = await $fetch(`http://localhost/api/staff/${auth.getUser.id}`);
  if(user.tableNumber)
  {
    table_id = user.tableNumber;
  }
}


console.log(auth.getUser.role)
function categorizeMenusByCategory(menus) {
  const categorizedMenus = [];

  menus.forEach((menu) => {
    const categoryId = menu.category_id;
    if (categorizedMenus[categoryId - 1]) {
      categorizedMenus[categoryId - 1].push(menu);
    } else {
      categorizedMenus[categoryId - 1] = [menu];
    }
  });
  return categorizedMenus;
}
async function getPrice() {
  if ( table_id != 0)
  {
    const data = await $fetch(`http://localhost/api/order/${table_id}`);
    console.log('order :', data)
    if (data) {
      let totalPrice = 0;
      data.forEach(item => {
        totalPrice += item.price * item.quantity;
      });
      return totalPrice;
    } else return 0
  }
  else
  {
    return "-";
  }

}

const menus = await $fetch("http://localhost/api/menu", {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
});
const categories = await $fetch('http://localhost/api/category', {
  method: "GET",
  headers: {
    Accept: "application/json",
  },
});
categories.forEach(category => {
  category.link = `/${category.id}`
})
const categorizedMenus = categorizeMenusByCategory(menus)
const price = await getPrice();
console.log(auth.getUser)
</script>
