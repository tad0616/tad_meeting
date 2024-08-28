<div class="btn-group pull-right float-right pull-end" role="group" >
    <{if $smarty.session.tad_meeting_adm or $create_meeting}>
        <a href="javascript:delete_tad_meeting_func(<{$tad_meeting_sn}>);" class="btn btn-sm btn-xs btn-danger" title="<{$smarty.const._TAD_DEL}>"><i class="fa fa-times" aria-hidden="true"></i></a>
        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form" class="btn btn-sm btn-xs btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
    <{/if}>
</div>
<h2 class="my">
    <{$tad_meeting_title}>
</h2>

<!--相關補充說明-->
<{if $tad_meeting_note}>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info">
                <{$tad_meeting_note}>
            </div>
        </div>
    </div>
<{/if}>

<!-- 判斷目前使用者是否有：觀看會議內容 -->
<{if $view_meeting}>
    <table class="table table-bordered table-hover table-condensed table-sm bg-white">
        <tbody>
            <tr>
                <!--會議類別-->
                <th class="c" scope="row"><{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_SN}></th>
                <td class="c"><{$tad_meeting_cate_sn_title}></td>
                <!--開會日期-->
                <th class="c" scope="row"><{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}></th>
                <td class="c"><{$tad_meeting_datetime}></td>
            </tr>
            <tr>
                <!--會議地點-->
                <th class="c" scope="row"><{$smarty.const._MD_TADMEETIN_TAD_MEETING_PLACE}></th>
                <td class="c"><{$tad_meeting_place}></td>
                <!--會議主席-->
                <th class="c" scope="row"><{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}></th>
                <td class="c"><{$tad_meeting_chairman}></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-5">
            <div style="color: rgb(110, 47, 71)"><{$orderby}></div>
        </div>
        <div class="col-sm-7 text-right text-end">
            <{$smarty.const._MD_TADMEETIN_DOWNLOAD}>
            <a href="pdf.php?tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_DOWNLOAD_PDF}></a>
            <a href="word.php?tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-primary"><i class="fa fa-file-word-o" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_DOWNLOAD_WORD}></a>
        </div>
    </div>

    <!--列出所有資料-->
    <{include file="$xoops_rootpath/modules/tad_meeting/templates/sub_data_list.tpl"}>

<{/if}>

<!-- 判斷目前使用者是否有：填寫會議內容 -->
<{if $post_meeting}>
    <{include file="$xoops_rootpath/modules/tad_meeting/templates/sub_data_edit_form.tpl"}>
<{/if}>
