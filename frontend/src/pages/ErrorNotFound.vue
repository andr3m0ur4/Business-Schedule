<template>
  <div class="wrapper">
    <div class="container">
      <div class="row no-gutters height-self-center">
        <div class="col-sm-12 text-center align-self-center">
          <div class="iq-error position-relative">
            <img src="../assets/images/error/404.png" class="img-fluid iq-error-img" alt="">
            <h2 class="mb-0 mt-4">Oops! Essa página não existe.</h2>
            <p>A página solicitada não existe.</p>
            <router-link class="btn btn-primary d-inline-flex align-items-center mt-3" to="/"><i class="ri-home-4-line"></i>Voltar ao início</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'ErrorNotFound'
});
</script>
