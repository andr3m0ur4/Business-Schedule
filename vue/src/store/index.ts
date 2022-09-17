import type { InjectionKey } from "vue";
import { createStore, Store, useStore as useStoreVuex } from "vuex";
import { CHANGE_PASSWORD, SEND_MAIL, VERIFY_TOKEN } from "./action-types";
import { type StateJob, job } from "./modules/job";
import { type StateStudio, studio } from "./modules/studio";
import { user, type StateUser } from "./modules/user";
import { type StateSwitcher, switcher } from "./modules/switcher";
import http from "@/http";

export interface State {
    job: StateJob,
    user: StateUser,
    switcher: StateSwitcher,
    studio: StateStudio

};

export const key: InjectionKey<Store<State>> = Symbol();

export const store = createStore<State>({
    // state: {
        // user: {
        //     data: JSON.parse(sessionStorage.getItem('user')) ?? {},
        //     token: sessionStorage.getItem('token')
        // },
        // job: {
        //     jobs: []
        // }
    // },
    actions: {
        [SEND_MAIL](context, email: String) {
            return http.post('send-mail', {
                email
            });
        },
        [VERIFY_TOKEN](context, token: String) {
            return http.get('verify-token', {
                params: {
                    token
                }
            });
        },
        [CHANGE_PASSWORD](context, data: Object) {
            return http.post('change-password', {
                password: data.password,
                password_confirmation: data.confirmPassword,
                token: data.token
            });
        }
    },
    modules: {
        job,
        user,
        switcher,
        studio

    }
});

export function useStore() : Store<State> {
    return useStoreVuex(key);
}
