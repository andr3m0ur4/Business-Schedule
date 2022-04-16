<template>
  <div class="content-page color-light">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Estúdios</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addStudio">Cadastrar Novo</a>
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
                    <tr v-for="studio in studios" :key="studio.id">
                      <td>{{ studio.id }}</td>
                      <td>{{ studio.name }}</td>
                      <td>
                        <div class="d-flex align-items-center list-action justify-content-end">
                          <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                            <i class="lar la-eye"></i>
                          </a>
                          <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                            <div class="dropdown">
                              <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                              <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateStudio" @click="loadStudio(studio.id)">Editar</a>
                                <a class="dropdown-item" href="#" @click="deleteStudio(studio.id, studio.name)">Excluir</a>
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

    <StudioModal
      id-modal="addStudio"
      title="Cadastrar Estúdio"
      :event="saveStudio"
      v-model:name="studio.name"
    />
    <StudioModal
      id-modal="updateStudio"
      title="Alterar Estúdio"
      :event="updateStudio"
      v-model:id="studio.id"
      v-model:name="studio.name"
    />
  </div>
</template>

<script>
import StudioModal from '@/components/StudioModal.vue'
import axios from '@/axios'

export default {
  name: 'StudioView',
  data() {
    return {
      studios: [],
      studio: {
        name: null
      }
    }
  },
  created() {
    this.getStudios()
  },
  updated() {
    $('.data-tables').DataTable()
  },
  methods: {
    getStudios() {
      axios.get('v1/studios')
        .then(response => {
          this.studios = response.data
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
    saveStudio() {
      if (!$('#addStudio form').get(0).reportValidity()) {
        return false
      }

      axios.post('v1/studios', this.studio)
        .then(response => {
          $('#addStudio').modal('hide')
          this.$swal('Sucesso', `${response.data.name} cadastrado com sucesso!`, 'success')
          this.getStudios()
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
    loadStudio(id) {
      axios.get(`v1/studios/${id}`)
        .then(response => {
          this.studio = response.data
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    updateStudio(id) {
      if (!$('#updateStudio form').get(0).reportValidity()) {
        return false
      }

      axios.put(`v1/studios/${id}`, {
        name: this.studio.name
      })
        .then(response => {
          $('#updateStudio').modal('hide')
          this.$swal('Sucesso', `${response.data.name} atualizado com sucesso!`, 'success')
          this.getStudios()
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    deleteStudio(id, name) {
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
            axios.delete(`v1/studios/${id}`)
              .then(response => {
                this.$swal(
                  'Excluído!',
                  `${response.data.name} foi excluído.`,
                  'success'
                )
                this.getStudios()
              })
              .catch(error => {
                this.$swal('Ops...', error.response.data.message, 'error')
              })
          }
        })
    }
  },
  components: {
    StudioModal
  }
}
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>