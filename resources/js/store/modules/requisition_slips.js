

import axios from "axios"

const state = {
    requisition_slips: [],
    requisition_slip: {},
}

const getters = {
    requisition_slips(state){
        return state.requisition_slips
    },
    requisition_slip(state){
        return state.requisition_slip
    }
}

const mutations = {
    setRequisitionSlips (state, requisition_slips) {
        state.requisition_slips = requisition_slips
    },
    setRequisitionSlip (state, requisition_slip){
        state.requisition_slip = requisition_slip
    }
}

const actions = {
    getRequisitionSlips ({ commit }) {
        axios.get('requisition_slip').then(({data}) => {
            commit(setRequisitionSlips, data)
        }).catch(() => {

        });
    },
    getRequisitionSlip({commit}, id){
        axios.get('requisition_slip/'+id).then(({data}) => {
            commit(setRequisitionSlip, data)
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