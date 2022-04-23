import Calendar from 'tui-calendar'; /* ES6 */

import throttle from 'tui-code-snippet/tricks/throttle';

import { CalendarList, findCalendar } from '@/assets/js/data/calendars';
import { generateSchedule, ScheduleList } from '@/assets/js/data/schedules';

'use strict';

/* eslint-disable */
/* eslint-env jquery */
/* global moment, tui, chance */
/* global findCalendar, CalendarList, ScheduleList, generateSchedule */

let calendar, resizeThrottled
const useCreationPopup = true
const useDetailPopup = true
let datePicker, selectedCalendar

function startCalendar() {
    calendar = new Calendar('#calendar', {
        defaultView: 'week',
        useCreationPopup: useCreationPopup,
        useDetailPopup: useDetailPopup,
        calendars: CalendarList,
        template: {
            milestone(model) {
                return '<span class="calendar-font-icon ic-milestone-b"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
            },
            allday(schedule) {
                return getTimeTemplate(schedule, true);
            },
            time(schedule) {
                return getTimeTemplate(schedule, false);
            }
        }
    });

    // event handlers
    calendar.on({
        clickMore(e) {
            console.log('clickMore', e);
        },
        clickSchedule(e) {
            console.log('clickSchedule', e);
        },
        clickDayname(date) {
            console.log('clickDayname', date);
        },
        beforeCreateSchedule(e) {
            console.log('beforeCreateSchedule', e);
            saveNewSchedule(e);
        },
        beforeUpdateSchedule(e) {
            var schedule = e.schedule;
            var changes = e.changes;

            console.log('beforeUpdateSchedule', e);

            if (changes && !changes.isAllDay && schedule.category === 'allday') {
                changes.category = 'time';
            }

            calendar.updateSchedule(schedule.id, schedule.calendarId, changes);
            refreshScheduleVisibility();
        },
        beforeDeleteSchedule(e) {
            console.log('beforeDeleteSchedule', e);
            calendar.deleteSchedule(e.schedule.id, e.schedule.calendarId);
        },
        afterRenderSchedule(e) {
            var schedule = e.schedule;
            // var element = cal.getElement(schedule.id, schedule.calendarId);
            // console.log('afterRenderSchedule', element);
        },
        clickTimezonesCollapseBtn(timezonesCollapsed) {
            console.log('timezonesCollapsed', timezonesCollapsed);

            if (timezonesCollapsed) {
                cal.setTheme({
                    'week.daygridLeft.width': '77px',
                    'week.timegridLeft.width': '77px'
                });
            } else {
                cal.setTheme({
                    'week.daygridLeft.width': '60px',
                    'week.timegridLeft.width': '60px'
                });
            }

            return true;
        }
    });

    setDropdownCalendarType();
    setRenderRangeText();
    setSchedules();
    setEventListener();

    // set calendars
    const calendarList = document.getElementById('calendarList');
    const html = [];
    CalendarList.forEach(calendarList => {
        html.push('<div class="lnb-calendars-item"><label>' +
            '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendarList.id + '" checked>' +
            '<span style="border-color: ' + calendarList.borderColor + '; background-color: ' + calendarList.borderColor + ';"></span>' +
            '<span>' + calendarList.name + '</span>' +
            '</label></div>'
        );
    });
    calendarList.innerHTML = html.join('\n');
}

/**
 * Get time template for time and all-day
 * @param {Schedule} schedule - schedule
 * @param {boolean} isAllDay - isAllDay or hasMultiDates
 * @returns {string}
 */
function getTimeTemplate(schedule, isAllDay) {
    var html = [];
    var start = moment(schedule.start.toUTCString());
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
}

/**
 * A listener for click the menu
 * @param {Event} e - click event
 */
function onClickMenu(e) {
    const target = $(e.target).closest('a[role="menuitem"]')[0];
    const action = getDataAction(target);
    const options = calendar.getOptions();
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
            viewName = calendar.getViewName();

            target.querySelector('input').checked = options.month.narrowWeekend;
            break;
        case 'toggle-start-day-1':
            options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
            options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
            viewName = calendar.getViewName();

            target.querySelector('input').checked = options.month.startDayOfWeek;
            break;
        case 'toggle-workweek':
            options.month.workweek = !options.month.workweek;
            options.week.workweek = !options.week.workweek;
            viewName = calendar.getViewName();

            target.querySelector('input').checked = !options.month.workweek;
            break;
        default:
            break;
    }

    calendar.setOptions(options, true);
    calendar.changeView(viewName, true);

    setDropdownCalendarType();
    setRenderRangeText();
    setSchedules();
}

function onClickNavi(e) {
    const action = getDataAction(e.target);

    switch (action) {
        case 'move-prev':
            calendar.prev();
            break;
        case 'move-next':
            calendar.next();
            break;
        case 'move-today':
            calendar.today();
            break;
        default:
            return;
    }

    setRenderRangeText();
    setSchedules();
}

function onNewSchedule() {
    const title = $('#new-schedule-title').val();
    const location = $('#new-schedule-location').val();
    const isAllDay = document.getElementById('new-schedule-allday').checked;
    const start = datePicker.getStartDate();
    const end = datePicker.getEndDate();
    const calendarList = selectedCalendar ? selectedCalendar : CalendarList[0];

    if (!title) {
        return;
    }

    calendar.createSchedules([{
        id: String(chance.guid()),
        calendarId: calendarList.id,
        title,
        isAllDay,
        location,
        start,
        end,
        category: isAllDay ? 'allday' : 'time',
        dueDateClass: '',
        color: calendarList.color,
        bgColor: calendarList.bgColor,
        dragBgColor: calendarList.bgColor,
        borderColor: calendarList.borderColor,
        state: 'Busy'
    }]);

    $('#modal-new-schedule').modal('hide');
}

function onChangeNewScheduleCalendar(e) {
    const target = $(e.target).closest('a[role="menuitem"]')[0];
    const calendarId = getDataAction(target);
    changeNewScheduleCalendar(calendarId);
}

function changeNewScheduleCalendar(calendarId) {
    const calendarNameElement = document.getElementById('calendarName');
    const calendar = findCalendar(calendarId);
    const html = [];

    html.push('<span class="calendar-bar" style="background-color: ' + calendar.bgColor + '; border-color:' + calendar.borderColor + ';"></span>');
    html.push('<span class="calendar-name">' + calendar.name + '</span>');

    calendarNameElement.innerHTML = html.join('');

    selectedCalendar = calendar;
}

function createNewSchedule(event) {
    const start = event.start ? new Date(event.start.getTime()) : new Date();
    const end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

    if (useCreationPopup) {
        calendar.openCreationPopup({
            start,
            end
        });
    }
}

function saveNewSchedule(scheduleData) {
    const calendarNew = scheduleData.calendar || findCalendar(scheduleData.calendarId);
    const schedule = {
        id: String(chance.guid()),
        title: scheduleData.title,
        isAllDay: scheduleData.isAllDay,
        start: scheduleData.start,
        end: scheduleData.end,
        category: scheduleData.isAllDay ? 'allday' : 'time',
        dueDateClass: '',
        color: calendarNew.color,
        bgColor: calendarNew.bgColor,
        dragBgColor: calendarNew.bgColor,
        borderColor: calendarNew.borderColor,
        location: scheduleData.location,
        isPrivate: scheduleData.isPrivate,
        state: scheduleData.state
    };

    if (calendarNew) {
        schedule.calendarId = calendarNew.id;
        schedule.color = calendarNew.color;
        schedule.bgColor = calendarNew.bgColor;
        schedule.borderColor = calendarNew.borderColor;
    }

    calendar.createSchedules([schedule]);

    refreshScheduleVisibility();
}

function onChangeCalendars(e) {
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

        CalendarList.forEach(calendarList => {
            calendarList.checked = checked;
        });
    } else {
        findCalendar(calendarId).checked = checked;

        allCheckedCalendars = calendarElements.every(input => {
            return input.checked;
        });

        if (allCheckedCalendars) {
            viewAll.checked = true;
        } else {
            viewAll.checked = false;
        }
    }

    refreshScheduleVisibility();
}

function refreshScheduleVisibility() {
    const calendarElements = Array.prototype.slice.call(
        document.querySelectorAll('#calendarList input')
    );

    CalendarList.forEach(calendarList => {
        calendar.toggleSchedules(calendarList.id, !calendarList.checked, false);
    });

    calendar.render(true);

    calendarElements.forEach(input => {
        const span = input.nextElementSibling;
        span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
    });
}

function setDropdownCalendarType() {
    const calendarTypeName = document.getElementById('calendarTypeName');
    const calendarTypeIcon = document.getElementById('calendarTypeIcon');
    const options = calendar.getOptions();
    let type = calendar.getViewName();
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
}

function currentCalendarDate(format) {
    const currentDate = moment([
        calendar.getDate().getFullYear(),
        calendar.getDate().getMonth(),
        calendar.getDate().getDate()
    ]);

    return currentDate.format(format);
  }

function setRenderRangeText() {
    const renderRange = document.getElementById('renderRange');
    const options = calendar.getOptions();
    const viewName = calendar.getViewName();

    const html = [];
    if (viewName === 'day') {
        html.push(currentCalendarDate('YYYY.MM.DD'));
    } else if (viewName === 'month' &&
        (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
        html.push(currentCalendarDate('YYYY.MM'));
    } else {
        html.push(moment(calendar.getDateRangeStart().getTime()).format('YYYY.MM.DD'));
        html.push(' ~ ');
        html.push(moment(calendar.getDateRangeEnd().getTime()).format(' MM.DD'));
    }
    renderRange.innerHTML = html.join('');
}

function setSchedules() {
    calendar.clear();
    generateSchedule(
        calendar.getViewName(),
        calendar.getDateRangeStart(),
        calendar.getDateRangeEnd()
    );
    calendar.createSchedules(ScheduleList);

    refreshScheduleVisibility();
}

function setEventListener() {
    $('#menu-navi').on('click', onClickNavi);
    $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
    $('#lnb-calendars').on('change', onChangeCalendars);

    $('#btn-save-schedule').on('click', onNewSchedule);
    $('#btn-new-schedule').on('click', createNewSchedule);

    $('#dropdownMenu-calendars-list').on('click', onChangeNewScheduleCalendar);

    window.addEventListener('resize', resizeThrottled);
}

function getDataAction(target) {
    return target.dataset ? target.dataset.action : target.getAttribute('data-action');
}

resizeThrottled = throttle(function() {
    calendar.render();
}, 50);

window.calendar = calendar;

export default {
    startCalendar
}