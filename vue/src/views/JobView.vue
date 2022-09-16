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
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addJob">Adicionar Função</a>
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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#updateJob" @click="loadJob(job)">Editar</a>
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

    <ModalJob :id="'addJob'" @onHide="clearJob">
      <template v-slot:header>
        <h5 class="modal-title" id="addJobLabel">Cadastrar Função</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </template>
      <template v-slot:body>
        <form id="form-wizard" class="text-center" @submit.prevent="saveJob">
          <fieldset>
            <div class="form-card text-left">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name">Nome: *</label>
                    <input type="text" class="form-control" name="name" v-model="job.name"
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
        <button type="button" class="btn btn-primary" @click="saveJob">Salvar</button>
      </template>
    </ModalJob>

    <ModalJob :id="'updateJob'" @onHide="clearJob">
      <template v-slot:header>
        <h5 class="modal-title" id="addJobLabel">Alterar Função</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </template>
      <template v-slot:body>
        <form id="form-wizard" class="text-center" @submit.prevent="updateJob">
          <fieldset>
            <div class="form-card text-left">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="name">Nome: *</label>
                    <input type="text" class="form-control" name="name" v-model="job.name"
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
        <button type="button" class="btn btn-primary" @click="updateJob">Salvar</button>
      </template>
    </ModalJob>

  </div>
</template>

<script lang="ts">
import { computed, defineComponent, inject } from 'vue'
import { useStore } from '../store';
import { DELETE_JOB, GET_JOBS, INSERT_JOB, UPDATE_JOB } from "../store/action-types";
import ModalJob from '../components/modals/ModalJob.vue';
import type IJob from '../interfaces/IJob';

export default defineComponent({
  name: 'JobView',
  data() {
    return {
      job: {} as IJob
    }
  },
  updated() {
    $(this.$refs.table).DataTable();
  },
  components: {
    ModalJob
  },
  methods: {
    loadJob(job: IJob) {
      this.job = job;
    },
    saveJob() {
      this.store.dispatch(INSERT_JOB, this.job)
        .then(() => {
          $('#addJob').modal('hide');
          this.swal('Sucesso', `${this.job.name} cadastrado com sucesso!`, 'success');
          this.clearJob();
          this.refreshDataTable
        });
    },
    updateJob() {
      this.store.dispatch(UPDATE_JOB, this.job)
        .then(() => {
          $('#updateJob').modal('hide');
          this.swal('Sucesso', `${this.job.name} atualizado com sucesso!`, 'success');
          this.clearJob();
          this.refreshDataTable();
        })
    },
    deleteJob(id: number, name: string) {
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
            this.store.dispatch(DELETE_JOB, id)
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
    clearJob() {
      this.job = {} as IJob;
    },
    refreshDataTable() {
      $(this.$refs.table).data.reload();
    }
  },
  setup() {
    const store = useStore();
    const swal = inject('$swal');
    store.dispatch(GET_JOBS);

    return {
      jobs: computed(() => store.state.job.jobs),
      store,
      swal
    }
  }
})
</script>

<style scoped>
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>
