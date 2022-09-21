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
                        <div v-if="employee.id !== messageInfo.user_id_from"
                          class="card card-block card-stretch calender-account user-list mt-3">
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
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat"
                                @click="messageInfo.user_id_to = employee.id;">Enviar mensagem</a>
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
    <ChatModal title="Nova mensagem" :message_info="message_info" />
  </div>
</template>

<script lang="ts">
import { useStore } from "@/store";
import { computed, defineComponent } from "@vue/runtime-core";
import { GET_USERS_MESSAGES } from "../store/action-types";

export default defineComponent({
  name: 'MessageView',
  setup() {
    const store = useStore();
    const user = computed(() => store.state.user.user.data);

    const messageInfo = {
      user_id_from: user.id,
      user_id_to: null,
      message: null
    };

    store.dispatch(GET_USERS_MESSAGES, messageInfo);

    return {
      store,
      employees: computed(() => store.state.employee.employees),
      messageInfo
    }
  }
})
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
