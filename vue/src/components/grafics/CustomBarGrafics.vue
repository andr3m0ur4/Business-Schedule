<template>
  <BarGrafics v-if="this.loaded" :data="this.chartData"></BarGrafics>
</template>
    
<script lang="ts">
  import { defineComponent } from "@vue/runtime-core"
  import BarGrafics from '../grafics/CustomBarGrafics.vue';
  import { useStore } from "../../store";
  import { COUNT_SUNDAY_TIME } from "../../store/action-types";

  export default defineComponent({
    name: 'CustomBarChart',
    components: { BarGrafics },
    data() {
    return {
        chartData: {},
        loaded: false
      }
    },
    setup() {
      const store = useStore();

      return {
        store
      }
    },
    created() {

      this.contSundayTime();

    },
    methods: {
      contSundayTime(){
        let tempTimeNames = [];
        let tempTimeDays = [];

        this.store.dispatch(COUNT_SUNDAY_TIME)
        .then((response) => {
          response.forEach(item => {
            tempTimeNames.push(item.name);
            tempTimeDays.push(item.quant)
          });

          this.createGrafic(tempTimeNames, tempTimeDays)

          this.loaded = true;

        });

      },
      createGrafic(tempTimeNames, tempTimeDays){
        this.chartData = {
          labels: tempTimeNames,
          datasets: [
            {
              label: 'Dias',
              backgroundColor: '#f87979',
              data: tempTimeDays
            }
          ]
        }
      }
    }
  })
</script>
