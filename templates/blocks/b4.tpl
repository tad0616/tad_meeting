<{if $smarty.session.bootstrap==4}>
    <{includeq file="$xoops_rootpath/modules/模組/templates/blocks/b4/`$this_file`"}>
<{else}>
    <{includeq file="$xoops_rootpath/modules/模組/templates/blocks/b3/`$this_file`"}>
<{/if}>