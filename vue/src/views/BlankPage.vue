<template>
  <div class="content-page">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
  name: 'BlankPage',
  data() {
    return {

    }
  },
  methods: {

  },
  mounted() {
    const toast = useToast();

    toast("I'm a toast!");
  }
}
</script>

<style>

.bottom-left {
  box-shadow: none; }

.bottom-right {
  box-shadow: none; }

.top-left {
  box-shadow: none; }

.top-right {
  box-shadow: none; }

.shadow-bottom {
  box-shadow: none; }

</style>
