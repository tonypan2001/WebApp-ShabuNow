<template>
<MainContainer>
    <HeaderContainer>
        <HeaderText>
            เมนู : Salad
        </HeaderText>
    </HeaderContainer>
    <hr>
    <ContentContainer>
        <div class="mt-4 w-full flex flex-row justify-center items-start mt-4">
            <div class="flex flex-col justify-between items-center w-2/3">
                <!-- <h1 class="my-4 text-4xl">Salad</h1> -->
                <div class="w-full flex flex-col justify-between items-center">
                    <img 
                    width="500"
                    height="500"
                    src="https://img.freepik.com/free-photo/delicious-vietnamese-food-including-pho-ga-noodles-spring-rolls-white-wall_181624-34158.jpg?w=1480&t=st=1694914784~exp=1694915384~hmac=28ce6696273496ac0f862aacccb0f3fcf9bb4b466ea118dc34c9bc3aaac883b0" 
                    alt="Salad"
                    class="rounded-lg object-cover">
                </div>
                <div class="border w-full">
                    <h1>Price</h1>
                    <h1>Menu Detail</h1>
                </div>
            </div>
            <div class="w-2/3 px-8 py-4">
                <div class="flex flex-col justify-start items-start text-lg">
                    <h1 class="text-2xl">โปรดเลือกปริมาณอาหาร</h1>
                    <select
                    class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
                    >
                      <option selected>โปรดเลือกปริมาณอาหาร</option>
                      <option value="food">ปริมาณ 100 g.</option>
                      <option value="drink">ปริมาณ 200 g.</option>
                      <option value="sweet">ปริมาณ 300 g.</option>
                    </select>
                </div>
                <div class="flex flex-col justify-start items-start text-lg mt-4">
                    <h1 class="text-2xl">เลือกท็อปปิ้ง</h1>
                    <select
                    class="mt-4 text-base text-slate-400 focus:ring-red-600 focus:border-red-600 focus:ring-1 focus:outline-none p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
                    >
                      <option selected>โปรดเลือกท็อปปิ้ง</option>
                      <option value="food">ข้่าวโพด</option>
                      <option value="drink">หัวหอม</option>
                      <option value="sweet">มันหวาน</option>
                    </select>
                </div>
                
            </div>
        </div>
    </ContentContainer>
</MainContainer>
</template>