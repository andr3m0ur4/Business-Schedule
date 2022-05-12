<template>
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
                        <form id="reset-password">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="password" name="password" id="password" v-model="password" required />
                                    <label class="form-label" for="password">Senha</label>
                                 </div>
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" v-model="password_confirmation" required />
                                    <label class="form-label" for="password_confirmation">Confirme a senha</label>
                                 </div>
                              </div>
                           </div>
                           <button type="button" class="btn btn-primary" @click="savePassword()">Redefinir</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'password_confirmationView',
  data() {
    return {
      password: null,
      password_confirmation: null
    }
  },
  created() {
    this.verifyToken();
  },
  methods: {
     verifyToken(){
      axios.get('verify-password',{
         params: {token: this.$route.params.token}
      })
        .then(response => {
         if (response.data.error) {
            this.$router.push('/')
         }
        })
     },
     savePassword() {
        if (!$('#reset-password').get(0).reportValidity()) {
          return false;
        }

        axios.post('change-password', {
        password: this.password,
        password_confirmation: this.password_confirmation,
        token: this.$route.params.token

      })
        .then(response => {
          this.$swal('Sucesso', `${response.data.usuario} senha redefinida com sucesso`, 'success')
          this.$router.push('/')
        })
        .catch(error => {
         this.$swal('Ops...', error.response.data.message, 'error')
        })
     }
  }
}

</script>
