<template>
  <div class="content-page color-light">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Programas</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTvShow">Adicionar Programa</a>
            </div>
            <div class="card-body">
              <div class="table-responsive data-table">
                <table class="data-tables table" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="tvShow in tvShows" :key="tvShow.id">
                      <td>{{ tvShow.id }}</td>
                      <td>{{ tvShow.name }}</td>
                      <td>
                        <div class="d-flex align-items-center list-action justify-content-end">
                          <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                            <i class="lar la-eye"></i>
                          </a>
                          <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                            <div class="dropdown">
                              <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                              <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateTvShow" @click="loadTvShow(tvShow.id)">Editar</a>
                                <a class="dropdown-item" href="#" @click="deleteTvShow(tvShow.id, tvShow.name)">Excluir</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <TvShowModal
      id-modal="addTvShow"
      title="Cadastrar Programa"
      :event="saveTvShow"
      v-model:name="tvShow.name"
    />
    <TvShowModal
      id-modal="updateTvShow"
      title="Alterar Programa"
      :event="updateTvShow"
      v-model:id="tvShow.id"
      v-model:name="tvShow.name"
    />
  </div>
</template>

<script>
import TvShowModal from '@/components/TvShowModal.vue'
import axios from '@/axios'

export default {
  name: 'TvShowView',
  data() {
    return {
      tvShows: [],
      tvShow: {
        name: null
        //description: null,
        //file : null
      }
    }
  },
  created() {
    this.getTvShows()
  },
  updated() {
    $('.data-tables').DataTable()
  },
  methods: {
    getTvShows() {
      axios.get('v1/tv-shows')
        .then(response => {
          this.tvShows = response.data
          $('.data-tables').DataTable().destroy()
        })
        .catch(error => {
          if (error.response.status == 401) {
            this.$store.commit('logout')
            this.$router.push({
              name: 'sign-in'
            })
          }
        })
    },
    saveTvShow() {
      axios.post('v1/tv-shows', {
        name: this.tvShow.name
        //description: this.tvShow.description,
        //file : this.tvShow.file
      })
        .then(response => {
          $('#addTvShow').modal('hide');
          $('#form-wizard').trigger('reset');
          this.$swal('Sucesso', `${response.data.name} cadastrado com sucesso!`, 'success');
          this.getTvShows();
        })
        .catch(error => {
          if (error.response.status == 401) {
            this.$store.commit('logout')
            this.$router.push({
              name: 'sign-in'
            })
          } else {
            this.$swal('Ops...', error.response.data.message, 'error')
          }
        })
    },
    loadTvShow(id) {
      axios.get(`v1/tv-shows/${id}`)
        .then(response => {
          this.tvShow = response.data
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    updateTvShow(id) {
      axios.put(`v1/tv-shows/${id}`, {
        name: this.tvShow.name
      })
        .then(response => {
          $('#updateTvShow').modal('hide')
          $('#form-wizard').trigger('reset');
          this.$swal('Sucesso', `${response.data.name} atualizado com sucesso!`, 'success')
          this.getTvShows()
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    deleteTvShow(id, name) {
      this.$swal({
        title: 'Você tem certeza?',
        text: `Deseja excluir ${name}? Não é possível reverter essa ação!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!'
      })
        .then(result => {
          if (result.isConfirmed) {
            axios.delete(`v1/tv-shows/${id}`)
              .then(response => {
                this.$swal(
                  'Excluído!',
                  `${response.data.name} foi excluído.`,
                  'success'
                )
                this.getTvShows()
              })
              .catch(error => {
                this.$swal('Ops...', error.response.data.message, 'error')
              })
          }
        })
    }
  },
  components: {
    TvShowModal
  }
}
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>
