<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText> บัญชีของคุณ </HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <!-- ข้อมูลส่วนตัว -->
      <div
        class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8"
        v-for="user in users"
      >
        <h1 class="text-2xl font-semibold text-red-600">ข้อมูลส่วนตัว</h1>

        <p class="mt-4">
          <span class="font-medium"> ชื่อลูกค้า : </span>
          {{ user.name }}
        </p>
        <p class="mt-4">
          <span class="font-medium"> วันที่สมัครสมาชิก : </span>
          {{ user.mem_date }}
        </p>
        <p class="mt-4">
          <span class="font-medium"> แต้มสะสม : </span>
          {{ user.points }}
        </p>
      </div>

      <!-- เปลี่ยนรหัสผ่าน -->
      <div
        class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8"
        v-for="user in users"
      >
        <h1 class="text-2xl font-semibold text-red-600">เปลี่ยนรหัสผ่าน</h1>
        <p class="mt-4">
          <span class="font-medium"> อีเมลล์ : </span>
          {{ user.email }}
        </p>
        <!-- password input field -->
        <!-- <label class="relative block mt-4">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <i class="bi bi-lock-fill text-2xl mr-2"></i>
                    </span>
                    <input class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base" placeholder="รหัสผ่านใหม่" type="password" name="password"/>
                </label> -->
                <InputField class="mt-4" placeholder="รหัสผ่านใหม่" type="password" name="password">
                    <template v-slot:icon>
                        <i class="bi bi-lock-fill text-2xl mr-2"></i> 
                    </template>
                </InputField>
                <!-- confirm password input field -->
                <InputField class="mt-4" placeholder="รหัสผ่านใหม่อีกครั้ง" type="password" name="confirm-password"/>

                <Button class="mt-4 p-3 text-lg">
                    ยืนยันการเปลี่ยนรหัสผ่าน
                </Button>

            </div>
        </ContentContainer>
        <hr>
        <!-- History table -->
        <Table :datas="tableData" :headers="tableHeaders" class="mt-8">
            <template v-slot:title>
                ประวัติการใช้บริการ
            </template>

        </Table>
    </MainContainer>
</template>

<script>
export default {
    data() {
        return {
            // customers or users detail
            users: [
                {
                    name: 'Prompan Uechanwech',
                    mem_date: '11/10/2023',
                    points: '125',
                    email: 'username01@example.com',
                    password: '',
                }
            ],
            // add some datas to table
            tableHeaders: [
                'No.',
                'Price',
                'Date',
                'Used Points',
            ],
            // add table headers
            tableData: [
                ['1', '3750', '11/12/2023', '150'],
                ['2', '2250', '10/12/2023', '53'],
                ['3', '750', '9/12/2023', '250'],
                ['4', '1750', '1/12/2023', '10'],
                ['5', '4200', '28/11/2023', '55'],
            ],
        }
    },
}
</script>
