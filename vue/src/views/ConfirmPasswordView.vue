<template>
          <div class="wrapper">
      <section class="login-content">
         <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
               <div class="col-md-5 col-sm-12 col-12 align-self-center">
                  <div class="card">
                     <div class="card-body text-center">
                        <h2>Redefina sua senha</h2>
                        <p>Digite sua nova senha de login.</p>
                        <form>
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="mail" name="mail" id="mail" v-model="mail" required />
                                    <label class="form-label" for="mail">Senha</label>
                                 </div>
                                 <div class="floating-input form-group">
                                    <input class="form-control" type="mail" name="mail" id="mail" v-model="mail" required />
                                    <label class="form-label" for="mail">Confirme a senha</label>
                                 </div>
                              </div>
                           </div>
                           <button type="button" class="btn btn-primary">Redefinir</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      </div>
</template>