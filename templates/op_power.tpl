<div id="grouppermformTab">
    <ul class="resp-tabs-list vert">
        <{foreach from=$title item=power_title}>
            <li> <{$power_title|default:''}> </li>
        <{/foreach}>
    </ul>

    <div class="resp-tabs-container vert">
        <{foreach from=$form item=power_form}>
            <div> <{$power_form|default:''}> </div>
        <{/foreach}>
    </div>
</div>
