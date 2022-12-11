import type IMessage from "../../../interfaces/IMessage";
import type { State } from "../../../store";
import { GET_MESSAGES, INSERT_MESSAGE, GET_RECENT_MESSAGES, READ_MESSAGE } from "../../../store/action-types";
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
            return http.get('v1/users-messages', {
              params: {
                user_id_to: messageInfo.user_id_to,
                user_id_from: messageInfo.user_id_from
              }
            })
              .then( (response) => {commit(DEFINE_MESSAGES, response.data)
                return response});
        },
        [INSERT_MESSAGE]({ commit }, dados: {}) {
            return http.post('v1/messages', dados)
              .then( (response) => commit(ADD_MESSAGE, response.data) )
                .catch(erro => console.log(erro.data));
        },
        [GET_RECENT_MESSAGES]({ commit }, user_id) {
          return http.get('v1/recent-messages',{
            params: {
              user_id_to: user_id,
            }
          })
            .then((response) => {
              return response.data});
        },
        [READ_MESSAGE]({ commit }, dados: {}) {
          return http.post('v1/read-messages', dados)
            .then((response) => {
              return response.data});
        }
    },
    getters: {
      getMessages(state) {
        return state.messages;
      },
    }
}