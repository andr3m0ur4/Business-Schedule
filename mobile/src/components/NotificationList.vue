<template>
  <div class="card shadow-none m-0">
      <div class="card-body p-0 ">
        <div class="cust-title p-3">
            <h5 class="mb-0">Notificações</h5>
        </div>
        <div class="p-2">
            <a href="#" class="iq-sub-card">
            <div class="media align-items-center cust-card p-2">
                <div class="">
                <img class="avatar-40 rounded-small" src="../assets/images/user/u-1.jpg" alt="01">
                </div>
                <div class="media-body ml-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Igor Santos</h6>
                    <small class="mb-0">12 min atrás</small>
                </div>
                <small class="mb-0">Cinegráfista</small>
                </div>
            </div>
            </a>
            <a href="#" class="iq-sub-card">
            <div class="media align-items-center cust-card p-2">
                <div class="">
                <img class="avatar-40 rounded-small" src="../assets/images/user/u-2.jpg" alt="02">
                </div>
                <div class="media-body ml-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">Rodrigo Ramos</h6>
                    <small class="mb-0">25 min atrás</small>
                </div>
                <small class="mb-0">Animador 2D/3D</small>
                </div>
            </div>
            </a>
            <a href="#" class="iq-sub-card">
            <div class="media align-items-center cust-card p-2">
                <div class="">
                <img class="avatar-40 rounded-small" src="../assets/images/user/u-3.jpg" alt="03">
                </div>
                <div class="media-body ml-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0">André Moura</h6>
                    <small class="mb-0">30 min atrás</small>
                </div>
                <small class="mb-0">Operador de Audio</small>
                </div>
            </div>
            </a>
        </div>
        <a class="right-ic btn-block position-relative p-3 border-top text-center" href="#" role="button">
            Ver tudo
        </a>
      </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core"

export default defineComponent({
  name: 'NotificationList'
})
</script>

<style scoped>

</style>