<template>
  <MainContainer>
    <HeaderContainer>
     <HeaderText>
        เมนูใหม่ยอดนิยม
     </HeaderText>
    </HeaderContainer>
      <ContentContainer>
        <section class="lg:flex justify-center items-center py-4 gap-x-8 max-w-[1100px]">
        <div class="border-2 border-red-500 mt-8 rounded-lg overflow-hidden max-w-[700px]">
          <div>
            <img width="700" height="400" class="object-cover w-[700px] h-[400px]"
                src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&q=80&w=2281&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
          </div>
          <div>
            <h1 class="text-3xl text-gray-600 font-medium ml-6 mt-4">พิซซ่าหน้าคลาสสิก อร่อย คุ้ม เครื่องเยอะ!</h1>
            <p class="text-xl text-gray-600 font-light mx-6 my-4 pb-4 border-b">
              พิซซ่าสุดคลาสสิกแป้งหนานุ่ม หรือจะเอาบางกรอบก็เลือกได้ พร้อมกับท็อปปิ้งที่เพิ่มให้ไม่ยั้งมือ ที่ลูกค้าหลายคนบอกว่าเมนูนี้คุ้มจริง ๆ
            </p>
            <div class="flex justify-center w-full mb-6">
            <NuxtLink to="/">
              <Button>
                <p class="text-xl px-4">
                เลือกดูเมนู ->
                </p>
              </Button>
            </NuxtLink>
            </div>
          </div>
        </div>
        <div class="border-2 border-red-500 mt-8 rounded-lg overflow-hidden max-w-[700px]">
          <div>
            <img width="700" height="400" class="object-cover w-[700px] h-[400px]"
                 src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&q=80&w=2487&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
          </div>
          <div>
            <h1 class="text-3xl text-gray-600 font-medium ml-6 mt-4">พิซซ่าหน้าคลาสสิก อร่อย คุ้ม เครื่องเยอะ!</h1>
            <p class="text-xl text-gray-600 font-light mx-6 my-4 pb-4 border-b">
              พิซซ่าสุดคลาสสิกแป้งหนานุ่ม หรือจะเอาบางกรอบก็เลือกได้ พร้อมกับท็อปปิ้งที่เพิ่มให้ไม่ยั้งมือ ที่ลูกค้าหลายคนบอกว่าเมนูนี้คุ้มจริง ๆ
            </p>
            <div class="flex justify-center w-full mb-6">
              <NuxtLink to="/">
                <Button>
                  <p class="text-xl px-4">
                    เลือกดูเมนู ->
                  </p>
                </Button>
              </NuxtLink>
            </div>
          </div>
        </div>
        </section>

      </ContentContainer>
  </MainContainer>
  <footer>
    <div class="flex justify-around items-center bg-gray-700 h-[250px] w-full text-2xl text-gray-100">
      <div class="flex flex-col gap-y-4">
        <p>ติดต่อ: 081-321-1234</p>
        <div class="flex flex-col">
          <p>ติดตามได้ที่</p>
          <div class="flex gap-x-4 mt-2 text-3xl">
            <a href="#" class="hover:text-white">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="hover:text-white">
             <i class="bi bi-line"></i>
            </a>
            <a href="#" class="hover:text-white">
              <i class="bi bi-envelope-at-fill"></i>
            </a>
          </div>
        </div>
      </div>
      <div>
       <p>ดาวโหลดแอพพลิเคชั่นได้ที่</p>
        <div class="mt-2 text-3xl flex justify-center gap-x-4">
          <a href="#" class="hover:text-white">
            <i class="bi bi-google-play"></i>
          </a>
          <a href="#" class="hover:text-white">
            <i class="bi bi-apple"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>
<script setup lang="ts">
</script>