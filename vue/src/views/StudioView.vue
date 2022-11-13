<template>
  <div class="content-page color-light">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
              <div class="iq-header-title">
                <h4 class="card-title mb-0">Estudios</h4>
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addStudio">Adicionar Estudio</a>
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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateStudio" @click="loadStudio(studio)">Editar</a>
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

    <ModalStudio :id="'addStudio'" @onHide="clearStudio">
      <template v-slot:header>
        <h5 class="modal-title" id="addStudioLabel">Cadastrar Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </template>
      <template v-slot:body>
        <form id="form-wizard" class="text-center" @submit.prevent="saveStudio">
          <fieldset>
            <div class="form-card text-left">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name">Nome: *</label>
                    <input type="text" class="form-control" name="name" v-model="studio.name"
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
        <button type="button" class="btn btn-primary" @click="saveStudio">Salvar</button>
      </template>
    </ModalStudio>

    <ModalStudio :id="'updateStudio'" @onHide="clearStudio">
      <template v-slot:header>
        <h5 class="modal-title" id="addStudioLabel">Alterar Estudio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </template>
      <template v-slot:body>
        <form id="form-wizard" class="text-center" @submit.prevent="updateStudio">
          <fieldset>
            <div class="form-card text-left">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name">Nome: *</label>
                    <input type="text" class="form-control" name="name" v-model="studio.name"
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
        <button type="button" class="btn btn-primary" @click="updateStudio">Salvar</button>
      </template>
    </ModalStudio>

  </div>
</template>

<script lang="ts">
import { computed, defineComponent, inject } from 'vue'
import { useStore } from '../store';
import { DELETE_STUDIO, GET_STUDIOS, INSERT_STUDIO, UPDATE_STUDIO } from "../store/action-types";
import ModalStudio from '../components/modals/ModalStudio.vue';
import type IStudio from '../interfaces/IStudio';
import { optionsTable } from '../assets/js/datatable';

export default defineComponent({
  name: 'StudioView',
  data() {
    return {
      studio: {} as IStudio
    }
  },
  updated() {
    $(this.$refs.table).DataTable(this.optionsDataTable);
  },
  components: {
    ModalStudio
  },
  methods: {
    loadStudio(studio: IStudio) {
      this.studio = studio;
    },
    saveStudio() {
      this.store.dispatch(INSERT_STUDIO, this.studio)
        .then(() => {
          $('#addStudio').modal('hide');
          this.swal('Sucesso', `${this.studio.name} cadastrado com sucesso!`, 'success');
          this.clearStudio();
          this.refreshDataTable();
        })
        .catch(err => this.$swal('Ops', err.response.data.message, 'error'));
    },
    updateStudio() {
      this.store.dispatch(UPDATE_STUDIO, this.studio)
        .then((response) => {
          // console.log(response);
          $('#updateStudio').modal('hide');
          this.swal('Sucesso', `${this.studio.name} atualizado com sucesso!`, 'success');
          this.clearStudio();
          this.refreshDataTable();
        })
    },
    deleteStudio(id: number, name: string) {
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
            this.store.dispatch(DELETE_STUDIO, id)
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
    clearStudio() {
      this.studio = {} as IStudio;
    },
    refreshDataTable() {
      $(this.$refs.table).DataTable().clear().rows.add($(this.$refs.table).find('tbody tr')).draw();
    }
  },
  setup() {
    const store = useStore();
    const swal = inject('$swal');
    store.dispatch(GET_STUDIOS);
    const optionsDataTable = optionsTable

    return {
      studios: computed(() => store.state.studio.studios),
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
