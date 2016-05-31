<!-- Header -->
<{include file='db:wgbacklinks_admin_header.tpl'}>

<{if $sites_list}>
<table class='table table-bordered'>
    <thead>
        <tr class="head">
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_ID}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_NAME}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_DESCR}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_URL}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_UNIQUEID}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_ACTIVE}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_SUBMITTER}></th>
            <th class="center"><{$smarty.const._AM_WGBACKLINKS_SITE_DATE_CREATED}></th>
            <th class="center width5"><{$smarty.const._AM_WGBACKLINKS_FORM_ACTION}></th>
        </tr>
    </thead>

    <{if $sites_count}>
    <tbody>
        <{foreach item=site from=$sites_list}>
        <tr class="<{cycle values="odd, even"}>">
            <td class='center'><{$site.id}></td>
            <td class="center"><{$site.name}></td>
            <td class="center"><{$site.descr}></td>
            <td class="center"><{$site.url}></td>
            <td class="center"><{$site.uniqueid}></td>
            <td class="center"><{$site.active_img}></td>
            <td class="center"><{$site.submitter}></td>
            <td class="center"><{$site.date_created}></td>
            <td class="center  width5">
                <a href="sites.php?op=edit&amp;site_id=<{$site.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="sites"></img></a>
                <{if $site.shared == 1 && $site.active == 0}>
                <a href="sites.php?op=delete&amp;site_id=<{$site.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="sites"></img></a>
                <{/if}>
                
            </td>
        </tr>
        <{/foreach}>
    </tbody>
    <{/if}>
</table>

<div class="clear">&nbsp;</div>

<{if $pagenav}>
	<div class="xo-pagenav floatright"><{$pagenav}></div>
    <div class="clear spacer"></div>
<{/if}>


<{/if}>

<{if $form}>
	<{$form}>
<{/if}>

<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<br></br>

<!-- Footer -->
<{include file='db:wgbacklinks_admin_footer.tpl'}>
