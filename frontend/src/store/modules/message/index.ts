import type IMessage from 'src/interfaces/IMessage';
import type { StateInterface } from 'src/store';
import { GET_MESSAGES, INSERT_MESSAGE } from 'src/store/action-types';
import type { Module } from 'vuex';
import { ADD_MESSAGE, DEFINE_MESSAGES } from 'src/store/mutation-types';
import { api } from 'src/boot/axios';

export interface StateMessage {
    messages: IMessage[]
}

export const message : Module<StateMessage, StateInterface> = {
    mutations: {
        [DEFINE_MESSAGES](state, messages: IMessage[]) {
            state.messages = messages;
        },
        [ADD_MESSAGE](state, message: IMessage) {
            state.messages.push(message);
        }
    },
    actions: {
        [GET_MESSAGES]({ commit }, messageInfo: IMessage) {
            api.get('v1/messages', {
                params: {
                    user_id_to: messageInfo.user_id_to,
                    user_id_from: messageInfo.user_id_from
                }
            })
                .then(response => commit(DEFINE_MESSAGES, response.data));
        },
        [INSERT_MESSAGE]({ commit }, message: IMessage) {
            return api.post('v1/messages', message)
                .then(response => commit(ADD_MESSAGE, response.data));
        }
    }
}
