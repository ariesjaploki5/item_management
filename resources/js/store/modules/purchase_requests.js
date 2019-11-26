

import axios from "axios"

const state = {
    purchase_requests: [],
    purchase_request: {},
}

const getters = {
    purchase_requests(state){
        return state.purchase_requests
    },
    purchase_request(state){
        return state.purchase_request
    }
}

const mutations = {
    setPurchaseRequests (state, purchase_requests) {
        state.purchase_requests = purchase_requests
    },
    setPurchaseRequest (state, purchase_request){
        state.purchase_request = purchase_request
    }
}

const actions = {
    getPurchaseRequests ({ commit }) {
        axios.get('purchase_request').then(({data}) => {
            commit(setPurchaseRequests, data)
        }).catch(() => {

        });
    },
    getPurchaseRequest({commit}, id){
        axios.get('purchase_request/'+id).then(({data}) => {
            commit(setPurchaseRequest, data)
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