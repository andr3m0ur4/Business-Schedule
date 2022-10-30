<template>
  <RouterView />
</template>

<script lang="ts">
  import { defineComponent } from '@vue/runtime-core';

  export default defineComponent({
    name: 'App'
  })
</script>

<style>
.Vue-Toastification__container.top-left,
.Vue-Toastification__container.top-center,
.Vue-Toastification__container.top-right,
.Vue-Toastification__container.bottom-left,
.Vue-Toastification__container.bottom-center,
.Vue-Toastification__container.bottom-right {
  box-shadow: none;
}
</style>
