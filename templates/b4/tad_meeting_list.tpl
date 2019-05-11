<{if $all_content}>

  <div id="tad_meeting_save_msg"></div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>

          <th>
            <!--會議名稱-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_TITLE}>
          </th>
          <th>
            <!--會議類別-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_SN}>
          </th>
          <th>
            <!--開會日期-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}>
          </th>
          <th>
            <!--會議地點-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_PLACE}>
          </th>
          <th>
            <!--會議主席-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}>
          </th>
        <{if $isAdmin}>
          <th><{$smarty.const._TAD_FUNCTION}></th>
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
              <{$data.tad_meeting_cate_sn}>
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

          <{if $isAdmin}>
            <td>
              <a href="javascript:delete_tad_meeting_func(<{$data.tad_meeting_sn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
              <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_sn=<{$data.tad_meeting_sn}>" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
            </td>
          <{/if}>
        </tr>
      <{/foreach}>
    </tbody>
  </table>


  <{if $isAdmin or $create_meeting}>
    <div class="text-right">
      <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn}>" class="btn btn-info"><{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
    </div>
  <{/if}>

  <{$bar}>
<{else}>
  <div class="jumbotron text-center">
    <{if $isAdmin or $create_meeting}>
      <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_cate_sn=<{$tad_meeting_cate_sn}>" class="btn btn-info"><{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
    <{else}>
      <h3><{$smarty.const._TAD_EMPTY}></h3>
    <{/if}>
  </div>
<{/if}>
