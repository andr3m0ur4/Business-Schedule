<template>
    <div class="content-page color-light">
      <div class="container-fluid container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-block card-stretch card-height">
              <div class="card-header d-flex justify-content-between">
                <div class="iq-header-title">
                  <h4 class="card-title mb-0">Funcionários</h4>
                </div>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addEmployee">Adicionar Funcionários</a>
              </div>
              <div class="card-body">
                <div class="table-responsive data-table">
                  <table class="data-tables table" style="width:100%" ref="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Função</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in Employees" :key="employee.id">
                        <td>{{ employee.id }}</td>
                        <td>{{ employee.name }}</td>
                        <td>{{ employee.email }}</td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.job_id }}</td>
                        <td>
                          <div class="d-flex align-items-center list-action justify-content-end">
                            <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                              <i class="lar la-eye"></i>
                            </a>
                            <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                              <div class="dropdown">
                                <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                                <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateEmployee" @click="loadEmployee(employee)">Editar</a>
                                  <a class="dropdown-item" href="#" @click="deleteEmployee(employee.id, employee.name)">Excluir</a>
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
  
      <ModalEmployee :id="'addEmployee'" @onHide="clearEmployee">
        <template v-slot:header>
          <h5 class="modal-title" id="addEmployeeLabel">Cadastrar Funcionário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="saveEmployee">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome:</label>
                      <input type="text" class="form-control" name="name" v-model="employee.name"
                        placeholder="Nome" required="true" />
                      <label class="mt-2" for="email">Email:</label>
                      <input type="text" class="form-control" name="email" v-model="employee.email"
                        placeholder="Email" required="true" />
                      <label class="mt-2" for="numero">Número:</label>
                      <input type="text" class="form-control" name="phone" v-model="employee.phone"
                        placeholder="Número" required="true" />
                      <label class="mt-2" for="funcao">Função:</label>
                      <input type="text" class="form-control" name="job" v-model="employee.job_id"
                        placeholder="Função" required="true" />
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </template>
        <template v-slot:footer>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="saveEmployee">Salvar</button>
        </template>
      </ModalEmployee>
  
      <ModalEmployee :id="'updateEmployee'" @onHide="clearEmployee">
        <template v-slot:header>
          <h5 class="modal-title" id="addEmployeeLabel">Alterar Funcionário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="updateEmployee">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" name="name" v-model="employee.name"
                        placeholder="Nome" required="true" />
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </template>
        <template v-slot:footer>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="updateEmployee">Salvar</button>
        </template>
      </ModalEmployee>
  
    </div>
  </template>
  
  <script lang="ts">
  import { computed, defineComponent, inject } from 'vue'
  import { useStore } from '../store';
  import { DELETE_EMPLOYEE, GET_EMPLOYEES, INSERT_EMPLOYEE, UPDATE_EMPLOYEE } from "../store/action-types";
  import ModalEmployee from '../components/modals/ModalEmployee.vue';
  import type IEmployee from '../interfaces/IEmployee';
  import { optionsTable } from '../assets/js/datatable';
  import { employee } from '@/store/modules/employee';
  
  export default defineComponent({
    name: 'EmployeeView',
    data() {
      return {
        employee: {} as IEmployee
      }
    },
    updated() {
      $(this.$refs.table).DataTable(this.optionsDataTable);
    },
    components: {
      ModalEmployee
    },
    methods: {
      loadEmployee(employee: IEmployee) {
        this.employee = employee;
      },
      saveEmployee() {
        this.store.dispatch(INSERT_EMPLOYEE, this.employee)
          .then(() => {
            $('#addEmployee').modal('hide');
            this.swal('Sucesso', `${this.employee.name} cadastrado com sucesso!`, 'success');
            this.clearEmployee();
            this.refreshDataTable();
          });
      },
      updateEmployee() {
        this.store.dispatch(UPDATE_EMPLOYEE, this.employee)
          .then(() => {
            $('#updateEmployee').modal('hide');
            this.swal('Sucesso', `${this.employee.name} atualizado com sucesso!`, 'success');
            this.clearEmployee();
            this.refreshDataTable();
          })
      },
      deleteEmployee(id: number, name: string) {
        this.$swal({
          title: 'Você tem certeza?',
          text: `Deseja excluir ${name}? Não é possível reverter essa ação!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, excluir!'
        })
          .then((result) => {
            if (result.isConfirmed) {
              this.store.dispatch(DELETE_EMPLOYEE, id)
                .then(() => {
                  this.$swal(
                    'Excluído!',
                    `${name} foi excluído.`,
                    'success'
                  );
                  this.refreshDataTable();
                })
            }
          });
      },
      clearEmployee() {
        this.employee = {} as IEmployee;
      },
      refreshDataTable() {
        $(this.$refs.table).DataTable().clear().rows.add($(this.$refs.table).find('tbody tr')).draw();
      }
    },
    setup() {
      const store = useStore();
      const swal = inject('$swal');
      store.dispatch(GET_EMPLOYEES);
      const optionsDataTable = optionsTable
  
      return {
        Employees: computed(() => store.state.employee.employees),
        store,
        swal,
        optionsDataTable
      }
    }
  })
  </script>
  
  <style scoped>
    .fixed-top-navbar.top-nav .content-page {
      padding-top: 103px;
    }
  </style>
  