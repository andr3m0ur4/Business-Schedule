<template>
  <q-layout view="lHh Lpr lFf">
    <q-page padding>
      <div class="wrapper">
        <section class="login-content">
          <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
              <div class="col-md-5 col-sm-12 col-12 align-self-center">
                <div class="card">
                  <div class="card-body text-center">
                    <img src="../assets/images/bs-icon-high.png" height="130" width="130">
                    <h2>Redefina sua senha</h2>
                    <p>Digite sua nova senha de login.</p>
                    <form id="reset-password" @submit.prevent="savePassword">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="floating-input form-group">
                            <input class="form-control" type="password" id="password" v-model="password"
                              required />
                            <label class="form-label" for="password">Senha</label>
                          </div>
                          <div class="floating-input form-group">
                            <input class="form-control" type="password" id="confirm-password" v-model="confirmPassword" required />
                            <label class="form-label" for="confirm-password">Confirme a senha</label>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Redefinir</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </q-page>
  </q-layout>
</template>

<script lang="ts">
import { useStore } from '../store';
import { CHANGE_PASSWORD, VERIFY_TOKEN } from '../store/action-types';
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'ConfirmPasswordPage',
  data() {
      return {
        password: '',
        confirmPassword: ''
      }
    },
    created() {
      this.verifyToken();
    },
    methods: {
      verifyToken() {
        this.store.dispatch(VERIFY_TOKEN, this.$route.params.token)
          .then(response => {
            if (response.data.error) {
              this.$router.push('/');
            }
          });
      },
      savePassword() {
        this.store.dispatch(CHANGE_PASSWORD, {
          password: this.password,
          confirmPassword: this.confirmPassword,
          token: this.$route.params.token
        })
          .then(response => {
            this.$swal('Sucesso', `${response.data.email} senha redefinida com sucesso`, 'success');
            this.$router.push('/');
          })
          .catch(error => {
            this.$swal('Ops...', error.response.data.message, 'error');
          })
      }
    },
    setup() {
      const store = useStore();

      return {
        store
      }
    }
  })
})
</script>
