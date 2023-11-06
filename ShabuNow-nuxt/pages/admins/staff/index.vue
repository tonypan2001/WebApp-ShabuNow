<template>
<MainContainer>
  <HeaderContainer>
    <HeaderText>
      รายชื่อพนักงาน
    </HeaderText>
  </HeaderContainer>
  <hr>
  <ContentContainer>
    <!-- Staff List -->
<!--    <div v-if="pending"><p>Loading...</p></div>-->
<!--    <div v-else>-->
<!--      <div class="mx-8 my-2 border p-4 rounded-xl hover:bg-green-200"-->
<!--           v-for="staff in staffs" :key="staff.id">-->
<!--        <nuxt-link class="hover:text-blue-500 hover:font-bold"-->
<!--                   :to="`/`">-->
<!--          {{ staff.firstname }} {{ staff.surname }}-->
<!--        </nuxt-link>-->
<!--      </div>-->
<!--    </div>-->
    <div v-if="pending"><p>Loading...</p></div>
    <div v-else class="max-w-[900px] w-full">

      <!-- checkboxes to select role chef or staff -->
      <div class="my-4">
        <h3 class="mb-2 text-base text-gray-900">เลือกตัวกรอง:</h3>

        <div class="flex flex-col justify-start lg:flex-row items-start gap-y-2.5 lg:gap-y-0 gap-x-5">
          <label @click="selectRole('')" id="total" for="total-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 px-4 py-2 border rounded">
            <input type="checkbox" name="total-checkbox" id="total-checkbox" class="accent-red-500">
            <p class="text-base text-gray-900 ml-2">ทั้งหมด</p>
          </label>

          <label @click="selectRole('chef')" id="chef" for="chef-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 px-4 py-2 border rounded">
            <input type="checkbox" name="chef-checkbox" id="chef-checkbox" class="accent-red-500">
            <p class="text-base text-gray-900 ml-2">Chef</p>
          </label>

          <label @click="selectRole('staff')" id="staff" for="staff-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 px-4 py-2 border rounded">
            <input type="checkbox" name="staff-checkbox" id="staff-checkbox" class="accent-red-500">
            <p class="text-base text-gray-900 ml-2">Staff</p>
          </label>

          <label @click="selectRole('admin')" id="admin" for="admin-checkbox" class="flex items-center cursor-pointer ease-out duration-300 hover:border-red-500 px-4 py-2 border rounded">
            <input type="checkbox" name="admin-checkbox" id="admin-checkbox" class="accent-red-500">
            <p class="text-base text-gray-900 ml-2">Admin</p>
          </label>
        </div>
      </div>

      <div class="mb-4 mt-8">
        <a
            href="/admins/staff/create"
            class="">
          <Button class="w-full py-2 px-6">
            <i class="bi bi-person-plus-fill mr-2"></i>
            เพิ่มพนักงานสตาฟ
          </Button>
        </a>
      </div>

      <hr class="mb-8">

<!--      Table -------------------------------------------------------------------->
      <div class="flex flex-col justify-center items-center w-full mb-10 p-4">
        <h1 class="bg-black text-center text-white text-sm lg:text-xl rounded-t-xl py-2 px-4">
          รายชื่อพนักงาน
        </h1>
        <table class="text-center text-sm lg:text-lg rounded-xl table-auto w-full border border-slate-500 border-separate border-spacing-3">
          <thead>
          <tr>
            <th  class="border border-slate-300 rounded-xl p-2 bg-gray-100">
              ลำดับ
            </th>
            <th  class="border border-slate-300 rounded-xl p-2 bg-gray-100">
              ชื่อ
            </th>
            <th  class="border border-slate-300 rounded-xl p-2 bg-gray-100">
              ตำแหน่ง
            </th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(staff, index) in filterOnSelected" :key="staff.id">
            <td class="border border-slate-300 rounded-xl p-4 text-xl">
              {{ index+1 }}
            </td>
            <td class="border border-slate-300 rounded-xl p-4 text-xl">
              <!--              {{ staff.firstname }} {{ staff.surname }}-->
              {{ staff.username }}
            </td>
            <td class="border border-slate-300 rounded-xl p-4 text-xl">
              {{ staff.role }}
            </td>
<!--            <td class="border border-slate-300 rounded-xl p-2">-->
<!--              <nuxt-link :to="`/admins/staff/${staff.id}`" class="">-->
<!--                <Button class=" py-2 px-2 bg-white hover:bg-red-500">-->
<!--                  <p class="text-md font-medium text-red-500 hover:text-white">-->
<!--                  <i class="bi bi-pencil-square mr-2"></i>-->
<!--                    ตรวจสอบ/แก้ไข-->
<!--                  </p>-->
<!--                </Button>-->
<!--              </nuxt-link>-->
<!--            </td>-->
          </tr>
          </tbody>
        </table>
      </div>
    </div>
<!--    <Table :datas="tableData" :headers="tableHeaders" class="mt-8">-->
<!--      <title>-->
<!--        พนักงานสตาฟทั้งหมด-->
<!--      </title>-->
<!--    </Table>-->
  </ContentContainer>
</MainContainer>
</template>

<script setup lang="ts">
import useMyFetch from "~/composables/useMyFetch";
const config = useRuntimeConfig()
const { data: staffs, pending } = await useMyFetch("staff",{})
console.log(staffs.value)

const filter = reactive({
  role: ""
})

const filterOnSelected = computed(() => {
  if (!staffs.value) return []
  if (filter.role === '') {
    return staffs.value
  } else {
    return staffs.value.filter(staff => staff.role === filter.role)
  }
})
// checkbox
function selectRole(role:string) {
  const totalbox = document.getElementById('total-checkbox') as HTMLInputElement
  const chefbox = document.getElementById('chef-checkbox') as HTMLInputElement
  const staffbox = document.getElementById('staff-checkbox') as HTMLInputElement
  const adminbox = document.getElementById('admin-checkbox') as HTMLInputElement
  const total = document.getElementById('total') as HTMLElement
  const chef = document.getElementById('chef') as HTMLElement
  const staff = document.getElementById('staff') as HTMLElement
  const admin = document.getElementById('admin') as HTMLElement
  if (role === 'chef') {
    filter.role = role
    chefbox.checked = true
    staffbox.checked = false
    adminbox.checked = false
    totalbox.checked = false
    chef.classList.add("border-red-500")
    staff.classList.remove("border-red-500")
    admin.classList.remove("border-red-500")
    total.classList.remove("border-red-500")
  } else if (role === 'staff') {
    filter.role = role
    chefbox.checked = false
    staffbox.checked = true
    adminbox.checked = false
    totalbox.checked = false
    chef.classList.remove("border-red-500")
    staff.classList.add("border-red-500")
    admin.classList.remove("border-red-500")
    total.classList.remove("border-red-500")
  } else if (role === 'admin') {
    filter.role = role
    chefbox.checked = false
    staffbox.checked = false
    adminbox.checked = true
    totalbox.checked = false
    chef.classList.remove("border-red-500")
    staff.classList.remove("border-red-500")
    total.classList.remove("border-red-500")
    admin.classList.add("border-red-500")
  } else if (role === '') {
    filter.role = role
    totalbox.checked = true
    chefbox.checked = false
    staffbox.checked = false
    adminbox.checked = false
    chef.classList.remove("border-red-500")
    staff.classList.remove("border-red-500")
    admin.classList.remove("border-red-500")
    total.classList.add("border-red-500")
  }
}
</script>


