<template>
    <MainContainer>
        <HeaderContainer>
            <HeaderText>
                บัญชีของคุณ
            </HeaderText>
        </HeaderContainer>
        <hr>
        <ContentContainer>
            <div class="w-2/3 p-4 text-xl font-light" v-for="user in users">

                <h1 class="text-2xl font-semibold text-red-600">ข้อมูลส่วนตัว</h1>

                <p class="mt-4">
                    <span class="font-medium">
                        ชื่อลูกค้า :
                    </span> 
                    {{ user.name }}
                </p>
                <p class="mt-4">
                    <span class="font-medium">
                        วันที่สมัครสมาชิก :
                    </span> 
                    {{ user.mem_date }}
                </p>
                <p class="mt-4">
                    <span class="font-medium">
                        แต้มสะสม : 
                    </span> 
                    {{ user.points }}
                </p>
            </div>

            <div class="w-2/3 p-4 text-xl font-light" v-for="user in users">

                <h1 class="text-2xl font-semibold text-red-600">เปลี่ยนรหัสผ่าน</h1>
                <p class="mt-4">
                    <span class="font-medium">
                        อีเมลล์ :
                    </span> 
                    {{ user.email }}
                </p>
                <label class="relative block mt-4">
                    <span class="sr-only">Search</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <i class="bi bi-lock-fill text-2xl mr-2"></i>
                    </span>
                    <input class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base" placeholder="รหัสผ่านใหม่" type="password" name="password"/>
                </label>
                <label class="relative block mt-4">
                    <span class="sr-only">Search</span>
                    <input class="placeholder:text-slate-400 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3 shadow-sm focus:outline-none focus:border-red-600 focus:ring-red-600 focus:ring-1 sm:text-base" placeholder="รหัสผ่านใหม่อีกครั้ง" type="password" name="password"/>
                </label>
            </div>
        </ContentContainer>
        <hr>
        <Table :datas="datas" class="mt-8">
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
            users: [
                {
                    name: 'Prompan Uechanwech',
                    mem_date: '11/10/2023',
                    points: '125',
                    email: 'username01@example.com',
                    password: '',
                }
            ],
            datas: [
                {
                    title: 'No.',
                    info: '1',
                },
                {
                    title: 'Price',
                    info: '1750'
                },
                {
                    title: 'Date',
                    info: '11/12/2023'
                },
                {
                    title: 'Used Points',
                    info: '150'
                }
            ]
        }
    }
}
</script>