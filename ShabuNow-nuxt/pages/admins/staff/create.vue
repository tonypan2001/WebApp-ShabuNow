
import { Input } from 'postcss';
<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>สร้างเจ้าหน้าที่</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <div class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8">

        <div class="overflow-hidden border h-[150px] flex flex-col lg:flex-row justify-around items-center rounded-xl bg-cover-category object-cover bg-center bg-no-repeat">
          <h1 class="text-xl lg:text-3xl font-semibold text-white z-10">
            เพิ่มพนักงานสตาฟ
          </h1>
          <div class="z-10 text-white text-6xl lg:text-8xl">
            <i class="bi bi-person-plus-fill"></i>
          </div>
          <div class="bg-cover-overlay"></div>
        </div>

        <form @submit.prevent="handleRegisterStaff()" action="">
          <InputField v-model="formData.username"
            class="mt-4"
            type="text"
            name="username"
            placeholder="Username"
          />
          <div>
            <span v-if="errors.username" class="text-red-500">
              {{ errors.username }}
            </span>
          </div>
          <InputField v-model="formData.email"
            class="mt-4"
            type="email"
            name="email"
            placeholder="Email"
          />
          <div>
            <span v-if="errors.email" class="text-red-500">
              {{ errors.email }}
            </span>
          </div>
          <InputField v-model="formData.password"
            class="mt-4"
            type="password"
            name="password"
            placeholder="Password"
          />
          <div>
            <span v-if="errors.password" class="text-red-500">
              {{ errors.password }}
            </span>
          </div>
          <InputField v-model="formData.confirm_password"
            class="mt-4"
            type="password"
            name="confirm-password"
            placeholder="Confirm password"
          />
          <div>
            <span v-if="errors.confirm_password" class="text-red-500">
              {{ errors.confirm_password }}
            </span>
          </div>

          <!-- checkboxes to select role chef or staff -->
          <div class="mt-4">
            <h3 class="mb-2 text-base text-gray-900">เลือกตำแหน่ง:</h3>

            <div class="flex items-center">
              <label @click="selectRole('chef')" id="chef" for="chef-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 px-4 py-2 border rounded">
                <input type="checkbox" name="chef-checkbox" id="chef-checkbox" class="accent-red-500">
                <p class="text-base text-gray-900 ml-2">Chef</p>
              </label>
  
              <label @click="selectRole('staff')" id="staff" for="staff-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 ml-5 px-4 py-2 border rounded">
                <input type="checkbox" name="staff-checkbox" id="staff-checkbox" class="accent-red-500">
                <p class="text-base text-gray-900 ml-2">Staff</p>
              </label>
            </div>
          </div>

          <div class="mt-4 text-base">
            <p class="text-red-500">{{ message.error }}</p>
            <p class="text-green-500">{{ message.success }}</p>
          </div>

<!--          <div class="mx-auto my-8">-->
<!--            <label-->
<!--              for="example1"-->
<!--              class="mt-4 mb-1 block text-lg font-medium text-gray-700"-->
<!--              >อัพโหลดรูปภาพ</label-->
<!--            >-->
<!--            <input-->
<!--              id="example1"-->
<!--              type="file"-->
<!--              class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"-->
<!--            />-->
<!--          </div>-->
          <!-- <button class="bg-red-500 text-white rounded-xl ">Log in</button> -->
          <hr class="mt-4">
          <Button class="mt-4 w-full">
            <slot name="button"> สร้างบัญชีพนักงานสตาฟ </slot>
          </Button>
        </form>
      </div>
    </ContentContainer>
  </MainContainer>
</template>

<script setup lang="ts">
const config = useRuntimeConfig()
const auth = useAuthStore()
const token = useTokenStore()
const formData = reactive({
  username: "",
  email: "",
  password: "",
  confirm_password: "",
  role: "",
})
const message = reactive({
  error: "",
  success: "",
})
const errors = ref([])
async function handleRegisterStaff() {
  console.log(formData)
  try {
    const staff = await $fetch(config.public.apiBaseURL + "staff/create", {
      method: "POST",
      body: formData
    })
    message.success = "สร้างบัญชีสำเร็จ"
    message.error = ""
  } catch (error) {
    message.success = ""
    message.error = "เกิดข้อผิดพลาด"
    console.log("Error" + error)
    if (error.response) {
      console.error("Response Status:", error.response.status);
      console.error("Response Data:", error.response.data);
    }
  }
}

// checkbox
function selectRole(role:string) {
  const chefbox = document.getElementById('chef-checkbox') as HTMLInputElement
  const staffbox = document.getElementById('staff-checkbox') as HTMLInputElement
  const chef = document.getElementById('chef') as HTMLElement
  const staff = document.getElementById('staff') as HTMLElement
  if (role === 'chef') {
    formData.role = "chef"
    chefbox.checked = true
    staffbox.checked = false
    chef.classList.add("border-red-500")
    staff.classList.remove("border-red-500")
  } else if (role === 'staff') {
    formData.role = "staff"
    chefbox.checked = false
    staffbox.checked = true
    chef.classList.remove("border-red-500")
    staff.classList.add("border-red-500")
  }
}
</script>

<style>
.bg-cover-category {
  position: relative;
  background-image: url('../../assets/img/cover1.jpg');
  background-position: center;
}
.bg-cover-overlay {
  background-color: rgba(0, 0, 0, .35);
  width: 100%;
  height: 100%;
  position: absolute;
}
</style>