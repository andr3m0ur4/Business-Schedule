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
            console.log(messageInfo);
            return http.get('v1/users-messages', {
                params: {
                    user_id_to: messageInfo.user_id_to,
                    user_id_from: messageInfo.user_id_from
                }
            })
                .then( (response) => {commit(DEFINE_MESSAGES, response.data)
                    //console.log(response.data + ' Index');
                    return response;
                });
        },
        [INSERT_MESSAGE]({ commit }, dados: {}) {
            console.log(message);
            return http
                .post('v1/message-send', dados)
                .then( (response) => {commit(ADD_MESSAGE, response.data)
                    console.log(dados)
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

