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
                  <div class="col-12"><h6>{{employee.name}}</h6></div>
                  <div class="col-12"><div class="badge badge-color ml-3 mt-0">Owner</div></div>
                </div>
              </div>
            </div>
          </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" id="exampleFormControlTextarea3" rows="7">
                      </textarea>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </div>
            <div v-for="message_local in messages" :key="message_local.id">
            <p>{{message_local.message}}</p>
          </div>
          <div class="col-md-12">
            <form id="form-wizard" class="text-center" @submit.prevent="event(id)">
              <div class="row">
                <div class="form-group col-md-9">
                  <input type="text" class="form-control" id="message" name="message" :value="message" @input="updateValue" placeholder="Enviar mensagem" required="required" />
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-primary" @click="event(id)">Enviar</button>
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
      message_local: {},
    }
  },
  props: {
    title: String,
    event: Function,
    id: Number,
    message: String,
    employee: Object,
    messages: Array
  },
  emits: ['update:message'],
  methods: {
    updateValue(event) {
      this.$emit('update:message', event.target.value)
    }
  },
  mounted() {
    $('#addChat, #updateChat').on('shown.bs.modal', function(e) {
      $(e.target).find('[message]').focus();
    });
    $('#addChat, #updateChat').on('hide.bs.modal', function() {
      $('#form-wizard').trigger('reset');
    })
  }
}
</script>
