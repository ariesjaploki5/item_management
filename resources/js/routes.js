



import login from './components/pages/auth/login';
import main from './components/pages/auth/main';

import logout from './components/pages/auth/logout';
import register from './components/pages/auth/register';

import home from './components/pages/home'

import purchase_orders from './components/pages/purchase_orders'
import purchase_order_list from './components/pages/purchase_orders/list'
import purchase_order from './components/pages/purchase_orders/show'
import purchase_order_obrs from './components/pages/purchase_orders/obrs'
import purchase_order_print from './components/pages/purchase_orders/print'
import purchase_order_create from './components/pages/purchase_orders/create'

import pmo_pos from './components/pages/pmo_pos'
import pmo_po_list from './components/pages/pmo_pos/list'
import pmo_po from './components/pages/pmo_pos/show'
import pmo_po_create_iar from './components/pages/pmo_pos/create_iar'
import pmo_po_create_dv from './components/pages/pmo_pos/create_dv'

import pmo_iars from './components/pages/pmo_iars'
import pmo_iar_list from './components/pages/pmo_iars/list'
import pmo_iar from './components/pages/pmo_iars/show'
import pmo_iar_print from './components/pages/pmo_iars/print'

import pmo_riss from './components/pages/pmo_riss'
import pmo_ris_list from './components/pages/pmo_riss/list'
import pmo_ris from './components/pages/pmo_riss/show'
import pmo_ris_create from './components/pages/pmo_riss/create'
import pmo_ris_print from './components/pages/pmo_riss/print'

import pmo_dvs from './components/pages/pmo_dvs'
import pmo_dv_list from './components/pages/pmo_dvs/list'
import pmo_dv from './components/pages/pmo_dvs/show'
import pmo_dv_print from './components/pages/pmo_dvs/print'

import purchase_requests from './components/pages/purchase_requests'
import purchase_request_list from './components/pages/purchase_requests/list'
import purchase_request from './components/pages/purchase_requests/show'
import purchase_request_create from './components/pages/purchase_requests/create'
import purchase_request_print from './components/pages/purchase_requests/print'

import users from './components/pages/users'
import user_list from './components/pages/users/list'
import user from './components/pages/users/show'
import user_create from './components/pages/users/create'
import profile from './components/pages/users/profile'

import employees from './components/pages/employees'
import employee_list from './components/pages/employees/list'
import employee from './components/pages/employees/show'
import employee_create from './components/pages/employees/create'

import batches from './components/pages/batches'
import batch_list from './components/pages/batches/list'
import batch from './components/pages/batches/show'
import batch_create from './components/pages/batches/create'

import items from './components/pages/items'
import item_list from './components/pages/items/list'
import item from './components/pages/items/show'
import item_dm from './components/pages/items/drugs_and_medicines'
import item_md from './components/pages/items/medical_supplies'
import item_os from './components/pages/items/other_supplies'
import item_ofs from './components/pages/items/office_supplies'

import disbursement_vouchers from './components/pages/disbursement_vouchers'
import disbursement_voucher_list from './components/pages/disbursement_vouchers/list'
import disbursement_voucher from './components/pages/disbursement_vouchers/show'

import inspection_and_acceptance_reports from './components/pages/inspection_and_acceptance_reports'
import inspection_and_acceptance_report_list from './components/pages/inspection_and_acceptance_reports/list'
import inspection_and_acceptance_report from './components/pages/inspection_and_acceptance_reports/show'
import inspection_and_acceptance_report_print from './components/pages/inspection_and_acceptance_reports/print'
import inspection_and_acceptance_report_report from './components/pages/inspection_and_acceptance_reports/report'

import create_iar from './components/pages/inspection_and_acceptance_reports/create'

import requisition_slips from './components/pages/requisition_slips'
import requisition_slip_list from './components/pages/requisition_slips/list'
import requisition_slip from './components/pages/requisition_slips/show'
import requisition_slip_create from './components/pages/requisition_slips/create'
import requisition_slip_print from './components/pages/requisition_slips/print'
import requisition_slip_reports from './components/pages/requisition_slips/report'

import test_print from './components/pages/test/print'

export const routes = [
    {
        path: '/test_print',
        name: 'test_print',
        component: test_print
    },
    {
        path: '/register',
        name: 'register',
        component: register,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/main',
        name: 'main',
        component: main,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/login',
        name: 'login',
        componet: login,
        meta: {
            requiresVisitor: true,
        }
    },
    {
        path: '/logout',
        name: 'logout',
        component: logout,

    },
    {
        path: '/',
        name: 'home',
        component: home,
        meta: {
            requiresAuth: true,
        }
    },
    {
        path: '/batches',
        component: batches,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: batch_list,
                name: 'batches',
            },
            {
                path: 'create_batch',
                component: batch_create,
                name: 'batch_create',
            },
            {
                path:':id',
                component: batch,
                name: 'batch_show',
            },
        ],
    },
    {
        path: '/employees',
        component: employees,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: employee_list,
                name: 'employees',
            },
            {
                path: 'create_employee',
                component: employee_create,
                name: 'employee_create',
            },
            {
                path:':id',
                component: employee,
                name: 'employee_show',
            },
        ],
    },
    {
        path: '/users',
        component: users,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: user_list,
                name: 'users',
            },
            {
                path: 'create_user',
                component: user_create,
                name: 'user_create',
            },
            {
                path:':id',
                component: user,
                name: 'user_show',
            },
            {
                path:':id/profile',
                component: profile,
                name: 'profile',
            },
        ],
    },
    {
        path: '/pmo_pos',
        component: pmo_pos,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: pmo_po_list,
                name: 'pmo_pos',
            },
            {
                path:':id',
                component: pmo_po,
                name: 'pmo_po_show',
            },
            {
                path: ':id/pmo_po_create_iar',
                component: pmo_po_create_iar,
                name: 'pmo_po_create_iar',
            },
            {
                path: ':id/pmo_po_create_dv',
                component: pmo_po_create_dv,
                name: 'pmo_po_create_dv',
            },
        ],
    },
    {
        path: '/pmo_iars',
        component: pmo_iars,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: pmo_iar_list,
                name: 'pmo_iars',
            },
            {
                path:':id',
                component: pmo_iar,
                name: 'pmo_iar_show',
            },
            {
                path: ':id/pmo_iar_print',
                component: pmo_iar_print,
                name: 'pmo_iar_print',
            },

        ],
    },
    {
        path: '/pmo_riss',
        component: pmo_riss,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: pmo_ris_list,
                name: 'pmo_riss',
            },
            {
                path: 'pmo_ris_create',
                component: pmo_ris_create,
                name: 'pmo_ris_create',
            },
            {
                path:':id',
                component: pmo_ris,
                name: 'pmo_ris_show',
            },
            {
                path: ':id/pmo_ris_print',
                component: pmo_ris_print,
                name: 'pmo_ris_print',
            },

        ],
    },
    {
        path: '/purchase_orders',
        component: purchase_orders,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: purchase_order_list,
                name: 'purchase_orders',
            },
            {
                path: 'create_po/:id',
                component: purchase_order_create,
                name: 'purchase_order_create',
            },
            {
                path:':id',
                component: purchase_order,
                name: 'purchase_order_show',
            },
            {
                path: ':id/obrs',
                component: purchase_order_obrs,
                name: 'purchase_order_obrs',
            },
            {
                path: ':id/print',
                component: purchase_order_print,
                name: 'purchase_order_print',
            },
            
            {
                path: ':id/create_iar',
                component: create_iar,
                name: 'create_iar',
            }
        ],
    },
    {
        path: '/purchase_requests',
        component: purchase_requests,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: purchase_request_list,
                name: 'purchase_requests',
            },
            {
                path: 'create_pr',
                component: purchase_request_create,
                name: 'purchase_request_create',
            },
            {
                path:':id',
                component: purchase_request,
                name: 'purchase_request_show',
            },
            {
                path: ':id/print',
                component: purchase_request_print,
                name: 'purchase_request_print',
            }
        ],
    },
    {
        path: '/items',
        component: items,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: item_list,
                name: 'items',
            },
            {
                path: '/item_dm',
                component: item_dm,
                name: 'item_dm',
            },
            {
                path: '/item_md',
                component: item_md,
                name: 'item_md',
            },
            {
                path: '/item_ofs',
                component: item_ofs,
                name: 'item_ofs',
            },
            {
                path: '/item_os',
                component: item_os,
                name: 'item_os',
            },
            {
                path:':id',
                component: item,
                name: 'item_show',
            }
        ],
    },
    {
        path: '/inspection_and_acceptance_reports',
        component: inspection_and_acceptance_reports,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: inspection_and_acceptance_report_list,
                name: 'inspection_and_acceptance_reports',
            },
            {
                path: 'reports',
                component: inspection_and_acceptance_report_report,
                name: 'inspection_and_acceptance_report_report',
            },
            {
                path:':id',
                component: inspection_and_acceptance_report,
                name: 'inspection_and_acceptance_report_show',
            },
            {
                path:':id/print',
                component: inspection_and_acceptance_report_print,
                name: 'inspection_and_acceptance_report_print',
            }
        ],
    },
    {
        path: '/requisition_slips',
        component: requisition_slips,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: requisition_slip_list,
                name: 'requisition_slips',
            },
            {
                path:'create_ris',
                component: requisition_slip_create, 
                name: 'requisition_slip_create',
            },
            {
                path: 'reports',
                component: requisition_slip_reports,
                name: 'requisition_slip_reports',
            },
            {
                path:':id',
                component: requisition_slip,
                name: 'requisition_slip_show',
            },
            {
                path:':id/print',
                component: requisition_slip_print,
                name: 'requisition_slip_print',
            },
        ],
    },
    {
        path: '/disbursement_vouchers',
        component: disbursement_vouchers,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: '',
                component: disbursement_voucher_list,
                name: 'disbursement_vouchers',
            },
            {
                path:':id',
                component: disbursement_voucher,
                name: 'disbursement_voucher_show',
            }
        ],
    },
]
