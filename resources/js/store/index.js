
import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import items from './modules/items'
import purchase_requests from './modules/purchase_requests'
import purchase_orders from './modules/purchase_orders'
import inspection_and_acceptance_reports from './modules/inspection_and_acceptance_reports'
import disbursement_vouchers from './modules/disbursement_vouchers'
import requisition_slips from './modules/requisition_slips'
import tokens from './modules/tokens'

Vue.use(Vuex)
axios.defaults.baseURL = 'http://192.168.7.84/api'

export default new Vuex.Store({
  modules: {
        tokens,
        items,
        purchase_orders,
        purchase_requests,
        inspection_and_acceptance_reports,
        disbursement_vouchers,
        requisition_slips,
  }

})