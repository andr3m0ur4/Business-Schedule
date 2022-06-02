<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addMessage" aria-hidden="true" id="addChat">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMessageLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-wizard" class="text-center">
                        <fieldset>
                            <div class="form-card text-left">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea3"
                                                rows="7"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
$(() => {
  $('#addMessage').on('shown.bs.modal', function() {
    $('#name').focus()
  })
})

$(() => {
  $('#addMessage').on('hide.bs.modal', function() {
    $('#form-wizard').trigger('reset')
  })
})
</script>
