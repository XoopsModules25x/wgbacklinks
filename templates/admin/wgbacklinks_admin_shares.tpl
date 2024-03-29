<!-- Header -->
<{include file='db:wgbacklinks_admin_header.tpl'}>

<{if isset($clients_list)}>
    <table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_ID}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_URL}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SHARE_RESULTS}></th>
            </tr>
        </thead>
        <{if isset($clients_count) && $clients_count > 0}>
            <tbody>
                <{foreach item=client from=$clients_list}>
                    <tr class="<{cycle values="odd, even"}>">
                        <td class='center'><{$client.id}></td>
                        <td class="center"><{$client.url}></td>
                        <td class="center">
                            <{foreach item=shared from=$client.shared}>
                                <p><{$shared.result}></p>
                            <{/foreach}>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>
<{/if}>

<{if !empty($error)}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<br>

<!-- Footer -->
<{include file='db:wgbacklinks_admin_footer.tpl'}>
