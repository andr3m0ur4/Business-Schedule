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

      <AppHeader />

      <router-view></router-view>
    </div>

    <ModalShareYourLink />
    <AppFooter />

    <!-- Backend Bundle JavaScript -->
    <!-- <script type="application/javascript" src="../assets/js/backend-bundle.min.js"></script> -->

    <!-- Chart Custom JavaScript -->
    <!-- <script src="../assets/js/customizer.js"></script> -->

    <!-- app JavaScript -->
    <!-- <script src="../assets/js/app.js"></script> -->
  </div>
</template>

<script>
import AppHeader from '@/components/AppHeader.vue'
import ModalShareYourLink from '@/components/ModalShareYourLink.vue'
import AppFooter from '@/components/AppFooter.vue'

export default {
  name: 'DefaultLayout',
  components: {
    AppHeader,
    ModalShareYourLink,
    AppFooter
  }
}
</script>

<style scoped>

</style>