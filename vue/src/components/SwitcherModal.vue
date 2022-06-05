<template>
  <div class="modal fade" :id="idModal" tabindex="-1" role="dialog" aria-labelledby="addSwitcherLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addSwitcherLabel">{{ title }}</h5>
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
                      <label for="name">Nome: *</label>
                      <input type="text" class="form-control" id="name" name="name" :value="name" @input="updateValue" placeholder="Nome" required="required" />
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="event(id)">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SwitcherModal',
  props: {
    idModal: String,
    title: String,
    event: Function,
    id: Number,
    name: String
  },
  emits: ['update:name'],
  methods: {
    updateValue(event) {
      this.$emit('update:name', event.target.value)
    }
  },
  mounted() {
    $('#addSwitcher, #updateSwitcher').on('shown.bs.modal', function(e) {
      $(e.target).find('[name]').focus();
    });
    $('#addSwitcher, #updateSwitcher').on('hide.bs.modal', function() {
      $('#form-wizard').trigger('reset');
    })
  }
}
</script>

<style scoped>

</style>