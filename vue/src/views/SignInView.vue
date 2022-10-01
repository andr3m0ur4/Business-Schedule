<template>
  <div>
    <div class="wrapper">
      <section class="login-content">
        <div class="container h-100">
          <div class="row justify-content-center align-items-center height-self-center">
            <div class="col-md-5 col-sm-12 col-12 align-self-center">
              <div class="card">
                <div class="card-body text-center">
                  <img src="../assets/images/bs-icon-high.png" height="130" width="130">
                  <h2>Entrar</h2>
                  <p>Faça Login para acessar o sistema.</p>
                  <form @submit.prevent="login">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="floating-input form-group">
                          <input class="form-control" type="text" name="email" id="email" v-model="user.email"
                            required />
                          <label class="form-label" for="email">E-mail</label>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="floating-input form-group">
                          <input class="form-control" type="password" name="password" id="password"
                            v-model="user.password" required />
                          <label class="form-label" for="password">Senha</label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="custom-control custom-checkbox mb-3 text-left">
                          <input type="checkbox" class="custom-control-input" id="customCheck1">
                          <label class="custom-control-label" for="customCheck1">Lembrar de mim</label>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <router-link to="/esqueceu-senha" class="text-primary float-right">Esqueceu a Senha?
                        </router-link>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script lang="ts">
import type IUser from "../interfaces/IUser";
import { LOGIN } from "../store/action-types";
import { defineComponent } from "@vue/runtime-core";
import { useStore } from "../store";

export default defineComponent({
  name: 'SignInView',
  data() {
    return {
      user: {
        remember: true
      } as IUser
    }
  },
  methods: {
    login() {
      this.store.dispatch(LOGIN, this.user)
        .then(() => {
          this.$router.push('/');
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

<style scoped>

</style>
