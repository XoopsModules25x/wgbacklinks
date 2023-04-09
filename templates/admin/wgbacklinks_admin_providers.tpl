<!-- Header -->
<{include file='db:wgbacklinks_admin_header.tpl'}>

<{if isset($providers_list)}>
	<table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_ID}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_URL}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_KEY}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_KEY_CHECK}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_PROVIDER_DATE_CREATED}></th>
                <th class="center width5"><{$smarty.const._AM_WGBACKLINKS_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if isset($providers_count)}>
            <tbody>
                <{foreach item=provider from=$providers_list}>
                    <tr class="<{cycle values="odd, even"}>">
                        <td class='center'><{$provider.id}></td>
                        <td class="center"><{$provider.name}></td>
                        <td class="center"><{$provider.url}></td>
                        <td class="center"><{$provider.key}></td>
                        <td class="center"><{$provider.validkey}></td>
                        <td class="center"><{$provider.submitter}></td>
                        <td class="center"><{$provider.date_created}></td>
                        <td class="center  width5">
                            <a href="providers.php?op=edit&amp;provider_id=<{$provider.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="providers"></a>
                            <a href="providers.php?op=delete&amp;provider_id=<{$provider.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="providers"></a>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>

    <div class="clear">&nbsp;</div>
    <{if isset($pagenav)}>
        <div class="xo-pagenav floatright"><{$pagenav}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>

<{if isset($form)}>
	<{$form}>
<{/if}>

<{if isset($error)}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer -->
<{include file='db:wgbacklinks_admin_footer.tpl'}>
