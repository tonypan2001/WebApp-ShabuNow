<template>
  <MainContainer>
    <HeaderContainer>
      <HeaderText>รายละเอียดเมนู</HeaderText>
    </HeaderContainer>
    <hr />
    <ContentContainer>
      <!-- เปลี่ยนรหัสผ่าน -->
      <div class="w-2/3 p-4 text-xl font-light border rounded-xl mt-8">
        <h1 class="text-2xl font-semibold text-red-600">แก้ไขรายละเอียดเมนู</h1>
        <InputField
          placeholder="ชื่อเมนู"
          type="text"
          name="confirm-password"
          value="5"
        />
        <InputField
          placeholder="ราคา (THB)"
          type="number"
          name="confirm-password"
        />
        <label
          for="countries"
          class="block mb-2 text-sm font-medium text-gray-900"
        ></label>
        <select
          id="countries"
          class="text-sm text-slate-400 focus:ring-blue-500 focus:border-blue-500 p-2.5 block bg-white border border-slate-300 rounded-md w-full py-3 pl-9 pr-3"
        >
          <option selected>เลือกหมวดหมู่</option>
          <option value="US">อาหาร</option>
          <option value="CA">เครื่องดื่ม</option>
          <option value="FR">ของหวาน</option>
        </select>

        <textarea
          id="message"
          rows="4"
          class="mt-4 block p-2.5 w-full text-sm text-slate-400 bg-white border border-slate-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
          placeholder="คำอธิบายเพิ่มเติม"
        ></textarea>
        <div class="mx-auto mt-2">
          <label
            for="example1"
            class="mb-1 block text-sm font-medium text-gray-700"
            >อัพโหลดรูปภาพ</label
          >
          <input
            id="example1"
            type="file"
            class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-slate-700 file:py-2 file:px-4 file:text-sm file:font-semibold file:text-white hover:file:bg-slate-900 focus:outline-none disabled:pointer-events-none disabled:opacity-60"
          />
        </div>
        <div class="mt-4 justify-center items-center flex">
          <Button>
            <slot name="button">ยืนยัน</slot>
          </Button>
        </div>
      </div>
    </ContentContainer>
  </MainContainer>
</template>
