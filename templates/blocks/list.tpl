<ul>
{foreach from=$strains item='s'}
    <li>
        <a href="{modurl modname="StrainID2" type="user" func="display" lid=$d->getsid()}">{$s->getname()}</a>
    </li>
    
{foreachelse}
    <li>{gt text='No strains available'}</li>
{/foreach}
</ul>
