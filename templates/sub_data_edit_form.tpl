<script  type="text/javascript" >
    $(document).ready(function(){
        var data_unit='' ;
        var data_job='' ;

        $("#tad_meeting_data_unit").blur(function(){
            data_unit = $("#tad_meeting_data_unit option:selected").text();
            if($("#tad_meeting_data_job option:selected").text() != ""){
                data_job = '<{$smarty.const._MD_TADMEETIN_BRACKETS_L}>' + $("#tad_meeting_data_job option:selected").text() + '<{$smarty.const._MD_TADMEETIN_BRACKETS_R}>';
            }
            $('#tad_meeting_data_title').val(data_unit +  data_job + '<{$smarty.const._MD_TADMEETIN_REPORT}>');
        });

        $("#tad_meeting_data_job").change(function(){
            data_unit = $("#tad_meeting_data_unit option:selected").text();
            if($("#tad_meeting_data_job option:selected").text()!= ""){
                data_job = '<{$smarty.const._MD_TADMEETIN_BRACKETS_L}>' + $("#tad_meeting_data_job option:selected").text() + '<{$smarty.const._MD_TADMEETIN_BRACKETS_R}>';
            }
            $('#tad_meeting_data_title').val(data_unit +  data_job + '<{$smarty.const._MD_TADMEETIN_REPORT}>');
        });


        $('#data_edit_form').click(function(){
            $('#myForm').toggle();
        });

    });
</script>

<{if $post_meeting}>
    <a name="tad_meeting_data_form"> </a>
    <div class="text-center" style="margin: 30px auto;">
        <button type="button" id="data_edit_form" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_ADD_REPORT}></button>
    </div>

    <form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form" <{if !$tad_meeting_data_sn}>style="display: none;"<{/if}>>
        <div class="alert alert-info">
            <!--處室-->
            <div class="form-group row">
                <label class="col-sm-2 control-label col-form-label text-sm-right">
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_UNIT}>
                </label>
                <div class="col-sm-4">
                    <select name="tad_meeting_data_unit" id="tad_meeting_data_unit" class="form-control" size=1>
                        <option value="" <{if $tad_meeting_data_unit == ""}>selected="selected"<{/if}>></option>
                        <{foreach from=$meeting_unit item=unit}>
                        <option value="<{$unit}>" <{if $tad_meeting_data_unit == $unit}>selected="selected"<{/if}>><{$unit}></option>
                        <{/foreach}>
                    </select>
                </div>

                <!--職務-->
                <label class="col-sm-2 control-label col-form-label text-sm-right">
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_JOB}>
                </label>
                <div class="col-sm-4">
                    <select name="tad_meeting_data_job" id="tad_meeting_data_job" class="form-control" size=1>
                        <option value="" <{if $tad_meeting_data_job == ""}>selected="selected"<{/if}>></option>
                        <{foreach from=$meeting_job item=job}>
                        <option value="<{$job}>" <{if $tad_meeting_data_job == $job}>selected="selected"<{/if}>><{$job}></option>
                        <{/foreach}>
                    </select>
                </div>
            </div>

            <!--報告標題-->
            <div class="form-group row">
                <label class="col-sm-2 control-label col-form-label text-sm-right">
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_TITLE}>
                </label>
                <div class="col-sm-10">
                    <input type="text" name="tad_meeting_data_title" id="tad_meeting_data_title" class="form-control " value="<{$tad_meeting_data_title}>" placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_TITLE}>">
                </div>
            </div>

            <!--報告內容-->
            <div class="form-group row">
                <label class="col-sm-2 control-label col-form-label text-sm-right">
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_CONTENT}>
                </label>
                <div class="col-sm-10">
                    <textarea name="tad_meeting_data_content" rows=8 id="tad_meeting_data_content" class="form-control " placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATA_CONTENT}>"><{$tad_meeting_data_content}></textarea>
                </div>
            </div>

            <!--上傳-->
            <div class="form-group row">
                <label class="col-sm-2 control-label col-form-label text-sm-right">
                    <{$smarty.const._MD_TADMEETIN_UP_TAD_MEETING_DATA_SN}>
                </label>
                <div class="col-sm-10">
                    <{$up_tad_meeting_data_sn_form}>
                </div>
            </div>

            <div class="text-center">
                <input type="hidden" name="tad_meeting_data_sort" id="tad_meeting_data_sort" value="<{$tad_meeting_data_sort}>">
                <input type='hidden' name="tad_meeting_data_uid" value="<{$tad_meeting_data_uid}>">
                <input type='hidden' name="tad_meeting_sn" value="<{$tad_meeting_sn}>">
                <input type='hidden' name="tad_meeting_data_sn" value="<{$tad_meeting_data_sn}>">
                <{$token_form}>
                <input type="hidden" name="op" value="<{$next_op}>">
                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> <{$smarty.const._TAD_SAVE}></button>
            </div>
        </div>
    </form>
<{/if}>