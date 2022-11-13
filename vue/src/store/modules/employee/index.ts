import type IEmployee from "../../../interfaces/IEmployee";
import type { State } from "../../../store";
import { GET_EMPLOYEES, GET_USERS_MESSAGES, INSERT_EMPLOYEE, UPDATE_EMPLOYEE, DELETE_EMPLOYEE } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { DEFINE_EMPLOYEES, ADD_EMPLOYEE, CHANGE_EMPLOYEE, REMOVE_EMPLOYEE } from "../../../store/mutation-types";

export interface StateEmployee {
  employees: IEmployee[];
}

export const employee: Module<StateEmployee, State> = {
  mutations: {
    [DEFINE_EMPLOYEES](state, employees: IEmployee[]) {
      state.employees = employees;
    },
    [ADD_EMPLOYEE](state, employee: IEmployee) {
        state.employees.push(employee);
    },
    [CHANGE_EMPLOYEE](state, employee: IEmployee) {
        const index = state.employees.findIndex(item => item.id == employee.id);
        state.employees[index] = employee;
    },
    [REMOVE_EMPLOYEE](state, id: number) {
        state.employees = state.employees.filter(item => item.id != id);
    }
  },
  actions: {
    [GET_USERS_MESSAGES]({ commit }, messageInfo: Object) {
      http
        .get("v1/list-users-messages", {
          params: {
            user_id_to: messageInfo.user_id_from,
          },
        })
        .then((response) => {
          commit(DEFINE_EMPLOYEES, response.data);
        });
    },
    [GET_EMPLOYEES]({ commit }) {
      http
        .get('v1/users')
        .then((response) => commit(DEFINE_EMPLOYEES, response.data));
    },
    [INSERT_EMPLOYEE]({ commit }, employee: IEmployee) {
        return http.post('v1/employees', employee)
            .then(response => commit(ADD_EMPLOYEE, response.data));
    },
    [UPDATE_EMPLOYEE]({ commit }, employee: IEmployee) {
        return http.put(`v1/employees/${employee.id}`, employee)
            .then(response => commit(CHANGE_EMPLOYEE, response.data));
    },
    [DELETE_EMPLOYEE]({ commit }, id: number) {
        return http.delete(`v1/employees/${id}`)
            .then(() => commit(REMOVE_EMPLOYEE, id));
    }
  },
  getters: {
    getEmployees(state) {
      return state.employees;
    }
  }
};
