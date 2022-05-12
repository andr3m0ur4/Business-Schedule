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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateEmployee" @click="$refs.employeeModal.loadEmployee(employee.id)">Edit</a>
                                <a class="dropdown-item" href="#" @click="deleteEmployee(employee.id, employee.name)">Delete</a>
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
                            <select class="selectpicker form-control" title="Função" id="job" v-model="employee.job_id" data-style="py-0">
                              <option v-for="job in jobs" :key="job.id" :value="job.id">{{ job.name }}</option>
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
                          <div class="floating-input form-group mb-0">
                            <input class="form-control" type="password" id="password" v-model="employee.password" required />
                            <label class="form-label" for="password">Senha</label>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="floating-input form-group mb-0">
                            <input class="form-control" type="password" v-model="employee.password_confirmation" id="password1" required />
                            <label class="form-label" for="password1">Confirmar Senha</label>
                          </div>
                      </div>
                      <div class="col-lg-12">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                          A senha deve conter no mínimo 8 caracteres, ser alfa-numérica, deve conter caracteres especiais e pelo menos 1 letra maiúscula.
                        </small>
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

    <EmployeeModal
      id-modal="updateEmployee"
      title="Alterar Funcionário"
      :refresh-table="getEmployees"
      ref="employeeModal"
    />
  </div>
</template>

<script>
import axios from '@/axios'
import EmployeeModal from '../components/EmployeeModal.vue'

export default {
  name: 'EmployeeView',
  data() {
    return {
      employees: [],
      jobs: [],
      employee: {},
      dataTable: null
    }
  },
  created() {
    this.getEmployees();
    this.getJobs();
  },
  mounted() {
    $('.selectpicker').selectpicker();
  },
  updated() {
    this.dataTable = $('.data-tables').DataTable(optionsTable);
    $('.selectpicker').selectpicker('refresh');
  },
  methods: {
    getEmployees() {
      axios.get('v1/users')
        .then(response => {
          this.employees = response.data
          if (this.dataTable) {
            this.dataTable.destroy();
          }
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
    getJobs() {
      axios.get('v1/jobs')
        .then(response => {
          this.jobs = response.data
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    },
    loadEmployee(id) {
      axios.get(`v1/users/${id}`)
        .then(response => {
          this.employee = response.data
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
          setTimeout(() => {
            $('#registerEmployee form').trigger('reset');
          }, 1000);
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
    },
    deleteEmployee(id, name) {
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
            axios.delete(`v1/users/${id}`)
              .then(response => {
                this.$swal(
                  'Excluído!',
                  `${response.data.name} foi excluído.`,
                  'success'
                )
                this.getEmployees()
              })
              .catch(error => {
                this.$swal('Ops...', error.response.data.message, 'error')
              })
          }
        })
    }
  },
  components: {
    EmployeeModal
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
