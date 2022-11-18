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
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addTvshow">Adicionar programa</a>
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
                      <tr v-for="tvshow in tvshows" :key="tvshow.id">
                        <td>{{ tvshow.id }}</td>
                        <td>{{ tvshow.name }}</td>
                        <td>
                          <div class="d-flex align-items-center list-action justify-content-end">
                            <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View" href="#">
                              <i class="lar la-eye"></i>
                            </a>
                            <div class="badge bg-primary-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Action">
                              <div class="dropdown">
                                <div class="text-primary dropdown-toggle action-item" id="moreOptions1" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false"></div>
                                <div class="dropdown-menu" aria-labelledby="moreOptions1">
                                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateTvshow" @click="loadTvshow(tvshow)">Editar</a>
                                  <a class="dropdown-item" href="#" @click="deleteTvshow(tvshow.id, tvshow.name)">Excluir</a>
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

      <ModalTvshow :id="'addTvshow'" @onHide="clearTvshow">
        <template v-slot:header>
          <h5 class="modal-title" id="addTvshowLabel">Cadastrar programa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="saveTvshow">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" name="name" v-model="tvshow.name"
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
          <button type="button" class="btn btn-primary" @click="saveTvshow">Salvar</button>
        </template>
      </ModalTvshow>

      <ModalTvshow :id="'updateTvshow'" @onHide="clearTvshow">
        <template v-slot:header>
          <h5 class="modal-title" id="addTvshowLabel">Alterar Função</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </template>
        <template v-slot:body>
          <form id="form-wizard" class="text-center" @submit.prevent="updateTvshow">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" name="name" v-model="tvshow.name"
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
          <button type="button" class="btn btn-primary" @click="updateTvshow">Salvar</button>
        </template>
      </ModalTvshow>

    </div>
  </template>

  <script lang="ts">
  import { computed, defineComponent, inject } from 'vue'
  import { useStore } from '../store';
  import { DELETE_TVSHOW, GET_TVSHOWS, INSERT_TVSHOW, UPDATE_TVSHOW } from "../store/action-types";
  import ModalTvshow from '../components/modals/ModalTvshow.vue';
  import type ITvshow from '../interfaces/ITvshow';
  import { optionsTable } from '../assets/js/datatable';

  export default defineComponent({
    name: 'TvShowView',
    data() {
      return {
        tvshow: {} as ITvshow
      }
    },
    updated() {
      $(this.$refs.table).DataTable(this.optionsDataTable);
    },
    components: {
      ModalTvshow
    },
    methods: {
      loadTvshow(tvshow: ITvshow) {
        this.tvshow = tvshow;
      },
      saveTvshow() {
        this.store.dispatch(INSERT_TVSHOW, this.tvshow)
          .then(() => {
            $('#addTvshow').modal('hide');
            this.swal('Sucesso', `${this.tvshow.name} cadastrado com sucesso!`, 'success');
            this.clearTvshow();
            this.refreshDataTable
          })
          .catch(err => this.$swal('Ops', err.response.data.message, 'error'));
      },
      updateTvshow() {
        this.store.dispatch(UPDATE_TVSHOW, this.tvshow)
          .then(() => {
            $('#updateTvshow').modal('hide');
            this.swal('Sucesso', `${this.tvshow.name} atualizado com sucesso!`, 'success');
            this.clearTvshow();
          })
          .catch(err => this.$swal('Ops', err.response.data.message, 'error'));
      },
      deleteTvshow(id: number, name: string) {
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
              this.store.dispatch(DELETE_TVSHOW, id)
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
      clearTvshow() {
        this.tvshow = {} as ITvshow;
      },
      refreshDataTable() {
        $(this.$refs.table).DataTable().clear().rows.add($(this.$refs.table).find('tbody tr')).draw();
      }
    },
    setup() {
      const store = useStore();
      const swal = inject('$swal');
      store.dispatch(GET_TVSHOWS);
      const optionsDataTable = optionsTable

      return {
        tvshows: computed(() => store.state.tvshow.tvshows),
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
