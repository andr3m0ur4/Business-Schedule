import { State } from "@/store";
import { Module } from "vuex";
import ISchedule from "../../../interfaces/ISchedule";
import http from "../../../http";
import { INSERT_OR_UPDATE_SCHEDULES, INSERT_SCHEDULES,COUNT_SCHEDULES,COUNT_TIME_SCHEDULE } from "../../../store/action-types";

export interface StateSchedule {
  schedules: ISchedule[];
}

export const schedule: Module<StateSchedule, State> = {
  mutations: {
  },
  actions: {
    [INSERT_SCHEDULES]({ commit }, schedules) {
      return http.post('v1/schedules/save', schedules);
    },
    [INSERT_OR_UPDATE_SCHEDULES]({ commit }, schedules) {
      return http.post('v1/schedules/save', schedules);
    },
    [COUNT_SCHEDULES]({ commit }) {
      return http.get('v1/count-schdules')
        .then((response) => {
          return response.data});
    },
    [COUNT_TIME_SCHEDULE]({ commit }) {
      return http.get('v1/count-time-schdules')
        .then((response) => {
          return response.data});
    }
  },
  getters: {
  }
}
