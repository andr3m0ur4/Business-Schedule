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
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSwitcher">Cadastrar Novo</a>
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
                    <tr v-for="switcher in switchers" :key="switcher.id">
                      <td>{{ switcher.id }}</td>
                      <td>{{ switcher.name }}</td>
                      <td>
                        <div class="d-flex align-items-center list-action justify-content-end">
                          <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                            <i class="lar la-eye"></i>
                          </a>
                          <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                            <div class="dropdown">
                              <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                              <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateSwitcher" @click="loadSwitcher(switcher.id)">Editar</a>
                                <a class="dropdown-item" href="#" @click="deleteSwitcher(switcher.id, switcher.name)">Excluir</a>
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

    <SwitcherModal
      id-modal="addSwitcher"
      title="Cadastrar Switcher"
      :event="saveSwitcher"
      v-model:name="switcher.name"
    />
    <SwitcherModal
      id-modal="updateSwitcher"
      title="Alterar Switcher"
      :event="updateSwitcher"
      v-model:id="switcher.id"
      v-model:name="switcher.name"
    />
  </div>
</template>

<script>
import SwitcherModal from '@/components/SwitcherModal.vue'
import axios from '@/axios'

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
          if (error.response.status == 401) {
            this.$store.commit('logout')
            this.$router.push({
              name: 'sign-in'
            })
          }
        })
    },
    saveSwitcher() {
      axios.post('v1/switcher', {
        name: this.switcher.name
      })
        .then(response => {
          $('#addSwitcher').modal('hide')
          this.$swal('Sucesso', `${response.data.name} cadastrado com sucesso!`, 'success')
          this.getSwitchers()
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
    loadSwitcher(id) {
      axios.get(`v1/switcher/${id}`)
        .then(response => {
          this.switcher = response.data
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    updateSwitcher(id) {
      axios.put(`v1/switcher/${id}`, {
        name: this.switcher.name
      })
        .then(response => {
          $('#updateSwitcher').modal('hide')
          this.$swal('Sucesso', `${response.data.name} atualizado com sucesso!`, 'success')
          this.getSwitchers()
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    deleteSwitcher(id, name) {
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
            axios.delete(`v1/switcher/${id}`)
              .then(response => {
                this.$swal(
                  'Excluído!',
                  `${response.data.name} foi excluído.`,
                  'success'
                )
                this.getSwitchers()
              })
              .catch(error => {
                this.$swal('Ops...', error.response.data.message, 'error')
              })
          }
        })
    }
  },
  components: {
    SwitcherModal
  }
}
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>