<div class="container-fluid">
    <{if $now_op|default:false}>
        <{include file="$xoops_rootpath/modules/tad_meeting/templates/op_`$now_op`.tpl"}>
    <{/if}>
</div>
