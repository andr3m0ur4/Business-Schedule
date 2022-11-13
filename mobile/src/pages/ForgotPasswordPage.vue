<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <q-page padding>
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
                              <input class="form-control" type="email" id="email" v-model="email" required />
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
      </q-page>
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import { useStore } from '../store';
import { SEND_MAIL } from '../store/action-types';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'ForgotPasswordPage',
  data() {
      return {
        email: ''
      }
    },
    methods: {
      sendMail() {
        this.store.dispatch(SEND_MAIL, this.email)
          .then(response => {
            this.$swal('Sucesso', `E-mail enviado para ${response.data.email}`, 'success');
            this.$router.push('/entrar');
          })
          .catch(error => {
            this.$swal('Erro', error.response.data.message, 'error');
          });
      }
    },
    setup() {
      const store = useStore();

      return {
        store
      }
    }
})
</script>
