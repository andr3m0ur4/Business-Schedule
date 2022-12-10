<template>
  <div class="col-lg-4 col-md-4">
    <div class="card card-block card-stretch card-height">
      <div class="card-header">
        <div class="header-title">
          <h4 class="card-title">Gráfico Test</h4>
        </div>
      </div>
      <div class="card-body">
        <BarGrafics v-if="loaded" :data="chartData"/>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import BarGrafics from '../components/BarGrafics.vue';

export default defineComponent({
  name: 'CustomBargrafics',
  components: { BarGrafics },
  data() {
    return {
      loaded: false,
      chartData: null
    }
  },
  async mounted() {
    this.loaded = false;

    setTimeout(() => {
      this.loaded = true;
      this.chartData = {
        labels: [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December'
        ],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [55, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 90]
          }
        ]
      }
    }, 3000);
  },
})
</script>
