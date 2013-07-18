{ajaxheader modname='StrainID2' ui=true}
{adminheader}
<div class="z-admin-content-pagetitle">
    {icon type="view" size="small"}
    <h3>{gt text='StrainID2 main'}</h3>
</div>

{insert name="getstatusmsg"}

{$strain_table}
 
<p><a href="{pnmodurl modname="StrainID2" type="admin" func="edit"}">{gt text="Create a Strain"}</a></p>
{adminfooter}
<script type="text/javascript">
// <![CDATA[
    Zikula.UI.Tooltips($$('.tooltips'));
// ]]>
</script>