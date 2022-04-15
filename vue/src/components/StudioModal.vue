<template>
  <div class="modal fade" id="addStudio" tabindex="-1" role="dialog" aria-labelledby="addStudioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudioLabel">{{ title }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-wizard" class="text-center" @submit.prevent="event()">
            <fieldset>
              <div class="form-card text-left">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="sname">Nome: *</label>
                      <input type="text" class="form-control" id="sname" name="name" v-model="studio.name" placeholder="Nome" required="required" />
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" @click="event()">Salvar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'StudioModal',
  props: {
    title: String,
    event: Function
  },
  data() {
    return {
      studio: {
        name: null
      }
    }
  },
  watch: {
    'studio.name'() {
      this.$emit('studio', this.studio.name)
    }
  }
}
</script>

<style scoped>

</style>