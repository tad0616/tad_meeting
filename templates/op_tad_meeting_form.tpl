<script  type="text/javascript" >
    $(document).ready(function(){
        var meeting_time ;
        var meeting_type ;

        $("#tad_meeting_datetime").blur(function(){
            meeting_time = $("#tad_meeting_datetime").val().substr(0,10);
            meeting_type = $("#tad_meeting_cate option:selected").text();
            $('#tad_meeting_title').val(meeting_time + ' ' + meeting_type);
        });

        $("#tad_meeting_cate").on('change', function(){
            meeting_time = $("#tad_meeting_datetime").val().substr(0,10);
            meeting_type = $("#tad_meeting_cate option:selected").text();
            $('#tad_meeting_title').val(meeting_time + ' ' + meeting_type);
        });
    });
</script>

<{if $create_meeting|default:false}>
    <form action="<{$action|default:''}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-group row mb-3">
            <!--開會日期 datetime-->
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}>
            </label>
            <div class="col-sm-4">
                <input type="text" name="tad_meeting_datetime" id="tad_meeting_datetime" class="form-control validate[required]" value="<{$tad_meeting_datetime|default:''}>"  onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm', startDate:'%y-%M-%d %H:%m'})" placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}>">
            </div>

            <!--會議類別-->
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_SN}>
            </label>
            <div class="col-sm-4">
                <select name="tad_meeting_cate_sn" id="tad_meeting_cate" class="form-control form-select validate[required]" size=1>
                    <option value=""></option>
                    <{foreach from=$tad_meeting_cate_sn_options item=opt}>
                        <option value="<{$opt.tad_meeting_cate_sn}>" <{if $tad_meeting_cate_sn==$opt.tad_meeting_cate_sn}>selected<{/if}>><{$opt.tad_meeting_cate_title}></option>
                    <{/foreach}>
                </select>
            </div>
        </div>

        <!--會議名稱-->
        <div class="form-group row mb-3">
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_TITLE}>
            </label>
            <div class="col-sm-10">
                <input type="text" name="tad_meeting_title" id="tad_meeting_title" class="form-control validate[required]" value="<{$tad_meeting_title|default:''}>" placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_TITLE}>">
            </div>
        </div>

        <!--會議地點-->
        <div class="form-group row mb-3">
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_PLACE}>
            </label>
            <div class="col-sm-4">
                <select name="tad_meeting_place" class="form-control form-select validate[required]" size=1>
                <{foreach from=$meeting_place item=place}>
                    <option value="<{$place|default:''}>" <{if $tad_meeting_place == $place}>selected="selected"<{/if}>><{$place|default:''}></option>
                <{/foreach}>
                </select>
            </div>

            <!--會議主席-->
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}>
            </label>
            <div class="col-sm-4">
                <input type="text" name="tad_meeting_chairman" id="tad_meeting_chairman" class="form-control " value="<{$tad_meeting_chairman|default:''}>" placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}>">
            </div>
        </div>

        <!--相關補充說明-->
        <div class="form-group row mb-3">
            <label class="col-sm-2 control-label col-form-label text-sm-right text-sm-end">
                <{$smarty.const._MD_TADMEETIN_TAD_MEETING_NOTE}>
            </label>
            <div class="col-sm-10">
                <textarea name="tad_meeting_note" rows=8 id="tad_meeting_note" class="form-control " placeholder="<{$smarty.const._MD_TADMEETIN_TAD_MEETING_NOTE}>"><{$tad_meeting_note|default:''}></textarea>
            </div>
        </div>

        <div class="text-center">
            <input type='hidden' name="tad_meeting_sn" value="<{$tad_meeting_sn|default:''}>">
            <{$token_form|default:''}>
            <input type="hidden" name="op" value="<{$next_op|default:''}>">
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk" aria-hidden="true"></i> <{$smarty.const._TAD_SAVE}></button>
        </div>
    </form>
<{/if}>