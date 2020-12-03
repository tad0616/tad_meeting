<{if $all_content}>
  <{if $isAdmin}>
    <{$delete_tad_meeting_cate_func}>

      <{$tad_meeting_cate_jquery_ui}>
      <script type="text/javascript">
      $(document).ready(function(){
        $("#tad_meeting_cate_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
          var order = $(this).sortable("serialize");
          $.post("<{$xoops_url}>/modules/tad_meeting/admin/tad_meeting_cate_save_sort.php", order + "&op=update_tad_meeting_cate_sort", function(theResponse){
            $("#tad_meeting_cate_save_msg").html(theResponse);
          });
        }
        });
      });
      </script>
  <{/if}>

  <div id="tad_meeting_cate_save_msg"></div>

  <table class="table table-striped table-hover">
    <thead>
      <tr class="info">

          <th>
            <!--分類標題-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_TITLE}>
          </th>
          <th>
            <!--狀態-->
            <{$smarty.const._MD_TADMEETIN_TAD_MEETING_CATE_ENABLE}>
          </th>
        <{if $isAdmin}>
          <th><{$smarty.const._TAD_FUNCTION}></th>
        <{/if}>
      </tr>
    </thead>

    <tbody id="tad_meeting_cate_sort">
      <{foreach from=$all_content item=data}>
        <tr id="tr_<{$data.tad_meeting_cate_sn}>">

            <td>
              <!--分類標題-->
              <a href="<{$action}>?tad_meeting_cate_sn=<{$data.tad_meeting_cate_sn}>"><{$data.tad_meeting_cate_title}></a>
            </td>

            <td>
              <!--狀態-->
              <{$data.tad_meeting_cate_enable}>
            </td>

          <{if $isAdmin}>
            <td>
              <a href="javascript:delete_tad_meeting_cate_func(<{$data.tad_meeting_cate_sn}>);" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
              <a href="<{$xoops_url}>/modules/tad_meeting/admin/main.php?op=tad_meeting_cate_form&tad_meeting_cate_sn=<{$data.tad_meeting_cate_sn}>" class="btn btn-sm btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
              <img src="<{$xoops_url}>/modules/tadtools/treeTable/images/updown_s.png" style="cursor: s-resize;margin:0px 4px;" alt="<{$smarty.const._TAD_SORTABLE}>" title="<{$smarty.const._TAD_SORTABLE}>">
            </td>
          <{/if}>
        </tr>
      <{/foreach}>
    </tbody>
  </table>


  <{if $isAdmin}>
    <div class="text-right">
      <a href="<{$xoops_url}>/modules/tad_meeting/admin/main.php?op=tad_meeting_cate_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>
  <{/if}>

  <{$bar}>
<{else}>
  <{if $isAdmin}>
    <div class="jumbotron text-center">
      <a href="<{$xoops_url}>/modules/tad_meeting/admin/main.php?op=tad_meeting_cate_form" class="btn btn-info"><{$smarty.const._TAD_ADD}></a>
    </div>
  <{/if}>
<{/if}>
