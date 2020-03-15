<{if $all_data_content}>
  <{if $isAdmin or $create_meeting}>
    <{$delete_tad_meeting_data_func}>
  <{/if}>

  <{if $isAdmin or $sort_report}>
    <{$tad_meeting_data_jquery_ui}>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#tad_meeting_data_sort").sortable({ opacity: 0.6, cursor: "move", update: function() {
          var order = $(this).sortable("serialize");
          $.post("<{$xoops_url}>/modules/tad_meeting/admin/tad_meeting_data_save_sort.php", order + "&op=update_tad_meeting_data_sort", function(theResponse){
            $("#tad_meeting_data_save_msg").html(theResponse);
          });
        }
        });
      });
    </script>
  <{/if}>

  <div id="tad_meeting_data_save_msg"></div>

    <div id="tad_meeting_data_sort">
      <{foreach from=$all_data_content item=data}>
        <div id="tr_<{$data.tad_meeting_data_sn}>">

          <!--報告標題-->
          <h3>
            <div class="pull-right" style="font-size: 0.9em; color: gray;">
              <div class="text-right">
                <!--處室-->
                <{$data.tad_meeting_data_unit}>
                <!--職務-->
                <{$data.tad_meeting_data_job}>
                <!--報告者-->
                <{$data.tad_meeting_data_uid_name}>
              </div>
              <div class="text-right">
                <{$data.tad_meeting_data_date}>
              </div>
            </div>

            <{$data.number2chinese}><{$smarty.const._MD_TADMEETIN_COMMA}><a href="<{$action}>?tad_meeting_data_sn=<{$data.tad_meeting_data_sn}>"><{$data.tad_meeting_data_title}></a>
          </h3>

          <div style="line-height: 1.8; padding: 10px 0px 0px 48px; text-align: justify;">
            <{if $data.tad_meeting_data_content_html}>
              <{$data.tad_meeting_data_content_html}>
            <{else}>
              <{$smarty.const._MD_TADMEETIN_NONE}>
            <{/if}>
            <{if $isAdmin or $now_uid==$data.tad_meeting_data_uid}>
              <div class="text-right">

                <a href="javascript:delete_tad_meeting_data_func(<{$data.tad_meeting_data_sn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
                <a href="<{$xoops_url}>/modules/tad_meeting/index.php?tad_meeting_sn=<{$tad_meeting_sn}>&tad_meeting_data_sn=<{$data.tad_meeting_data_sn}>#tad_meeting_data_form" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
                <{if $isAdmin or $sort_report}>
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
  <{if $isAdmin or $create_meeting}>
    <div class="jumbotron text-center">
      <h3><{$smarty.const._TAD_EMPTY}></h3>
    </div>
  <{/if}>
<{/if}>
