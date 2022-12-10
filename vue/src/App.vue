<template>
  <RouterView />
</template>

<script lang="ts">
  import { defineComponent } from 'vue';

  export default defineComponent({
    name: 'App',
    mounted() {
      document.title = 'Business Schedule';
    }
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
