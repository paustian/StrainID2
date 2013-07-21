{ajaxheader modname='StrainID2' ui=true}
<h2>{gt text='Strain ID2'}</h2>

{insert name="getstatusmsg"}
{modulelinks type='User'}
<p><a href="{modurl modname="StrainID2" type="user" func="search"}">{gt text="Search for a strain"}</a></p>

{$strain_table}

