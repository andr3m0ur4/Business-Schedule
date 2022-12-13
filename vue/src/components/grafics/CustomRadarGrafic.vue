<template>
  <RadarGrafic v-if="this.loaded" :data="this.chartData"></RadarGrafic>
</template>
    
<script lang="ts">
  import { defineComponent } from "@vue/runtime-core"
  import RadarGrafic from './RadarGrafic.vue';
  import { useStore } from "../../store";
  import { COUNT_TV_SHOW_EMPLOYEES } from "../../store/action-types";

  export default defineComponent({
    name: 'CustomBarChart',
    components: { RadarGrafic },
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

      this.countTvShowEmployees();

    },
    methods: {
      countTvShowEmployees(){
        let tempTvShowName = [];
        let tempCountEmployees = [];

        this.store.dispatch(COUNT_TV_SHOW_EMPLOYEES)
          .then((response) => {
            response.forEach(item => {
              tempTvShowName.push(item.name);
              tempCountEmployees.push(item.count_user);
            });

            this.createGrafic(tempTvShowName, tempCountEmployees)

            this.loaded = true;

        });

      },
      createGrafic(tempTvShowName, tempCountEmployees){
        this.chartData = {
          labels: tempTvShowName,
          datasets: [
            {
              label: 'Funcionários',
              backgroundColor: '#f87979',
              data: tempCountEmployees
            }
          ]
        }
      }
    }
  })
</script>
