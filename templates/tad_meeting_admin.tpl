<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <div id="save_msg"></div>
            <{$ztree_code}>

            <div class="d-grid gap-2">
                <a href="main.php?op=tad_meeting_cate_form" class="btn btn-info btn-block"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._TAD_ADD_CATE}></a>
            </div>

            <{if $tad_meeting_cate_sn > 0}>
                <div class="alert alert-info" style="margin-top:20px;">
                    <h4><{$cate.tad_meeting_cate_title}></h4>
                    <ol>
                        <li><{$smarty.const._MA_TADMEETIN_CAN_ACCESS_GROUPS}>: <{$view_meeting_txt}></li>
                        <li><{$smarty.const._MA_TADMEETIN_CAN_CREATE_GROUPS}>: <{$create_meeting_txt}></li>
                        <li><{$smarty.const._MA_TADMEETIN_CAN_POST_GROUPS}>: <{$post_meeting_txt}></li>
                        <li><{$smarty.const._MA_TADMEETIN_CAN_SORT_GROUPS}>: <{$sort_meeting_txt}></li>
                    </ol>
                </div>
            <{/if}>
        </div>
        <div class="col-sm-9">
            <div class="alert alert-success">
                <{if $tad_meeting_cate_sn > 0}>
                    <div class="row">
                        <div class="col-sm-4">
                            <h1 class="my"><{$cate.tad_meeting_cate_title}></h1>
                        </div>
                        <div class="col-sm-8 text-right text-end">
                            <div style="margin-top: 10px;">
                                <a href="javascript:delete_tad_meeting_cate_func(<{$cate.tad_meeting_cate_sn}>);" class="btn btn-danger <{if $cate_count.$tad_meeting_cate_sn > 0}>disabled<{/if}>"><i class="fa fa-times" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                                <a href="main.php?op=tad_meeting_cate_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn}>" class="btn btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                                <a href="main.php?op=tad_meeting_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn}>" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._TAD_ADD}></a>
                            </div>
                        </div>
                    </div>
                <{else}>
                    <h1 class="my"><{$smarty.const._MA_TADMEETIN_ALL_MEETING}></h1>
                <{/if}>
            </div>

            <{if $now_op=="tad_meeting_cate_form"}>
                <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/op_`$now_op`.tpl"}>
            <{elseif $now_op=="tad_meeting_form"}>
                <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/op_`$now_op`.tpl"}>
            <{elseif $now_op=="list_tad_meeting"}>
                <form action="main.php" method="post" class="form-horizontal" role="form">
                    <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/op_`$now_op`.tpl"}>
                </form>
            <{else}>
                <div class="alert alert-danger text-center">
                    <h3><{$smarty.const._TAD_EMPTY}></h3>
                </div>
            <{/if}>
        </div>
    </div>
</div>