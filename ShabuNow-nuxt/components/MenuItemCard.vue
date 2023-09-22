<template>
  <div
    class="border border-red-600 rounded-xl shadow-lg w-72 h-auto mt-4 p-4 flex flex-col justify-center items-center"
  >
    <img
      class="rounded-xl object-cover h-[256px] w-full"
      :src="imageUrl || ''"
      alt=""
    />
    <div class="flex flex-col mt-4 justify-center items-center w-full">
      <p class="mt-2 text-2xl">
        <slot name="title"> Default title </slot>
      </p>
      <p class="mt-2 text-xl font-light">
        <slot name="price"> Default price </slot>
      </p>

      <Button class="mt-2 w-full">
        <i class="bi bi-plus-lg mr-1"></i>
        <slot name="button"> Defaut button text </slot>
      </Button>
    </div>
  </div>
</template>

<script>
import Button from "./Button.vue";

export default {
  props: {
    imageUrl: String,
  },
};
</script>
