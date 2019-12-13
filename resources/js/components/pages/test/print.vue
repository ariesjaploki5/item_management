<template>
  <div>
    <div class="page-header" style="text-align: center">
        <div class="row  bg-white" id="image_row">
            <div class="col-3 border border-dark border-right-0">
                <img :src="'/img/bghmc.png'" class="img-thumbnail">
            </div>
            <div class="row d-none d-print-block fixed-top text-right mr-5 mt-2">
                <span id="control_no" class="mr-5">{{ ris.control_no }}</span>
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
                    <div class="col-3">Division: </div><div class="col-8 border-bottom border-dark">
                        <span id="dept_div">{{ ris.division_desc }}</span>
                    </div>
                    <div class="col-3">Office: </div><div class="col-8 border-bottom border-dark">
                        <span id="dept_div">{{ ris.department_desc }}</span>
                    </div>
                    <div class="col-4">Resp. Center Code </div><div class="col-7 border-bottom border-dark">

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-3" style="padding-right: 0px !important;">RIS NO.: </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ ris.ris_no }}</div>
                    <div class="col-3" style="padding-right: 0px !important;">RIS DATE: </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;">{{ ris.ris_date }}</div>
                    <div class="col-3" style="padding-right: 0px !important;">Fund Cluster </div>
                    <div class="col-8 border-bottom border-dark" style="padding-left: 0px !important;"></div>
                </div>
            </div>
        </div>
    </div>

  <div class="page-footer">
    <div class="row bg-white">
            <table  class="table table-bordered">
                <tbody>
                    <tr>
                        <td width="20%"></td>
                        <td width="20%">Requested by</td>
                        <td width="20%">Approved by</td>
                        <td width="20%">Issued by</td>
                        <td width="20%">Received By</td>
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
                        <td class="text-center">{{ ris.requested_by_user }}</td>
                        <td class="text-center">RIVERA, TEOFILO JR M. </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
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
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
  </div>

  <table>

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <!--*** CONTENT GOES HERE ***-->
          <div class="page">PAGE 1</div>
          <div class="page">PAGE 2</div>
          <div class="page" style="line-height: 3;">
            PAGE 3 - Long Content
            <br/> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tincidunt metus eu consectetur rutrum. Praesent tempor facilisis dapibus. Aliquam cursus diam ac vehicula pulvinar. Integer lacinia non odio et condimentum. Aenean faucibus cursus
            mi, sed interdum turpis sagittis a. Quisque quis pellentesque mi. Ut erat eros, posuere sed scelerisque ut, pharetra vitae tellus. Suspendisse ligula sapien, laoreet ac hendrerit sit amet, viverra vel mi. Pellentesque faucibus nisl et dolor
            pharetra, vel mattis massa venenatis. Integer congue condimentum nisi, sed tincidunt velit tincidunt non. Nulla sagittis sed lorem pretium aliquam. Praesent consectetur volutpat nibh, quis pulvinar est volutpat id. Cras maximus odio posuere
            suscipit venenatis. Donec rhoncus scelerisque metus, in tempus erat rhoncus sed. Morbi massa sapien, porttitor id urna vel, volutpat blandit velit. Cras sit amet sem eros. Quisque commodo facilisis tristique. Proin pellentesque sodales rutrum.
            Vestibulum purus neque, congue vel dapibus in, venenatis ut felis. Donec et ligula enim. Sed sapien sapien, tincidunt vitae lectus quis, ultricies rhoncus mi. Nunc dapibus nulla tempus nunc interdum, sed facilisis ex pellentesque. Nunc vel
            lorem leo. Cras pharetra sodales metus. Cras lacus ex, consequat at consequat vel, laoreet ac dui. Curabitur aliquam, sapien quis congue feugiat, nisi nisl feugiat diam, sed vehicula velit nulla ac nisl. Aliquam quis nisi euismod massa blandit
            pharetra nec eget nunc. Etiam eros ante, auctor sit amet quam vel, fringilla faucibus leo. Morbi a pulvinar nulla. Praesent sed vulputate nisl. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean commodo
            mollis iaculis. Maecenas consectetur enim vitae mollis venenatis. Ut scelerisque pretium orci id laoreet. In sit amet pharetra diam. Vestibulum in molestie lorem. Nunc gravida, eros non consequat fermentum, ex orci vestibulum orci, non accumsan
            sem velit ac lectus. Vivamus malesuada lacus nec velit dignissim, ac fermentum nulla pretium. Aenean mi nisi, convallis sed tempor in, porttitor eu libero. Praesent et molestie ante. Duis suscipit vitae purus sit amet aliquam. Vestibulum lectus
            justo, lobortis a purus a, dapibus efficitur metus. Suspendisse potenti. Duis dictum ex lorem. Suspendisse nec ligula consectetur magna hendrerit ullamcorper et eget mauris. Etiam vestibulum sodales diam, eget venenatis nunc luctus quis. Ut
            fermentum placerat neque nec elementum. Praesent orci erat, rhoncus vitae est eu, dictum molestie metus. Cras et fermentum elit. Aenean eget augue lacinia, varius ante in, ullamcorper dolor. Cras viverra purus non egestas consectetur. Nulla
            nec dolor ac lectus convallis aliquet sed a metus. Suspendisse eu imperdiet nunc, id pulvinar risus. Maecenas varius sagittis est, vel fermentum risus accumsan at. Vestibulum sollicitudin dui pharetra sapien volutpat, id convallis mi vestibulum.
            Phasellus commodo sit amet lorem quis imperdiet. Proin nec diam sed urna euismod ultricies at sed urna. Quisque ornare, nulla et vehicula ultrices, massa purus vehicula urna, ac sodales lacus leo vitae mi. Sed congue placerat justo at placerat.
            Aenean suscipit fringilla vehicula. Quisque iaculis orci vitae arcu commodo maximus. Maecenas nec nunc rutrum, cursus elit quis, porttitor sapien. Sed ac hendrerit ipsum, lacinia fringilla velit. Donec ultricies feugiat dictum.
          </div>
        </td>
      </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
          <!--place holder for the fixed-position footer-->
          <div class="page-footer-space"></div>
        </td>
      </tr>
    </tfoot>

  </table>
  </div>
</template>

<script>
export default {
    data(){
        return{
            ris: {
                items: [],
            },
        }
    },
    methods: {
        get_ris(){
            axios.get('ris/2019-12-0005').then(({data}) => {
                this.ris = data;
            }).catch(() => {

            });
        },
    },
    created(){
        this.get_ris();
    }

}
</script>

<style scoped>
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
    .page-header, .page-header-space {
        height: 100px;
        }

        .page-footer, .page-footer-space {
        height: 50px;

        }

        .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        border-top: 1px solid black; /* for demo */
        background: yellow; /* for demo */
        }

    .page-header {
    position: fixed;
    top: 0mm;
    width: 100%;
    border-bottom: 1px solid black; /* for demo */
    background: yellow; /* for demo */
    }

.page {
  page-break-after: always;
}

@page {
  margin: 20mm
}

@media print {
   thead {display: table-header-group;} 
   tfoot {display: table-footer-group;}
   
   button {display: none;}
   
   body {margin: 0;}
}
</style>