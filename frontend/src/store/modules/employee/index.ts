import type IEmployee from 'src/interfaces/IEmployee';
import type { StateInterface } from 'src/store';
import { GET_USERS_MESSAGES } from 'src/store/action-types';
import type { Module } from 'vuex';
import { DEFINE_EMPLOYEES } from 'src/store/mutation-types';
import { api } from 'src/boot/axios';

export interface StateEmployee {
    employees: IEmployee[]
}

export const employee: Module<StateEmployee, StateInterface> = {
    mutations: {
        [DEFINE_EMPLOYEES](state, employees: IEmployee[]) {
            state.employees = employees;
        }
    },
    actions: {
        [GET_USERS_MESSAGES]({ commit }, messageInfo: unknown) {
            api.get('v1/list-users-messages', {
                params: {
                    user_id_to: messageInfo.user_id_from
                }
            })
                .then(response => {
                    commit(DEFINE_EMPLOYEES, response.data)});
        }
    }
}
