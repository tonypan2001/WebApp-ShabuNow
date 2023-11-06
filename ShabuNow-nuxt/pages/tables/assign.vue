<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>จัดการโต๊ะ</HeaderText>
    </HeaderContainer>
    <hr />
    <form @submit.prevent="onSubmit()" action="">
      <ContentContainer>
        <DetailCard class="mb-12">
          <template v-slot:detail_title>จัดโต๊ะให้กับลูกค้า</template>
          <InputField v-model="formData.userid"
                      class="mt-4"
                      placeholder="ID ของ ลูกค้า"
                      type="text"
                      name="name"
          />
          <select v-model="formData.tableid"
                  class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
          >
            <option v-for="table in filteredTables"> {{ table.id }}</option>
          </select>

          <Button class="mt-4 w-full">
            <slot name="button">ยืนยัน</slot>
          </Button>
        </DetailCard>
      </ContentContainer>
    </form>
  </MainContainer>
</template>

<script setup lang="ts">

import {Category, Table} from "~/models/defineType";
import {navigateTo} from "#app";

const config = useRuntimeConfig()

const formData = reactive({
  userid: "",
  tableid: ""
})

const error = reactive({
  errors: ""
})

async function onSubmit() {
  console.log(formData)
  try {
    const res = await $fetch(config.public.apiBaseURL + "table/checkIn", {
      method: "POST",
      body: formData
    })
    await navigateTo("/orders")
  } catch (error) {
    console.log(error)
  }
}

const tables = await $fetch(config.public.apiBaseURL + 'table')

function filterTable(tables: Table[])
{
  const filterTable: Table[] = [];

  tables.forEach((table) => {
    if (table.status === "available") {
      filterTable.push(table)
    }
  })
  return filterTable
}

const filteredTables = filterTable(tables)
console.log(filteredTables)

</script>