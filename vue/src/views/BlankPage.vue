<template>
  <div class="content-page">
    <div class="container-fluid container">
  <div class="row">
    <div class="col-lg-12">

      <div id="calendar" style="height: 800px;"></div>

    </div>
  </div>
    </div>
  </div>
</template>

<script>
import Calendar from 'tui-calendar'; /* ES6 */

export default {
  name: 'BlankPage',
  data() {
    return {
      calendar: null,
      calendarList: [
          {
            id: '0',
            name: 'home'
          },
          {
            id: '1',
            name: 'office'
          }
      ],
      scheduleList: [
          {
            id: '1',
            calendarId: '1',
            title: 'my schedule',
            category: 'time',
            dueDateClass: '',
            start: '2022-04-18T22:30:00+09:00',
            end: '2022-04-19T02:30:00+09:00'
          },
          {
            id: '2',
            calendarId: '1',
            title: 'second schedule',
            category: 'time',
            dueDateClass: '',
            start: '2022-04-18T17:30:00+09:00',
            end: '2022-04-19T17:31:00+09:00'
          }
      ],
      view: 'week',
      taskView: true,
      scheduleView: ['time'],
      theme: {
        'month.dayname.height': '30px',
        'month.dayname.borderLeft': '1px solid #ff0000',
        'month.dayname.textAlign': 'center',
        'week.today.color': '#333',
        'week.daygridLeft.width': '100px',
        'week.timegridLeft.width': '100px'
      },
      week: {
          narrowWeekend: true,
          showTimezoneCollapseButton: true,
          timezonesCollapsed: false
      },
      month: {
          visibleWeeksCount: 6,
          startDayOfWeek: 1
      },
      timezones: [{
          timezoneOffset: 540,
          displayLabel: 'GMT+09:00',
          tooltip: 'Seoul'
      }, {
          timezoneOffset: -420,
          displayLabel: 'GMT-08:00',
          tooltip: 'Los Angeles'
      }],
      disableDblClick: false,
      isReadOnly: false,
      template: {
          milestone: function(schedule) {
              return `<span style="color:red;">${schedule.title}</span>`;
          },
          milestoneTitle: function() {
              return 'MILESTONE';
          },
      },
      useCreationPopup: true,
      useDetailPopup: true,
    }
  },
  methods: {
    onAfterRenderSchedule() {
      console.log('onAfterRenderSchedule');
    },
    onClickSchedule() {
      console.log('here');
        // this.$refs.tuiCalendar.invoke('today');
    },
    onClickDayname() {
      console.log('dayname');
    }
  },
  mounted() {
    this.calendar = new Calendar('#calendar', {
      defaultView: 'week',
      taskView: true,
      scheduleView: ['time'],
      theme: {
        'month.dayname.height': '30px',
        'month.dayname.borderLeft': '1px solid #ff0000',
        'month.dayname.textAlign': 'center',
        'week.today.color': '#333',
        'week.daygridLeft.width': '100px',
        'week.timegridLeft.width': '100px'
      },
      week: {
          narrowWeekend: true,
          showTimezoneCollapseButton: true,
          timezonesCollapsed: false
      },
      month: {
          visibleWeeksCount: 6,
          startDayOfWeek: 1
      },
      timezones: [{
          timezoneOffset: 540,
          displayLabel: 'GMT+09:00',
          tooltip: 'Seoul'
      }, {
          timezoneOffset: -420,
          displayLabel: 'GMT-08:00',
          tooltip: 'Los Angeles'
      }],
      disableDblClick: true,
      isReadOnly: false,
      template: {
          milestone: function(schedule) {
              return `<span style="color:red;">${schedule.title}</span>`;
          },
          milestoneTitle: function() {
              return 'MILESTONE';
          },
          popupSave: function() {
            return 'Save';
          },
      },
      useCreationPopup: true,
      useDetailPopup: true,
    });

    this.calendar.createSchedules(this.scheduleList)

    this.calendar.on('clickSchedule', function(event) {
        console.log(event);
    });

    this.calendar.createSchedules([
      {
          id: '3',
          calendarId: '1',
          title: 'André Moura',
          body: 'Lorem ipsum...',
          category: 'time',
          dueDateClass: '',
          bgColor: 'orange',
          start: '2022-04-20T03:30:00+09:00',
          end: '2022-04-20T07:30:00+09:00'
      },
    ]);

    this.calendar.on({
      beforeCreateSchedule: function(e) {
        console.log("beforeCreateSchedule", e);
        // saveNewSchedule(e);
      },
    })
  }
}
</script>

<style scoped>
  @import "tui-calendar/dist/tui-calendar.css";

  /* If you use the default popups, use this. */
  @import 'tui-date-picker/dist/tui-date-picker.css';
  @import 'tui-time-picker/dist/tui-time-picker.css';
  .fixed-top-navbar.top-nav .content-page {
    padding-top: 103px;
  }
</style>