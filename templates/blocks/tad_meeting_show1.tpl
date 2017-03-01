<!-- for bootstrap3-->
  <ul class="list-group">
    <{foreach from=$block.content item=data}>
      <li class="list-group-item">
        <a href="<{$xoops_url}>/modules/tad_meeting/index.php?tad_meeting_sn=<{$data.tad_meeting_sn}>"><{$data.tad_meeting_title}></a>
      </li>
    <{/foreach}>
  </ul>
