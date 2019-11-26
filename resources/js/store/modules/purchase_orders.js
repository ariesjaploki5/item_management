

import axios from "axios"

const state = {
    purchase_orders: [],
    purchase_order: {},
}

const getters = {
    purchase_orders(state){
        return state.purchase_orders
    },
    purchase_order(state){
        return state.purchase_order
    }
}

const mutations = {
    setPurchaseOrders (state, purchase_orders) {
        state.purchase_orders = purchase_orders
    },
    setPurchaseOrder (state, purchase_order){
        state.purchase_order = purchase_order
    }
}

const actions = {
    getPurchaseOrders ({ commit }) {
        axios.get('purchase_order').then(({data}) => {
            commit(setPurchaseOrders, data)
        }).catch(() => {

        });
    },
    getPurchaseOrder({commit}, id){
        axios.get('purchase_order/'+id).then(({data}) => {
            commit(setPurchaseOrder, data)
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