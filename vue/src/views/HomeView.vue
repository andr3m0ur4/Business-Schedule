<template>
  <main class="content-page">
    <div class="container">
      <div class="col-lg-12 mb-4">
          <div class="py-4 border-bottom">
            <div class="form-title text-center">
              <h3>Seja Bem Vindo!!</h3>
            </div>
          </div>
        </div>
    </div>
    <div class="container">
      <!-- Carrossel -->
      <section>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <img src="../assets/images/bs-icon-high.png" width="100" height="100" class="rounded-circle ml-2">
            </div>
            <div id="carouselExampleIndicators" class="carousel slide mt-3" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="Second slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">Esacalas  de trabalho</h5>
                <p class="card-text">Leia mais sobre como sua nova escala pode ser visualizada</p>
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Leia sobre
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis distinctio ipsam nisi neque architecto vitae enim. Culpa magni eaque molestias quasi, placeat accusamus voluptates ipsam in harum ab rerum doloremque!
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                2 dias atrás
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <img src="../assets/images/bs-icon-high.png" width="100" height="100" class="rounded-circle ml-2">
            </div>
            <div id="carouselExampleIndicators" class="carousel slide mt-3" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item" style="max-height: 600px;">
                        <img class="d-block w-100 h-100 img-fluid" src="../assets/images/escala-de-trabalho.jpg" alt="Second slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">Esacalas  de trabalho</h5>
                <p class="card-text">Leia mais sobre como sua nova escala pode ser visualizada</p>
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Leia sobre
                    </a>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis distinctio ipsam nisi neque architecto vitae enim. Culpa magni eaque molestias quasi, placeat accusamus voluptates ipsam in harum ab rerum doloremque!
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                2 dias atrás
            </div>
        </div>
    </div>


</section>
    </div>

    <!-- Modal -->
    <div class="modal fade create-workform" id="create-event" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">Create a Workflow</h4>
              <div class="mb-3">
                <h5>When this happens</h5>
                <div class="content">
                  <div class="form-group mb-0">
                    <select name="type" class="selectpicker form-control" data-style="py-0">
                      <option>Select..</option>
                      <option>New event is scheduled</option>
                      <option>Before event starts</option>
                      <option>Event starts</option>
                      <option>Event ends</option>
                      <option>Event is canceled</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <h5 class="mb-3">Do this</h5>
                <div class="form-group  mb-0">
                  <select name="type" class="selectpicker form-control" data-style="py-0">
                    <option>Select..</option>
                    <option>Send email to invitee</option>
                    <option>Send email to host</option>
                    <option>Send text to invitee</option>
                    <option>Send text to host</option>
                  </select>
                </div>
              </div>
              <div class="mt-3">
                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                  <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                  <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'HomeView',
})
</script>

<style scoped>

</style>
