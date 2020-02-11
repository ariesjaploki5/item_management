<template>
    <div class="container">
        <div class="container-fluid">
            <button class="btn btn-primary d-print-none button ml-2 mb-2" @click="print()">Print</button>

            <header>
                <div class="row bg-white" id="image_row">
                    <div class="col-3 border border-dark border-right-0">
                        <img :src="'/img/bghmc.png'" class="img-thumbnail">
                    </div>
                    <div class="col-9 border border-dark">
                        <div class="row justify-content-center border-dark border-bottom">
                            <div class="col-12">
                                <div class="text-center" id="dept_div">Republic of the Philippines</div>
                                <div class="text-center" id="dept_div">Department of Health</div>
                                <div class="text-center" id="dept_div">BAGUIO GENERAL HOSPITAL AND MEDICAL CENTER</div>
                                <div class="text-center" id="dept_div">Baguio City</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 text-center border-dark border-right">
                                <div class="row">
                                    <div class="col-12" id="dept_div">
                                        <div class="text-center">MATERIALS MANAGEMENT OFFICE</div>
                                    </div>
                                    <div class="col-12" id="dept_div">
                                        <div class="text-center">
                                            <h4><span>INSPECTION AND ACCEPTANCE REPORT</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4" style="padding-left: 1px !important; padding-right: 0px !important;">
                                <div class="row">
                                    <div class="col-12" id="dept_div">
                                        <div class="text-left border-bottom border-dark">Form No.: HS-MMO-004</div>
                                    </div>
                                    <div class="col-12" id="dept_div">
                                        <div class="text-left border-bottom border-dark">Revision No.: 1</div>
                                    </div>
                                    <div class="col-12" id="dept_div_2">
                                        <div class="text-left">Effectivity Date: September 1, 2016</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border border-dark border-top-0 border-bottom-0 bg-white">
                    <div class="col-6 border-right border-dark">
                        <div class="row">
                            <div class="col-3">Supplier: </div>
                            <div class="col-8 border-bottom border-dark">{{ iar.po.supplier_name }}</div>
                            <div class="col-3">PO Number: </div>
                            <div class="col-8 border-bottom border-dark">{{ iar.po_no }}</div>
                            <div class="col-3">PO Date: </div>
                            <div class="col-8 border-bottom border-dark">{{ iar.po.po_date }}</div>
                            <div class="col-3">Resp. Center: </div>
                            <div class="col-8 border-bottom border-dark">{{ iar.po.dept_name }}</div>
                            <div class="col-3 mb-2">ObRequest: </div>
                            <div class="col-8 border-bottom border-dark mb-2">{{ iar.po.obrs }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4" style="padding-right: 0px !important;">IAR Number: </div>
                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">
                                {{ iar.iar_no }}</div>
                            <div class="col-4" style="padding-right: 0px !important;">IAR Date: </div>
                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">
                                {{ iar.iar_date }}</div>
                            <div class="col-3"></div>
                            <div class="col-8"></div>
                            <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Number: </div>
                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">
                                {{ iar.ref_no }}</div>
                            <div class="col-4" style="padding-right: 0px !important;">DR/Invoice Date: </div>
                            <div class="col-7 border-bottom border-dark" style="padding-left: 0px !important;">
                                {{ iar.ref_date }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <main>
                <div class="row bg-white">
                    <table class="table table-bordered">
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
                        <tbody class="table_class">
                            <tr v-for="batch in iar.batches" :key="batch.batch_no">
                                <td class="text-center" style="height:3rem;"></td>
                                <td class="text-left">{{ batch.item_desc }}</td>
                                <td class="text-center">{{ batch.item_unit }}</td>
                                <td class="text-right">{{ batch.quantity | numFormat }}</td>
                                <td class="text-right">₱{{ batch.cost }}</td>
                                <td class="text-right">₱{{ batch.total_cost | numFormat('0,0.00') }}</td>
                                <td class="text-center">{{ batch.batch_no}}</td>
                            </tr>
                            <tr class="border">
                                <td id="nb" colspan="5" class="text-right font-weight-bold border-right-0 border-left-0 border-bottom-0" ></td>
                                <td id="nb" class="font-weight-bold total border-right-0 border-left-0 border-bottom-0">
                                    <span class="float-left">Total</span> 
                                    <span class="float-right">₱{{total | numFormat('0,0.00')}}</span>
                                </td>                                
                                <td id="nb" class="border-left-0 border-right-0 border-bottom-0"></td>
                            </tr>
                            <tr>
                                <td id="nb" colspan="7" class=" text-center font-weight-bold"><i>***Nothing follows***</i></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            
                        </tfoot>
                    </table>
                </div>
            </main>
            <footer>
                <div class="row bg-white">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="48%" class="text-center" colspan="3">INSPECTION</th>
                                <th width="52%" class="text-center" colspan="4">ACCEPTANCE</th>
                            </tr>
                            <tr>
                                <th colspan="7">
                                    <div class="row bg-white">
                                        <div class="col-6">
                                            Inspected, verified and found in order as to quantity, specifications, and
                                            expiry date (if applicable).
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-4">Date Received:</div>
                                                <div class="col-7 border-bottom border-dark">{{ iar.received_date }}
                                                </div>
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
                                        <div class="col-4 border-dark border-right">
                                            <span class="mb-5"> Inspection Officer</span>
                                            <div class="w-100"></div>
                                            <div class="col-12 text-center mt-4 mb-2">
                                                <h5>{{ iar.inspection_officer_name }}</h5>
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="row">
                                                <div class="col-5">Date Inspected</div>
                                                <div class="col-6 border-bottom border-dark"> {{ iar.inspection_date }}</div>
                                            </div>
                                        </div>
                                        <div class="col-4 border-dark border-right">
                                            <span>Requisitioning Officer</span>
                                            <div class="w-100"></div>
                                            <div class="col-12 text-center mt-4 mb-2">
                                                <h5>(NAME)</h5>
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="row">
                                                <div class="col-5">Date Inspected</div>
                                                <div class="col-6 border-bottom border-dark"> {{ iar.inspection_date }}</div>
                                            </div>
                                        </div>
                                        <div class="col-4 border-dark">
                                            <span>Supply and/or Property Custodian</span>
                                            <div class="w-100"></div>
                                            <div class="col-12 text-center mt-4 mb-2">
                                                <h5>JANO R. CARDENAS</h5>
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="row">
                                                <div class="col-12 text-center"> OIC - Head, Materials Management Office</div>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </footer>
        </div>
    </div>
</template>
<script>

    import axios from 'axios'
    export default {

        data() {
            return {
                iar: {
                    po: {
                        supplier_name: '',
                        po_date: '',
                        dept_name: '',
                    },
                    batches: [],
                }
            }
        },
        methods: {
            get_iar() {
                axios.get('pmo_iar/' + this.$route.params.id).then(({
                    data
                }) => {
                    this.iar = data;
                }).catch(() => {

                });
            },
            print() {
                var curURL = window.location.href;
                history.replaceState(history.state, '', '/');
                window.print();
                history.replaceState(history.state, '', curURL);
            },
        },
        created() {
            this.get_iar();
        },
        computed: {
            total: function(){
                var sum=0;
                this.iar.batches.forEach(myTot);
                function myTot(item) {
                    sum += item.total_cost;
                }
                return sum 
            }
        
        },
    }

</script>
<style>
    @media print {

        .ris_class {
            font-size: 33px !important;
            font-family: Times New Roman !important;
        }

        main {
            height: 55rem;
        }

        body {
            overflow: auto;
            height: auto;

        }

        /* #image_row{
             margin-top: 2rem;
        } */

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

        table.table-bordered>thead>tr>th,
        table.table-bordered>tbody>tr>td {
            border: 1px solid rgb(0, 0, 0) !important;
        }

        #nb{ 
            border-left: solid white !important;
            border-right: solid white !important;
            border-bottom: solid white !important;
            /* height: 500px !important; */
        }
    }

    .container{
        display: flex !important;
        align-items: flex-start !important;
    }
    .cc {
        align-self: center !important;
    }

    .img-thumbnail {
        border: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 6%;
        width: 58%;
    }

    .scroll-y {
        height: auto;
        overflow: visible;
    }

    .col-xl,
    .col-xl-auto,
    .col-xl-12,
    .col-xl-11,
    .col-xl-10,
    .col-xl-9,
    .col-xl-8,
    .col-xl-7,
    .col-xl-6,
    .col-xl-5,
    .col-xl-4,
    .col-xl-3,
    .col-xl-2,
    .col-xl-1,
    .col-lg,
    .col-lg-auto,
    .col-lg-12,
    .col-lg-11,
    .col-lg-10,
    .col-lg-9,
    .col-lg-8,
    .col-lg-7,
    .col-lg-6,
    .col-lg-5,
    .col-lg-4,
    .col-lg-3,
    .col-lg-2,
    .col-lg-1,
    .col-md,
    .col-md-auto,
    .col-md-12,
    .col-md-11,
    .col-md-10,
    .col-md-9,
    .col-md-8,
    .col-md-7,
    .col-md-6,
    .col-md-5,
    .col-md-4,
    .col-md-3,
    .col-md-2,
    .col-md-1,
    .col-sm,
    .col-sm-auto,
    .col-sm-12,
    .col-sm-11,
    .col-sm-10,
    .col-sm-9,
    .col-sm-8,
    .col-sm-7,
    .col-sm-6,
    .col-sm-5,
    .col-sm-4,
    .col-sm-3,
    .col-sm-2,
    .col-sm-1,
    .col,
    .col-auto,
    .col-12,
    .col-11,
    .col-10,
    .col-9,
    .col-8,
    .col-7,
    .col-6,
    .col-5,
    .col-4,
    .col-3,
    .col-2,
    .col-1 {
        width: 100%;
        padding-top: 0px;
        padding-bottom: 0px;

    }

    table.table-bordered>thead>tr>th {
        border: 1px solid rgb(0, 0, 0);
    }

    table.table-bordered>tbody>tr>td {
        border: 1px solid rgb(0, 0, 0);
    }

    #dept_div {
        font-size: 15px !important;
    }

    .iar_class {
        font-size: 33px !important;
        font-family: Times New Roman !important;
    }

    .table_class tr td {
        font-size: 15px !important;

    }

</style>
