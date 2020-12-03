<{if $block}>
    <ul class="vertical_menu">
        <{foreach from=$block item=data}>
            <li>
                <a href="<{$xoops_url}>/modules/tad_meeting/index.php?tad_meeting_sn=<{$data.tad_meeting_sn}>"><{$data.tad_meeting_title}></a>
            </li>
        <{/foreach}>
    </ul>
    <div class="text-right"><a href="<{$xoops_url}>/modules/tad_meeting/index.php" class="badge badge-info">more...</a></div>
<{/if}>