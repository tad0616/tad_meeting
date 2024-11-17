<h2 class="sr-only visually-hidden">List Meeting</h2>

<{if $all_content|default:false}>
    <div id="tad_meeting_save_msg"></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr class="bg-primary white">
                <th class="c">
                    <!--會議名稱-->
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_TITLE}>
                </th>
                <th class="c">
                    <!--會議類別-->
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_SN}>
                </th>
                <th class="c">
                    <!--開會日期-->
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}>
                </th>
                <th class="c">
                    <!--會議地點-->
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_PLACE}>
                </th>
                <th class="c">
                    <!--會議主席-->
                    <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}>
                </th>
                <{if $tad_meeting_adm|default:false}>
                    <th class="c"><{$smarty.const._TAD_FUNCTION}></th>
                <{/if}>
            </tr>
        </thead>

        <tbody id="tad_meeting_sort">
            <{foreach from=$all_content item=data}>
                <tr id="tr_<{$data.tad_meeting_sn}>">

                    <td>
                        <!--會議名稱-->
                        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?tad_meeting_sn=<{$data.tad_meeting_sn}>"><{$data.tad_meeting_title}></a>
                    </td>

                    <td>
                        <!--會議類別-->
                        <{if $tad_meeting_adm|default:false}>
                            <a href="<{$xoops_url}>/modules/tad_meeting/admin/main.php?tad_meeting_cate_sn=<{$data.tad_meeting_cate_sn}>"><{$data.tad_meeting_cate_title}></a>
                        <{else}>
                            <{$data.tad_meeting_cate_title}>
                        <{/if}>

                    </td>

                    <td>
                        <!--開會日期-->
                        <{$data.tad_meeting_datetime}>
                    </td>

                    <td>
                        <!--會議地點-->
                        <{$data.tad_meeting_place}>
                    </td>

                    <td>
                        <!--會議主席-->
                        <{$data.tad_meeting_chairman}>
                    </td>

                    <{if $tad_meeting_adm|default:false}>
                        <td>
                            <a href="javascript:delete_tad_meeting_func(<{$data.tad_meeting_sn}>);" class="btn btn-sm btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_sn=<{$data.tad_meeting_sn}>" class="btn btn-sm btn-xs btn-warning"><i class="fa fa-pencil-square" aria-hidden="true"></i> <{$smarty.const._TAD_EDIT}></a>
                        </td>
                    <{/if}>
                </tr>
            <{/foreach}>
        </tbody>
    </table>

    <{if $tad_meeting_adm or $create_meeting}>
        <div class="text-right text-end">
            <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn|default:''}>" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
        </div>
    <{/if}>

    <{$bar|default:''}>
<{else}>
    <div class="jumbotron bg-light p-5 rounded-lg m-3 text-center">
        <{if $tad_meeting_adm or $create_meeting}>
            <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn|default:''}>" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> <{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
        <{else}>
            <h3><{$smarty.const._TAD_EMPTY}></h3>
        <{/if}>
    </div>
<{/if}>
