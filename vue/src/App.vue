<template>
  <RouterView />
</template>

<script lang="ts">
  import { defineComponent } from '@vue/runtime-core';
  import { RouterView } from 'vue-router';

  export default defineComponent({
    name: 'App'
  })
</script>

<style scoped>

</style>
