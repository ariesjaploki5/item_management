

import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);
axios.defaults.baseURL = 'http://192.168.7.84/api';

export const store = new Vuex.Store({
    state : {
        token : localStorage.getItem('access_token') || null,
        user: '',
        approving_officers: [],
        apps: [],
        attachment_dvs: [],
        attachments: [],
        batches: [],
        brands: [],
        categories: [],
        countries: [],
        dvs: [],
        holidays: [],
        iars: [],
        inspection_officers: [],
        item_riss: [],
        item_ris_issuances: [],
        items: [],
        manufacturers: [],
        modes: [],
        obrs: [],
        packagings: [],
        
        purchase_orders: [],
        purchase_order_details: {},
        
        purchase_requests: [],
        purchase_request_details: {},

        riss: [],
        roles: [],
        suppliers: [],
        units: [],
        users: [],
        employees: [],
        departments: [],
    },
    getters: {
        loggedIn(state){
            return state.token !== null
        },
        user(state){
            return state.user
        },
        users(state){
            return state.users
        },
        
        approving_officers(state){
            return state.approving_officers
        },
        apps(state){
            return state.apps
        },
        attachment_dvs(state){
            return state.attachment_dvs
        },
        attachments(state){
            return state.attachments
        },
        batches(state){
            return state.batches
        },
        brands(state){
            return state.brands
        },
        categories(state){
            return state.categories
        },
        countries(state){
            return state.countries
        },
        dvs(state){
            return state.dvs
        },
        holidays(state){
            return state.holidays
        },
        inspection_officers(state){
            return state.inspection_officers
        },
        item_ris_issuances(state){
            return state.item_ris_issuances
        },
        item_riss(state){
            return state.item_riss
        },
        iars(state){
            return state.iars
        },
        items(state){
            return state.items
        },
        manufacturers(state){
            return state.manufacturers
        },
        modes(state){
            return state.modes
        },
        obrs(state){
            return state.obrs
        },
        packagings(state){
            return state.packagings
        },
        purchase_order_details(state){
            return state.purchase_order_details
        },
        purchase_orders(state){
            return state.purchase_orders
        },
        purchase_request_details(state){
            return state.purchase_request_details
        },
        purchase_requests(state){
            return state.purchase_requests
        },
        riss(state){
            return state.riss
        },
        roles(state){
            return state.roles
        },
        suppliers(state){
            return state.suppliers
        },
        units(state){
            return state.units
        },
        employees(state){
            return state.employees
        },
        departments(state){
            return state.departments
        },
    },
    mutations: {
        retrieveToken(state, token){
            state.token = token
        },
        destroyToken(state){
            state.token = null
        },
        retrieveUser(state, user){
            state.user = user
        },
        detroyUser(state){
            state.user = null
        },
        getUsers(state, users){
            state.users = users
        },
        
        getApprovingOfficers(state, approving_officers){
            state.approving_officers = approving_officers
        },
        getApps(state, apps){
            state.apps = apps
        },
        getAttachmentDv(state, attachment_dvs){
            state.attachment_dvs = attachment_dvs
        },
        getAttachments(state, attachments){
            state.attachments = attachments
        },
        getBatches(state, batches){
            state.batches = batches
        },
        getBrands(state, brands){
            state.brands = brands
        },
        getCategories(state, categories){
            state.categories = categories
        },
        getCountries(state, countries){
            state.countries = countries
        },
        getDvs(state, dvs){
            state.dvs = dvs
        },
        getHolidays(state, holidays){
            state.holidays = holidays
        },
        getIars(state, iars){
            state.iars = iars
        },
        getInspectionOfficers(state, inspection_officers){
            state.inspection_officers = inspection_officers
        },
        getItems(state, items){
            state.items = items
        },
        getItemRiss(state, item_riss){
            state.item_riss = item_riss
        },
        getItemRisIssuances(state, item_ris_issuances){
            state.item_ris_issuances = item_ris_issuances
        },
        getManufacturers(state, manufacturers){
            state.manufacturers = manufacturers
        },
        getModes(state, modes){
            state.modes = modes
        },
        getObrs(state, obrs){
            state.obrs = obrs
        },
        getPackagings(state, packagings){
            state.packagings = packagings
        },
        getPurchaseOrderDetails(state, purchase_order_details){
            state.purchase_order_details = purchase_order_details
        },
        getPurchaseOrders(state, purchase_orders){
            state.purchase_orders = purchase_orders
        },
        getPurchaseRequestDetails(state, purchase_request_details){
            state.purchase_request_details = purchase_request_details
        },
        getPurchaseRequests(state, purchase_requests){
            state.purchase_requests = purchase_requests
        },
        getRiss(state, riss){
            state.riss = riss
        },
        getRoles(state, roles){
            state.roles = roles
        },
        getSuppliers(state, suppliers){
            state.suppliers = suppliers
        },
        getUnits(state, units){
            state.units = units
        },
        getEmployees(state, employees){
            state.employees = employees
        },
        getDepartments(state, departments){
            state.departments = departments
        },

    },
    actions: {
        async destroyToken(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token;
            if (context.getters.loggedIn) {
                return new Promise((resolve) => {
                    axios.post('/logout').then(response => {
                        localStorage.removeItem('access_token');
                        context.commit('destroyToken');
                        // context.commit('destroyUser');

                        resolve(response)
                    }).catch(() => {
                        localStorage.removeItem('access_token');
                        context.commit('destroyToken');
                        // context.commit('destroyUser');
                    });
                });
            }
        },
        async retrieveToken(context, credentials) {
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
        async retrieveUser(context){
            await axios.get('get_user').then(response => {
                context.commit('retrieveUser', response.data);
            }).catch();
        },
        async destroyUser(context){
            
        },
        async getUsers(context){
            await axios.get('users').then(response => {
                context.commit('getUsers', response.data);
            }).catch();
        },
        
        async getApprovingOfficers(context){
            await axios.get('approving_officer').then(response => {
                context.commit('getApprovingOfficers', response.data);
            }).catch();
        },
        async getApps(context){
            await axios.get('app').then(response => {
                context.commit('getApps', response.data);
            }).catch();
        },
        async getAttachmentDv(context){
            await axios.get('attachment_dv').then(({data}) => {
                context.commit('getAttachmentDv', data);
            }).catch();
        },
        async getAttachments(context){
            await axios.get('attachments').then(({data}) => {
                context.commit('getAttachments', data);
            }).catch();
        },
        async getBatches(context){
            await axios.get('batch').then(({data}) => {
                context.commit('getBatches', data);
            }).catch();
        },
        async getBrands(context){
            await axios.get('brand').then(({data}) => {
                context.commit('getBrands', data);
            }).catch(() => {
                axios.get('brand').then(({data}) => {
                    context.commit('getBrands', data);
                }).catch(() => {
                    
                });
            });
        },
        async getCategories(context){
            await axios.get('category').then(({data}) => {
                context.commit('getCategories', data);
            }).catch();
        },
        async getCountries(context){
            await axios.get('country').then(({data}) => {
                context.commit('getCountries', data);
            }).catch((error) => {
                axios.get('country').then(({data}) => {
                    context.commit('getCountries', data);
                }).catch((error) => {
                    
                });
            });
        },
        async getDvs(context){
            await axios.get('dv').then(({data}) => {
                context.commit('getDvs', data);
            }).catch();
        },
        async getHolidays(context){
            await axios.get('holidays').then(({data}) => {
                context.commit('getHolidays', data);
            }).catch();
        },
        async getIars(context){
            await axios.get('iar').then(({data}) => {
                context.commit('getIars', data);
            }).catch();
        },
        async getInspectionOfficers(context){
            await axios.get('inspection_officer').then(({data}) => {
                context.commit('getInspectionOfficers', data);
            }).catch();
        },
        async getItemRiss(context){
            await axios.get('item_ris').then(({data}) => {
                context.commit('getItemRiss', data);
            }).catch();
        },
        async getItemRisIssuances(context){
            await axios.get('item_ris_issuance').then(({data}) => {
                context.commit('getItemRisIssuances', data);
            }).catch();
        },
        async getItems(context){
            await axios.get('item').then(({data}) => {
                context.commit('getItems', data);
            }).catch();
        },
        async getItemsPerCategory(context, id){
            await axios.get('item_per_category/'+id).then(({data}) => {
                context.commit('getItems', data);
            }).catch();
        },
        async getManufacturers(context){
            await axios.get('manufacturer').then(({data}) => {
                context.commit('getManufacturers', data);
            }).catch((error) => {
                axios.get('manufacturer').then(({data}) => {
                    context.commit('getManufacturers', data);
                }).catch((error) => {
                    
                });
            });
        },
        async getModes(context){
            await axios.get('mode').then(({data}) => {
                context.commit('getModes', data);
            }).catch();
        },
        async getObrs(context){
            await axios.get('obrs').then(({data}) => {
                context.commit('getObrs', data);
            }).catch();
        },
        async getPackagings(context){
            await axios.get('packaging').then(({data}) => {
                context.commit('getPackagings', data);
            }).catch((error) => {
                axios.get('packaging').then(({data}) => {
                    context.commit('getPackagings', data);
                }).catch((error) => {
                    
                });
            });
        },
        // async getPurchaseOrderDetails(context, id){
        //     await axios.get('pmo_po/'+id).then(({data}) => {
        //         context.commit('getPurchaseOrderDetails', data);
        //     }).catch();
        // },
        async getPurchaseOrderDetails(context, id){
            await axios.get('purchase_order/'+id).then(({data}) => {
                context.commit('getPurchaseOrderDetails', data);
            }).catch();
        },
        // async getPurchaseOrders(context){
        //     await axios.get('pmo_po').then(({data}) => {
        //         context.commit('getPurchaseOrders', data);
        //     }).catch();
        // },
        async getPurchaseOrders(context){
            await axios.get('purchase_order').then(({data}) => {
                context.commit('getPurchaseOrders', data);
            }).catch();
        },
        async searchPurchaseOrders(context, search_word){
            await axios.post('search_po',{
                search_word: search_word
            }).then(({data}) => {
                context.commit('getPurchaseOrders', data);
            }).catch(() => {

            });
        },
        async getPurchaseRequestDetails(context, id){
            await axios.get('purchase_request/'+id).then(({data}) => {
                context.commit('getPurchaseRequestDetails', data);
            }).catch();
        },
        async getPurchaseRequests(context){
            await axios.get('purchase_request').then(({data}) => {
                context.commit('getPurchaseRequests', data);
            }).catch();
        },
        async getRiss(context){
            await axios.get('ris').then(({data}) => {
                context.commit('getRiss', data);
            }).catch();
        },
        async getRoles(context){
            await axios.get('role').then(({data}) => {
                context.commit('getRoles', data);
            }).catch();
        },
        async getSuppliers(context){
            await axios.get('supplier').then(({data}) => {
                context.commit('getSuppliers', data);
            }).catch((error) => {
                axios.get('supplier').then(({data}) => {
                    context.commit('getSuppliers', data);
                }).catch((error) => {
                    
                });
            });
        },
        async getUnits(context){
            await axios.get('unit').then(({data}) => {
                context.commit('getUnits', data);
            }).catch();
        },
        async getEmployees(context){
            await axios.get('employee').then(({data}) => {
                context.commit('getEmployees', data);
            }).catch();
        },
        async getDepartments(context){
            await axios.get('department').then(({data}) => {
                context.commit('getDepartments', data);
            }).catch(() => {

            });
        },
    },
});
