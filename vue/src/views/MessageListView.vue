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
                        <div  v-if="employee.id !== message_info.user_id_from" class="card card-block card-stretch calender-account user-list mt-3" >
                          <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                              <div class="media flex-wrap align-items-center">
                                <div class="mr-3">
                                  <img class="avatar-50 rounded" src="../assets/images/user/02.jpg" alt="01">
                                </div>
                                <div>
                                  <div class="media align-items-top user-detail mb-1">
                                    <h6>{{ employee.name }}</h6>
                                    <div class="badge badge-color ml-3 mt-0">Cargo</div>
                                  </div>
                                  <p class="mb-0">{{ employee.email }}</p>
                                </div>
                              </div>
                              <div class="date">
                                <p class="mb-0">03 December, 2020</p>
                              </div>
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat" @click="message_info.user_id_to = employee.id; this.employee = employee;">Enviar mensagem</a>
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
    <ChatModal
      title="Nova mensagem"
      :message_info="message_info"
      :employee="employee"
    />
  </div>
</template>

<script>
import ChatModal from '@/components/ChatModal.vue'
import axios from '@/axios'
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  name: 'MessageListView',
  setup() {
    const store = useStore()

    return {
      user: computed(() => store.state.user.data)
    }
  },
  data() {
    return {
      employees: [],
      employee: {},
      message_info: {
        user_id_from: this.user.id,
        user_id_to: null,
        message: null
      },
      dataTable: null
    }
  },
  created() {
    this.getEmployees();
  },
  updated() {
    optionsTable.order = [];
    this.dataTable = $('.data-tables').DataTable(optionsTable);


  },
  methods: {
    getEmployees() {
      axios.get('v1/list-users-messages',{
         params: {user_id_to: this.message_info.user_id_from}
      })
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
    getUserData() {
      axios.get('v1/users-data')
        .then(response => {
          this.message_info.user_id_from = response.data
        })
        .catch(error => {
          if (error.response.status == 401) {
            this.$store.commit('logout')
            this.$router.push({
              name: 'sign-in'
            })
          }
        })
    }
  },
  components: {
    ChatModal
  }
}
</script>
<style scoped>
  .height-self-center {
    height: auto;
    border-radius: 5px;
  }
</style>
<style>
  .dataTables_wrapper .dataTables_filter input {
    background-color: #fff;
    border-color: #333;
  }
</style>
