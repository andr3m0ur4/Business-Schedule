import type IJob from "../../../interfaces/IJob";
import type { State } from "../../../store";
import { DELETE_JOB, GET_JOBS, INSERT_JOB, UPDATE_JOB } from "../../../store/action-types";
import type { Module } from "vuex";
import http from "../../../http";
import { ADD_JOB, CHANGE_JOB, DEFINE_JOBS, REMOVE_JOB } from "../../../store/mutation-types";

export interface StateJob {
  jobs: IJob[];
}

export const job: Module<StateJob, State> = {
  mutations: {
    [DEFINE_JOBS](state, jobs: IJob[]) {
      state.jobs = jobs;
    },
    [ADD_JOB](state, job: IJob) {
      state.jobs.push(job);
    },
    [CHANGE_JOB](state, job: IJob) {
      const index = state.jobs.findIndex((item) => item.id == job.id);
      state.jobs[index] = job;
    },
    [REMOVE_JOB](state, id: number) {
      state.jobs = state.jobs.filter((item) => item.id != id);
    },
  },
  actions: {
    [GET_JOBS]({ commit }) {
      http
        .get("v1/jobs")
        .then((response) => commit(DEFINE_JOBS, response.data));
    },
    [INSERT_JOB]({ commit }, job: IJob) {
      return http
        .post("v1/jobs", job)
        .then((response) => commit(ADD_JOB, response.data));
    },
    [UPDATE_JOB]({ commit }, job: IJob) {
      return http
        .put(`v1/jobs/${job.id}`, job)
        .then((response) => commit(CHANGE_JOB, response.data));
    },
    [DELETE_JOB]({ commit }, id: number) {
      return http.delete(`v1/jobs/${id}`).then(() => commit(REMOVE_JOB, id));
    },
  },
  getters: {
    getJobs(state) {
      return state.jobs;
    },
  },
};
