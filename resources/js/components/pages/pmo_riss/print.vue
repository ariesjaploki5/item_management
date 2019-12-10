<template>
    <div class="container">
        <button class="btn btn-primary d-print-none button ml-2 mb-2" @click="print()">Print</button> 
        <div class="row  bg-white" id="image_row">
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
                            <div class="col-12"><div class="text-center"><h4>REQUISITION AND ISSUE SLIP</h4></div></div>
                        </div>
                    </div>
                    <div class="col-4" style="padding-left: 1px !important; padding-right: 0px !important;">
                        <div class="row">
                            <div class="col-12"><div class="text-left border-bottom border-dark">Form No.: HS-MMO-023</div></div>
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
                    <div class="col-3">Division: </div><div class="col-8 border-bottom border-dark">{{ ris.division }}</div>
                    <div class="col-3">Office: </div><div class="col-8 border-bottom border-dark">{{ ris.department }}</div>
                    <div class="col-3">Resp. Center Code </div><div class="col-8 border-bottom border-dark">{{ ris.department }}</div>
                    
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-3" style="padding-right: 0px !important;">RIS NO.: </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ ris.ris_no }}</div>
                    <div class="col-3" style="padding-right: 0px !important;">RIS DATE: </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ ris.ris_date }}</div>
                    <div class="col-3" style="padding-right: 0px !important;">Fund Cluster </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ ris.ris_date }}</div>
                </div>
            </div>
        </div>
        <div class="row  bg-white">
            <table class="table table-bordered" style="margin-bottom: 0px; height: 800px;">
                <thead>
                    <tr>
                        <th class="text-center">Stock No.</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Unit</th>
                        <th class="text-center">Unit Cost</th>
                        <th class="text-center">Lot/Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="batch in ris.items" :key="batch.batch_no">
                        <td class="text-center"></td>
                        <td class="text-right">{{ batch.requested_quantity }}</td>
                        <td class="text-center">{{ batch.item_unit }}</td>
                        <td class="text-left">
                            {{ batch.item_desc }}
                            <div class="w-100"></div>
                            <label for="" v-show="batch.brand !== null">Brand: </label>{{ batch.brand }}
                        </td>
                        <td class="text-right">{{ batch.issued_quantity }}</td>
                        <td class="text-center">{{ batch.item_unit }}</td>
                        <td class="text-right">{{ batch.cost }}</td>
                        <td class="text-left">{{ batch.batch_no }}</td>
                    </tr>
                </tbody>
            </table>
            <table  class="table table-bordered">
                <tbody>
                    <tr>
                        <td></td>
                        <td>Requested by</td>
                        <td>Approved by</td>
                        <td>Issued by</td>
                        <td>Received By</td>
                    </tr>
                    <tr>
                        <td>Signature</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Printed name</td>
                        <td>{{ ris.requested_name }}</td>
                        <td></td>
                        <td>{{ ris.issued_name }}</td>
                        <td>{{ ris.received_name }}</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>{{ ris.ris_date }}</td>
                        <td></td>
                        <td>{{ ris.issued_date }}</td>
                        <td>{{ ris.received_date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>

import axios from 'axios'
export default {

    data(){
        return{
            ris: {
                batches: [],
            }
        }
    },
    methods: {
        get_ris(){
            axios.get('pmo_ris/'+this.$route.params.id).then(({data}) => {
                this.ris = data;
            }).catch(() => {

            });
        },
        print(){
            window.print();
        },
    },
    created(){
        this.get_ris();
    },
    computed:{

    },
}
</script>
<style lang="scss" scoped>

    @media print {
    body { 
        overflow: auto;
        height: auto; 
        
    }
    #image_row{
        margin-top: 2rem;
    }

    /* .img-thumbnail {
                margin-top: 5%;
        } */
    .img-thumbnail {
        border: none;
        display: block;
        margin-top: .7rem;
        margin-left: auto;
        margin-right: auto;
        width: 70% !important;
        height: 80% !important;
    }

    table.table-bordered > thead > tr > th, table.table-bordered > tbody > tr > td{
        border:1px solid rgb(0, 0, 0) !important;
    }
    #barcode{
        margin-top: 0rem !important;
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
    table.table-bordered > thead > tr > th{
        border:1px solid rgb(0, 0, 0);
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid rgb(0, 0, 0);
    }

</style>