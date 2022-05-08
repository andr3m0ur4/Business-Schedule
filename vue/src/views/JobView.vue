<template>
  <div class="content-page color-light">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Funções</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addJob">Adicionar Novo</a>
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
                    <tr v-for="job in jobs" :key="job.id">
                      <td>{{ job.id }}</td>
                      <td>{{ job.name }}</td>
                      <td>
                        <div class="d-flex align-items-center list-action justify-content-end">
                          <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                            <i class="lar la-eye"></i>
                          </a>
                          <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                            <div class="dropdown">
                              <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                              <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateJob" @click="loadJob(job.id)">Editar</a>
                                <a class="dropdown-item" href="#" @click="deleteJob(job.id, job.name)">Excluir</a>
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

    <JobModal
      id-modal="addJob"
      title="Cadastrar Função"
      :event="saveJob"
      v-model:name="job.name"
    />
    <JobModal
      id-modal="updateJob"
      title="Alterar Função"
      :event="updateJob"
      v-model:id="job.id"
      v-model:name="job.name"
    />
  </div>
</template>

<script>
import JobModal from '@/components/JobModal.vue'
import axios from '@/axios'

export default {
  name: 'JobView',
  data() {
    return {
      jobs: [],
      job: {
        name: null
        //description: null,
        //file : null
      }
    }
  },
  created() {
    this.getJobs()
  },
  updated() {
    $('.data-tables').DataTable()
  },
  methods: {
    getJobs() {
      axios.get('v1/jobs')
        .then(response => {
          this.jobs = response.data
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
    saveJob() {
      axios.post('v1/jobs', {
        name: this.job.name
        //description: this.tvShow.description,
        //file : this.tvShow.file
      })
        .then(response => {
          $('#addJob').modal('hide')
          $('#addJob form').trigger('reset')
          this.$swal('Sucesso', `${response.data.name} cadastrado com sucesso!`, 'success')
          this.getJobs()
        })
        .catch(error => {
          if (error.response.status == 401) {
            $('#addJob').modal('hide')
            this.$store.commit('logout')
            this.$router.push({
              name: 'sign-in'
            })
          } else {
            this.$swal('Ops...', error.response.data.message, 'error')
          }
        })
    },
    loadJob(id) {
      axios.get(`v1/jobs/${id}`)
        .then(response => {
          this.job = response.data
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    updateJob(id) {
      axios.put(`v1/jobs/${id}`, {
        name: this.job.name
      })
        .then(response => {
          $('#updateJob').modal('hide')
          this.$swal('Sucesso', `${response.data.name} atualizado com sucesso!`, 'success')
          this.getJobs()
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    deleteJob(id, name) {
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
            axios.delete(`v1/jobs/${id}`)
              .then(response => {
                this.$swal(
                  'Excluído!',
                  `${response.data.name} foi excluído.`,
                  'success'
                )
                this.getJobs()
              })
              .catch(error => {
                this.$swal('Ops...', error.response.data.message, 'error')
              })
          }
        })
    }
  },
  components: {
    JobModal
  }
}
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>