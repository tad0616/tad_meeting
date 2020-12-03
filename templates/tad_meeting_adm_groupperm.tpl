<div class="container-fluid">
    <{if $now_op}>
        <{includeq file="$xoops_rootpath/modules/tad_meeting/templates/op_`$now_op`.tpl"}>
    <{else}>
        <{$permission_content}>
    <{/if}>
</div>
