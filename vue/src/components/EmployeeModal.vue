<template>
  <div class="modal fade" :id="idModal" tabindex="-1" role="dialog" aria-labelledby="updateEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateEmployeeLabel">{{ title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-wizard" class="text-center" @submit.prevent="updateEmployee(employee.id)">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sname">Nome: *</label>
                      <input type="text" class="form-control" id="sname" v-model="employee.name" placeholder="Nome" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sname">Celular: *</label>
                      <input type="text" class="form-control" id="sphone" v-model="employee.phone" placeholder="Celular" required />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="sjob">Função: *</label>
                      <select class="selectpicker form-control" id="sjob" v-model="employee.job_id">
                        <option v-for="job in jobs" :key="job.id" :value="job.id">
                          {{ job.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="stype">Privilégio: *</label>
                      <select class="selectpicker form-control" id="stype" v-model="employee.type">
                        <option value="Admin">Administrador</option>
                        <option value="Employee">Funcionário</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="updateEmployee(employee.id)">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'EmployeeModal',
  props: {
    idModal: String,
    title: String,
    refreshTable: Function
  },
  data() {
    return {
      employee: {},
      jobs: []
    }
  },
  mounted() {
    this.loadJobs()
  },
  updated() {
    $('.selectpicker').selectpicker('refresh')
  },
  methods: {
    loadEmployee(id) {
      axios.get(`v1/users/${id}`)
        .then(response => {
          this.employee = response.data
        })
        .catch(error => {
          console.log(error.response);
        })
    },
    loadJobs() {
      axios.get('v1/jobs')
        .then(response => {
          this.jobs = response.data
        })
        .catch(error => {
          console.log(error.response);
        })
    },
    updateEmployee(id) {
      if (!$('#updateEmployee form').get(0).reportValidity()) {
        return false
      }

      axios.put(`v1/users/${id}`, this.employee)
        .then(response => {
          $('#updateEmployee').modal('hide')
          this.$swal('Sucesso', `${response.data.name} atualizado com sucesso!`, 'success')
          this.refreshTable()
        })
        .catch(error => {
          this.$swal('Ops...', error.response.data.message, 'error')
        })
    }
  }
}

$(() => {
  $('#updateEmployee').on('shown.bs.modal', function() {
    $('#sname').focus()
  })
})
</script>

<style scoped>

</style>