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
                                    <input class="form-control" type="mail" name="mail" id="mail" v-model="mail" required />
                                    <label class="form-label" for="mail">E-mail</label>
                                 </div>
                              </div>
                           </div>
                           <button type="button" @click="sendMail()" class="btn btn-primary">Redefinir</button>
                        </form>
                        {{mail}}
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
  name: 'ForgotPasswordView',
  data() {
    return {
      mail:null
    }
  },
  methods: {
   sendMail() {
      console.log(this.mail)
         axios.get('email/sendMail', {
         params: {mail: this.mail}
      })
         .then(response => {
            this.$swal('Sucesso', `E-mail enviado para ${response.data.email}`, 'success')
         })
         .catch(error => {

           console.log(error.response)
         })
      }
   }
}
</script>
