<template>
  <div class="content-page">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Funcionários</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#registerEmployee">Adicionar Funcionário</a>
            </div>
            <div class="card-body">
              <div class="table-responsive data-table">
                <table class="data-tables table" style="width:100%">
                  <thead>
                    <tr>
                      <th>Perfil</th>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>N° Telefone</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                      <td>
                        <img src="../assets/images/user/04.jpg"  class="rounded avatar-40 img-fluid" alt="">
                      </td>
                      <td>{{ employee.name }}</td>
                      <td>{{ employee.email }}</td>
                      <td>{{ employee.phone }}</td>
                      <td>
                        <div class="d-flex align-items-center list-action">
                          <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                            <i class="lar la-eye"></i>
                          </a>
                          <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                            <div class="dropdown">
                              <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
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
    <div class="modal fade" id="registerEmployee" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left create-workform">
              <div class="card">
                <div class="card-body text-center">
                  <h2>Cadastro de Funcionário</h2>
                  <p>Cadastre um novo funcionário no sistema.</p>
                  <form @submit.prevent="saveEmployee">
                    <div class="row">
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <input class="form-control" type="text" id="name" v-model="employee.name" required />
                            <label class="form-label" for="name">Nome</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <select class="selectpicker form-control" title="Função" id="job" v-model="employee.job" data-style="py-0">
                              <option value="">Desenvolvedor</option>
                              <option value="">Cinegrafista</option>
                              <option value="">Diretor</option>
                            </select>
                          </div>
                      </div>
                      <div class="col-lg-12">
                          <div class="floating-input form-group">
                            <input class="form-control" type="email" id="email" v-model="employee.email" required />
                            <label class="form-label" for="email">E-mail</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <input class="form-control" type="password" id="password" v-model="employee.password" required />
                            <label class="form-label" for="password">Senha</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <input class="form-control" type="password" v-model="employee.password_confirmation" id="password1" required />
                            <label class="form-label" for="password1">Confirmar Senha</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <input class="form-control" type="phone" id="phone" v-model="employee.phone" required />
                            <label class="form-label" for="phone">Celular</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group">
                            <select class="selectpicker form-control" id="type" title="Privilégio" v-model="employee.type" data-style="py-0">
                              <option value="Admin">Administrador</option>
                              <option value="Employee">Funcionário</option>
                            </select>
                          </div>
                      </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                      <div class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</div>
                      <div class="btn btn-outline-primary" @click="saveEmployee">Salvar</div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'EmployeeView',
  data() {
    return {
      employees: [],
      employee: {}
    }
  },
  created() {
    this.getEmployees()
  },
  mounted() {
    $('.selectpicker').selectpicker()
  },
  updated() {
    $('.data-tables').DataTable()
  },
  methods: {
    getEmployees() {
      axios.get('v1/users')
        .then(response => {
          this.employees = response.data
        })
        .catch(error => {
          console.log(error.response);
        })
    },
    saveEmployee() {
      if (!$('#registerEmployee form').get(0).reportValidity()) {
        return false
      }

      axios.post('v1/users', this.employee)
        .then(response => {
          this.$swal('Sucesso', `${response.data.name} cadastrado com sucesso!`, 'success')
          $('#registerEmployee').modal('hide')
          $('#registerEmployee form').trigger('reset')
          this.getEmployees()
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
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
  #registerEmployee .card {
    margin-bottom: 0;
  }
</style>

<style>
  #registerEmployee .floating-input .form-control {
    height: auto;
    padding: 0;
  }
  #registerEmployee .bootstrap-select .dropdown-toggle:focus {
    outline: none !important;
  }
  #registerEmployee .bootstrap-select>.dropdown-toggle.bs-placeholder,
  #registerEmployee .bootstrap-select>.dropdown-toggle.bs-placeholder:focus {
    color: #535f6b;
  }
</style>