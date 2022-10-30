import type { State } from "../../../store";
import { DELETE_EMPLOYEE_TIME, GET_EMPLOYEES_TIMES, INSERT_EMPLOYEE_TIME, UPDATE_EMPLOYEE_TIME } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { ADD_EMPLOYEE_TIME, CHANGE_EMPLOYEE_TIME, DEFINE_EMPLOYEES, DEFINE_EMPLOYEES_TIMES, REMOVE_EMPLOYEE_TIME } from "../../../store/mutation-types";
import IEmployeeTime from "../../../interfaces/IEmployeeTime";

export interface StateEmployeeTime {
  employeesTimes: IEmployeeTime[];
}

export const employeeTime: Module<StateEmployeeTime, State> = {
  mutations: {
    [DEFINE_EMPLOYEES_TIMES](state, employeesTimes: IEmployeeTime[]) {
      state.employeesTimes = employeesTimes;
    },
    [ADD_EMPLOYEE_TIME](state, employeeTime: IEmployeeTime) {
      if (!state.employeesTimes) {
        state.employeesTimes = [];
      }
      state.employeesTimes.push(employeeTime);
    },
    [CHANGE_EMPLOYEE_TIME](state, employeeTime: IEmployeeTime) {
      const index = state.employeesTimes.findIndex((item) => item.id == employeeTime.id);
      state.employeesTimes[index] = employeeTime;
    },
    [REMOVE_EMPLOYEE_TIME](state, id: string) {
      state.employeesTimes = state.employeesTimes.filter((item) => item.id != id);
    }
  },
  actions: {
    [GET_EMPLOYEES_TIMES]({ commit }) {
      http
        .get('v1/employee-times')
        .then((response) => commit(DEFINE_EMPLOYEES_TIMES, response.data));
    },
    [INSERT_EMPLOYEE_TIME]({ commit }, employeeTime: IEmployeeTime) {
      return http
        .post('v1/employee-times', employeeTime)
        .then((response) => commit(ADD_EMPLOYEE_TIME, response.data));
    },
    [UPDATE_EMPLOYEE_TIME]({ commit }, employeeTime: IEmployeeTime) {
      return http
        .put(`v1/employee-times/${employeeTime.id}`, employeeTime)
        .then((response) => commit(CHANGE_EMPLOYEE_TIME, response.data));
    },
    [DELETE_EMPLOYEE_TIME]({ commit }, id: string) {
      return http.delete(`v1/employee-times/${id}`).then(() => commit(REMOVE_EMPLOYEE_TIME, id));
    }
  },
  getters: {
    getEmployeesTimes(state) {
      return state.employeesTimes;
    }
  }
};