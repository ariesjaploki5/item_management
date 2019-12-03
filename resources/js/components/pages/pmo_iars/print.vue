<template>
    <div class="container">
        <button class="btn btn-primary d-print-none button ml-2 mb-2" @click="print()">Print</button> 
        <!-- <div class="header">
            <div class="row bg-white" id="image_row">
                <div class="col-3 border border-dark border-right-0">
                    <img :src="'/img/bghmc.png'" class="img-thumbnail">
                </div>
                <div class="col-9 border border-dark">
                    <div class="row justify-content-center border-dark border-bottom">
                        <div class="col-12">
                            <div class="text-center">Republic of the Philippines</div>
                            <div class="text-center">Department of Health</div>
                            <div class="text-center">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                            <div class="text-center">Baguio City</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 text-center border-dark border-right">
                            <div class="row">
                                <div class="col-12"><div class="text-center">MATERIALS MANAGEMENT OFFICE</div></div>
                                <div class="col-12"><div class="text-center"><h4>INSPECTION AND ACCEPTANCE REPORT</h4></div></div>
                            </div>
                        </div>
                        <div class="col-4" style="padding-left: 1px !important; padding-right: 0px !important;">
                            <div class="row">
                                <div class="col-12"><div class="text-left border-bottom border-dark">Form No.: HS – MMO – 004</div></div>
                                <div class="col-12"><div class="text-left border-bottom border-dark">Revision No.: 1</div></div>
                                <div class="col-12"><div class="text-left">Effectivity Date: September 1, 2016</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row border border-dark border-top-0 border-bottom-0  bg-white">
                <div class="col-6 border-right border-dark">
                    <div class="row">
                        <div class="col-3">Supplier: </div><div class="col-8 border-bottom border-dark">{{ iar.supplier_name }}</div>
                        <div class="col-3">PO Number: </div><div class="col-8 border-bottom border-dark">{{ iar.po_no }}</div>
                        <div class="col-3">PO Date: </div><div class="col-8 border-bottom border-dark">{{ iar.po_date }}</div>
                        <div class="col-3">Resp. Center: </div><div class="col-8 border-bottom border-dark">{{ iar.resp_center }}</div>
                        <div class="col-3 mb-2">ObRequest: </div><div class="col-8 border-bottom border-dark mb-2"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-3" style="padding-right: 0px !important;">IAR Number: </div>
                        <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.iar_no }}</div>
                        <div class="col-3" style="padding-right: 0px !important;">IAR Date: </div>
                        <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.iar_date }}</div>
                        <div class="col-3"></div><div class="col-8"></div>
                        <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Number: </div>
                        <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.ref_no }}</div>
                        <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Date: </div>
                        <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.ref_date }}</div>
                    </div>
                </div>
            </div>
        </div> -->
        <div>
            <div class="row bg-white">
                <table class="table table-bordered" cellspacing="0" cellpadding="0">
                    <thead class="mt-5">
                        <tr>
                            <th colspan="7">
                                <div class="row bg-white" id="image_row">
                                    <div class="col-3 border border-dark border-right-0">
                                        <img :src="'/img/bghmc.png'" class="img-thumbnail">
                                    </div>
                                    <div class="col-9 border border-dark">
                                        <div class="row justify-content-center border-dark border-bottom">
                                            <div class="col-12">
                                                <div class="text-center">Republic of the Philippines</div>
                                                <div class="text-center">Department of Health</div>
                                                <div class="text-center">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                                                <div class="text-center">Baguio City</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 text-center border-dark border-right">
                                                <div class="row">
                                                    <div class="col-12"><div class="text-center">MATERIALS MANAGEMENT OFFICE</div></div>
                                                    <div class="col-12"><div class="text-center"><h4>INSPECTION AND ACCEPTANCE REPORT</h4></div></div>
                                                </div>
                                            </div>
                                            <div class="col-4" style="padding-left: 1px !important; padding-right: 0px !important;">
                                                <div class="row">
                                                    <div class="col-12"><div class="text-left border-bottom border-dark">Form No.: HS – MMO – 004</div></div>
                                                    <div class="col-12"><div class="text-left border-bottom border-dark">Revision No.: 1</div></div>
                                                    <div class="col-12"><div class="text-left">Effectivity Date: September 1, 2016</div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border border-dark border-top-0 border-bottom-0  bg-white">
                                    <div class="col-6 border-right border-dark">
                                        <div class="row">
                                            <div class="col-3">Supplier: </div><div class="col-8 border-bottom border-dark">{{ iar.supplier_name }}</div>
                                            <div class="col-3">PO Number: </div><div class="col-8 border-bottom border-dark">{{ iar.po_no }}</div>
                                            <div class="col-3">PO Date: </div><div class="col-8 border-bottom border-dark">{{ iar.po_date }}</div>
                                            <div class="col-3">Resp. Center: </div><div class="col-8 border-bottom border-dark">{{ iar.resp_center }}</div>
                                            <div class="col-3 mb-2">ObRequest: </div><div class="col-8 border-bottom border-dark mb-2"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3" style="padding-right: 0px !important;">IAR Number: </div>
                                            <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.iar_no }}</div>
                                            <div class="col-3" style="padding-right: 0px !important;">IAR Date: </div>
                                            <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.iar_date }}</div>
                                            <div class="col-3"></div><div class="col-8"></div>
                                            <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Number: </div>
                                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.ref_no }}</div>
                                            <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Date: </div>
                                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">{{ iar.ref_date }}</div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th width="15%" class="text-center">Stock / Property No.</th>
                            <th width="23%" class="text-center">Description</th>
                            <th width="10%" class="text-center">Unit</th>
                            <th width="10%" class="text-center">Quantity</th>
                            <th width="12%" class="text-center">Unit Cost</th>
                            <th width="15%" class="text-center">Total</th>
                            <th width="15%" class="text-center">Lot/Batch No.</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr class="border border-dark">
                            <th width="48%" colspan="3" class="text-center">INSPECTION</th>
                            <th width="52%" colspan="4" class="text-center">ACCEPTANCE</th>
                        </tr>
                        <tr>
                            <th colspan="7">
                                <div class="row bg-white">
                                    <div class="col-6">
                                        Inspected, verified and foind in order as to quantity, specifications, and expiry date (if applicable).
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-4">Date Received:</div>
                                            <div class="col-7 border-bottom border-dark">{{ iar.received_date }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Partial / Complete ?</div>
                                            <div class="col-7 border-bottom border-dark"></div>
                                        </div>
                                    </div>
                                </div>
                            </th>

                        </tr>
                        <tr>
                            <th colspan="7">
                                <div class="row bg-white">
                                    <div class="col-4 border-dark border-right border-left">
                                        <div class="row">
                                            Inspection Officer
                                        </div>
                                        <div class="row mt-4">
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4>{{ iar.inspection_officer_name }}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                Date Inspected
                                            </div>
                                            <div class="col-6 border-bottom border-dark">
                                                {{ iar.inspection_date }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 border-dark border-right">
                                        <div class="row">
                                            Requisitioning Officer
                                        </div>
                                        <div class="row mt-4">
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4>(NAME)</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                Date Inspected
                                            </div>
                                            <div class="col-6 border-bottom border-dark">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        
                                        <div class="row">
                                            Supply and/or Property Custodian
                                        </div>
                                        <div class="row mt-4">
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <h4>TEOFILO M. RIVERA JR.</h4>
                                                Supervising Administrative Officer Head,<div class="w-100"></div>
                                                Materials Management Office
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr v-for="batch in iar.batches" :key="batch.batch_no">
                            <td class="text-center"></td>
                            <td class="text-left">{{ batch.item_desc }}</td>
                            <td class="text-center">{{ batch.unit_desc }}</td>
                            <td class="text-right">{{ batch.quantity }}</td>
                            <td class="text-right">{{ batch.cost }}</td>
                            <td class="text-right">{{ batch.total_cost }}</td>
                            <td class="text-center">{{ batch.batch_no}}</td>
                        </tr>

                    </tbody>
                    
                </table>
            </div>
        </div>
        <div>
            
        </div>
        
    </div>
</template>
<script>

import axios from 'axios'
export default {

    data(){
        return{
            iar: {
                batches: [],
            }
        }
    },
    methods: {
        get_iar(){
            axios.get('iar/'+this.$route.params.id).then(({data}) => {
                this.iar = data;
            }).catch(() => {

            });
        },
        print(){
            var curURL = window.location.href;
            history.replaceState(history.state, '', '/');
            window.print();
            history.replaceState(history.state, '', curURL);
        },
    },
    created(){
        this.get_iar();
    },
    computed:{

    },
}
</script>
<style lang="scss" scoped>

    @media print {

        .row  {
            margin-right: -4px !important;
            margin-left: -4px !important;
        }


        .img-thumbnail {
            border: none;
            display: block;
            margin-top: .7rem;
            margin-left: auto;
            margin-right: auto;
            width: 70% !important;
            height: 80% !important;
        }

        td {
            padding: 0 !important; 
            margin: 0 !important;
        }
        


        @page { 
            margin-bottom: 50px;

        }



        table.table-bordered > thead > tr > th, table.table-bordered > tbody > tr > td, table.table-bordered > tfoot > tr > th{
            border:1px solid rgb(0, 0, 0) !important;
        }

    }

    
    .img-thumbnail {
        border: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 45%;
    }
    .scroll-y {
        height: auto;
        overflow: visible;
    }

    .col-xl, .col-xl-auto, 
        .col-xl-12, .col-xl-11, 
        .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, 
        .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg, .col-lg-auto, 
        .col-lg-12, .col-lg-11, .col-lg-10, 
        .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, 
        .col-lg-3, .col-lg-2, .col-lg-1, .col-md, .col-md-auto, .col-md-12, .col-md-11, 
        .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, 
        .col-md-3, .col-md-2, .col-md-1, .col-sm, .col-sm-auto, .col-sm-12, .col-sm-11, 
        .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, 
        .col-sm-3, .col-sm-2, .col-sm-1, .col, .col-auto, .col-12, .col-11, .col-10, .col-9, 
        .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1 {
        width: 100%;
        padding-top: 0px;
        padding-bottom: 0px;

    }
    .row  {
                margin-right: -4px !important;
                margin-left: -4px !important;
        }
table.table-bordered > thead > tr > th, table.table-bordered > tbody > tr > td, table.table-bordered > tfoot > tr > th{
            border:1px solid rgb(0, 0, 0) !important;
        }

    .content-wrapper {
        background: rgba(205, 205, 207, 0.87) !important;
    }
</style>