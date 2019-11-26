

import axios from "axios"

const state = {
    suppliers: [],
    supplier: {},
}

const getters = {
    suppliers(state){
        return state.suppliers
    },
    supplier(state){
        return state.supplier
    }
}

const mutations = {
    setSuppliers (state, suppliers) {
        state.suppliers = suppliers
    },
    setSupplier (state, supplier){
        state.supplier = supplier
    }
}

const actions = {
    getSuppliers ({ commit }) {
        axios.get('supplier').then(({data}) => {
            commit(setSuppliers, data)
        }).catch(() => {

        });
    },
    getSupplier({commit}, id){
        axios.get('supplier/'+id).then(({data}) => {
            commit(setSupplier, data)
        }).catch(() => {

        });
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }