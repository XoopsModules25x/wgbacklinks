<{include file='db:wgbacklinks_header.tpl'}>

<{if count($sites|default:0) > 0}>
	<table class="table">
        <tr>
			<th class="head center"><{$smarty.const._MA_WGBACKLINKS_SITE_NAME}></th>
            <th class="head center"><{$smarty.const._MA_WGBACKLINKS_SITE_DESCR}></th>
            <th class="head center"><{$smarty.const._MA_WGBACKLINKS_SITE_URL}></th>
		</tr>
        <{section name=i loop=$sites}>
		<tr class="<{cycle values="odd, even"}>">
			<td class="top center"><{$sites[i].name|default:''}></td>
            <td class="top center"><{$sites[i].descr|default:''}></td>
            <td class="top center"><a href="<{$sites[i].url|default:''}>" title=""><{$sites[i].name|default:''}></a></td>
		</tr>
		<{/section}>
	</table>
<{/if}>

<{include file='db:wgbacklinks_footer.tpl'}>
