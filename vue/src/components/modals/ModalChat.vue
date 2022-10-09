<template>
  <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true" ref="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header"></slot>
        </div>
        <div class="modal-body">
          <slot name="body"></slot>
        </div>
        <div class="modal-footer">
          <slot name="footer"></slot>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script lang="ts">
import { defineComponent } from "@vue/runtime-core"

export default defineComponent({
  name: 'ModalChat',
  props: {
    id: {
      type: String,
      required: true
    }
  },
  emits: ['onHide'],
  mounted() {
    $(this.$refs.modal).on('shown.bs.modal', (e: Event) => {
      $(e.target).find('[message]').focus();
    });
    $(this.$refs.modal).on('hidden.bs.modal', () => {
      this.$emit('onHide');
    });
  }
})
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