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
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addStudio">Add New</a>
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
                            <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                href="#"><i class="lar la-eye"></i></a>
                            <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                                <div class="dropdown">
                                  <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button"
                                      aria-expanded="false">
                                  </div>
                                  <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                      <a class="dropdown-item" href="#">Edit</a>
                                      <a class="dropdown-item" href="#">Delete</a>
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
  </div>

  <StudioModal title="Cadastrar Estúdio" :event="saveStudio" @studio="getName" />
</template>

<script>
import StudioModal from '@/components/StudioModal.vue'

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
      axios.post('v1/studios', {
        name: this.studio.name
      })
        .then(() => {
          $('#addStudio').modal('hide')
          this.$swal('Sucesso', 'Estúdio cadastrado com sucesso!', 'success')
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
    getName(name) {
      this.studio.name = name
    }
  },
  components: {
    StudioModal
  }
}

$(() => {
  $('#addStudio').on('shown.bs.modal', function() {
    $('#sname').focus()
  })
})
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>