import type IEmployee from "@/interfaces/IEmployee";
import type { State } from "@/store";
import { GET_USERS_MESSAGES } from "@/store/action-types";
import type { Module } from "vuex";
import http from "@/http";
import { DEFINE_EMPLOYEES } from "@/store/mutation-types";

export interface StateEmployee {
    employees: IEmployee[]
}

export const employee: Module<StateEmployee, State> = {
    mutations: {
        [DEFINE_EMPLOYEES](state, employees: IEmployee[]) {
            state.employees = employees;
        }
    },
    actions: {
        [GET_USERS_MESSAGES]({ commit }, messageInfo: Object) {
            http.get('v1/list-users-messages', {
                params: {
                    user_id_to: messageInfo.user_id_from
                }
            })
                .then(response => {
                    commit(DEFINE_EMPLOYEES, response.data)});
        }
    }
}
