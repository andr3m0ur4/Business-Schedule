<template>
  <main class="content-page">
    <div class="content-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="py-4 border-bottom">
             <div class="form-title text-center">
              <h3>Dashboard Administrativa</h3>
             </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-4 tab-extra" id="view-event">
            <div class="float-md-right mb-4"><a href="#event1" class="btn view-btn">View Event</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
                <div class="header-title">
                  <h4 class="card-title text-center">Tempo restante até persistir uma nova escala</h4>
                </div>
              </div>
            <div class="card-body text-center mt-5">
              <div class="row timer">
                <div class="icon iq-icon-box-2 mb-1 rounded text-primary font-icon">
                  <i class="las la-hourglass"></i>
                </div>
                <h2 class="mb-2 text-primary">{{this.time}} dias</h2>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
              <div class="header-title">
                <h4 class="card-title text-center">Número de escala</h4>
              </div>
            </div>
            <div class="card-body text-center">
              <svg width="36" height="48" viewBox="0 0 36 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M9.10495 33.9964C8.29026 33.1817 8.71495 33.4114 6.74995 32.8855C5.85838 32.6464 5.07463 32.1871 4.36588 31.6367L0.112441 42.0655C-0.299122 43.0752 0.469629 44.1721 1.559 44.1308L6.4987 43.9424L9.8962 47.5311C10.6462 48.3224 11.9624 48.0758 12.374 47.0661L17.2537 35.1017C16.2375 35.668 15.1096 35.9999 13.9434 35.9999C12.1153 35.9999 10.3978 35.2883 9.10495 33.9964V33.9964ZM35.8875 42.0655L31.634 31.6367C30.9253 32.188 30.1415 32.6464 29.25 32.8855C27.2746 33.4142 27.7078 33.1836 26.895 33.9964C25.6021 35.2883 23.8837 35.9999 22.0556 35.9999C20.8893 35.9999 19.7615 35.6671 18.7453 35.1017L23.625 47.0661C24.0365 48.0758 25.3537 48.3224 26.1028 47.5311L29.5012 43.9424L34.4409 44.1308C35.5303 44.1721 36.299 43.0742 35.8875 42.0655V42.0655ZM24.6562 31.8749C26.0887 30.4171 26.2528 30.5427 28.2928 29.9867C29.595 29.6314 30.6131 28.5955 30.9618 27.2699C31.6631 24.6074 31.4812 24.9289 33.3946 22.9808C34.3481 22.0105 34.7203 20.5958 34.3715 19.2702C33.6712 16.6096 33.6703 16.9808 34.3715 14.3174C34.7203 12.9917 34.3481 11.5771 33.3946 10.6067C31.4812 8.65862 31.6631 8.97925 30.9618 6.31768C30.6131 4.99206 29.595 3.95612 28.2928 3.60081C25.679 2.88737 25.994 3.07393 24.0787 1.12487C23.1253 0.154558 21.735 -0.225129 20.4328 0.130183C17.82 0.842683 18.1846 0.843621 15.5671 0.130183C14.2649 -0.225129 12.8746 0.153621 11.9212 1.12487C10.0078 3.073 10.3228 2.88737 7.70807 3.60081C6.40588 3.95612 5.38776 4.99206 5.03901 6.31768C4.33869 8.97925 4.51963 8.65862 2.60619 10.6067C1.65275 11.5771 1.27963 12.9917 1.62932 14.3174C2.32963 16.9761 2.33057 16.6049 1.62932 19.2692C1.28057 20.5949 1.65275 22.0096 2.60619 22.9808C4.51963 24.9289 4.33776 24.6074 5.03901 27.2699C5.38776 28.5955 6.40588 29.6314 7.70807 29.9867C9.8062 30.5586 9.96276 30.4686 11.3437 31.8749C12.584 33.1377 14.5162 33.3636 16.0068 32.4205C16.6029 32.0421 17.2944 31.8411 18.0004 31.8411C18.7065 31.8411 19.3979 32.0421 19.994 32.4205C21.4837 33.3636 23.4159 33.1377 24.6562 31.8749ZM9.15557 16.4961C9.15557 11.5246 13.1156 7.49425 18 7.49425C22.8843 7.49425 26.8443 11.5246 26.8443 16.4961C26.8443 21.4677 22.8843 25.498 18 25.498C13.1156 25.498 9.15557 21.4677 9.15557 16.4961V16.4961Z"
                  fill="#465af7" />
              </svg>
              <h2 class="mb-2 mt-3 text-primary">{{this.count}}</h2>
              <h4>Escalas</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
              <div class="header-title">
                <h4 class="card-title text-center">Domingos sem folgar</h4>
              </div>
            </div>
            <div class="card-body">
              <CustomBarGrafics></CustomBarGrafics>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
              <div class="header-title">
                <h4 class="card-title text-center">Limite de horas trabalhadas</h4>
              </div>
            </div>
            <div class="container">
              <div class="card card-color mt-2" v-for="emplyeeTime in emplyeeTimes" :key="emplyeeTime.name">
                <div class="card-body" >
                  <div class="row limit">
                    <div class="icon iq-icon-box-2 rounded text-primary font-icon">
                      <i class="las la-stopwatch"></i>
                    </div>
                    <h4>{{emplyeeTime.name}}</h4>
                    <h4>-</h4>
                    <h4>{{emplyeeTime.hour_emp}}</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card card-block card-stretch card-height">
            <div class="card-header">
              <div class="header-title">
                <h4 class="card-title text-center">Programas com mais Funcionários</h4>
              </div>
            </div>
            <div class="card-body">
              <CustomRadarGrafic
              />
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade create-workform" id="create-event" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">Create a Workflow</h4>
              <div class="mb-3">
                <h5>When this happens</h5>
                <div class="content">
                  <div class="form-group mb-0">
                    <select name="type" class="selectpicker form-control" data-style="py-0">
                      <option>Select..</option>
                      <option>New event is scheduled</option>
                      <option>Before event starts</option>
                      <option>Event starts</option>
                      <option>Event ends</option>
                      <option>Event is canceled</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <h5 class="mb-3">Do this</h5>
                <div class="form-group  mb-0">
                  <select name="type" class="selectpicker form-control" data-style="py-0">
                    <option>Select..</option>
                    <option>Send email to invitee</option>
                    <option>Send email to host</option>
                    <option>Send text to invitee</option>
                    <option>Send text to host</option>
                  </select>
                </div>
              </div>
              <div class="mt-3">
                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                  <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                  <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import CustomBarGrafics from '../components/grafics/CustomBarGrafics.vue';
import DoughnutGrafic from '../components/grafics/DoughnutGrafic.vue';
import LineGrafic from '../components/grafics/LineGrafic.vue';
import CustomRadarGrafic from '../components/grafics/CustomRadarGrafic.vue';
import { useStore } from "../store";
import { COUNT_SCHEDULES, COUNT_TIME_SCHEDULE, COUNT_EMPLOYEE_TIME} from "../store/action-types";

export default defineComponent({
    name: "HomeView",
    components: { CustomBarGrafics, DoughnutGrafic, LineGrafic, CustomRadarGrafic },
    data() {
    return {
        count: 0,
        time: 0,
        emplyeeTimes: []
      }
    },
    setup() {
      const store = useStore();

      return {
        store
      }
    },
    created() {
      this.countSchedule();
      this.timeRemainSchedule();
      this.contEmployeeTime();
    },
    methods: {
      countSchedule(){

        this.store.dispatch(COUNT_SCHEDULES)
          .then((response) => {
            this.count = response.total;
          });
      },
      timeRemainSchedule(){

          this.store.dispatch(COUNT_TIME_SCHEDULE)
            .then((response) => {
              this.time = response.time;
            });

      },
    contEmployeeTime(){

        this.store.dispatch(COUNT_EMPLOYEE_TIME)
          .then((response) => {
            this.emplyeeTimes = response;
          });
     
      }
    }
})
</script>

<style scoped>

.font-icon {
    font-size: 50px;
    text-align: center;
    display: inline-block;
}

.timer {
    align-items: center;
    justify-content: center;
}

.limit {
    align-items: center;
}

.align-center {
    align-items: center;
    justify-content: center;
}

.card-color {
  background-color: rgb(30,144,255);
}

</style>
