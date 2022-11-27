<template>
  <div class="content-page">
    <div class="content-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-block p-card">
              <div class="profile-box">
                <div class="profile-card rounded">
                  <img src="../assets/images/user/12.jpg" alt="profile-bg"
                    class="avatar-100 rounded d-block mx-auto img-fluid mb-3">
                  <h3 class="font-600 text-white text-center mb-0">{{user.name}}</h3>
                  <p class="text-white text-center mb-5">{{ getUserJob }}</p>
                </div>
                <div class="pro-content rounded">
                  <div class="d-flex align-items-center mb-3">
                    <div class="p-icon mr-3">
                      <i class="las la-envelope-open-text"></i>
                    </div>
                    <p class="mb-0 eml">{{user.email}}</p>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                    <div class="p-icon mr-3">
                      <i class="las la-phone"></i>
                    </div>
                    <p class="mb-0">{{user.phone}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import { computed, defineComponent, inject } from 'vue'
  import { useStore } from '../store';
  import { GET_EMPLOYEES, GET_USER } from "../store/action-types";
  import type IEmployee from '../interfaces/IEmployee';
  import { employee } from '@/store/modules/employee';

export default defineComponent({
  name: 'ProfileView',
  data() {
      return {
        employee: {} as IEmployee,
        userJob: {
          job: { name: '' }
        }
      }
    },
    methods: {
      loadEmployee(employee: IEmployee) {
        this.employee = employee;
      }
    },
    computed: {
      getUserJob() {
        return this.userJob && this.userJob.job ? this.userJob.job.name : '';
      }
    },
    watch: {
      user(newUser) {
        console.log(newUser)
      }
    },
    setup() {
      const store = useStore();
      const swal = inject('$swal');
      store.dispatch(GET_EMPLOYEES);
      const user = computed(() => store.getters.getUser);
      store.dispatch(GET_USER, user.value.id);
      const userJob = computed(() => store.getters.getUserJob);

      return {
        Employees: computed(() => store.state.employee.employees),
        user,
        userJob,
        store,
        swal

      }
    }
})
</script>

<style scoped>
  .profile-box {
    padding-bottom: 150px;
  }
</style>
