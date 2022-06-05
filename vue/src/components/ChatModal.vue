<template>
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addMessage" aria-hidden="true" :id="idModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMessageLabel">{{title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-wizard" class="text-center" @submit.prevent="event(id)">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="message">Mensagem: *</label>
                      <textarea  class="form-control" id="message" name = 'message' :value="message" @input="updateValue" rows="7" ></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-primary" @click="event(id)">Enviar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'ChatModal',
  props: {
    idModal: String,
    title: String,
    event: Function,
    id: Number,
    message: String
  },
  emits: ['update:message'],
  methods: {
    updateValue(event) {
      this.$emit('update:message', event.target.value)
    }
  },
  mounted() {
    $('#addChat, #updateChat').on('shown.bs.modal', function(e) {
      $(e.target).find('[name]').focus();
    });
    $('#addChat, #updateChat').on('hide.bs.modal', function() {
      $('#form-wizard').trigger('reset');
    })
  }
}
</script>
