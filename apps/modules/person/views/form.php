<?php

/* 
 * ***************************************************************
 * Script : form.php
 * Version : 
 * Date : Mar 26, 2017
 * Time : 8:32:34 PM
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{msg_main}</h3>
            </div>
            <?php
                echo form_open('person/submit');
            ?>
            <div class="box-body">
                <div class="form-group">
                    <?php echo form_input($form['id']) ;?>
                    <?php echo form_input($form['name']) ;?>
                </div>
                <div class="form-group">
                    <?php echo form_textarea($form['address']) ;?>
                </div>
                <div class="form-group">
                    <?php echo form_dropdown($form['gender']['name'],$form['gender']['data'],$form['gender']['value'],$form['gender']['attr']) ;?>
                </div>
                <div class="form-group">
                    <?php echo form_input($form['phone']) ;?>
                </div>
                <div class="form-group">
                    <?php echo form_input($form['email']) ;?>
                </div>
                <div class="form-group">
                    <?php echo form_input($form['birthdate']) ;?>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
                <a href="<?=site_url('person');?>" class="btn btn-default">
                    Batal
                </a>
            </div>
            <?php
                echo form_close();
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#birthdate").datepicker({
        'format': 'yyyy-mm-dd'
    });
</script>