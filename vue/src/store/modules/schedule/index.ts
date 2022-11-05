import { State } from "@/store";
import { Module } from "vuex";
import ISchedule from "../../../interfaces/ISchedule";
import http from "../../../http";
import { INSERT_OR_UPDATE_SCHEDULES, INSERT_SCHEDULES } from "../../../store/action-types";

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
    }
  },
  getters: {

  }
}
