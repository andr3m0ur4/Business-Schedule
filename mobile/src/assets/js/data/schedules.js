import Chance from 'chance';
import { CalendarList } from './calendars';

const chance = new Chance();

'use strict';

/*eslint-disable*/

const ScheduleList = [];

const SCHEDULE_CATEGORY = [
    'milestone',
    'task'
];

class ScheduleInfo {
    constructor() {
        this.id = null;
        this.calendarId = null;
        this.title = null;
        this.body = null;
        this.location = null;
        this.isAllday = false;
        this.start = null;
        this.end = null;
        this.category = '';
        this.dueDateClass = '';

        this.color = null;
        this.bgColor = null;
        this.dragBgColor = null;
        this.borderColor = null;
        this.customStyle = '';

        this.isFocused = false;
        this.isPending = false;
        this.isVisible = true;
        this.isReadOnly = false;
        this.isPrivate = false;
        this.goingDuration = 0;
        this.comingDuration = 0;
        this.recurrenceRule = '';
        this.state = '';

        this.raw = {
            memo: '',
            hasToOrCc: false,
            hasRecurrenceRule: false,
            location: null,
            creator: {
                name: '',
                avatar: '',
                company: '',
                email: '',
                phone: ''
            }
        };
    }

    static generateTime(schedule, renderStart, renderEnd) {
        var startDate = moment(renderStart.getTime());
        var endDate = moment(renderEnd.getTime());
        var diffDate = endDate.diff(startDate, 'days');

        schedule.isAllday = chance.bool({likelihood: 30});
        if (schedule.isAllday) {
            schedule.category = 'allday';
        } else if (chance.bool({likelihood: 30})) {
            schedule.category = SCHEDULE_CATEGORY[chance.integer({min: 0, max: 1})];
            if (schedule.category === SCHEDULE_CATEGORY[1]) {
                schedule.dueDateClass = 'morning';
            }
        } else {
            schedule.category = 'time';
        }

        startDate.add(chance.integer({min: 0, max: diffDate}), 'days');
        startDate.hours(chance.integer({min: 0, max: 23}));
        startDate.minutes(chance.bool() ? 0 : 30);
        schedule.start = startDate.toDate();

        endDate = moment(startDate);
        if (schedule.isAllday) {
            endDate.add(chance.integer({min: 0, max: 3}), 'days');
        }

        schedule.end = endDate
            .add(chance.integer({min: 1, max: 4}), 'hour')
            .toDate();

        if (!schedule.isAllday && chance.bool({likelihood: 20})) {
            schedule.goingDuration = chance.integer({min: 30, max: 120});
            schedule.comingDuration = chance.integer({min: 30, max: 120});;

            if (chance.bool({likelihood: 50})) {
                schedule.end = schedule.start;
            }
        }
    }

    static generateNames() {
        var names = [];
        var i = 0;
        var length = chance.integer({min: 1, max: 10});

        for (; i < length; i += 1) {
            names.push(chance.name());
        }

        return names;
    }

    static generateRandomSchedule(calendar, renderStart, renderEnd) {
        var schedule = new ScheduleInfo();

        schedule.id = chance.guid();
        schedule.calendarId = calendar.id;

        schedule.title = chance.sentence({words: 3});
        schedule.body = chance.bool({likelihood: 20}) ? chance.sentence({words: 10}) : '';
        schedule.isReadOnly = chance.bool({likelihood: 20});
        ScheduleInfo.generateTime(schedule, renderStart, renderEnd);

        schedule.isPrivate = chance.bool({likelihood: 10});
        schedule.location = chance.address();
        schedule.attendees = chance.bool({likelihood: 70}) ? ScheduleInfo.generateNames() : [];
        schedule.recurrenceRule = chance.bool({likelihood: 20}) ? 'repeated events' : '';
        schedule.state = chance.bool({likelihood: 20}) ? 'Free' : 'Busy';
        schedule.color = calendar.color;
        schedule.bgColor = calendar.bgColor;
        schedule.dragBgColor = calendar.dragBgColor;
        schedule.borderColor = calendar.borderColor;

        if (schedule.category === 'milestone') {
            schedule.color = schedule.bgColor;
            schedule.bgColor = 'transparent';
            schedule.dragBgColor = 'transparent';
            schedule.borderColor = 'transparent';
        }

        schedule.raw.memo = chance.sentence();
        schedule.raw.creator.name = chance.name();
        schedule.raw.creator.avatar = chance.avatar();
        schedule.raw.creator.company = chance.company();
        schedule.raw.creator.email = chance.email();
        schedule.raw.creator.phone = chance.phone();

        if (chance.bool({ likelihood: 20 })) {
            var travelTime = chance.minute();
            schedule.goingDuration = travelTime;
            schedule.comingDuration = travelTime;
        }

        ScheduleList.push(schedule);
    }

    static generateSchedule(viewName, renderStart, renderEnd) {
        ScheduleList.splice(0, ScheduleList.length);
        CalendarList.forEach(function(calendar) {
            var i = 0, length = 10;
            if (viewName === 'month') {
                length = 3;
            } else if (viewName === 'day') {
                length = 4;
            }
            for (; i < length; i += 1) {
                ScheduleInfo.generateRandomSchedule(calendar, renderStart, renderEnd);
            }
        });
    }

    static createSchedules(schedules) {
        schedules.forEach(schedule => {
            schedule.start = moment(schedule.start._date).toDate();
            schedule.end = moment(schedule.end._date).toDate();
            ScheduleList.push(schedule);
        });
    }

    static createSchedulesFromDB(schedules) {
        if (schedules) {
            schedules.forEach(scheduleDB => {
                if (scheduleDB.user) {
                    const schedule = {
                        id: scheduleDB.id,
                        calendarId: String(scheduleDB.user.job_id),
                        title: scheduleDB.user.name,
                        start: scheduleDB.start,
                        end: scheduleDB.end,
                        category: 'time',
                        raw: {
                            employee: scheduleDB.user,
                            schedules: scheduleDB.schedules,
                        },
                        state: 'public'
                    };
                    ScheduleList.push(schedule);
                }
            });
        }
    }

    static createTasksFromDB(tasks) {
        if (tasks) {
            tasks.forEach(scheduleDB => {
                const schedule = {
                    id: scheduleDB.id,
                    calendarId: '',
                    title: scheduleDB.tvShow.name,
                    location: scheduleDB.studio.name,
                    start: scheduleDB.start,
                    end: scheduleDB.end,
                    category: 'task',
                    raw: {
                        tvShow: scheduleDB.tvShow,
                        studio: scheduleDB.studio,
                        switcher: scheduleDB.switcher
                    },
                    state: 'public'
                };
                ScheduleList.push(schedule);
            });
        }
    }
}

export {
    ScheduleList,
    ScheduleInfo
}