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
                      <h3>Mensagem</h3>
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
                                <p class="mb-0">{{}}</p>
                              </div>
                              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addChat"
                                @click="messageT.user_id_to = employee.id; this.employee = employee; loadMessage();">Enviar mensagem</a>
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
                  <h4>{{ this.employee.name }}</h4>
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
        <div class="col-12 border rounded" id="MessageView">
          <div id="box-message" data-target="#navbar-example2" data-offset="0">
            <div v-if = load class="text-left col-12  mt-2">
              <div display="block" class="text-center">
                <h3>Carregando</h3>
                <img class="w-100 h-100 img-fluid image" src="../assets/images/load.gif" >
              </div>
            </div>
            <div v-else class="text-right col-12 mt-2 scrollspy-example" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
              <div id="box-message">
                <div v-for="message in messages" :key="message.id" class="mr-2">
                  <div v-if="message.user_id_from === messageT.user_id_to" class="text-left col-12  mt-2">
                    <div class="row">
                      <h6><span class="badge badge-info mr-2" id="mdo">{{ this.employee.name }}</span></h6>
                      <h6>
                        {{this.formatDate(message.created_at)}}
                      </h6>
                    </div>
                    <h5>{{ message.message }}</h5>
                  </div>
                  <div v-else class="text-right col-12 mt-2">
                    <div class="row justify-content-end">
                      <h6 class="mr-2">
                        {{this.formatDate(message.created_at)}}
                      </h6>
                      <h6><span class="badge badge-primary" id="mdo">Eu</span></h6>
                    </div>
                    <h5>{{ message.message }}</h5>
                  </div>
                </div>
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
                      <input type="text" class="form-control" name="messageF" :disabled=lockMessage v-model="messageInfo.message"
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

        <img v-if = send class="d-block w-100 h-100 img-fluid image-send" src="../assets/images/load.gif" >
        <p v-if = send>Enviando</p>
        <button type="button" class="btn btn-primary button-height" @click="saveMessage" :disabled=lockMessage>Enviar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </template>
    </ModalChat>
  </div>
</template>

<script lang="ts">
import { useStore } from "../store";
import { computed, defineComponent, inject , ref} from "@vue/runtime-core";
import { GET_USERS_MESSAGES, GET_MESSAGES, INSERT_MESSAGE } from "../store/action-types";
import ModalChat from '../components/modals/ModalChat.vue';
import type IMessage from '../interfaces/IMessage';
import Pusher from 'pusher-js';
import { onMounted } from "@vue/runtime-core";



export default defineComponent({
  name: 'MessageView',
  data() {
    return {
      messageInfo: {} as IMessage,
      messages: ref([]),
      employee: {},
      message: {},
      load: false,
      send: false,
      lockMessage: false
    }
  },
  setup() {
    //Pusher.logToConsole = true;   
    const store = useStore();
    const user = computed(() => store.getters.getUser);

    const messageT = {
      user_id_from: user.id,
      user_id_to: null,
      message: null
    };

    store.dispatch(GET_USERS_MESSAGES, messageT);

    const pusher = new Pusher('5f128ecfb6a1dab47acb', {
      cluster: 'sa1'
      });

    return {
      store,
      employees: computed(() => store.getters.getEmployees),
      messageT,
      pusher,
      user
    }
  },
  components: {
    ModalChat
  },
  methods: {
    saveMessage() {
      let canal = '';

      this.messageInfo.user_id_to = this.messageT.user_id_to;
      this.messageInfo.user_id_from = this.user.id;
      canal = (this.channelLogic());

      const dados = {
        messageInfo: this.messageInfo,
        canal: canal
      };

      this.lockMessage = true;
      this.send = true;
      this.store.dispatch(INSERT_MESSAGE, dados)
        .then(() => {
          this.clearMessage();
          this.lockMessage = false;
          this.send = false;
        });
    },
    loadMessage(){

      this.messages = [];
      this.messageInfo.user_id_to = this.messageT.user_id_to;
      this.messageInfo.user_id_from = this.user.id;

      this.load = true;
      this.store.dispatch(GET_MESSAGES, this.messageInfo)
      .then((response) => {
        this.messages = this.messages.concat(response.data)
        this.load = false;
      });

      this.defineChannel();

    },
    defineChannel(){
      let channel;
      this.pusher.unsubscribe(this.channelLogic());

      channel = this.pusher.subscribe(this.channelLogic());

      channel.bind('messageR', function(data) {

      this.messages.push(data.message);

      }, this);
    },
    channelLogic(){
      if (this.messageInfo.user_id_to < this.messageInfo.user_id_from) 
      {
        return (this.messageInfo.user_id_from + '_' +  this.messageInfo.user_id_to);
      } 
      else 
      {
        return (this.messageInfo.user_id_to + '_' + this.messageInfo.user_id_from);
      }
      
    },
    formatDate(date){
      return moment(date).format('HH:mm');
    },
    clearMessage() {
      this.messageInfo = {} as IMessage;
    },
  },
})
</script>

<style scoped>
  .image{
      max-width:100px;
      max-height:100px;
      width: auto;
      height: auto;
  }

  .image-send{
      max-width:50px;
      max-height:50px;
      width: auto;
      height: auto;
  }

  .height-self-center {
    height: auto;
    border-radius: 5px;
  }

  .scrollspy-example {
  position: relative;
  height: 200px;
  margin-top: 0.5rem;
  overflow: auto;
  }
  .button-height {
    height: 45px;
  }
  .message{
    padding-right: 28px;
  }
</style>
<style>
  .dataTables_wrapper .dataTables_filter input {
    background-color: #fff;
    border-color: #333;
  }
  
</style>
