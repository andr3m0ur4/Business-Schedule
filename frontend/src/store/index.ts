import { store } from 'quasar/wrappers'
import { InjectionKey } from 'vue'
import { Router } from 'vue-router'
import {
  createStore,
  Store as VuexStore,
  useStore as vuexUseStore,
} from 'vuex'
import { CHANGE_PASSWORD, SEND_MAIL, VERIFY_TOKEN } from './action-types'
import { employee, type StateEmployee } from './modules/employee';
import { type StateJob, job } from './modules/job';
import { type StateStudio, studio } from './modules/studio';
import { user, type StateUser } from './modules/user';
import { type StateSwitcher, switcher } from './modules/switcher';
import { type StateTvshow, tvshow } from './modules/tvshow';
import { type StateMessage, message } from './modules/message';
import { api } from 'src/boot/axios'

// import example from './module-example'
// import { ExampleStateInterface } from './module-example/state';

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export interface StateInterface {
  // Define your own store structure, using submodules if needed
  // example: ExampleStateInterface;
  // Declared as unknown to avoid linting issue. Best to strongly type as per the line above.
  employee: StateEmployee,
  job: StateJob,
  user: StateUser,
  switcher: StateSwitcher,
  studio: StateStudio,
  tvshow: StateTvshow,
  message: StateMessage
}

// provide typings for `this.$store`
declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $store: VuexStore<StateInterface>
  }
}

// provide typings for `useStore` helper
export const storeKey: InjectionKey<VuexStore<StateInterface>> = Symbol('vuex-key')

// Provide typings for `this.$router` inside Vuex stores
 declare module 'vuex' {
   export interface Store<S> {
     readonly $router: Router;
   }
 }

export default store(function (/* { ssrContext } */) {
  const Store = createStore<StateInterface>({
    actions: {
      [SEND_MAIL](context, email: string) {
          return api.post('send-mail', {
              email
          });
      },
      [VERIFY_TOKEN](context, token: string) {
          return api.get('verify-token', {
              params: {
                  token
              }
          });
      },
      [CHANGE_PASSWORD](context, data: unknown) {
          return api.post('change-password', {
              password: data.password,
              password_confirmation: data.confirmPassword,
              token: data.token
          });
      }
    },
    modules: {
      employee,
      job,
      user,
      switcher,
      studio,
      tvshow,
      message
    },

    // enable strict mode (adds overhead!)
    // for dev mode and --debug builds only
    strict: !!process.env.DEBUGGING
  })

  return Store;
})

export function useStore() {
  return vuexUseStore(storeKey)
}
