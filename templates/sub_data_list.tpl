<{if $all_data_content}>
    <{if $smarty.session.tad_meeting_adm or $create_meeting}>
        <{$delete_tad_meeting_data_func}>
    <{/if}>

    <{if $smarty.session.tad_meeting_adm or $sort_meeting}>
        <{$tad_meeting_data_jquery_ui}>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#tad_meeting_data_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
                    var order = $(this).sortable("serialize");
                    $.post("<{$xoops_url}>/modules/tad_meeting/tad_meeting_data_save_sort.php", order + "&op=update_tad_meeting_data_sort&tad_meeting_cate_sn=<{$tad_meeting_cate_sn}>", function(theResponse){
                        $("#tad_meeting_data_save_msg").html(theResponse);
                    });
                }
                });
            });
        </script>
    <{/if}>

    <div id="tad_meeting_data_save_msg"></div>

    <div id="tad_meeting_data_sort" class="bg-white" style="padding: 30px 20px; margin: 30px 0px; box-shadow: 0px 0px 10px gray;">
        <{foreach from=$all_data_content item=data}>
            <div id="tr_<{$data.tad_meeting_data_sn}>">
                <!--報告標題-->
                <div class="pull-right float-right pull-end" style="font-size: 0.9rem; color: rgb(43, 90, 151);">
                    <div class="text-right text-end">
                        <!--處室-->
                        <{$data.tad_meeting_data_unit}>
                        <!--職務-->
                        <{$data.tad_meeting_data_job}>
                        <!--報告者-->
                        <{$data.tad_meeting_data_uid_name}>
                    </div>
                    <div class="text-right text-end">
                        <{$data.tad_meeting_data_date}>
                    </div>
                </div>
                <h3 class="my">
                    <{$data.number2chinese}><{$smarty.const._MD_TADMEETIN_COMMA}><{$data.tad_meeting_data_title}>
                </h3>

                <div style="line-height: 1.8; padding: 10px 0px 0px 48px; text-align: justify;">
                    <{if $data.tad_meeting_data_content_html}>
                        <{$data.tad_meeting_data_content_html}>
                    <{else}>
                        <{$smarty.const._MD_TADMEETIN_NONE}>
                    <{/if}>
                    <{if $smarty.session.tad_meeting_adm or $now_uid==$data.tad_meeting_data_uid}>
                        <div class="text-right text-end">
                            <a href="javascript:delete_tad_meeting_data_func(<{$data.tad_meeting_data_sn}>);" class="btn btn-sm btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/tad_meeting/index.php?tad_meeting_sn=<{$tad_meeting_sn}>&tad_meeting_data_sn=<{$data.tad_meeting_data_sn}>#tad_meeting_data_form" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                            <{if $sort_meeting}>
                                <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
                            <{/if}>
                        </div>
                    <{/if}>
                    <{$data.list_file}>
                </div>
                <hr>
            </div>
        <{/foreach}>
    </div>
<{else}>
    <{if $smarty.session.tad_meeting_adm or $create_meeting}>
        <div class="jumbotron bg-light p-5 rounded-lg m-3 text-center">
            <h3><{$smarty.const._TAD_EMPTY}></h3>
        </div>
    <{/if}>
<{/if}>
