

import axios from "axios"

const state = {
    inspection_and_acceptance_reports: [],
    inspection_and_acceptance_report: {},
}

const getters = {
    inspection_and_acceptance_reports(state){
        return state.inspection_and_acceptance_reports
    },
    inspection_and_acceptance_report(state){
        return state.inspection_and_acceptance_report
    }
}

const mutations = {
    setInspectionAndAcceptanceReports (state, inspection_and_acceptance_reports) {
        state.inspection_and_acceptance_reports = inspection_and_acceptance_reports
    },
    setInspectionAndAcceptanceReport (state, inspection_and_acceptance_report){
        state.inspection_and_acceptance_report = inspection_and_acceptance_report
    }
}

const actions = {
    getInspectionAndAcceptanceReports ({ commit }) {
        axios.get('inspection_and_acceptance_report').then(({data}) => {
            commit(setInspectionAndAcceptanceReports, data)
        }).catch(() => {

        });
    },
    getInspectionAndAcceptanceReport({commit}, id){
        axios.get('inspection_and_acceptance_report/'+id).then(({data}) => {
            commit(setInspectionAndAcceptanceReport, data)
        }).catch(() => {

        });
    },
    postInspectionAndAcceptanceReport({commit}, payload){
        axios.post('inspection_and_acceptance_report', {

        }).then(() => {

        }).catch(() => {

        });
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }