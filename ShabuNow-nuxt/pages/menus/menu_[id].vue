<template>
<MainContainer>
    <HeaderContainer>
        <HeaderText>
            เมนู : Salad
        </HeaderText>
    </HeaderContainer>
    <hr>
    <ContentContainer>
        <div class="my-8 w-full flex flex-col lg:flex-row justify-start items-center lg:items-start">
            <div class="flex flex-col justify-between items-center w-2/3">
                <div class="w-full flex flex-col justify-between items-start">
                    <img 
                    width="500"
                    height="500"
                    src="https://img.freepik.com/free-photo/delicious-vietnamese-food-including-pho-ga-noodles-spring-rolls-white-wall_181624-34158.jpg?w=1480&t=st=1694914784~exp=1694915384~hmac=28ce6696273496ac0f862aacccb0f3fcf9bb4b466ea118dc34c9bc3aaac883b0" 
                    alt="Salad"
                    class="rounded-lg object-cover w-full">
                    <div class="my-4 border-y">
                        <div class="text-2xl mt-4 font-medium py-1.5 px-4 rounded-lg border-2 text-red-600 border-red-600">
                            <h1>ราคา ฿ 75 บาท</h1> 
                        </div>
                        <hr class="my-4">
                        <h1 class="text-xl mt-2">รายละเอียดเมนู</h1>
                        <p class="my-4 text-lg font-light text-gray-800">
                            He oppose at thrown desire of no. Announcing impression unaffected day his are unreserved indulgence. Him hard find read are you sang. Parlors visited noisier how explain pleased his see suppose. Do ashamed assured on related offence at equally totally.
                        </p>
                    </div>
                </div>
            </div>
            <div class="px-4 lg:px-8 py-4 w-2/3">
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

                <form @submit.prevent="onSubmit()" action="">
                  <!-- for customer -->
                  <div class="flex flex-col justify-start items-start text-lg">
                      <Button class="mt-4 w-full">
                          <i class="bi bi-cart-plus mr-2"></i>
                          เพิ่มเข้าตะกร้า
                      </Button>
                  </div>
                </form>
            </div>

        </div>
    </ContentContainer>
</MainContainer>
</template>

<script setup lang="ts">
definePageMeta({
  middleware: ['admin']
})

const auth = useAuthStore()

const route = useRoute()

const formData = reactive({
  menu_id: route.params.id,
  quantity: 1,
})

const error = reactive({
  errors: ""
})
async function onSubmit() {

  console.log(route.params.id)
  try {
    //แก้ระบบโต๊ะ
    const res = await $fetch("http://localhost/api/order/store/1/", {
      method: "POST",
      body: formData
    })
    error.success = "ส่ง order สำเร็จ"
    error.errors = ""
  } catch (error) {
    error.errors = "ส่ง order ไม่สำเร็จ"
    error.success = ""
    console.log("Error" + error)
    if (error.response) {
      console.error("Response Status:" , error.response.status);
      console.error("Response Data:" , error.response.data);
    }
  }
}
</script>