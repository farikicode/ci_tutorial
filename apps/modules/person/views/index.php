<?php

/* 
 * ***************************************************************
 * Script : index.php
 * Version : 
 * Date : Mar 21, 2017
 * Time : 9:59:11 PM
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a href="<?=site_url('person/add');?>" class="btn btn-primary">Tambah</a>
                <a href="javascirpt:void(0);" class="btn btn-default btn-refresh">Refresh</a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover dataTable">
                    <thead>
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                Alamat
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                No. Telp
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Tgl. Lahir
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Hapus
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>
                                Nama
                            </th>
                            <th>
                                Alamat
                            </th>
                            <th>
                                Jenis Kelamin
                            </th>
                            <th>
                                No. Telp
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Tgl. Lahir
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                                Hapus
                            </th>
                        </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
            <div class="box-footer">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
       table = $(".dataTable").DataTable({
           "bProcessing" : true,
           "bServerSide" : true,
           "columnDefs" : [
               {"orderable": false, "targets" : 6 },
               {"orderable": false, "targets" : 7 },
           ],
           "pagingType" : "simple",
           "sAjaxSource" : "<?=site_url('person/json_dgview');?>",
           
       });
    });
</script>