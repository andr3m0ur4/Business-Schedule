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
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addSwitcher">Adicionar Switcher</a>
              </div>
              <div class="card-body">
                <div class="table-responsive data-table">
                  <table class="data-tables table" style="width:100%" ref="table">
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
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateSwitcher" @click="loadSwitcher(switcher)">Editar</a>
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

      <ModalSwitcher :id="'addSwitcher'" @onHide="clearSwitcher">
        <template v-slot:header>
          <h5 class="modal-title" id="addSwitcherLabel">Cadastrar Função</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="saveSwitcher">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" name="name" v-model="switcher.name"
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
          <button type="button" class="btn btn-primary" @click="saveSwitcher">Salvar</button>
        </template>
      </ModalSwitcher>

      <ModalSwitcher :id="'updateSwitcher'" @onHide="clearSwitcher">
        <template v-slot:header>
          <h5 class="modal-title" id="addSwitcherLabel">Alterar Função</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="updateSwitcher">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" name="name" v-model="switcher.name"
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
          <button type="button" class="btn btn-primary" @click="updateSwitcher">Salvar</button>
        </template>
      </ModalSwitcher>

    </div>
  </template>

  <script lang="ts">
  import { computed, defineComponent, inject } from 'vue'
  import { useStore } from '../store';
  import { DELETE_SWITCHER, GET_SWITCHERS, INSERT_SWITCHER, UPDATE_SWITCHER } from "../store/action-types";
  import ModalSwitcher from '../components/modals/ModalSwitcher.vue';
  import type ISwitcher from '../interfaces/ISwitcher';
  import { optionsTable } from '../assets/js/datatable';

  export default defineComponent({
    name: 'SwitcherView',
    data() {
      return {
        switcher: {} as ISwitcher
      }
    },
    updated() {
      $(this.$refs.table).DataTable(this.optionsDataTable);
    },
    components: {
      ModalSwitcher
    },
    methods: {
      loadSwitcher(switcher: ISwitcher) {
        this.switcher = switcher;
      },
      saveSwitcher() {
        this.store.dispatch(INSERT_SWITCHER, this.switcher)
          .then(() => {
            $('#addSwitcher').modal('hide');
            this.swal('Sucesso', `${this.switcher.name} cadastrado com sucesso!`, 'success');
            this.clearSwitcher();
            this.refreshDataTable
          })
          .catch(err => {console.log(err)});
      },
      updateSwitcher() {
        this.store.dispatch(UPDATE_SWITCHER, this.switcher)
          .then(() => {
            $('#updateSwitcher').modal('hide');
            this.swal('Sucesso', `${this.switcher.name} atualizado com sucesso!`, 'success');
            this.clearSwitcher();
            this.refreshDataTable();
          })
      },
      deleteSwitcher(id: number, name: string) {
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
              this.store.dispatch(DELETE_SWITCHER, id)
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
      clearSwitcher() {
        this.switcher = {} as ISwitcher;
      },
      refreshDataTable() {
        $(this.$refs.table).DataTable().clear().rows.add($(this.$refs.table).find('tbody tr')).draw();
      }
    },
    setup() {
      const store = useStore();
      const swal = inject('$swal');
      store.dispatch(GET_SWITCHERS);
      const optionsDataTable = optionsTable

      return {
        switchers: computed(() => store.state.switcher.switchers),
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
