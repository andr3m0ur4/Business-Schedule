<template>
  <footer class="iq-footer">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="../backend/privacy-policy.html">Política de Privacidade</a></li>
            <li class="list-inline-item"><a href="../backend/terms-of-service.html">Termos de Uso</a></li>
          </ul>
        </div>
        <div class="col-lg-6 text-right">
          Copyright 2022 <a href="#">Calendify</a> All Rights Reserved.
        </div>
      </div>
    </div>
  </footer>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
  name: 'MainFooter'
})
</script>

<style scoped>

</style>
