<template>
  <div class="content-page">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="py-4 border-bottom">
            <div class="form-title text-center">
              <h3>My Schedule</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <h4 class="mb-3">Choose A Schedule Below</h4>
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
                    <li><div class="item mb-2"><i class="ri-pencil-line mr-3"></i>Edit</div></li>
                    <li><div class="item"><i class="ri-delete-bin-6-line mr-3"></i>Delete</div></li>
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
            </div>
            <div class="create-workform">
              <a href="#" data-toggle="modal" data-target="#modal-new-schedule" id="btn-new-schedule" class="btn btn-primary pr-5 position-relative">
                New Schedule
                <span class="add-btn"><i class="ri-add-line"></i></span>
              </a>
            </div>
          </div>
          <h4 class="mb-3">Set Your weekly hours</h4>
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
                          today
                        </button>
                      </div>
                      <div class="fc-center">
                        <h2 id="renderRange">April 2022</h2>
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
                                <i class="calendar-icon ic_view_day"></i>Daily
                              </a>
                            </li>
                            <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                <i class="calendar-icon ic_view_week"></i>Weekly
                              </a>
                            </li>
                            <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                <i class="calendar-icon ic_view_month"></i>Month
                              </a>
                            </li>
                            <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                <i class="calendar-icon ic_view_week"></i>2 weeks
                              </a>
                            </li>
                            <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                <i class="calendar-icon ic_view_week"></i>3 weeks
                              </a>
                            </li>
                            <li role="presentation" class="dropdown-divider"></li>
                            <li role="presentation">
                              <a role="menuitem" data-action="toggle-workweek">
                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                <span class="checkbox-title"></span>Show weekends
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" data-action="toggle-start-day-1">
                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                <span class="checkbox-title"></span>Start Week on Monday
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" data-action="toggle-narrow-weekend">
                                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                <span class="checkbox-title"></span>Narrower than weekdays
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
    <div class="modal fade" id="modal-new-schedule" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="popup text-left">
              <h4 class="mb-3">Adicionar Horário</h4>
              <form action="/" id="submit-schedule" @submit.prevent="">
                <div class="content create-workform row">
                  <div class="col-md-6 mb-2">
                    <select id="dropdownMenu-calendars-list" class="selectpicker">
                      <option v-for="job in calendarList" :key="job.id"
                        class="tui-full-calendar-popup-section-item tui-full-calendar-dropdown-menu-item"
                        :data-action="job.id" :data-content="`
                          <span class='tui-full-calendar-icon tui-full-calendar-calendar-dot' style='background-color: ${job.bgColor}'></span>
                          <span class='tui-full-calendar-content'>${job.name}</span>
                        `">
                      </option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-label" for="schedule-title">Funcionário</label>
                      <input class="form-control" placeholder="Digite o Nome" type="text" id="schedule-title" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="schedule-start-date">Start Date</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="schedule-start-date" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="startpicker-container" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-label" for="schedule-end-date">End Date</label>
                      <div class="tui-datepicker-input tui-datetime-input tui-has-focus">
                        <input type="text" class="form-control date-input" id="schedule-end-date" aria-label="Date-Time" required>
                        <span class="tui-ico-date"></span>
                      </div>
                      <div id="endpicker-container" style="margin-top: -1px;"></div>
                    </div>
                  </div>
                  <div class="col-md-12 mt-4">
                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                      <button class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</button>
                      <button class="btn btn-outline-primary" type="submit" id="btn-save-schedule">Salvar</button>
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

<script>
import Calendar from 'tui-calendar';
import DatePicker from 'tui-date-picker';
import throttle from 'tui-code-snippet/tricks/throttle';
import axios from '@/axios'

import { CalendarList, CalendarInfo } from '@/assets/js/data/calendars';
import { generateSchedule, ScheduleList } from '@/assets/js/data/schedules';

export default {
  name: 'MyScheduleView',
  data() {
    return {
      calendar: null,
      useCreationPopup: true,
      useDetailPopup: true,
      datePicker: null,
      selectedCalendar: null,
      jobs: [],
      calendarList: [],
      resizeThrottled: null
    }
  },
  mounted() {
    // makeCalendar()
    // submitCalendar()
    $('.selectpicker').selectpicker()

    const getTimeTemplate = (schedule, isAllDay) => {
      return this.getTimeTemplate(schedule, isAllDay);
    }

    this.calendar = new Calendar('#calendar', {
      defaultView: 'week',
      taskView: false,
      scheduleView: ['time'],
      useCreationPopup: this.useCreationPopup,
      useDetailPopup: this.useDetailPopup,
      template: {
        milestone(model) {
          return `<span class="calendar-font-icon ic-milestone-b"></span>
                  <span style="background-color: ${model.bgColor} ">${model.title}</span>`;
        },
        allday(schedule) {
          return getTimeTemplate(schedule, true);
        },
        time(schedule) {
          return getTimeTemplate(schedule, false);
        }
      }
    })

    this.resizeThrottled = throttle(() => {
      this.calendar.render();
    }, 50);

    this.setEventHandlers()
    this.setDropdownCalendarType()
    this.setRenderRangeText()
    this.setEventListener()
    this.getJobs()

    window.calendar = this.calendar
  },
  methods: {
    setEventHandlers() {
      this.calendar.on({
        clickMore(e) {
          console.log('clickMore', e);
        },
        clickSchedule(e) {
          console.log('clickSchedule', e);
        },
        clickDayname(date) {
          console.log('clickDayname', date);
        },
        beforeCreateSchedule: e => {
          console.log('beforeCreateSchedule', e);
          this.saveNewSchedule(e);
        },
        beforeUpdateSchedule: e => {
          const schedule = e.schedule;
          const changes = e.changes;

          console.log('beforeUpdateSchedule', e);

          if (changes && !changes.isAllDay && schedule.category === 'allday') {
            changes.category = 'time';
          }

          this.calendar.updateSchedule(schedule.id, schedule.calendarId, changes);
          this.refreshScheduleVisibility();
        },
        beforeDeleteSchedule: e => {
          console.log('beforeDeleteSchedule', e);
          this.calendar.deleteSchedule(e.schedule.id, e.schedule.calendarId);
        },
        afterRenderSchedule: e => {
          const schedule = e.schedule;
          const element = this.calendar.getElement(schedule.id, schedule.calendarId);
          element
          // console.log('afterRenderSchedule', element);
        },
        clickTimezonesCollapseBtn: timezonesCollapsed => {
          console.log('timezonesCollapsed', timezonesCollapsed);

          if (timezonesCollapsed) {
            this.calendar.setTheme({
              'week.daygridLeft.width': '77px',
              'week.timegridLeft.width': '77px'
            });
          } else {
            this.calendar.setTheme({
              'week.daygridLeft.width': '60px',
              'week.timegridLeft.width': '60px'
            });
          }

          return true;
        }
      });
    },
    setCalendars() {
      const calendarList = document.getElementById('calendarList');
      const html = [];

      CalendarList.forEach(calendar => {
          html.push(
            `<div class="lnb-calendars-item">
              <label>
                <input type="checkbox" class="tui-full-calendar-checkbox-round" value="${calendar.id}" checked>
                <span style="border-color: ${calendar.borderColor}; background-color: ${calendar.borderColor};"></span>
                <span>${calendar.name}</span>
              </label>
            </div>`
          );
      });
      calendarList.innerHTML = html.join('\n');
    },
    getTimeTemplate(schedule, isAllDay) {
      const html = [];
      const start = moment(schedule.start.toUTCString());
      if (!isAllDay) {
        html.push('<strong>' + start.format('HH:mm') + '</strong> ');
      }

      if (schedule.isPrivate) {
        html.push('<span class="calendar-font-icon ic-lock-b"></span>');
        html.push(' Private');
      } else {
        if (schedule.isReadOnly) {
          html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
        } else if (schedule.recurrenceRule) {
          html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
        } else if (schedule.attendees.length) {
          html.push('<span class="calendar-font-icon ic-user-b"></span>');
        } else if (schedule.location) {
          html.push('<span class="calendar-font-icon ic-location-b"></span>');
        }
        html.push(' ' + schedule.title);
      }

      return html.join('');
    },
    onClickMenu(e) {
      const target = $(e.target).closest('a[role="menuitem"]')[0];
      const action = this.getDataAction(target);
      const options = this.calendar.getOptions();
      let viewName = '';

      console.log(target);
      console.log(action);
      switch (action) {
          case 'toggle-daily':
              viewName = 'day';
              break;
          case 'toggle-weekly':
              viewName = 'week';
              break;
          case 'toggle-monthly':
              options.month.visibleWeeksCount = 0;
              viewName = 'month';
              break;
          case 'toggle-weeks2':
              options.month.visibleWeeksCount = 2;
              viewName = 'month';
              break;
          case 'toggle-weeks3':
              options.month.visibleWeeksCount = 3;
              viewName = 'month';
              break;
          case 'toggle-narrow-weekend':
              options.month.narrowWeekend = !options.month.narrowWeekend;
              options.week.narrowWeekend = !options.week.narrowWeekend;
              viewName = this.calendar.getViewName();

              target.querySelector('input').checked = options.month.narrowWeekend;
              break;
          case 'toggle-start-day-1':
              options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
              options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
              viewName = this.calendar.getViewName();

              target.querySelector('input').checked = options.month.startDayOfWeek;
              break;
          case 'toggle-workweek':
              options.month.workweek = !options.month.workweek;
              options.week.workweek = !options.week.workweek;
              viewName = this.calendar.getViewName();

              target.querySelector('input').checked = !options.month.workweek;
              break;
          default:
              break;
      }

      this.calendar.setOptions(options, true);
      this.calendar.changeView(viewName, true);

      this.setDropdownCalendarType();
      this.setRenderRangeText();
      this.setSchedules();
    },
    onClickNavi(e) {
      const action = this.getDataAction(e.target);

      switch (action) {
          case 'move-prev':
            this.calendar.prev();
            break;
          case 'move-next':
            this.calendar.next();
            break;
          case 'move-today':
            this.calendar.today();
            break;
          default:
            return;
      }

      this.setRenderRangeText();
      this.setSchedules();
    },
    onNewSchedule() {
      const title = $('#schedule-title').val();
      // const location = $('#new-schedule-location').val();
      const location = ''
      // const isAllDay = document.getElementById('new-schedule-allday').checked;
      const isAllDay = false
      const start = this.datePicker.getStartDate();
      const end = this.datePicker.getEndDate();
      const calendar = this.selectedCalendar ? this.selectedCalendar : Calendar[0];

      if (!title) {
        return;
      }

      this.calendar.createSchedules([{
        id: String(chance.guid()),
        calendarId: calendar.id,
        title,
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
        state: 'Busy'
      }]);

      $('#modal-new-schedule').modal('hide');
    },
    onChangeNewScheduleCalendar(e) {
      const target = e.target.options[e.target.selectedIndex]
      const calendarId = this.getDataAction(target)
      this.changeNewScheduleCalendar(calendarId)
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
    createNewSchedule(event) {
      const start = event.start ? new Date(event.start.getTime()) : new Date();
      const end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

      if (this.useCreationPopup) {
        this.calendar.openCreationPopup({
          start,
          end
        });
      }
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
      console.log(schedule);

      this.calendar.createSchedules([schedule]);

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
    refreshScheduleVisibility() {
      const calendarElements = Array.prototype.slice.call(
        document.querySelectorAll('#calendarList input')
      );

      CalendarList.forEach(calendar => {
        this.calendar.toggleSchedules(calendar.id, !calendar.checked, false);
      });

      this.calendar.render(true);

      calendarElements.forEach(input => {
        const span = input.nextElementSibling;
        span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
      });
    },
    setDropdownCalendarType() {
      const calendarTypeName = document.getElementById('calendarTypeName');
      const calendarTypeIcon = document.getElementById('calendarTypeIcon');
      const options = this.calendar.getOptions();
      let type = this.calendar.getViewName();
      let iconClassName;

      if (type === 'day') {
        type = 'Daily';
        iconClassName = 'calendar-icon ic_view_day';
      } else if (type === 'week') {
        type = 'Weekly';
        iconClassName = 'calendar-icon ic_view_week';
      } else if (options.month.visibleWeeksCount === 2) {
        type = '2 weeks';
        iconClassName = 'calendar-icon ic_view_week';
      } else if (options.month.visibleWeeksCount === 3) {
        type = '3 weeks';
        iconClassName = 'calendar-icon ic_view_week';
      } else {
        type = 'Monthly';
        iconClassName = 'calendar-icon ic_view_month';
      }

      calendarTypeName.innerHTML = type;
      calendarTypeIcon.className = iconClassName;
    },
    currentCalendarDate(format) {
      const currentDate = moment([
          this.calendar.getDate().getFullYear(),
          this.calendar.getDate().getMonth(),
          this.calendar.getDate().getDate()
      ]);

      return currentDate.format(format);
    },
    setRenderRangeText() {
      const renderRange = document.getElementById('renderRange');
      const options = this.calendar.getOptions();
      const viewName = this.calendar.getViewName();

      const html = [];
      if (viewName === 'day') {
        html.push(this.currentCalendarDate('YYYY.MM.DD'));
      } else if (
        viewName === 'month' &&
        (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)
      ) {
        html.push(this.currentCalendarDate('YYYY.MM'));
      } else {
        html.push(moment(this.calendar.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
        html.push(' ~ ');
        html.push(moment(this.calendar.getDateRangeEnd().getTime()).format(' MM.DD'));
      }

      renderRange.innerHTML = html.join('');
    },
    setSchedules() {
      this.calendar.clear();
      generateSchedule
      // função para gerar horários aleatórios
      // generateSchedule(
      //   this.calendar.getViewName(),
      //   this.calendar.getDateRangeStart(),
      //   this.calendar.getDateRangeEnd()
      // );
      this.calendar.createSchedules(ScheduleList);

      this.refreshScheduleVisibility();
    },
    setDateTimePicker() {
      $('#dropdownMenu-calendars-list').selectpicker('refresh')
      $('#dropdownMenu-calendars-list').change()

      this.datePicker = new DatePicker.createRangePicker({
        startpicker: {
          date: new Date(),
          input: '#schedule-start-date',
          container: '#startpicker-container'
        },
        endpicker: {
          date: new Date(),
          input: '#schedule-end-date',
          container: '#endpicker-container'
        },
        format: 'dd/MM/yyyy HH:mm',
        timePicker: {
          showMeridiem: false
        }
      })
    },
    setEventListener() {
      $('#menu-navi').on('click', this.onClickNavi);
      $('.dropdown-menu a[role="menuitem"]').on('click', this.onClickMenu);
      $('#lnb-calendars').on('change', this.onChangeCalendars);

      $('#btn-save-schedule').on('click', this.onNewSchedule);
      $('#btn-new-schedule').on('click', this.createNewSchedule);

      $('#dropdownMenu-calendars-list').on('change', this.onChangeNewScheduleCalendar);

      $('#modal-new-schedule').on('shown.bs.modal', this.setDateTimePicker);

      window.addEventListener('resize', this.resizeThrottled);
    },
    getDataAction(target) {
      return target.dataset ? target.dataset.action : target.getAttribute('data-action');
    },
    getJobs() {
      axios.get('v1/jobs')
        .then(response => {
          this.jobs = response.data
          CalendarInfo.createCalendar(this.jobs)
          this.setCalendars()
          this.calendar.setCalendars(CalendarList)
          this.setSchedules();
          this.calendarList = CalendarList
        })
        .catch(error => {
          console.log(error.response);
        })
    }
  }
}
</script>

<style scoped>
  @import '@/assets/vendor/fullcalendar/core/main.css';
  @import '@/assets/vendor/fullcalendar/daygrid/main.css';
  @import '@/assets/vendor/fullcalendar/timegrid/main.css';
  @import '@/assets/vendor/fullcalendar/list/main.css';

  @import "tui-calendar/dist/tui-calendar.css";

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
  .tui-full-calendar-button.tui-full-calendar-section-private {
    padding-top: 4px;
  }
  .tui-full-calendar-popup-section-item {
    font-size: inherit;
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
</style>

<style scoped lang="css" src="@/assets/css/icons.css"></style>
