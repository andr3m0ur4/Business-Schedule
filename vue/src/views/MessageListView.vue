<template>
  <div class="wrapper">
    <div class="container-top">
      <div class="row justify-content-center align-items-center height-self-center">
        <div class="col-md-12 col-sm-12 col-12 align-self-center">
          <div class="content-page">
            <div class="container">
              <div class="row">
                <div class="col-lg-12 mb-3">
                  <div class="py-3 border-bottom">
                    <div class="form-title text-center">
                      <h3>Mensagens</h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive data-table">
                <table class="data-tables table" style="width:100%">
                  <thead>
                    <tr>
                      <th>CONTATOS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                      <td>
                        <div class="card card-block card-stretch calender-account user-list" >
                          <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                              <div class="media flex-wrap align-items-center">
                                <div class="mr-3">
                                  <img class="avatar-50 rounded" src="../assets/images/user/02.jpg" alt="01">
                                </div>
                                <div>
                                  <div class="media align-items-top user-detail mb-1">
                                    <h6>{{ employee.name }}</h6>
                                    <div class="badge badge-color ml-3 mt-0">Owner</div>
                                  </div>
                                  <p class="mb-0">{{ employee.email }}</p>
                                </div>
                              </div>
                              <div class="date">
                                <p class="mb-0">03 December, 2020</p>
                              </div>
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat" @click="message.user_id_to = employee.id; this.employee = employee">Enviar mensagem</a>
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
    <ChatModal id-modal="addChat" 
      title="Nova mensagem"
      :event="saveMessage"
      v-model:message="message.message"
      :employee="employee"
    />
  </div>
</template>

<script>
import ChatModal from '@/components/ChatModal.vue'
import axios from '@/axios'

export default {
  name: 'MessageListView',
  data() {
    return {
      employees: [],
      employee: {},
      message: {
        user_id_from: null,
        user_id_to: null,
        message: null
      },
      dataTable: null
    }
  },
  created() {
    this.getEmployees();
    this.getUserData();
  },
  updated() {
    this.dataTable = $('.data-tables').DataTable(optionsTable);
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
    saveMessage() {
      if (!$('#addChat form').get(0).reportValidity()) {
        return false
      }

      axios.post('v1/messages', this.message)
        .then(response => {
          this.$swal('Sucesso', `Menssagem enviada com sucesso`, 'success')
          $('#addChat').modal('hide')
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
    getUserData() {
      axios.get('v1/users-data')
        .then(response => {
          this.message.user_id_from = response.data
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
  },
  components: {
    ChatModal
  }
}
</script>
