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
                        <h1 class="text-xl mt-2 underline">รายละเอียดเมนู</h1>
                        <p class="my-4 text-lg text-gray-800">
                            He oppose at thrown desire of no. Announcing impression unaffected day his are unreserved indulgence. Him hard find read are you sang. Parlors visited noisier how explain pleased his see suppose. Do ashamed assured on related offence at equally totally.
                        </p>
                    </div>
                </div>
            </div>
            <!-- status menu option for chef role -->
            <div class="px-4 lg:px-8 py-4 w-2/3">
                <div class="flex flex-col justify-start items-start text-lg">
                    <h1 class="text-xl lg:text-2xl text-red-600">ปรับเปลี่ยนสถานะของเมนู</h1>
                    <select
                    class="mt-4 text-base focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
                    >
                      <option value="available">พร้อมเสิร์ฟ</option>
                      <option value="canceled">ยกเลิกชั่วคราว</option>
                    </select>
                    <Button class="mt-4 w-full">
                        ยืนยันเปลี่ยนสถานะ
                    </Button>
                </div>
            </div>
            <!-- end chef -->
        </div>
    </ContentContainer>
</MainContainer>
</template>