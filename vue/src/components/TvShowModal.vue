<template>
  <div class="modal fade" :id="idModal" tabindex="-1" role="dialog" aria-labelledby="addTvShowLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTvShowLabel">{{ title }}</h5>
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
                      <label for="sname">Nome: *</label>
                      <input type="text" class="form-control" id="sname" name="name" :value="name" @input="updateValue" placeholder="Nome" required="required" />
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
  name: 'TvShowModal',
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
  }
}

$(() => {
  $('#addTvShow').on('show.bs.modal', function() {
    $('#form-wizard').trigger('reset')
  })

  $('#addTvShow').on('shown.bs.modal', function() {
    $('#sname').focus()
  })
})
</script>

<style scoped>

</style>