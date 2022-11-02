import type IMessage from "../../../interfaces/IMessage";
import type { State } from "../../../store";
import { GET_MESSAGES, INSERT_MESSAGE } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { ADD_MESSAGE, DEFINE_MESSAGES } from "../../../store/mutation-types";

export interface StateMessage {
    messages: IMessage[]
}

export const message : Module<StateMessage, State> = {
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
            http.get('v1/messages', {
                params: {
                    user_id_to: messageInfo.user_id_to,
                    user_id_from: messageInfo.user_id_from
                }
            })
                .then(response => commit(DEFINE_MESSAGES, response.data));
        },
        [INSERT_MESSAGE]({ commit }, message: IMessage) {
            console.log(message);
            return http
                .post('v1/messages', message)
                .then( (response) => {commit(ADD_MESSAGE, response.data)
                    console.log(response.data)
                    console.log(response)} )
                    .catch(erro => console.log(erro.data));
        }
    },
    getters: {
        getMessages(state) {
          return state.messages;
        },
    }
}

