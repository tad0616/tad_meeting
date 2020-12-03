<form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">
    <div class="row" style="margin: 10px 0px;">
        <div class="col-sm-6">
            <!--分類標題-->
            <div class="form-group row">
                <label class="col-sm-3 control-label col-form-label text-sm-right">
                    <{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_TITLE}>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="tad_meeting_cate_title" id="tad_meeting_cate_title" class="form-control validate[required]" value="<{$tad_meeting_cate_title}>" placeholder="<{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_TITLE}>">
                </div>
            </div>

            <!--分類說明-->
            <div class="form-group row">
                <label class="col-sm-3 control-label col-form-label text-sm-right">
                    <{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_DESC}>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="tad_meeting_cate_desc" id="tad_meeting_cate_desc" class="form-control " value="<{$tad_meeting_cate_desc}>" placeholder="<{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_DESC}>">
                </div>
            </div>

            <!--分類排序-->
            <div class="form-group row">
                <label class="col-sm-3 control-label col-form-label text-sm-right">
                    <{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_SORT}>
                </label>
                <div class="col-sm-9">
                    <input type="text" name="tad_meeting_cate_sort" id="tad_meeting_cate_sort" class="form-control " value="<{$tad_meeting_cate_sort}>" placeholder="<{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_SORT}>">
                </div>
            </div>

            <!--狀態-->
            <div class="form-group row">
                <label class="col-sm-3 control-label col-form-label text-sm-right">
                    <{$smarty.const._MA_TADMEETIN_TAD_MEETING_CATE_ENABLE}>
                </label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tad_meeting_cate_enable" id="tad_meeting_cate_enable_1" value="1" <{if $tad_meeting_cate_enable == "1"}>checked<{/if}>>
                    <label class="form-check-label" for="tad_meeting_cate_enable_1"><{$smarty.const._YES}></label>
                    </div>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tad_meeting_cate_enable" id="tad_meeting_cate_enable_0" value="0" <{if $tad_meeting_cate_enable != "1"}>checked<{/if}>>
                    <label class="form-check-label" for="tad_meeting_cate_enable_0"><{$smarty.const._NO}></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <label><{$smarty.const._MA_TADMEETIN_CAN_ACCESS_GROUPS}></label>
            <{$enable_group}>
        </div>

        <div class="col-sm-3">
            <label><{$smarty.const._MA_TADMEETIN_CAN_POST_GROUPS}></label>
            <{$enable_post_group}>
        </div>
    </div>

    <div class="text-center">
        <input type='hidden' name="tad_meeting_cate_sn" value="<{$tad_meeting_cate_sn}>">
        <{$token_form}>
        <input type="hidden" name="op" value="<{$next_op}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>
