<template>

  <div class="wrapper">
    <section class="login-content">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center height-self-center">
          <div class="col-md-5 col-sm-12 col-12 align-self-center">
            <div class="card">
              <div class="card-body text-center">
                <img src="../assets/images/bs-icon-high.png" height="130" width="130">
                <h2>Redefina a senha</h2>
                <p>Digite seu endereço de e-mail e enviaremos um e-mail com instruções para redefinir sua senha.</p>
                <form>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="floating-input form-group">
                        <input class="form-control" type="email" name="email" id="email" v-model="email" required />
                        <label class="form-label" for="email">E-mail</label>
                      </div>
                    </div>
                  </div>
                  <button type="button" @click="sendMail" class="btn btn-primary">Redefinir</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</template>

<script lang="ts">
import { defineComponent } from "@vue/runtime-core";

  export default defineComponent({
    name: 'ForgotPasswordView',
    data() {
      return {
        email: ''
      }
    },
    methods: {
      sendMail() {}
    }
  })
</script>
