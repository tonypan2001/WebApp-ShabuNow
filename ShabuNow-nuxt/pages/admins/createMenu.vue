<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>สร้างเมนู</HeaderText>
    </HeaderContainer>
    <hr />
    <form @submit.prevent="onSubmit()" action="">
    <ContentContainer>
      <DetailCard class="mb-12">
        <template v-slot:detail_title>สร้างเมนูอาหาร</template>
        <InputField v-model="formData.name"
        class="mt-4"
        placeholder="ชื่อเมนู"
        type="text"
        name="name"
        />
        <InputField v-model="formData.price"
        class="mt-4"
        placeholder="ราคา (THB)"
        type="number"
        name="price"
        />
        <select v-model="formData.category"
        class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
        >
          <option selected>เลือกหมวดหมู่</option>
          <option v-for="catogory in categories"> {{ catogory.name }}</option>
        </select>

        <textarea v-model="formData.description"
        row="2"
          class="mt-4 text-base block p-2.5 w-full bg-white border border-slate-300 rounded-lg focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none"
          placeholder="คำอธิบายเพิ่มเติม"
        ></textarea>

        <div class="mx-auto my-8">
          <label
            class="mt-4 mb-1 block text-lg font-medium text-gray-700"
            >อัพโหลดรูปภาพ</label
          >
          <input @change="handleChangeFile"
            id="example1"
            type="file"
            class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
          />
          <p>{{ file?.name }}</p>
        </div>
        <Button class="mt-4 w-full">
          <slot name="button">ยืนยัน</slot>
        </Button>
      </DetailCard>
    </ContentContainer>
    </form>
  </MainContainer>
</template>

<script setup lang="ts">
import {Category} from "~/models/defineType";
import {navigateTo} from "#app";
import {format} from "node:url";

const config = useRuntimeConfig()

const formData = reactive({
  name: "",
  price: "",
  category: "",
  description: "",
  imgPath: ""
})

const error = reactive({
  errors: ""
})

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

async function onSubmit() {
  try {
    const body = new FormData()
    const generateNewFilename = generateUniqueId() + ".jpeg"
    formData.imgPath = generateNewFilename
    console.log(formData)

    console.log(generateNewFilename)
    console.log("uploaded file: "+file.value + "--"+ file.value.name)

    body.append('file', file.value, generateNewFilename)

    const response = await $fetch("/api/upload", {
      method: "POST", body
    })

    await $fetch(config.public.apiBaseURL + "menu/store", {
      method: "POST",
      body: formData
    })
    error.success = "สร้างเมนูสำเร็จ"
    error.errors = ""
    await navigateTo(`/admins`)
  } catch (error) {
    error.success = ""
    error.errors = "สร้างเมนูไม่สำเร็จ"
    console.log("Error" + error)
    if (error.response) {
      console.error("Response Status:" , error.response.status);
      console.error("Response Data:" , error.response.data);
    }
  }
}

const categories = await $fetch(config.public.apiBaseURL + 'category', {
  method: "GET",
  headers: {
    Accept: "application/json",
  },
});

</script>
