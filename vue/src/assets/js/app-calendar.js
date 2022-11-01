import Calendar from '../vendor/tui-calendar'; /* ES6 */
import DatePicker from 'tui-date-picker';

import util from 'tui-code-snippet';

import { CalendarList, CalendarInfo } from './data/calendars';
import { generateSchedule, ScheduleInfo, ScheduleList } from './data/schedules';

'use strict';

/* eslint-disable */
/* eslint-env jquery */
/* global moment, tui, chance */
/* global findCalendar, CalendarList, ScheduleList, generateSchedule */

let calendar, resizeThrottled;
const useCreationPopup = false;
const useDetailPopup = true;
let datePicker, selectedCalendar;
let schedules = [];

function startCalendar($this) {
    calendar = new Calendar('#calendar', {
        defaultView: 'week',
        taskView: ['task'],
        scheduleView: ['time'],
        useCreationPopup: useCreationPopup,
        useDetailPopup: useDetailPopup,
        calendars: CalendarList,
        template: {
            milestone(model) {
                return `
                    <span class="calendar-font-icon ic-milestone-b"></span>
                    <span style="background-color: ${model.bgColor}">${model.title}</span>
                `;
            },
            allday(schedule) {
                return getTimeTemplate(schedule, true);
            },
            time(schedule) {
                return getTimeTemplate(schedule, false);
            }
        }
    });

    setEventHandlers($this);
    setDropdownCalendarType();
    setRenderRangeText();
    // setSchedules();
    setEventListener();
    // setCalendars();
}

function getCalendar() {
    return calendar;
}

function getSelectedCalendar() {
    return selectedCalendar;
}

function pushSchedule(schedule) {
    schedules.push(schedule);
    setSchedules();
}

/**
 * Define event handlers
 * @return {boolean}
 */
function setEventHandlers($this) {
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
            e.state = 'Private';
            saveNewSchedule(e);
        },
        beforeUpdateSchedule(e) {
            // aqui entra a regra para abrir popup de atualizaçao
            const schedule = e.schedule;
            const changes = e.changes ?? e.schedule;

            console.log('beforeUpdateSchedule', e);

            if (changes && !changes.isAllDay && schedule.category === 'allday') {
                changes.category = 'time';
            }

            // $('#label-schedule, #label-task').text('Alterar');
            // this.newSchedule = false;
            // this.newTask = false;

            if (false && schedule.category == 'task') {
                this.selectedSchedule.id = schedule.id;
                if (schedule.raw) {
                  this.selectedTvShow = schedule.raw.tvShow;
                  this.selectedStudio = schedule.raw.studio;
                  this.selectedSwitcher = schedule.raw.switcher;
                }

                this.datePickerTask.setStartDate(changes.start ? changes.start.toDate() : schedule.start.toDate());
                this.datePickerTask.setEndDate(changes.end ? changes.end.toDate() : schedule.end.toDate());
                $('#modal-new-task').modal();
              }

            if (schedule.category == 'time') {
                //
            }

            $this.selectedSchedule.id = schedule.id;
            $this.selectedSchedule.calendarId = schedule.calendarId;

            if (schedule.raw) {
                $this.selectedEmployee = schedule.raw.employee;

                if (schedule.raw.schedules) {
                    $this.selectedTvShowTimes = schedule.raw.schedules.map(schedule => {
                        return schedule.tv_show_time.id;
                    });
                }
            }

            const start = changes.start ? changes.start.toDate() : schedule.start.toDate();
            const end = changes.end ? changes.end.toDate() : schedule.end.toDate();

            openCreationPopup.call($this, {
                type: 'time',
                create: false,
                calendarId: schedule.calendarId,
                start,
                end
            });

            calendar.updateSchedule(schedule.id, schedule.calendarId, changes);
            refreshScheduleVisibility();
        },
        beforeDeleteSchedule(e) {
            console.log('beforeDeleteSchedule', e);
            calendar.deleteSchedule(e.schedule.id, e.schedule.calendarId);
            $this.deleteSchedule(e.schedule);
        },
        afterRenderSchedule(e) {
            var schedule = e.schedule;
            // var element = cal.getElement(schedule.id, schedule.calendarId);
            // console.log('afterRenderSchedule', element);
            // this.scheduleList.push(schedule);
        },
        clickTimezonesCollapseBtn(timezonesCollapsed) {
            console.log('timezonesCollapsed', timezonesCollapsed);

            if (timezonesCollapsed) {
                calendar.setTheme({
                    'week.daygridLeft.width': '77px',
                    'week.timegridLeft.width': '77px'
                });
            } else {
                calendar.setTheme({
                    'week.daygridLeft.width': '60px',
                    'week.timegridLeft.width': '60px'
                });
            }

            return true;
        }
    });
}

/**
 * Set calendars
 */
function setCalendars() {
    const calendarList = document.getElementById('calendarList');
    const html = [];

    CalendarList.forEach(calendarList => {
        html.push(
            `<div class="lnb-calendars-item">
                <label>
                    <input type="checkbox" class="tui-full-calendar-checkbox-round" value="${calendarList.id}" checked>
                    <span style="border-color: ${calendarList.borderColor}; background-color: ${calendarList.borderColor};"></span>
                    <span>${calendarList.name}</span>
                </label>
            </div>`
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
    const selectedIndex = e.target.selectedIndex >= 0 ? e.target.selectedIndex : 0;
    const target = e.target.options[selectedIndex];
    const calendarId = getDataAction(target);
    changeNewScheduleCalendar(calendarId);
}

function changeNewScheduleCalendar(calendarId) {
    const calendarNameElement = document.getElementById('calendarName');
    const calendar = CalendarInfo.findCalendar(calendarId);
    const html = [];

    html.push('<span class="calendar-bar" style="background-color: ' + calendar.bgColor + '; border-color:' + calendar.borderColor + ';"></span>');
    html.push('<span class="calendar-name">' + calendar.name + '</span>');

    // calendarNameElement.innerHTML = html.join('');

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
    const calendarNew = scheduleData.calendar || CalendarInfo.findCalendar(scheduleData.calendarId);
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
        type = 'Diário';
        iconClassName = 'calendar-icon ic_view_day';
    } else if (type === 'week') {
        type = 'Semanal';
        iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 2) {
        type = '2 semanas';
        iconClassName = 'calendar-icon ic_view_week';
    } else if (options.month.visibleWeeksCount === 3) {
        type = '3 semanas';
        iconClassName = 'calendar-icon ic_view_week';
    } else {
        type = 'Mensal';
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
        html.push(currentCalendarDate('DD/MM/YYYY'));
    } else if (viewName === 'month' && (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
        html.push(currentCalendarDate('MM/YYYY'));
    } else {
        html.push(moment(calendar.getDateRangeStart().getTime()).format('DD/MM/YYYY'));
        html.push(' ~ ');
        html.push(moment(calendar.getDateRangeEnd().getTime()).format(' DD/MM'));
    }
    renderRange.innerHTML = html.join('');
}

function setSchedules(paramSchedules = null) {
    if (paramSchedules) {
        schedules = paramSchedules;
    }

    calendar.clear();
    ScheduleList.splice(0, ScheduleList.length);
    ScheduleInfo.createSchedulesFromDB(schedules);

    // função para gerar horários aleatórios
    // generateSchedule(
    //     calendar.getViewName(),
    //     calendar.getDateRangeStart(),
    //     calendar.getDateRangeEnd()
    // );
    calendar.createSchedules(ScheduleList);

    refreshScheduleVisibility();
}

function startCalendarMenu(jobs) {
    CalendarList.splice(0, CalendarList.length);
    CalendarInfo.createCalendar(jobs);
    setCalendars();
    calendar.setCalendars(CalendarList);
    setCalendars();
    return CalendarList;
}

function setEventListener() {
    $('#menu-navi').on('click', onClickNavi);
    $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
    $('#lnb-calendars').on('change', onChangeCalendars);

    $('#btn-save-schedule').on('click', onNewSchedule);
    $('#btn-new-schedule').on('click', createNewSchedule);

    $('#dropdownMenu-calendars-list').on('change', onChangeNewScheduleCalendar);

    window.addEventListener('resize', resizeThrottled);
}

function getDataAction(target) {
    return target.dataset ? target.dataset.action : target.getAttribute('data-action');
}

function setDateTimePicker(options) {
    return new DatePicker.createRangePicker({
        startpicker: {
            date: new Date(),
            input: options.startInput,
            container: options.startContainer
        },
        endpicker: {
            date: new Date(),
            input: options.endInput,
            container: options.endContainer
        },
        format: 'dd/MM/yyyy HH:mm',
        timePicker: {
            showMeridiem: false
        }
    });
}

function openCreationPopup(options) {
    if (options.type == 'time') {
        this.$refs.formSchedule.reset();
        if (options.create) {
            $(this.$refs.labelSchedule).text('Adicionar');
            this.newSchedule = true;
        } else {
            $(this.$refs.labelSchedule).text('Alterar');
            this.newSchedule = false;
        }

        if (Number.isInteger(Number(options.calendarId))) {
            $(this.$refs.dropdownMenuCalendarsList).selectpicker('val', options.calendarId);
            this.$refs.dropdownMenuCalendarsList.dispatchEvent(new Event('change'));
        }

        this.datePicker.setStartDate(options.start);
        this.datePicker.setEndDate(options.end);
        $(this.$refs.modalSchedule).modal();
    } else {
        this.datePickerTask.setStartDate(options.start);
        this.datePickerTask.setEndDate(options.end);
        $(this.$refs.modalTask).modal();
    }
}

resizeThrottled = util.throttle(function() {
    calendar.render();
}, 50);

window.calendar = calendar;

export {
    startCalendar,
    getCalendar,
    getSelectedCalendar,
    startCalendarMenu,
    setDateTimePicker,
    setSchedules,
    pushSchedule,
    openCreationPopup
}
