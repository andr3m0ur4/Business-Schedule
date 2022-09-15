<template>
  <div class="fixed-top-navbar top-nav">
    <!-- loader Start -->
    <!-- <div id="loading">
      <div id="loading-center">
      </div>
    </div> -->
    <!-- loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">

      <MainHeader />

      <RouterView />
    </div>

    <!-- <ModalShareYourLink /> -->
    <MainFooter />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";
import MainHeader from "./MainHeader.vue";
import MainFooter from "./MainFooter.vue";

export default defineComponent({
    name: "DefaultLayout",
    components: { MainHeader, MainFooter }
})
</script>

<style scoped>

</style>
