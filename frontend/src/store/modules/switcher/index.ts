import type ISwitcher from 'src/interfaces/ISwitcher';
import type { StateInterface } from 'src/store';
import { DELETE_SWITCHER, GET_SWITCHERS, INSERT_SWITCHER, UPDATE_SWITCHER } from 'src/store/action-types';
import type { Module } from 'vuex';
import { ADD_SWITCHER, CHANGE_SWITCHER, DEFINE_SWITCHERS, REMOVE_SWITCHER } from 'src/store/mutation-types';
import { api } from 'src/boot/axios';

export interface StateSwitcher {
    switchers: ISwitcher[]
}

export const switcher : Module<StateSwitcher, StateInterface> = {
    mutations: {
        [DEFINE_SWITCHERS](state, switchers: ISwitcher[]) {
            state.switchers = switchers;
        },
        [ADD_SWITCHER](state, switcher: ISwitcher) {
            state.switchers.push(switcher);
        },
        [CHANGE_SWITCHER](state, switcher: ISwitcher) {
            const index = state.switchers.findIndex(item => item.id == switcher.id);
            state.switchers[index] = switcher;
        },
        [REMOVE_SWITCHER](state, id: number) {
            state.switchers = state.switchers.filter(item => item.id != id);
        }
    },
    actions: {
        [GET_SWITCHERS]({ commit }) {
            api.get('v1/switchers')
                .then(response => commit(DEFINE_SWITCHERS, response.data));
        },
        [INSERT_SWITCHER]({ commit }, switcher: ISwitcher) {
            return api.post('v1/switchers', switcher)
                .then(response => commit(ADD_SWITCHER, response.data));
        },
        [UPDATE_SWITCHER]({ commit }, switcher: ISwitcher) {
            return api.put(`v1/switchers/${switcher.id}`, switcher)
                .then(response => commit(CHANGE_SWITCHER, response.data));
        },
        [DELETE_SWITCHER]({ commit }, id: number) {
            return api.delete(`v1/switchers/${id}`)
                .then(() => commit(REMOVE_SWITCHER, id));
        }
    }
}
