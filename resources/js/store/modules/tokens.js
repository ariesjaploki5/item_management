

import axios from "axios"

const state = {
    token: localStorage.getItem('access_token') || null,

}

const getters = {
    loggedIn(state){
        return state.token !== null
    }
}

const mutations = {
    retrieveToken (state, token){
        state.token = token
    },
    destroyToken(state){
        state.token = null
    }
}

const actions = {
    destroyToken(context) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token;
        if (context.getters.loggedIn) {
            return new Promise((resolve) => {
                axios.post('/logout').then(response => {
                    localStorage.removeItem('access_token');
                    context.commit('destroyToken');
                    resolve(response)
                }).catch(() => {
                    localStorage.removeItem('access_token');
                    context.commit('destroyToken');
                });
            });
        }
    },
    retrieveToken(context, credentials) {
        return new Promise((resolve) => {
            axios.post('/login', {
                username: credentials.username,
                password: credentials.password,
            }).then(response => {
                const token = response.data.access_token;
                localStorage.setItem('access_token', token);
                axios.defaults.headers.common = {
                    'X-CSRF-TOKEN': token.content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token,
                }
                context.commit('retrieveToken', token);
                resolve(response);
            }).catch();
        })
    },  
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }