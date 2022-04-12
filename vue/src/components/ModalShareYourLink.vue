<template>
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="popup text-left" id="popup">
            <h4 class="mb-3">Add Action</h4>
            <div class="content create-workform">
              <div class="form-group">
                <h6 class="form-label mb-3">Copy Your Link</h6>
                <div class="input-group">
                  <input type="text" class="form-control" readonly value="calendly.com/rickoshea1234">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="las la-link"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h6 class="form-label mb-3">Email Your Link</h6>
                <div class="input-group">
                  <input type="text" class="form-control" readonly value="calendly.com/rickoshea1234">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon3"><i class="las la-envelope"></i></span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h6 class="form-label mb-3">Add to Your Website</h6>
                <div class="input-group">
                  <input type="text" class="form-control" readonly value="calendly.com/rickoshea1234">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon4"><i class="las la-code"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mt-3">
                  <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                    <button type="submit" data-dismiss="modal" class="btn btn-primary mr-4">Cancel</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-outline-primary">Save</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalShareYourLink'
}
</script>

<style scoped>

</style>