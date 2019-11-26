

import axios from "axios"

const state = {
    items: [],
    item: {},
}

const getters = {
    items(state){
        return state.items
    },
    item(state){
        return state.item
    }
}

const mutations = {
    setItems (state, items) {
        state.items = items
    },
    setItem (state, item){
        state.item = item
    }
}

const actions = {
    getItems ({ commit }) {
        axios.get('item').then(({data}) => {
            commit(setItems, data)
        }).catch(() => {

        });
    },
    getItem({commit}, id){
        axios.get('item/'+id).then(({data}) => {
            commit(setItem, data)
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