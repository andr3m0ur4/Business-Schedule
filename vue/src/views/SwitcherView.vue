<template>
  <div class="content-page color-light">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Switchers</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSwitcher">Adiconar</a>
            </div>
            <div class="card-body">
              <div class="table-responsive data-table">
                <table class="data-tables table" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="switcher in switchers" :key="switcher.id">
                      <td>{{ switcher.id }}</td>
                      <td>{{ switcher.name }}</td>
                      <td>
                          <div class="d-flex align-items-center list-action">
                            <a class="badge bg-warning-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Rating"
                                href="#"><i class="far fa-star"></i></a>
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
                                      <a class="dropdown-item" href="#">Hide from Contacts</a>
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

  <!-- Modal -->
  <div class="modal fade" id="addSwitcher" tabindex="-1" role="dialog" aria-labelledby="addSwitcherLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSwitcherLabel">Cadastrar Switcher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-wizard" class="text-center" @submit.prevent="saveSwitcher()">
              <fieldset>
                <div class="form-card text-left">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="name">Nome: *</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="switcher.name" placeholder="Nome" required="required" />
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" @click="saveSwitcher()">Salvar</button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SwitcherView',
  data() {
    return {
      switchers: [],
      switcher: {
        name: null
      }
    }
  },
  created() {
    this.getSwitchers()
  },
  updated() {
    $('.data-tables').DataTable()
  },
  methods: {
    getSwitchers() {
      axios.get('v1/switcher')
        .then(response => {
          this.switchers = response.data
          $('.data-tables').DataTable().destroy()
        })
        .catch(error => {
          console.log(error);
        })
    },
    saveSwitcher() {
      axios.post('v1/switcher', {
        name: this.switcher.name
      })
        .then(() => {
          $('#addSwitcher').modal('hide')
          this.$swal('Sucesso', 'Switcher cadastrado com sucesso!', 'success')
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
    }
  }
}

$(() => {
  $('#addSwitcher').on('shown.bs.modal', function() {
    $('#name').focus()
  })
})
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>