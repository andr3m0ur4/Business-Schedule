'use strict';

/* eslint-disable require-jsdoc, no-unused-vars */

const colors = [
    {
        color: '#ffffff',
        bgColor: '#9e5fff',
        dragBgColor: '#9e5fff',
        borderColor: '#9e5fff'
    },
    {
        color: '#ffffff',
        bgColor: '#00a9ff',
        dragBgColor: '#00a9ff',
        borderColor: '#00a9ff'
    },
    {
        color: '#ffffff',
        bgColor: '#ff5583',
        dragBgColor: '#ff5583',
        borderColor: '#ff5583'
    },
    {
        color: '#ffffff',
        bgColor: '#03bd9e',
        dragBgColor: '#03bd9e',
        borderColor: '#03bd9e'
    },
    {
        color: '#ffffff',
        bgColor: '#bbdc00',
        dragBgColor: '#bbdc00',
        borderColor: '#bbdc00'
    },
    {
        color: '#ffffff',
        bgColor: '#9d9d9d',
        dragBgColor: '#9d9d9d',
        borderColor: '#9d9d9d'
    },
    {
        color: '#ffffff',
        bgColor: '#ffbb3b',
        dragBgColor: '#ffbb3b',
        borderColor: '#ffbb3b'
    },
    {
        color: '#ffffff',
        bgColor: '#ff4040',
        dragBgColor: '#ff4040',
        borderColor: '#ff4040'
    },
    {
        color: '#ffffff',
        bgColor: '#9e5fff',
        dragBgColor: '#9e5fff',
        borderColor: '#9e5fff'
    },
    {
        color: '#ffffff',
        bgColor: '#9e5fff',
        dragBgColor: '#9e5fff',
        borderColor: '#9e5fff'
    },
    {
        color: '#ffffff',
        bgColor: '#00a9ff',
        dragBgColor: '#00a9ff',
        borderColor: '#00a9ff'
    },
    {
        color: '#ffffff',
        bgColor: '#ff5583',
        dragBgColor: '#ff5583',
        borderColor: '#ff5583'
    },
    {
        color: '#ffffff',
        bgColor: '#03bd9e',
        dragBgColor: '#03bd9e',
        borderColor: '#03bd9e'
    },
    {
        color: '#ffffff',
        bgColor: '#bbdc00',
        dragBgColor: '#bbdc00',
        borderColor: '#bbdc00'
    },
    {
        color: '#ffffff',
        bgColor: '#9d9d9d',
        dragBgColor: '#9d9d9d',
        borderColor: '#9d9d9d'
    },
    {
        color: '#ffffff',
        bgColor: '#ffbb3b',
        dragBgColor: '#ffbb3b',
        borderColor: '#ffbb3b'
    },
    {
        color: '#ffffff',
        bgColor: '#ff4040',
        dragBgColor: '#ff4040',
        borderColor: '#ff4040'
    },
    {
        color: '#ffffff',
        bgColor: '#9e5fff',
        dragBgColor: '#9e5fff',
        borderColor: '#9e5fff'
    }
]

const CalendarList = [];

class CalendarInfo {
    constructor() {
        this.id = null;
        this.name = null;
        this.checked = true;
        this.color = null;
        this.bgColor = null;
        this.borderColor = null;
        this.dragBgColor = null;
    }

    addCalendar(calendar) {
        CalendarList.push(calendar);
    }

    hexToRGBA(hex) {
        var radix = 16;
        var r = parseInt(hex.slice(1, 3), radix),
            g = parseInt(hex.slice(3, 5), radix),
            b = parseInt(hex.slice(5, 7), radix),
            a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
        var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

        return rgba;
    }

    static createCalendar(options) {
        options.forEach((option, id) => {
            const calendar = new CalendarInfo();
            calendar.id = String(option.id);
            calendar.name = option.name;
            calendar.color = colors[id] ? colors[id].color : colors[0].color;
            calendar.bgColor = colors[id] ? colors[id].bgColor : colors[0].bgColor;
            calendar.dragBgColor = colors[id] ? colors[id].dragBgColor : colors[0].dragBgColor;
            calendar.borderColor = colors[id] ? colors[id].borderColor : colors[0].borderColor;
            calendar.addCalendar(calendar);
        });
    }

    static findCalendar(id) {
        let found;

        CalendarList.forEach(calendar => {
            if (calendar.id === id) {
                found = calendar;
            }
        });

        return found || CalendarList[0];
    }

    static initCalendar() {
        var calendar;
        var id = 0;

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'My Calendar';
        calendar.color = '#ffffff';
        calendar.bgColor = '#9e5fff';
        calendar.dragBgColor = '#9e5fff';
        calendar.borderColor = '#9e5fff';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Company';
        calendar.color = '#ffffff';
        calendar.bgColor = '#00a9ff';
        calendar.dragBgColor = '#00a9ff';
        calendar.borderColor = '#00a9ff';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Family';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ff5583';
        calendar.dragBgColor = '#ff5583';
        calendar.borderColor = '#ff5583';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Friend';
        calendar.color = '#ffffff';
        calendar.bgColor = '#03bd9e';
        calendar.dragBgColor = '#03bd9e';
        calendar.borderColor = '#03bd9e';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Travel';
        calendar.color = '#ffffff';
        calendar.bgColor = '#bbdc00';
        calendar.dragBgColor = '#bbdc00';
        calendar.borderColor = '#bbdc00';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'etc';
        calendar.color = '#ffffff';
        calendar.bgColor = '#9d9d9d';
        calendar.dragBgColor = '#9d9d9d';
        calendar.borderColor = '#9d9d9d';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'Birthdays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ffbb3b';
        calendar.dragBgColor = '#ffbb3b';
        calendar.borderColor = '#ffbb3b';
        calendar.addCalendar(calendar);

        calendar = new CalendarInfo();
        id += 1;
        calendar.id = String(id);
        calendar.name = 'National Holidays';
        calendar.color = '#ffffff';
        calendar.bgColor = '#ff4040';
        calendar.dragBgColor = '#ff4040';
        calendar.borderColor = '#ff4040';
        calendar.addCalendar(calendar);
    }
}

export {
    CalendarList,
    CalendarInfo
}
