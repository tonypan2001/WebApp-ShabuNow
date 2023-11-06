<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                คำสั่งซื้อของลูกค้า
            </HeaderText>
<!--          <li class="lg:m-0 m-4">-->
<!--            <a-->
<!--                href="/tables/assign"-->
<!--                class="hover:border-2 hover:border-red-600 hover:text-red-600 cursor-pointer rounded-xl px-1 py-1.5 mx-2">-->
<!--              จัดการที่นั่ง-->
<!--            </a>-->
<!--          </li>-->
          <nuxt-link to="/tables/assign">
            <Button class="py-3">
              <i class="bi bi-person-down text-xl mr-2"></i>
              จัดการที่นั่ง
            </Button>
          </nuxt-link>
        </HeaderContainer>
        <hr>
        <ContentContainer>

            <h1 class="mt-4 text-xl text-red-600 font-medium">จำนวนโต๊ะทั้งหมด : {{ counter.count }}</h1>
            <!-- Add table and Delete table-->
            <div class="mt-4 flex justify-center items-center w-full gap-x-2">
                <Button @click="showConfirmationDialog('add')" class="py-3">
                    <i class="bi bi-plus-circle text-xl mr-2"></i>
                    เพิ่มโต๊ะ
                </Button>
                <Button @click="showConfirmationDialog('delete')" class="py-3">
                    <i class="bi bi-dash-circle text-xl mr-2"></i>
                    ลดโต๊ะ
                </Button>

            </div>

            <GridContainer class="mt-8">
                <!-- หมายเลขโต๊ะ -->
              <div v-for="(tableNumber, index) in tableNumbers" :key="index"
                class="relative p-4 m-4 ease-out duration-300 border-2 hover:border-red-600 rounded-lg cursor-pointer">
                <GraphicsTable :class="[isAvailable ? 'bg-amber-600':'bg-green-600']" :tableNumber="tableNumber" :href="'/orders/table_' + tableNumber" />
              </div>

            </GridContainer>

            <ConfirmationDialog
            v-if="showDialog"
            :header_message="dialogHeaderMessage"
            :message="dialogMessage"
            :confirmAction="handleDialogConfirm"
            :cancelAction="hideConfirmationDialog"/>

        </ContentContainer>
    </MainContainer>
</template>

<script setup lang="ts">

  import { ref, reactive } from "vue";
  import {Table} from "~/models/defineType";

  const tableNumbers = ref([]);
  const counter = ref(0);
  const showDialog = ref(false);
  const dialogHeaderMessage = ref("");
  const dialogMessage = ref("");
  const dialogAction = ref("");

  const config = useRuntimeConfig()

  const tableNumbersGen = (count) => {
    const tableNumbers = [];
    for (let i = 1; i <= count; i++) {
      tableNumbers.push(i);
    }
    return tableNumbers;
  };

  const showConfirmationDialog = (action) => {
    showDialog.value = true;
    dialogAction.value = action;
    if (dialogAction.value === "add") {
      dialogHeaderMessage.value = "Add the table?";
      dialogMessage.value = "คุณแน่ใจหรือไม่ว่าต้องการเพิ่มจำนวนโต๊ะ?";
    } else if (dialogAction.value === "delete") {
      dialogHeaderMessage.value = "Remove the table?";
      dialogMessage.value = "คุณแน่ใจหรือไม่ว่าต้องการลดจำนวนโต๊ะ?";
    }
  };

  const hideConfirmationDialog = () => {
    showDialog.value = false;
  };

  const handleDialogConfirm = () => {
    if (dialogAction.value === "add") {
      incrementTable();
      showDialog.value = false;
      console.log("Add");
      try {
        const table = $fetch(config.public.apiBaseURL + "table/create", {
          method: "POST",
          body: { tableNumber: counter.value },
        });
      } catch (error) {
        console.log("Error" + error);
        if (error.response) {
          console.error("Response Status:", error.response.status);
          console.error("Response Data:", error.response.data);
        }
      }
    } else if (dialogAction.value === "delete") {
      decrementTable();
      showDialog.value = false;
      console.log("Delete");
      try {
        const table = $fetch(config.public.apiBaseURL + "table/delete", {
          method: "DELETE",
          body: { tableNumber: counter.value },
        });
      } catch (error) {
        console.log("Error" + error);
        if (error.response) {
          console.error("Response Status:", error.response.status);
          console.error("Response Data:", error.response.data);
        }
      }
    }
  };

  const numberofTable = await $fetch(config.public.apiBaseURL + `table/count`);
  for (let i = 1; i <= numberofTable; i++) {
    tableNumbers.value.push(i);
  }

  const incrementTable = () => {
    hideConfirmationDialog();
    counter.value++;
    tableNumbers.value.push(tableNumbers.value.length + 1);
  };

  const decrementTable = () => {
    if (tableNumbers.value.length > 0) {
      counter.value--;
      tableNumbers.value.pop();
    }
  };
</script>