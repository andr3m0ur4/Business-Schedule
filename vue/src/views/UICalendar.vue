<template>
  <div class="content-page">
    <div class="container-fluid container">
      <div class="row">
        <div class="col-lg-12">

          <div id="top">
            <a href="https://github.com/nhn/tui.calendar">
                <img src="../assets/images/ui-calendar/img-bi.png" srcset="../assets/images/ui-calendar/img-bi@2x.png 2x,../assets/images/ui-calendar/img-bi@3x.png 3x">
            </a>
          </div>
          <div id="lnb">
              <div class="lnb-new-schedule">
                  <button id="btn-new-schedule" type="button" class="btn btn-default btn-block lnb-new-schedule-btn" data-toggle="modal">
                      New schedule</button>
              </div>
              <div id="lnb-calendars" class="lnb-calendars">
                  <div>
                      <div class="lnb-calendars-item">
                          <label>
                              <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked>
                              <span></span>
                              <strong>View all</strong>
                          </label>
                      </div>
                  </div>
                  <div id="calendarList" class="lnb-calendars-d1">
                  </div>
              </div>
              <div class="lnb-footer">
                  © NHN Corp.
              </div>
          </div>
          <div id="right">
              <div id="menu">
                  <span class="dropdown">
                      <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="true">
                          <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                          <span id="calendarTypeName">Dropdown</span>&nbsp;
                          <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
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
                  <span id="menu-navi">
                      <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                      <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                          <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                          <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                      </button>
                  </span>
                  <span id="renderRange" class="render-range"></span>
              </div>
              <div id="calendar"></div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import app from '@/assets/js/app-calendar'

export default {
  name: 'UICalendar',
  mounted() {
    app.startCalendar()
  }
}
</script>

<style scoped>
  @import "tui-calendar/dist/tui-calendar.css";

  /* If you use the default popups, use this. */
  @import 'tui-date-picker/dist/tui-date-picker.css';
  @import 'tui-time-picker/dist/tui-time-picker.css';
</style>

<style scoped lang="css" src="@/assets/css/ui-calendar.css"></style>
<style scoped lang="css" src="@/assets/css/icons.css"></style>