<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                คำสั่งซื้อของลูกค้า
            </HeaderText>
          <li class="lg:m-0 m-4">
            <a
                href="/tables/assign"
                class="hover:border-2 hover:border-red-600 hover:text-red-600 cursor-pointer rounded-xl px-1 py-1.5 mx-2">
              จัดการที่นั่ง
            </a>
          </li>
        </HeaderContainer>
        <hr>
        <ContentContainer>

            <h1 class="mt-4 text-xl text-red-600 font-medium">จำนวนโต๊ะทั้งหมด : {{ counter.count }}</h1>
            <!-- Add table and Delete table-->
            <div class="mt-4 flex justify-center items-center w-full">
                <Button @click="showConfirmationDialog('add')" class="py-3 ml-2">
                    <i class="bi bi-plus-circle text-xl mr-2"></i>
                    เพิ่มโต๊ะ
                </Button>
                <Button @click="showConfirmationDialog('delete')" class="py-3 ml-2">
                    <i class="bi bi-dash-circle text-xl mr-2"></i>
                    ลดโต๊ะ
                </Button>
            </div>

            <GridContainer class="mt-8">
                <!-- หมายเลขโต๊ะ -->
              <div v-for="(tableNumber, index) in tableNumbers" :key="index" class="relative">
                <GraphicsTable :tableNumber="tableNumber" :href="'/orders/table_' + tableNumber" />
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

  const tableNumbers = ref([]);
  const counter = ref(0);
  const showDialog = ref(false);
  const dialogHeaderMessage = ref("");
  const dialogMessage = ref("");
  const dialogAction = ref("");

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
        const table = $fetch("http://localhost/api/table/create", {
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
        const table = $fetch("http://localhost/api/table/delete", {
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

  const numberofTable = await $fetch(`http://localhost/api/table/count`);
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

// import { reactive } from 'vue';
//
// export default {
//     data() {
//         return {
//             tableNumbers: [],
//             counter: reactive({count:0}),
//
//             // Show dialog
//             showDialog: false,
//             dialogHeaderMessage: '',
//             dialogMessage: '',
//             dialogAction: '',
//         }
//     },
//     created() {
//         this.tableNumbers = this.tableNumbersGen(this.counter.count)
//     },
//     methods: {
//         showConfirmationDialog(action) {
//             this.showDialog = true;
//             this.dialogAction = action;
//             if (this.dialogAction === 'add') {
//                 this.dialogHeaderMessage = 'Add the table?'
//                 this.dialogMessage = 'คุณแน่ใจหรือไม่ว่าต้องการเพิ่มจำนวนโต๊ะ?'
//             } else if (this.dialogAction === 'delete') {
//                 this.dialogHeaderMessage = 'Remove the table?'
//                 this.dialogMessage = 'คุณแน่ใจหรือไม่ว่าต้องการลดจำนวนโต๊ะ?'
//             }
//         },
//         hideConfirmationDialog() {
//             this.showDialog = false;
//         },
//         handleDialogConfirm() {
//             if (this.dialogAction === 'add') {
//                 this.incrementTable();
//                 this.showDialog = false;
//                 console.log('Add');
//             } else if (this.dialogAction === 'delete') {
//                 this.decrementTable();
//                 this.showDialog = false;
//                 console.log('Delete');
//             }
//         },
//         tableNumbersGen(count) {
//             const tableNumbers = []
//             for(let i = 1; i<= count; i++) {
//                 tableNumbers.push(i);
//             }
//             return tableNumbers
//         },
//         incrementTable() {
//             this.hideConfirmationDialog()
//             this.counter.count++
//             this.tableNumbers.push(this.tableNumbers.length + 1)
//
//         },
//         decrementTable() {
//             if (this.tableNumbers.length > 0) {
//                 this.counter.count--
//                 this.tableNumbers.pop()
//             }
//         },
//     }
//
//
// }
</script>