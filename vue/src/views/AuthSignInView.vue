<template>
  <div class="">
    <!-- loader Start -->
    <!-- <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->
    
    <div class="wrapper">
      <section class="login-content">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-md-5 col-sm-12 col-12 align-self-center">
                  <div class="card">
                     <div class="card-body text-center">
                        <h2>Entrar</h2>
                        <p>Faça Login para acessar o sistema.</p>
                        <form @submit.prevent="login($event)">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="text" name="email" id="email" v-model="email" required />
                                    <label class="form-label" for="email">E-mail</label>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="password" name="password" id="password" v-model="password" required />
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
                                 <a href="auth-recoverpw.html" class="text-primary float-right">Esqueceu a Senha?</a>
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

    <!-- Backend Bundle JavaScript -->
    <!-- <script src="../assets/js/backend-bundle.min.js"></script> -->

    <!-- Chart Custom JavaScript -->
    <!-- <script src="../assets/js/customizer.js"></script> -->

    <!-- app JavaScript -->
    <!-- <script src="../assets/js/app.js"></script> -->
  </div>
</template>

<script>
export default {
  name: 'AuthSignInView',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    login() {
      axios
        .post('login', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          if (response.data.token) {
            sessionStorage.setItem('token', response.data.token)
            window.location.href = '/'
          }
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.error, 'error')
        })
    }
  }
}
</script>

<style scoped>

</style>