<{$toolbar}>

<{if $now_op=="tad_meeting_form"}>
  <!-- 判斷目前使用者是否有：建立會議 -->
  <{if $create_meeting}>
    <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/tad_meeting_edit_form.tpl"}>
  <{/if}>
<{/if}>

<!--顯示某一筆資料-->
<{if $now_op=="show_one_tad_meeting"}>

  <h2 class="text-center">
    <div class="btn-group pull-right" role="group" >
      <{if $isAdmin or $create_meeting}>

        <a href="javascript:delete_tad_meeting_func(<{$tad_meeting_sn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form&tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?op=tad_meeting_form" class="btn btn-sm btn-info"><{$smarty.const._MD_TADMEETIN_ADD_MEETING}></a>
      <{/if}>
      <a href="<{$action}>" class="btn btn-sm btn-success"><{$smarty.const._TAD_HOME}></a>
    </div>
    <{$tad_meeting_title}>
  </h2>

  <!--相關補充說明-->
  <{if $tad_meeting_note}>
    <div class="row">
      <label class="col-sm-3 text-right">
        <{$smarty.const._MD_TADMEETIN_TAD_MEETING_NOTE}>
      </label>
      <div class="col-sm-9">
        <div class="card card-body bg-light m-1">
          <{$tad_meeting_note}>
        </div>
      </div>
    </div>
  <{/if}>

  <!-- 判斷目前使用者是否有：觀看會議內容 -->
  <{if $read_report}>
    <table class="table table-bordered table-hover">
      <tbody>
        <tr>
          <!--會議類別-->
          <th><{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_SN}></th>
          <td><{$tad_meeting_cate_sn_title}></td>
          <!--開會日期-->
          <th><{$smarty.const._MD_TADMEETIN_TAD_MEETING_DATETIME}></th>
          <td><{$tad_meeting_datetime}></td>
        </tr>
        <tr>
          <!--會議地點-->
          <th><{$smarty.const._MD_TADMEETIN_TAD_MEETING_PLACE}></th>
          <td><{$tad_meeting_place}></td>
          <!--會議主席-->
          <th><{$smarty.const._MD_TADMEETIN_TAD_MEETING_CHAIRMAN}></th>
          <td><{$tad_meeting_chairman}></td>
        </tr>
      </tbody>
    </table>

    <div class="text-right">
      <a href="pdf.php?tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-danger"><{$smarty.const._MD_TADMEETIN_DOWNLOAD_PDF}></a>
      <a href="word.php?tad_meeting_sn=<{$tad_meeting_sn}>" class="btn btn-primary"><{$smarty.const._MD_TADMEETIN_DOWNLOAD_WORD}></a>
    </div>

    <!--列出所有資料-->
    <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/tad_meeting_data_list.tpl"}>

  <{/if}>

  <!-- 判斷目前使用者是否有：填寫會議內容 -->
  <{if $add_report}>
    <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/tad_meeting_data_edit_form.tpl"}>
  <{/if}>

<{/if}>

<!--列出所有資料-->
<{if $now_op=="list_tad_meeting"}>
  <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/tad_meeting_list.tpl"}>
<{/if}>
