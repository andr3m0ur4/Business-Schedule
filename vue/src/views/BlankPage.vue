<template>
  <div class="content-page">
    <div class="container-fluid container">
  <div class="row">
    <div class="col-lg-12">

       <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
          <input type="text" id="datepicker-input" aria-label="Date-Time">
          <span class="tui-ico-date"></span>
        </div>
        <div id="wrapper" style="margin-top: -1px;"></div>

    </div>
  </div>
    </div>
  </div>
</template>

<script>
import DatePicker from 'tui-date-picker';

export default {
  name: 'BlankPage',
  data() {
    return {

    }
  },
  methods: {

  },
  mounted() {
    var datepicker = new DatePicker('#wrapper', {
        date: new Date(),
        input: {
          element: '#datepicker-input',
          format: 'yyyy-MM-dd HH:mm A'
        },
        timePicker: true
      });
      datepicker
  }
}
</script>

<style scoped>

</style>
