import type { InjectionKey } from "vue";
import { createStore, Store, useStore as useStoreVuex } from "vuex";
import { type StateJob, job } from "./modules/job";
import { type StateStudio, studio } from "./modules/studio";
import { user, type StateUser } from "./modules/user";
import { type StateSwitcher, switcher } from "./modules/switcher";

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
