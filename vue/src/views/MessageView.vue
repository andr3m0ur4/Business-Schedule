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
                      <h3>Mensagendffs</h3>
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
                        <div v-if="employee.id !== user.id"
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
                                <p class="mb-0">{{employee.id}}</p>
                              </div>
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat"
                                @click="messageT.user_id_to = employee.id; ">Enviar mensagem</a>
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

    <ModalChat :id="'addChat'" @onHide="clearMessage">
      <template v-slot:header>
                  <div class="media flex-wrap align-items-center">
                    <div class="mr-3">
                      <img class="avatar-50 rounded" src="../assets/images/user/04.jpg" alt="01">
                    </div>
                    <div>
                      <div class="media align-items-top user-detail mb-1">
                        <div class="row">
                          <div class="col-12">
                            <h4>{{  }}</h4>
                          </div>
                          <div class="col-12">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
      </template>
      <template v-slot:body>
        <div class="col-12 border rounded">
                    <div id="box-message" class="scrollspy-example" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                      <div v-for="message_local in messages" :key="message_local.id">
                        <div v-if="message_local.user_id_from === messageT.user_id_to" class="text-left col-12  mt-2">
                          <div class="row">
                            <h6><span class="badge badge-info mr-2" id="mdo">{{  }}</span></h6>
                            <h6>
                              {{message_local.created_at}}
                            </h6>
                          </div>
                          <h5>{{ message_local.message }}</h5>
                        </div>
                        <div v-else class="text-right col-12 mt-2">
                          <div class="row justify-content-end">
                            <h6 class="mr-2">
                              {{message_local.created_at}}
                            </h6>
                            <h6><span class="badge badge-primary" id="mdo">Eu</span></h6>
                          </div>
                          <h5>{{ message_local.message }}</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mt-2">
                    <form id="form-wizard" class="text-center" @submit.prevent="saveMessage">
                      <fieldset>
                        <div class="form-card text-left">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <input type="text" class="form-control" name="message" v-model="messageInfo.message"
                                  placeholder="Digite uma Menssagem" required="true" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
      </template>
      <template v-slot:footer>
        <button type="button" class="btn btn-primary button-height" @click="saveMessage">Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </ModalChat>
  </div>
</template>

<script lang="ts">
import { useStore } from "../store";
import { computed, defineComponent, inject } from "@vue/runtime-core";
import { GET_USERS_MESSAGES, GET_MESSAGES, INSERT_MESSAGE } from "../store/action-types";
import ModalChat from '../components/modals/ModalChat.vue';
import type IMessage from '../interfaces/IMessage';

export default defineComponent({
  name: 'MessageView',
  data() {
    return {
      messageInfo: {} as IMessage,
      messages: {} as IMessage[]
    }
  },
  watch: {
    messages: {
      handler(newMessages, oldMessages){
        setMessages(newMessages);
      }
    }
  },
  setup() {
    const store = useStore();
    const user = computed(() => store.getters.getUser);

    const messageT = {
      user_id_from: user.id,
      user_id_to: null,
      message: null
    };

    store.dispatch(GET_USERS_MESSAGES, messageT);

    return {
      store,
      employees: computed(() => store.getters.getEmployees),
      messages: computed(() => store.getters.getMessages),
      messageT,
      user
    }
  },
  components: {
    ModalChat
  },
  methods: {
    saveMessage() {

      this.messageInfo.user_id_to = this.messageT.user_id_to;
      this.messageInfo.user_id_from = this.user.id;
      console.log(this.messageInfo.user_id_to)
      this.store.dispatch(INSERT_MESSAGE, this.messageInfo)
        .then(() => {
          this.clearMessage();
        });
    },
    loadMessage(){

      //return this.messages =  computed(() => store.state.message.messages);

    },
    clearMessage() {
      this.messageInfo = {} as IMessage;
    },
  },
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
