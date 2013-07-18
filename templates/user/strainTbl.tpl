<div id="StrainID_body">
    <table class="z-datatable">
        <tr class="strain_list_row_header">
            <td>{gt text="Name"}</td>
            <td>{gt text="Indole"}</td>
            <td>{gt text="Methyl Red"}</td>
            <td>{gt text="Vogues-Proskauer"}</td>
            <td>{gt text="Citrate"}</td>
            <td>{gt text="H<sub>2</sub>S"}</td>
            <td>{gt text="Phenyl Alanine"}</td>
            <td>{gt text="Lysine"}</td>
            <td>{gt text="Ornithine"}</td>
            <td>{gt text="Motility"}</td>
            <td>{gt text="Lastose Fermentation"}</td>
        <tr>
    {foreach item='strain' from=$strains}
        <tr class="strain_list_row">
            {if $is_admin}
            <td><a href="{modurl modname='StrainID2' type='admin' func='edit' sid=`$strain.sid`}"><i>{$strain.name}</i></a></td>
            {else}
            <td><i>{$strain.name}</i></td>
            {/if}
            <td class="strain_cell">{$strain.indole}</td>
            <td class="strain_cell">{$strain.methylred}</td>
            <td class="strain_cell">{$strain.voguesproskauer}</td>
            <td class="strain_cell">{$strain.simmonscitrate}</td>
            <td class="strain_cell">{$strain.h2s}</td>
            <td class="strain_cell">{$strain.phenylalanine}</td>
            <td class="strain_cell">{$strain.lysine}</td>
            <td class="strain_cell">{$strain.ornithine}</td>
            <td class="strain_cell">{$strain.motility}</td>
            <td class="strain_cell">{$strain.lactose}</td>
        <tr>
    {/foreach}
    </table>  
</div>