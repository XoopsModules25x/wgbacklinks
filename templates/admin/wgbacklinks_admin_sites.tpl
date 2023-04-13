<!-- Header -->
<{include file='db:wgbacklinks_admin_header.tpl'}>

<{if isset($sites_list)}>
    <table class='table table-bordered'>
        <thead>
            <tr class="head">
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_ID}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_NAME}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_DESCR}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_URL}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_UNIQUEID}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_ACTIVE}></th>
                <{if isset($moduletype) && $moduletype == 1}>
                    <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_SHARED}></th>
                <{/if}>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_SUBMITTER}></th>
                <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_DATE_CREATED}></th>
                <th class="center width5"><{$smarty.const._AM_WGBACKLINKS_FORM_ACTION}></th>
            </tr>
        </thead>
        <{if isset($sites_count) && $sites_count > 0}>
            <tbody>
                <{foreach item=site from=$sites_list}>
                    <tr class="<{cycle values="odd, even"}>">
                        <td class='center'><{$site.id}></td>
                        <td class="center"><{$site.name}></td>
                        <td class="center"><{$site.descr}></td>
                        <td class="center"><{$site.url}></td>
                        <td class="center"><{$site.uniqueid}></td>
                        <td class="center"><{$site.active_img}></td>
                        <{if isset($moduletype) && $moduletype == 1}>
                            <td class="center"><{$site.shared_img}></td>
                        <{/if}>
                        <td class="center"><{$site.submitter}></td>
                        <td class="center"><{$site.date_created}></td>
                        <td class="center  width5">
                            <a href="sites.php?op=edit&amp;site_id=<{$site.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 'edit.png'}>" alt="sites"></a>
                            <{if isset($site.shared) && $site.shared == 1 && isset($site.active) && $site.active == 0}>
                                <a href="sites.php?op=delete&amp;site_id=<{$site.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 'delete.png'}>" alt="sites"></a>
                            <{/if}>
                        </td>
                    </tr>
                <{/foreach}>
            </tbody>
        <{/if}>
    </table>
    <div class="clear">&nbsp;</div>

    <{if !empty($pagenav)}>
        <div class="xo-pagenav floatright"><{$pagenav}></div>
        <div class="clear spacer"></div>
    <{/if}>
<{/if}>

<{if !empty($form)}>
	<{$form}>
<{/if}>
<{if !empty($error)}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>
<br>
<!-- Footer -->
<{include file='db:wgbacklinks_admin_footer.tpl'}>
