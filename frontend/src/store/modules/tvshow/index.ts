import type ITvshow from 'src/interfaces/ITvshow';
import type { StateInterface } from 'src/store';
import { DELETE_TVSHOW, GET_TVSHOWS, INSERT_TVSHOW, UPDATE_TVSHOW } from 'src/store/action-types';
import type { Module } from 'vuex';
import { ADD_TVSHOW, CHANGE_TVSHOW, DEFINE_TVSHOWS, REMOVE_TVSHOW } from 'src/store/mutation-types';
import { api } from 'src/boot/axios';

export interface StateTvshow {
    tvshows: ITvshow[]
}

export const tvshow : Module<StateTvshow, StateInterface> = {
    mutations: {
        [DEFINE_TVSHOWS](state, tvshows: ITvshow[]) {
            state.tvshows = tvshows;
        },
        [ADD_TVSHOW](state, tvshow: ITvshow) {
            state.tvshows.push(tvshow);
        },
        [CHANGE_TVSHOW](state, tvshow: ITvshow) {
            const index = state.tvshows.findIndex(item => item.id == tvshow.id);
            state.tvshows[index] = tvshow;
        },
        [REMOVE_TVSHOW](state, id: number) {
            state.tvshows = state.tvshows.filter(item => item.id != id);
        }
    },
    actions: {
        [GET_TVSHOWS]({ commit }) {
            api.get('v1/tv-shows')
                .then(response => commit(DEFINE_TVSHOWS, response.data));
        },
        [INSERT_TVSHOW]({ commit }, tvshow: ITvshow) {
            return api.post('v1/tv-shows', tvshow)
                .then(response => commit(ADD_TVSHOW, response.data));
        },
        [UPDATE_TVSHOW]({ commit }, tvshow: ITvshow) {
            return api.put(`v1/tv-shows/${tvshow.id}`, tvshow)
                .then(response => commit(CHANGE_TVSHOW, response.data));
        },
        [DELETE_TVSHOW]({ commit }, id: number) {
            return api.delete(`v1/tv-shows/${id}`)
                .then(() => commit(REMOVE_TVSHOW, id));
        }
    }
}
