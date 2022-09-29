<template>
  <div class="content-page">
    <div class="content-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-block p-card">
              <div class="profile-box">
                <div class="profile-card rounded">
                  <img src="../assets/images/user/12.jpg" alt="profile-bg"
                    class="avatar-100 rounded d-block mx-auto img-fluid mb-3">
                  <h3 class="font-600 text-white text-center mb-0">André Moura</h3>
                  <p class="text-white text-center mb-5">Operador de Aúdio</p>
                </div>
                <div class="pro-content rounded">
                  <div class="d-flex align-items-center mb-3">
                    <div class="p-icon mr-3">
                      <i class="las la-envelope-open-text"></i>
                    </div>
                    <p class="mb-0 eml">andre@contato.com</p>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                    <div class="p-icon mr-3">
                      <i class="las la-phone"></i>
                    </div>
                    <p class="mb-0">(12) 99999-9999</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card card-block mb-3">
              <div class="card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title mb-0">Histórico na empresa</h4>
                </div>
              </div>
              <div class="card-body">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard
                  dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                  make a type specimen
                  book. It has survived not only five centuries, but also the leap into electronic typesetting,
                  remaining essentially
                  unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                  passages, and more
                  recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <h5 class="mb-2">Programas trabalhados</h5>
                <ul class="list-unstyled mb-0">
                  <li class="mb-3"><i class="fa fa-check-circle text-primary fa-lg mr-2"></i>Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.</li>
                  <li class="mb-3"><i class="fa fa-check-circle text-primary fa-lg mr-2"></i>Aliquam ultrices tellus in
                    auctor blandit.</li>
                  <li class="mb-3"><i class="fa fa-check-circle text-primary fa-lg mr-2"></i>Etiam tincidunt erat non
                    ante sagittis bibendum.</li>
                  <li class="mb-3"><i class="fa fa-check-circle text-primary fa-lg mr-2"></i>Nunc malesuada massa ut
                    nisl sollicitudin semper.</li>
                  <li><i class="fa fa-check-circle text-primary fa-lg mr-2"></i>Fusce et arcu in dui feugiat finibus.
                  </li>
                </ul>
                <h5 class="mb-2 mt-4">Horas extra</h5>
                <div class="iq-progress-bar-linear d-inline-block w-100 mb-3">
                  <span>Janeiro</span>
                  <span class="float-right">90%</span>
                  <div class="iq-progress-bar pro-skill">
                    <span data-percent="90"></span>
                  </div>
                </div>
                <div class="iq-progress-bar-linear d-inline-block w-100 mb-3">
                  <span>Fevereiro</span>
                  <span class="float-right">85%</span>
                  <div class="iq-progress-bar pro-skill">
                    <span data-percent="85" class="bg1"></span>
                  </div>
                </div>
                <div class="iq-progress-bar-linear d-inline-block w-100 mb-3">
                  <span>Março</span>
                  <span class="float-right">70%</span>
                  <div class="iq-progress-bar pro-skill">
                    <span data-percent="70" class="bg2"></span>
                  </div>
                </div>
                <div class="iq-progress-bar-linear d-inline-block w-100">
                  <span>Abril</span>
                  <span class="float-right">55%</span>
                  <div class="iq-progress-bar pro-skill">
                    <span data-percent="55" class="bg3"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
  name: 'ProfileView'
})
</script>

<style scoped>
  .profile-box {
    padding-bottom: 150px;
  }
</style>
