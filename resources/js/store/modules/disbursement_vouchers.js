

import axios from "axios"

const state = {
    disbursement_vouchers: [],
    disbursement_voucher: {},
}

const getters = {
    disbursement_vouchers(state){
        return state.disbursement_vouchers
    },
    disbursement_voucher(state){
        return state.disbursement_voucher
    }
}

const mutations = {
    setDisbursementVouchers (state, disbursement_vouchers) {
        state.disbursement_vouchers = disbursement_vouchers
    },
    setDisbursementVoucher (state, disbursement_voucher){
        state.disbursement_voucher = disbursement_voucher
    }
}

const actions = {
    getDisbursementVouchers ({ commit }) {
        axios.get('disbursement_voucher').then(({data}) => {
            commit(setDisbursementVouchers, data)
        }).catch(() => {

        });
    },
    getDisbursementVoucher({commit}, id){
        axios.get('disbursement_voucher/'+id).then(({data}) => {
            commit(setDisbursementVoucher, data)
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