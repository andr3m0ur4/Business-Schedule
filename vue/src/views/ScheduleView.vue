<template>
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
          <h4 class="mb-3">Escolha uma Escala Abaixo</h4>
          <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <div class="form-group mb-0">
                <select name="type" class="selectpicker form-control" data-style="py-0">
                  <option>Working Hours</option>
                  <option>Default Hours</option>
                  <option>Working Hours</option>
                  <option>Learning Hours</option>
                </select>
              </div>
              <div class="select-dropdown input-prepend input-append">
                <div class="btn-group">
                  <label data-toggle="dropdown">
                    <span class="dropdown-toggle search-query rounded btn bg-white btn-edit"><i class="las la-edit mr-0 text-center"></i></span><span class="search-replace"></span>
                    <span class="caret"><!--icon--></span>
                  </label>
                  <ul class="dropdown-menu w-100 border-none p-3">
                    <li><div class="item mb-2"><i class="ri-pencil-line mr-3"></i>Editar</div></li>
                    <li><div class="item"><i class="ri-delete-bin-6-line mr-3"></i>Excluir</div></li>
                  </ul>
                </div>
              </div>
            </div>
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
            <div>
              <button class="btn btn-success" @click="saveSchedulePopup()">Atualizar Escala</button>
            </div>
            <div class="select-dropdown input-prepend input-append">
              <div class="btn-group">
                <div class="create-workform">
                  <label data-toggle="dropdown">
                    <a href="#" class="btn btn-primary pr-5 position-relative">
                      Novo Horário
                      <span class="add-btn"><i class="ri-add-line"></i></span>
                    </a>
                  </label>
                  <ul class="dropdown-menu new-schedule w-100 border-none p-3">
                    <li>
                      <div class="item mb-2" data-toggle="modal" @click="openModalNewSchedule">
                        <i class="ri-user-add-fill mr-3"></i>Horário de Funcionário
                      </div>
                    </li>
                    <li>
                      <div class="item" data-toggle="modal" data-target="#modal-new-task" id="btn-new-task">
                        <i class="ri-tv-2-line mr-3"></i>Horário de Programa
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <h4 class="mb-3">Defina os Horários de Trabalho</h4>
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-block card-stretch">
                <div class="card-body">
                  <div class="fc fc-ltr fc-unthemed">
                    <div class="fc-toolbar fc-header-toolbar">
                      <div class="fc-left" id="menu-navi">
                        <div class="fc-button-group">
                          <button type="button" class="fc-prev-button fc-button fc-button-primary" aria-label="prev" data-action="move-prev">
                            <span class="fc-icon fc-icon-chevron-left" data-action="move-prev"></span>
                          </button>
                          <button type="button" class="fc-next-button fc-button fc-button-primary" aria-label="next" data-action="move-next">
                            <span class="fc-icon fc-icon-chevron-right" data-action="move-next"></span>
                          </button>
                        </div>
                        <button type="button" class="fc-today-button fc-button fc-button-primary" data-action="move-today">
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
                  <div id="calendar" class="calendar-s" style="height: 848px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-new-schedule" tabindex="-1" role="dialog" aria-hidden="true" ref="modalSchedule">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">
                <span ref="labelSchedule">Adicionar</span> Horário de Funcionário
              </h4>
              <form action="/" id="submit-schedule" @submit.prevent="" ref="formSchedule">
                <div class="content create-workform row">
                  <div class="col-md-6 mb-2">
                    <select id="dropdownMenu-calendars-list" class="selectpicker" @change="filterEmployees" ref="dropdownMenuCalendarsList">
                      <option v-for="calendar in calendarList" :key="calendar.id"
                        class="tui-full-calendar-popup-section-item tui-full-calendar-dropdown-menu-item"
                        :data-action="calendar.id" :value="calendar.id" :data-content="`
                          <span class='tui-full-calendar-icon tui-full-calendar-calendar-dot' style='background-color: ${calendar.bgColor}'></span>
                          <span class='tui-full-calendar-content'>${calendar.name}</span>
                        `">
                      </option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="schedule-title">Funcionário</label>
                      <select class="selectpicker form-control" id="schedule-title"
                        v-model="selectedEmployee" title="Digite o Nome" data-live-search="true" required>
                        <option v-for="employee in employeesByJobs" :key="employee.id" :data-action="employee.id" :value="employee">
                          {{ employee.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="schedule-title">Horários de Programas</label>
                      <select class="selectpicker form-control" id="select-tvshow-time" title="Informe o Nome do Programa"
                        v-model="selectedTvShowTimes" data-live-search="true" multiple data-multiple-separator=" | ">
                        <option v-for="tvShowTime in tvShowTimesByRange(tvShowTimes)" :key="tvShowTime.id" :value="tvShowTime.id">
                          {{ tvShowTime.tvShow.name }}: {{ dateTime(tvShowTime.start) }} ~ {{ time(tvShowTime.end) }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="start-schedule">Horário Inicial</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="start-schedule" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="startpicker-container-schedule" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="end-schedule">Horário Final</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="end-schedule" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="endpicker-container-schedule" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-12 mt-4">
                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                      <button class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</button>
                      <button v-if="newSchedule" class="btn btn-outline-primary" type="submit" @click="onNewSchedule">Salvar</button>
                      <button v-else class="btn btn-outline-primary" type="submit" @click="onUpdateSchedule">Salvar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-new-task" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">
                <span id="label-task">Adicionar</span> Horário de Programa
              </h4>
              <form action="/" id="submit-task" @submit.prevent="">
                <div class="content create-workform row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="tv-show-title">Programa</label>
                      <select class="selectpicker form-control" id="tv-show-title" v-model="selectedTvShow" title="Digite o Nome" data-live-search="true" required>
                        <option v-for="tvShow in tvShows" :key="tvShow.id" :data-action="tvShow.id" :value="tvShow">
                          {{ tvShow.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="studio-title">Estúdio</label>
                      <select class="selectpicker form-control" id="studio-title" v-model="selectedStudio" title="Digite o Nome" data-live-search="true" required>
                        <option v-for="studio in studios" :key="studio.id" :data-action="studio.id" :value="studio">
                          {{ studio.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="switcher-title">Switcher</label>
                      <select class="selectpicker form-control" id="switcher-title" v-model="selectedSwitcher" title="Digite o Nome" data-live-search="true" required>
                        <option v-for="switcher in switchers" :key="switcher.id" :data-action="switcher.id" :value="switcher">
                          {{ switcher.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="start-task">Horário Inicial</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="start-task" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="startpicker-container-task" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="end-task">Horário Final</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="end-task" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="endpicker-container-task" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-12 mt-4">
                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                      <button class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</button>
                      <button v-if="newTask" class="btn btn-outline-primary" type="submit" @click="onNewTask">Salvar</button>
                      <button v-else class="btn btn-outline-primary" type="submit" @click="onUpdateTask">Salvar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import DatePicker from 'tui-date-picker';
import axios from '@/http';
import { POSITION, useToast } from "vue-toastification";
import { getCalendar, getSelectedCalendar, openCreationPopup, pushSchedule, setDateTimePicker, setSchedules, startCalendar, startCalendarMenu } from '../assets/js/app-calendar';

import { CalendarList, CalendarInfo } from '../assets/js/data/calendars';
import { ScheduleList, ScheduleInfo } from '../assets/js/data/schedules';
import { computed, watchEffect } from '@vue/runtime-core';
import { useStore } from '../store';
import { GET_EMPLOYEES, GET_EMPLOYEES_TIMES, GET_JOBS, INSERT_EMPLOYEE_TIME } from '../store/action-types';
import IEmployeeTime from '../interfaces/IEmployeeTime';

export default {
  name: 'MyScheduleView',
  data() {
    return {
      datePicker: null,
      datePickerTask: null,
      selectedSchedule: {},
      selectedCalendar: {},
      selectedEmployee: {},
      selectedTvShow: {},
      selectedStudio: {},
      selectedSwitcher: {},
      selectedTvShowTimes: [],
      employees: [],
      employeesByJobs: [],
      tvShows: [],
      studios: [],
      switchers: [],
      tvShowTimes: [],
      isEmployeeTime: false,
      isTvShowTime: false,
      calendarList: [],
      scheduleList: [],
      // text: '',
      resizeThrottled: null,
      newSchedule: true,
      newTask: true,
      start: null,
      end: null,
      scheduleNotSaved: false,
      toastId: null
    }
  },
  mounted() {
    $('.selectpicker').selectpicker();
    $('.my-schedule .bootstrap-select > .dropdown-toggle').eq(1).hide();

    startCalendar(this);
    this.setDateTimePicker();

    // this.resizeThrottled = util.throttle(() => {
    //   this.calendar.render();
    // }, 50);

    // this.getJobs();
    // this.getUsers();
    // this.getTvShows();
    // this.getStudios();
    // this.getSwitchers();

    window.calendar = getCalendar();
  },
  methods: {
    onNewSchedule() {
      if (!$(this.$refs.formSchedule).get(0).reportValidity()) {
        return false;
      }

      const title = this.selectedEmployee.name;
      const location = ''
      const isAllDay = false
      const start = this.datePicker.getStartDate();
      const end = this.datePicker.getEndDate();
      const calendar = getSelectedCalendar();
      const id = String(chance.guid());
      const schedules = [];

      // const employeeId = this.getDataAction($('#schedule-title').find(':selected').get(0));

      // const schedules = this.selectedTvShowTimes.map(tvShowTime => {
      //   return {
      //     tv_show_time: this.calendar.getSchedule(tvShowTime, '')
      //   };
      // });

      if (!title) {
        return;
      }

      getCalendar().createSchedules([{
        id,
        calendarId: calendar.id,
        title,
        raw: {
          employee: this.selectedEmployee,
          schedules
        },
        isAllDay,
        location,
        start,
        end,
        category: isAllDay ? 'allday' : 'time',
        dueDateClass: '',
        color: calendar.color,
        bgColor: calendar.bgColor,
        dragBgColor: calendar.bgColor,
        borderColor: calendar.borderColor,
        state: 'Private'
      }]);

      const schedule = getCalendar().getSchedule(id, calendar.id);
      this.createSchedule(schedule);

      $(this.$refs.modalSchedule).modal('hide');
    },
    onUpdateSchedule() {
      if (!$(this.$refs.formSchedule).get(0).reportValidity()) {
        return false;
      }

      const title = this.selectedEmployee.name;
      const id = this.selectedSchedule.id;
      const calendarId = this.selectedSchedule.calendarId;
      const start = this.datePicker.getStartDate();
      const end = this.datePicker.getEndDate();
      const calendar = this.selectedCalendar;

      if (!title || !id) {
        return;
      }

      // const schedules = this.selectedTvShowTimes.map(tvShowTime => {
      //   return {
      //     tv_show_time: this.calendar.getSchedule(tvShowTime, '')
      //   };
      // });

      getCalendar().updateSchedule(id, calendarId, {
        title,
        calendarId: calendar.id,
        raw: {
          employee: this.selectedEmployee,
          // schedules
        },
        start,
        end,
        category: 'time'
      });

      // alterar para atualizar no DB
      // this.updateStorage(id, calendar.id, calendarId);

      $(this.$refs.modalSchedule).modal('hide');
    },
    onNewTask() {
      if (!$('#submit-task').get(0).reportValidity()) {
        return false;
      }

      const id = String(chance.guid())
      const title = this.selectedTvShow.name;
      const location = this.selectedStudio.name;
      const start = this.datePickerTask.getStartDate();
      const end = this.datePickerTask.getEndDate();

      this.calendar.createSchedules([{
        id,
        location,
        title,
        start,
        end,
        category: 'task',
        state: 'Private',
        raw: {
          tvShow: this.selectedTvShow,
          studio: this.selectedStudio,
          switcher: this.selectedSwitcher
        }
      }]);

      this.saveStorage(id, '', 'tasks');

      $('#modal-new-task').modal('hide');
    },
    onUpdateTask() {
      const title = this.selectedTvShow.name;
      const location = this.selectedStudio.name;
      const id = this.selectedSchedule.id;
      const calendarId = '';
      const start = this.datePickerTask.getStartDate();
      const end = this.datePickerTask.getEndDate();
      console.log('title', title);
      console.log('id', id);

      if (!title || !id) {
        return;
      }

      this.calendar.updateSchedule(id, calendarId, {
        title,
        location,
        start,
        end,
        category: 'task',
        raw: {
          tvShow: this.selectedTvShow,
          studio: this.selectedStudio,
          switcher: this.selectedSwitcher
        }
      });

      this.updateStorage(id, '', calendarId, 'tasks');

      $('#modal-new-task').modal('hide');
    },
    filterEmployees(e) {
      const target = e.target.options[e.target.selectedIndex];
      const calendarId = target.getAttribute('data-action')
      this.employeesByJobs = this.employees.filter(employee => {
        return employee.job_id == calendarId;
      });
    },
    changeNewScheduleCalendar(calendarId) {
      const calendarNameElement = document.getElementById('calendarName');
      const calendar = CalendarInfo.findCalendar(calendarId);
      const html = [];

      html.push(
        `<span
          class="calendar-bar"
          style="background-color: ${calendar.bgColor}; border-color:${calendar.borderColor};"
        ></span>`
      );
      html.push(`<span class="calendar-name">${calendar.name}</span>`);

      // calendarNameElement.innerHTML = html.join('');
      calendarNameElement

      this.selectedCalendar = calendar
    },
    createNewTask(event) {
      $('#submit-task').trigger('reset');
      $('#label-task').text('Adicionar');
      this.newTask = true;
      this.selectedTvShow = null;
      this.selectedStudio = null;
      this.selectedSwitcher = null;

      const start = event.start ? new Date(event.start.getTime()) : new Date();
      const end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();
      this.datePickerTask.setStartDate(start);
      this.datePickerTask.setEndDate(end);
    },
    saveNewSchedule(scheduleData) {
      const calendar = scheduleData.calendar || CalendarInfo.findCalendar(scheduleData.calendarId);
      const schedule = {
        id: String(chance.guid()),
        title: scheduleData.title,
        isAllDay: scheduleData.isAllDay,
        start: scheduleData.start,
        end: scheduleData.end,
        category: scheduleData.isAllDay ? 'allday' : 'time',
        dueDateClass: '',
        color: calendar.color,
        bgColor: calendar.bgColor,
        dragBgColor: calendar.bgColor,
        borderColor: calendar.borderColor,
        location: scheduleData.location,
        isPrivate: scheduleData.isPrivate,
        state: scheduleData.state
      };

      if (calendar) {
        schedule.calendarId = calendar.id;
        schedule.color = calendar.color;
        schedule.bgColor = calendar.bgColor;
        schedule.borderColor = calendar.borderColor;
      }

      this.calendar.createSchedules([schedule]);
      this.saveStorage(schedule.id, calendar.id);

      this.refreshScheduleVisibility();
    },
    onChangeCalendars(e) {
      const calendarId = e.target.value;
      const checked = e.target.checked;
      const viewAll = document.querySelector('.lnb-calendars-item input');
      const calendarElements = Array.prototype.slice.call(
        document.querySelectorAll('#calendarList input')
      );
      let allCheckedCalendars = true;

      if (calendarId === 'all') {
        allCheckedCalendars = checked;

        calendarElements.forEach(input => {
          const span = input.parentNode;
          input.checked = checked;
          span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
        });

        CalendarList.forEach(calendar => {
          calendar.checked = checked;
        });
      } else {
        CalendarInfo.findCalendar(calendarId).checked = checked;

        allCheckedCalendars = calendarElements.every(input => {
          return input.checked;
        });

        if (allCheckedCalendars) {
          viewAll.checked = true;
        } else {
          viewAll.checked = false;
        }
      }

      this.refreshScheduleVisibility();
    },
    // filterByText() {
    //   if (!this.text) {
    //     return;
    //   }
    //   this.calendar.trigger('afterRenderSchedule');
    // },
    refreshScheduleVisibility() {
      const calendarElements = Array.prototype.slice.call(
        document.querySelectorAll('#calendarList input')
      );

      CalendarList.forEach(calendar => {
        this.calendar.toggleSchedules(calendar.id, !calendar.checked, false);
      });

      this.calendar.render(true);

      const schedules = JSON.parse(this.$ls.get('schedules', '[]'));
      if (schedules.length > 0) {
        this.scheduleNotSaved = true;
      } else {
        this.scheduleNotSaved = false;
      }

      calendarElements.forEach(input => {
        const span = input.nextElementSibling;
        span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
      });
    },
    currentCalendarDate(format) {
      const currentDate = moment([
          this.calendar.getDate().getFullYear(),
          this.calendar.getDate().getMonth(),
          this.calendar.getDate().getDate()
      ]);

      return currentDate.format(format);
    },
    setSchedules(employeeTimes) {
      // aqui os horarios dos funcionários são recuperados
      // chamar setSchedules de app-calendar.js
      setSchedules(employeeTimes);
    },
    setDateTimePicker() {
      this.datePicker = setDateTimePicker({
        startInput: '#start-schedule',
        startContainer: '#startpicker-container-schedule',
        endInput: '#end-schedule',
        endContainer: '#endpicker-container-schedule'
      });
      return;
      this.datePickerTask = new DatePicker.createRangePicker({
        startpicker: {
          date: new Date(),
          input: '#start-task',
          container: '#startpicker-container-task'
        },
        endpicker: {
          date: new Date(),
          input: '#end-task',
          container: '#endpicker-container-task'
        },
        format: 'dd/MM/yyyy HH:mm',
        timePicker: {
          showMeridiem: false
        }
      })
    },
    getDataAction(target) {
      return target.dataset ? target.dataset.action : target.getAttribute('data-action');
    },
    saveStorage(id, calendarId, category = 'schedules') {
      const schedule = this.calendar.getSchedule(id, calendarId);
      const schedules = JSON.parse(this.$ls.get(category, '[]'));
      schedules.push(schedule);
      this.$ls.set(category, JSON.stringify(schedules));

      if (schedules.length > 0) {
        this.scheduleNotSaved = true;
      }
    },
    updateStorage(id, calendarId, oldCalendarId, category = 'schedules') {
      const schedule = this.calendar.getSchedule(id, calendarId);
      let schedules = JSON.parse(this.$ls.get(category, '[]'));

      schedules = schedules.map(item => {
        if (item.id == id && item.calendarId == oldCalendarId) {
          item = schedule;
        }
        return item;
      });

      this.scheduleNotSaved = true;

      this.$ls.set(category, JSON.stringify(schedules));
    },
    deleteStorage(id, calendarId, category = 'schedules') {
      let schedules = JSON.parse(this.$ls.get(category, '[]'));

      schedules = schedules.filter(item => {
        return !(item.id == id && item.calendarId == calendarId);
      });

      const removedItem = {
        id,
        isVisible: false
      };
      this.addRemovedItems(removedItem, `removed-${category}`);

      if (schedules.length == 0) {
        this.scheduleNotSaved = false;
      }

      this.$ls.set(category, JSON.stringify(schedules));
    },
    removeStorage(category = 'removed-schedules') {
      this.$ls.remove(category);
    },
    addRemovedItems(schedule, category = 'removed-schedules') {
      const schedules = JSON.parse(this.$ls.get(category, '[]'));
      schedules.push(schedule);
      this.$ls.set(category, JSON.stringify(schedules));
    },
    getRemovedItems(schedules, category = 'removed-schedules') {
      const removedItems = JSON.parse(this.$ls.get(category, '[]'));
      return schedules.concat(removedItems);
    },
    clearRangeStorage(category = 'schedules') {
      const start = this.calendar.getDateRangeStart().toDate();
      const end = moment(this.calendar.getDateRangeEnd().toDate()).add({
        hours: 23,
        minutes: 23,
        seconds: 59
      }).toDate();

      const schedules = JSON.parse(this.$ls.get(category, '[]'));
      const currentSchedules = schedules.filter(schedule => {
        return !moment(moment(schedule.start._date).toDate()).isBetween(start, end);
      });
      this.$ls.set(category, JSON.stringify(currentSchedules));
    },
    createSchedule(schedule) {
      const employeeTime = {} as IEmployeeTime;
      employeeTime.id = schedule.id;
      employeeTime.start = this.formatDate(schedule.start.toDate());
      employeeTime.end = this.formatDate(schedule.end.toDate());
      employeeTime.user_id = schedule.raw.employee.id;
      this.saveEmployeeTime(employeeTime);
    },
    saveEmployeeTime(employeeTime: IEmployeeTime) {
      this.store.dispatch(INSERT_EMPLOYEE_TIME, employeeTime)
        .then(() => this.renderToastSuccess('Muito bom! Horário de funcionário salvo com sucesso.'));
    },
    getTvShows() {
      axios.get('v1/tv-shows')
        .then(response => {
          this.tvShows = response.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    getStudios() {
      axios.get('v1/studios')
        .then(response => {
          this.studios = response.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    getSwitchers() {
      axios.get('v1/switchers')
        .then(response => {
          this.switchers = response.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    saveSchedulePopup() {
      // validar horarios dos funcionarios
      this.$swal({
        title: 'Deseja salvar as modificações na Escala?',
        icon: 'question',
        text: 'Ao salvar a Escala, ela será imediatamente disponibilizada aos funcionários!',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Salvar',
        denyButtonText: 'Não salvar',
      })
        .then(result => {
          if (result.isConfirmed) {
            this.saveSchedule();
          } else if (result.isDenied) {
            this.$swal('As modificações não foram salvas', '', 'info');
          }
        });
    },
    saveSchedule() {
      this.scheduleList = [];
      this.calendar.setDate(this.calendar.getDate());

      const unwatch = this.$watch(() => this.scheduleList.length, () => {
        let schedules = this.scheduleList.filter(schedule => {
          if (schedule.category != 'time' || !schedule.raw) {
            return null;
          }

          schedule.startDateTime = this.formatDate(schedule.start.toDate());
          schedule.endDateTime = this.formatDate(schedule.end.toDate());
          return schedule;
        });
        schedules = this.getRemovedItems(schedules, 'removed-schedules');
        // console.log(schedules);

        let tasks = this.scheduleList.filter(schedule => {
          if (schedule.category != 'task' || !schedule.raw) {
            return null;
          }

          schedule.startDateTime = this.formatDate(schedule.start.toDate());
          schedule.endDateTime = this.formatDate(schedule.end.toDate());
          return schedule;
        });
        tasks = this.getRemovedItems(tasks, 'removed-tasks');
        // console.log(tasks);

        axios.post('v1/tv-show-times/save', tasks)
          .then(response => {
            this.removeStorage('removed-tasks');
            axios.post('v1/employee-times/save', schedules)
              .then(response => {
                this.$swal('Bom trabalho!', 'Os horários foram salvos com sucesso.', 'success');
                this.removeStorage();
                this.clearRangeStorage();
                this.clearRangeStorage('tasks');
                this.setSchedules();
              })
              .catch(error => {
                console.log(error.response);
              })
              .finally(() => {
                unwatch();
              });
          })
          .catch(error => {
            console.log(error.response);
          })
          .finally(() => {
            unwatch();
          });
      });
    },
    tvShowTimesByRange(tvShowTimes) {
      if (this.calendar) {
        const start = this.calendar.getDateRangeStart().toDate();
        const end = moment(this.calendar.getDateRangeEnd().toDate()).add({
          hours: 23,
          minutes: 23,
          seconds: 59
        }).toDate();

        return tvShowTimes.filter(tvShowTime => {
          return moment(tvShowTime.start).isBetween(start, end);
        });
      }

      return tvShowTimes;
    },
    formatDate(value) {
      if (value) {
        return moment(value).format('YYYY-MM-DD HH:mm:ss');
      }
    },
    dateTime(value) {
      return moment(value).format('DD/MM HH:mm');
    },
    time(value) {
      return moment(value).format('HH:mm');
    },
    openModalNewSchedule() {
      const start = event.start ? new Date(event.start.getTime()) : new Date();
      const end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

      openCreationPopup.call(this, {
        create: true,
        start,
        end
      })
    },
    renderToastSuccess(message: string) {
      const toast = useToast();
      toast.success(
        message, {
        position: POSITION.TOP_RIGHT,
        timeout: 5000,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: false,
        closeButton: 'button',
        icon: true,
        rtl: false
      });
    }
  },
  watch: {
    employeesByJobs() {
      this.$nextTick(() => {
        $('#schedule-title').selectpicker('refresh');
      });
    },
    calendarList() {
      this.$nextTick(() => {
        $('#dropdownMenu-calendars-list').selectpicker('refresh');
      })
    },
    tvShows() {
      this.$nextTick(() => {
        $('#tv-show-title').selectpicker('refresh');
      });
    },
    studios() {
      this.$nextTick(() => {
        $('#studio-title').selectpicker('refresh');
      });
    },
    switchers() {
      this.$nextTick(() => {
        $('#switcher-title').selectpicker('refresh');
      });
    },
    tvShowTimes() {
      this.$nextTick(() => {
        $('#select-tvshow-time').selectpicker('refresh');
      })
    },
    selectedTvShow() {
      this.$nextTick(() => {
        $('#tv-show-title').selectpicker('refresh');
      });
    },
    selectedStudio() {
      this.$nextTick(() => {
        $('#studio-title').selectpicker('refresh');
      });
    },
    selectedSwitcher() {
      this.$nextTick(() => {
        $('#switcher-title').selectpicker('refresh');
      });
    },
    selectedTvShowTimes() {
      this.$nextTick(() => {
        $('#select-tvshow-time').selectpicker('refresh');
      });
    },
    scheduleNotSaved() {
      const toast = useToast();
      toast.clear();

      if (!this.scheduleNotSaved) {
        toast.dismiss(this.toastId);
        return;
      }

      this.toastId = toast.warning(
        'Atenção! Existem "horários" que ainda não foram salvos, clique em Atualizar Escala para salvá-los definitivamente!', {
        position: 'top-right',
        timeout: false,
        closeOnClick: true,
        pauseOnFocusLoss: true,
        pauseOnHover: true,
        draggable: true,
        draggablePercent: 0.6,
        showCloseButtonOnHover: false,
        hideProgressBar: true,
        closeButton: "button",
        icon: true,
        rtl: false,
        toastClassName: 'toast-warning'
      });
    },
    jobs(newJobs, oldJobs) {
      this.calendarList = startCalendarMenu(newJobs);
    },
    employeeTimes(newEmployeeTimes, oldEmployeeTimes) {
      this.setSchedules(newEmployeeTimes);
    }
  },
  setup() {
    const store = useStore();
    store.dispatch(GET_JOBS);
    store.dispatch(GET_EMPLOYEES);
    store.dispatch(GET_EMPLOYEES_TIMES);

    return {
      jobs: computed(() => store.getters.getJobs),
      employees: computed(() => store.getters.getEmployees),
      employeeTimes: computed(() => store.getters.getEmployeesTimes),
      store
    }
  }
}
</script>

<style scoped>
  @import '../assets/vendor/fullcalendar/core/main.css';
  @import '../assets/vendor/fullcalendar/daygrid/main.css';
  @import '../assets/vendor/fullcalendar/timegrid/main.css';
  @import '../assets/vendor/fullcalendar/list/main.css';

  @import '../assets/vendor/tui-calendar/dist/tui-calendar.css';

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
</style>
<style>
  .tui-full-calendar-popup-detail .tui-full-calendar-popup-container {
    color: #333;
    font-weight: 400;
  }
  .toast-warning {
    top: 3.8em;
  }
</style>

<style scoped lang="css" src="@/assets/css/icons.css"></style>

  function moment(arg0: any[]) {
    throw new Error('Function not implemented.');
  }
