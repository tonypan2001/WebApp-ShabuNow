<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>รายละเอียดเมนู</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <DetailCard class="mb-12">
        <template v-slot:detail_title>แก้ไขรายละเอียดเมนูอาหาร</template>
        <form @submit.prevent="onSubmit()" action="">
        <InputField v-model="formData.name"
          :placeholder="showMenu.name"
          type="text"
          id="name"
          name="name"
          class="mt-4"
        />
        <InputField v-model="formData.price"
          :placeholder="showMenu.price"
          type="number" id="price"
          name="price"
          class="mt-4"
        />
        <select id="category" v-model="formData.category"
        class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
        >
<!--          <option selected disabled>เลือกหมวดหมู่</option>-->
          <option v-for="category in categories" :value="category.name">{{category.name}}</option>
        </select>

        <textarea v-model="formData.description"
          row="2" id="description"
          class="mt-4 text-base block p-4 w-full bg-white border border-slate-300 rounded-lg focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none"
          :placeholder="showMenu.description"
        ></textarea>

        <div class="mx-auto mt-2 my-8">
          <label
            for="example1"
            class="mt-4 mb-1 block text-lg font-medium text-gray-700"
            >อัพโหลดรูปภาพ</label
          >
          <input @change="handleChangeFile"
            id="imgPath"
            type="file"
            class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
          />
        </div>

        <div class="mb-2 text-red-500">
          <p>{{message.error}}</p>
        </div>
        <div class="mb-2 text-green-500">
          <p>{{message.success}}</p>
        </div>

        <Button class="mt-4 w-full">
          <slot name="button">ยืนยัน</slot>
        </Button>
        </form>
      </DetailCard>

    </ContentContainer>
  </MainContainer>
</template>

<script setup lang="ts">
import {getElementById} from "domutils";
import {navigateTo} from "#app";

const config = useRuntimeConfig()
const route = useRoute()
console.log(route.params.id)

// set text

const formData = reactive({
  name: "",
  price: "",
  category: "",
  description: "",
  // status: "",
  imgPath: "",
})
const message = reactive({
  error: "",
  success: "",
})

// upload image
function generateUniqueId() {
  const timestamp = new Date().getTime();
  const random = Math.random().toString(36).substring(2);
  return timestamp + random;
}

const file = ref<File|null>(null)

const handleChangeFile = (event: Event) => {
  const [_file] = (event.target as HTMLInputElement).files as FileList

  file.value = _file
  console.log("added file: "+file.value.name)
}

// get old info
const showMenu = await $fetch(config.public.apiBaseURL + `menu/show/${route.params.id}`, {
  method: "GET",
  headers: {
    Accept: "application/json",
  }
})

async function onSubmit() {
  try {

    // upload image
    const body = new FormData()
    const generateNewFilename = generateUniqueId() + ".jpeg"
    formData.imgPath = generateNewFilename
    body.append('file', file.value, generateNewFilename)

    console.log('uploading file...')
    const response = await $fetch("/api/upload", {
      method: "POST", body
    })

    console.log(formData)
    const menu = await $fetch(config.public.apiBaseURL + `menu/update/${route.params.id}`, {
      method: "PUT",
      body: formData
    })

    message.success = "แก้ไขเมนูสำเร็จ"
    message.error = ""
    await navigateTo(`/chefs`)
  } catch (err) {
    console.log(err)
    message.error = "แก้ไขเมนูไม่สำเร็จ โปรดตรวจสอบว่าข้อมูลถูกต้อง"
    message.success = ""
  }
}

const categories = await $fetch(config.public.apiBaseURL + 'category', {
  method: "GET",
  headers: {
    Accept: "application/json",
  },
})

console.log(categories)
</script>