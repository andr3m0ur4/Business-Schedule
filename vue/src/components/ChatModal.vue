<template>
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addMessage" aria-hidden="true" id="addChat">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="media flex-wrap align-items-center">
            <div class="mr-3">
              <img class="avatar-50 rounded" src="../assets/images/user/04.jpg" alt="01">
            </div>
            <div>
              <div class="media align-items-top user-detail mb-1">
                <div class="row">
                  <div class="col-12">
                    <h4>{{ employee.name }}</h4>
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
        </div>
        <div class="modal-body">
          <div class="col-12 border rounded">
            <div id="box-message" class="scrollspy-example" data-spy="scroll" data-target="#navbar-example2" data-offset="0">
              <div v-for="message_local in messages" :key="message_local.id">
                <div v-if="message_local.user_id_from === employee.id" class="text-left col-12">
                  <div class="row">
                    <h6><span class="badge badge-info mr-2" id="mdo">{{ employee.name }}</span></h6>
                    <h6>
                      {{message_local.created_at}}
                    </h6>
                  </div>
                  <h5>{{ message_local.message }}</h5>
                </div>
                <div v-else class="text-right col-12 message">
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
            <form id="form-wizard" class="text-center" @submit.prevent="saveMessage()">
              <div class="row">
                <div class="form-group col-md-9">
                  <input type="text" class="form-control" id="message" name="message" v-model="message.message"
                  placeholder="Enviar mensagem" required="required" />
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary button-height" @click="saveMessage()">Enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '@/axios'

export default {
  name: 'ChatModal',
  data() {
    return {
      message_local: {
        user_id_from: null,
        user_id_to: null,
        message: null
      },
      message: {
        user_id_from: null,
        user_id_to: null,
        message: null
      },
      messages: [],
      intervalMy: null
    }
  },
  props: {
    title: String,
    id: Number,
    message_info: Object,
    employee: Object
  },
  emits: ['update:message'],
  methods: {
    saveMessage() {
      if (!$('#addChat form').get(0).reportValidity()) {
        return false
      }
      console.log(this.message);
      axios.post('v1/messages', this.message)
        .then(() => {
          this.message.message = null;
          const box = document.getElementById('box-message');
          box.scrollTop = box.scrollHeight
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
    loadMessage(){
      axios.get('v1/users-messages',{
         params: {user_id_to: this.message.user_id_to, user_id_from: this.message.user_id_from}
      })
      .then(response => {
        this.messages = response.data

        this.messages.forEach((item) => {
            item.created_at = moment(item.created_at).format('HH:mm')
        })

        setTimeout(() => {
          const box = document.getElementById('box-message');
          box.scrollTop = box.scrollHeight;
        }, 0);
      })
      .catch(error => {
        console.log(error)
      })
    },
    readMessages() {
      axios.post('v1/read-messages', this.message)
        .then(() => {
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
    }
  },
  mounted() {
    $('#addChat, #updateChat').on('shown.bs.modal', (e) => {
      $(e.target).find('[message]').focus();
      this.message = this.message_info;
      this.readMessages();
      this.loadMessage();
      this.intervalMy = setInterval(this.loadMessage, 3000);
      const box = document.getElementById('box-message');
      box.scrollTop = box.scrollHeight;
    });
    $('#addChat, #updateChat').on('hide.bs.modal', () => {
      $('#form-wizard').trigger('reset');
      this.readMessages();
      // console.log(this.intervalMy);
      clearInterval(this.intervalMy);
    })

  }
}
</script>

<style scoped>
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
