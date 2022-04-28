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
            calendar.color = colors[id].color;
            calendar.bgColor = colors[id].bgColor;
            calendar.dragBgColor = colors[id].dragBgColor;
            calendar.borderColor = colors[id].borderColor;
            calendar.addCalendar(calendar);
        })
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
}

export {
    CalendarList,
    CalendarInfo
}
