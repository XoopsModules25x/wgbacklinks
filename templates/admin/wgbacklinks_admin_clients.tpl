<!-- Header -->
<{include file='db:wgbacklinks_admin_header.tpl'}>

<{if $clients_list|default:false}>
	<table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_ID}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_URL}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_KEY}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_KEY_CHECK}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_CLIENT_DATE_CREATED}></th>
                <th class="center width5"><{$smarty.const._AM_WGBACKLINKS_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if $clients_count|default:false}>
            <tbody>
                <{foreach item=client from=$clients_list}>
                    <tr class="<{cycle values="odd, even"}>">
                        <td class='center'><{$client.id}></td>
                        <td class="center"><{$client.url}></td>
                        <td class="center"><{$client.key}></td>
                        <td class="center"><{$client.validkey}></td>
                        <td class="center"><{$client.submitter}></td>
                        <td class="center"><{$client.date_created}></td>
                        <td class="center  width5">
                            <a href="clients.php?op=edit&amp;client_id=<{$client.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="clients"></a>
                            <a href="clients.php?op=delete&amp;client_id=<{$client.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="clients"></a>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>

    <div class="clear">&nbsp;</div>

    <{if $pagenav|default:''}>
        <div class="xo-pagenav floatright"><{$pagenav}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>

<{if $form|default:''}>
	<{$form}>
<{/if}>

<{if $error|default:''}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer -->
<{include file='db:wgbacklinks_admin_footer.tpl'}>
