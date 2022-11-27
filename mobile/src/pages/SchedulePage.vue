<template>
  <q-page padding>
    <div class="content-page">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <div class="py-4 border-bottom">
              <div class="form-title text-center">
                <h3>Minha Escala</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-3">
              <div class="d-flex flex-wrap align-items-center" id="filter-by">
                <div id="filter-none" class="filter-extra"></div>
                <div id="filter-button" class="select-dropdown input-prepend input-append filter-dropdown filter-extra active">
                  <div class="btn-group">
                    <label data-toggle="dropdown" class="mb-0">
                      <span class="dropdown-toggle search-query selet-caption btn bg-white">Filtrar Por</span><span class="search-replace"></span>
                      <span class="caret"></span>
                    </label>
                    <div id="lnb-calendars" class="lnb-calendars">
                      <ul class="dropdown-menu p-3 border-none">
                        <li class="lnb-calendars-item">
                          <div class="item mb-2">
                            <div class="checkbox">
                              <label for="checkbox1" class="mb-0">
                                <input type="checkbox" class="checkbox-input mr-3 tui-full-calendar-checkbox-square" id="checkbox1" value="all" checked>
                                <span></span>
                                <strong>Todas as Equipes</strong>
                              </label>
                            </div>
                          </div>
                        </li>
                        <li id="calendarList" class="lnb-calendars-d1"></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- <input @input="filterByText" v-model="text" type="text" class=""> -->
              </div>

            </div>
            <h4 class="mb-3">Horários de Trabalho</h4>
            <div class="row">
              <div class="col-lg-12">
                <div class="card card-block card-stretch">
                  <div class="card-body">
                    <div class="fc fc-ltr fc-unthemed">
                      <div class="fc-toolbar fc-header-toolbar">
                        <div class="fc-left" id="menu-navi">
                          <div class="fc-button-group">
                            <button type="button" class="fc-prev-button fc-button fc-button-primary prev" aria-label="prev" data-action="move-prev">
                              <span class="fc-icon fc-icon-chevron-left" data-action="move-prev"></span>
                            </button>
                            <button type="button" class="fc-next-button fc-button fc-button-primary next" aria-label="next" data-action="move-next">
                              <span class="fc-icon fc-icon-chevron-right" data-action="move-next"></span>
                            </button>
                          </div>
                          <button type="button" class="fc-today-button fc-button fc-button-primary today" data-action="move-today">
                            hoje
                          </button>
                        </div>
                        <div class="fc-center">
                          <h2 id="renderRange"></h2>
                        </div>
                        <div class="fc-right">
                          <span class="dropdown bootstrap-select">
                            <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="true">
                              <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                              <span id="calendarTypeName">Dropdown</span>&nbsp;
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                  <i class="calendar-icon ic_view_day"></i>Diário
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                  <i class="calendar-icon ic_view_week"></i>Semanal
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                  <i class="calendar-icon ic_view_month"></i>Mensal
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                  <i class="calendar-icon ic_view_week"></i>2 semanas
                                </a>
                              </li>
                              <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                  <i class="calendar-icon ic_view_week"></i>3 semanas
                                </a>
                              </li>
                              <li role="presentation" class="dropdown-divider"></li>
                              <li role="presentation">
                                <a role="menuitem" data-action="toggle-workweek">
                                  <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                  <span class="checkbox-title"></span>Exibir Finais de Semana
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" data-action="toggle-start-day-1">
                                  <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                  <span class="checkbox-title"></span>Iniciar Semana na Segunda
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" data-action="toggle-narrow-weekend">
                                  <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                  <span class="checkbox-title"></span>Priorizar Dias da Semana
                                </a>
                              </li>
                            </ul>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div id="calendar" class="calendar-s" style="height: 848px;" @touchstart="myTouchStart" @touchend="myTouchEnd"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script lang="ts">
import { computed, defineComponent } from 'vue'
import { setSchedules, startCalendar, startCalendarMenu } from '../assets/js/app-calendar';
import { ScheduleInfo, ScheduleList } from '../assets/js/data/schedules';
import { useStore } from '../store';
import { GET_EMPLOYEES_TIMES, GET_JOBS, GET_TV_SHOW_TIMES } from '../store/action-types';

export default defineComponent({
  name: 'SchedulePage',
  data() {
    return {
      calendar: {},
      calendarList: [],
      pageX: 0
    }
  },
  mounted() {
    this.calendar = startCalendar(this);
  },
  methods: {
    createScheduleList(employeeTimes, tvShowTimes) {
      ScheduleList.splice(0, ScheduleList.length);
      ScheduleInfo.createSchedulesFromDB(employeeTimes);
      ScheduleInfo.createTasksFromDB(tvShowTimes);
      setSchedules();
    },
    myTouchStart(event: any) {
      this.pageX = event.changedTouches[0].pageX
    },
    myTouchEnd(event: any) {
      const pageEnd = event.changedTouches[0].pageX

      if (this.pageX > pageEnd && (this.pageX - pageEnd) >= 250) {
        this.calendar.next();
      } else if ((pageEnd - this.pageX) >= 250) {
        this.calendar.prev();
      }
    }
  },
  watch: {
    jobs(newJobs) {
      this.calendarList = startCalendarMenu(newJobs);
    },
    employeeTimes: {
      handler(newEmployeeTimes) {
        this.createScheduleList(newEmployeeTimes, this.tvShowTimes);
      },
      deep: true
    },
    tvShowTimes: {
      handler(newTvShowTimes) {
        this.createScheduleList(this.employeeTimes, newTvShowTimes);
      },
      deep: true
    }
  },
  setup() {
    const store = useStore();
    store.dispatch(GET_JOBS);
    store.dispatch(GET_EMPLOYEES_TIMES)
      .then(() => store.dispatch(GET_TV_SHOW_TIMES));

    return {
      jobs: computed(() => store.getters.getJobs),
      employeeTimes: computed(() => store.getters.getEmployeesTimes),
      tvShowTimes: computed(() => store.getters.getTvShowTimes),
      store
    }
  }
})
</script>

<style scoped>
  @import '../assets/vendor/fullcalendar/core/main.css';
  @import '../assets/vendor/fullcalendar/daygrid/main.css';
  @import '../assets/vendor/fullcalendar/timegrid/main.css';
  @import '../assets/vendor/fullcalendar/list/main.css';


  @import url('../assets/css/styles/reset.css');
  @import url('../assets/css/styles/icons.css');

  /* If you use the default popups, use this. */
  @import 'tui-date-picker/dist/tui-date-picker.css';
  @import 'tui-time-picker/dist/tui-time-picker.css';

  #filter-by .filter-dropdown .selet-caption.dropdown-toggle:after {
    margin-left: 12px;
    vertical-align: middle;
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
  }
  #filter-by .filter-dropdown ul.dropdown-menu {
    width: 220px;
  }
  .lnb-calendars div.checkbox {
    padding-right: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e5e5e5;
    font-weight: normal;
  }

  .fc-right .bootstrap-select > .dropdown-toggle {
    height: 38px;
    line-height: 37px;
    background: #d1e2ff;
    color: #465af7;
    width: 225px;
    vertical-align: top;
    margin-right: 15px;
    text-transform: capitalize;
    font-size: 1em;
  }
  .fc-right .bootstrap-select > .dropdown-toggle:focus {
    color: #fff;
    background-color: #465af7;
    outline: none;
  }
  .dropdown-menu {
    top: 25px;
    padding: 3px 0;
    border-radius: 2px;
    border: 1px solid #bbb;
  }
  .dropdown-menu > li > a {
    display: block;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
    padding: 9px 12px;
    cursor: pointer;
  }
  .dropdown-menu > li > a:hover {
    background-color: rgba(81, 92, 230, 0.05);
    color: #333;
  }
  .dropdown-menu.new-schedule {
    min-width: 16rem;
  }
  .dropdown-menu.new-schedule .item {
    cursor: pointer;
  }
  .tui-full-calendar-button.tui-full-calendar-section-private {
    padding-top: 4px;
  }
  .tui-full-calendar-popup-section-item {
    font-size: inherit;
  }
  .tui-full-calendar-popup-detail .tui-full-calendar-popup-container {
    color: #333;
    font-weight: 400;
  }
  .tui-full-calendar-popup {
    font-weight: 400;
  }

  .tui-datepicker-input {
    display: block;
    width: 100%;
    height: 100%;
    border-radius: 5px;
  }
  .tui-datepicker-input > input.date-input {
    height: 45px;
    padding: 0.313rem 1.25rem;
    cursor: pointer;
    font-size: 14px;
  }
  .tui-timepicker-select {
    padding-top: 2px;
  }
  .my-schedule .bootstrap-select > .dropdown-toggle:nth-of-type(2) {
    display: none;
  }

  @media (max-width: 767px) {
    .container, .container .col-lg-12 {
      padding-right: 0;
      padding-left: 0;
    }
    #menu-navi {
      white-space: nowrap;
    }
    .fc-toolbar {
      flex-wrap: wrap;
    }
    .fc-toolbar.fc-header-toolbar {
      overflow-x: visible;
    }
  }
</style>
<style>
@import "tui-calendar/dist/tui-calendar.css";
.tui-full-calendar-popup-detail .tui-full-calendar-popup-container {
  color: #333;
  font-weight: 400;
}
.toast-warning {
  top: 3.8em;
}
@media (max-width: 425px) {
  #calendar .tui-full-calendar-timegrid-left,
  #calendar .tui-full-calendar-daygrid-layout > .tui-full-calendar-task-left.tui-full-calendar-left {
    width: 53px !important;
  }
  #calendar .tui-full-calendar-timegrid-right {
    margin-left: 54px !important;
  }
}
</style>

<style scoped lang="css" src="../assets/css/icons.css"></style>
