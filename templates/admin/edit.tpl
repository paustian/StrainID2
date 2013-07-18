{* purpose of this template: build the Form to edit an instance of strain *}
{adminheader}
{if $mode eq 'edit'}
    {gt text='Edit strain' assign='templateTitle'}
    {assign var='adminPageIcon' value='edit'}
{elseif $mode eq 'create'}
    {gt text='Create strain' assign='templateTitle'}
    {assign var='adminPageIcon' value='new'}
{else}
    {gt text='Edit strain' assign='templateTitle'}
    {assign var='adminPageIcon' value='edit'}
{/if}
<div class="strainid-strain strainid-edit">
    {pagesetvar name='title' value=$templateTitle}
    <div class="z-admin-content-pagetitle">
        {icon type=$adminPageIcon size='small' alt=$templateTitle}
        <h3>{$templateTitle}</h3>
    </div>
{form cssClass='z-form'}
    {* add validation summary and a <div> element for styling the form *}
    
    {formsetinitialfocus inputId='name'}


    <fieldset>
        <legend>{gt text='Content'}</legend>
        
        <div class="z-formrow">
            {formlabel for='name' __text='Name' mandatorysym='1'}
            {formtextinput group='strain' id='name' mandatory=true readOnly=false __title='Enter the name of the strain' textMode='singleline' maxLength=255 cssClass='required' text=$name}
        </div>
        
        <div class="z-formrow">
            {formlabel for='indole' __text='Indole' mandatorysym='1'}
            {formdropdownlist group='strain' id='indole' mandatory=true readOnly=false __title='Enter the indole reaction for the strain' items=$reaction cssClass='required' selectedValue=$indole}
        </div>
        
        <div class="z-formrow">
            {formlabel for='methylred' __text='Methyl Red' mandatorysym='1'}
            {formdropdownlist group='strain' id='methylred' mandatory=true readOnly=false __title='Enter the methyl red reaction for the strain' items=$reaction cssClass='required' selectedValue=$methylred}
        </div>
        
        <div class="z-formrow">
            {formlabel for='voguesproskauer' __text='Vogues Proskauer' mandatorysym='1'}
            {formdropdownlist group='strain' id='voguesproskauer' mandatory=true readOnly=false __title='Enter the vogues proskauer reaction for the strain' items=$reaction cssClass='required' selectedValue=$voguesproskauer}
        </div>
        
        <div class="z-formrow">
            {formlabel for='simmonscitrate' __text='Simmons Citrate' mandatorysym='1'}
            {formdropdownlist group='strain' id='simmonscitrate' mandatory=true readOnly=false __title='Enter the simmons citrate reaction for the strain' items=$reaction cssClass='required' selectedValue=$simmonscitrate}
        </div>
        
        <div class="z-formrow">
            {formlabel for='h2s' __text='H2S' mandatorysym='1'}
            {formdropdownlist group='strain' id='h2s' mandatory=true readOnly=false __title='Enter the hydrogensulfide reaction for the strain' items=$reaction cssClass='required' selectedValue=$h2s}
        </div>
        
        <div class="z-formrow">
            {formlabel for='phenylalanine' __text='Phenylalanine' mandatorysym='1'}
            {formdropdownlist group='strain' id='phenylalanine' mandatory=true readOnly=false __title='Enter the phenylalanine reaction for the strain' items=$reaction cssClass='required' selectedValue=$phenylalanine}
        </div>
        
        <div class="z-formrow">
            {formlabel for='lysine' __text='Lysine' mandatorysym='1'}
            {formdropdownlist group='strain' id='lysine' mandatory=true readOnly=false __title='Enter the lysine reaction for the strain' items=$reaction cssClass='required' selectedValue=$lysine}
        </div>
        
        <div class="z-formrow">
            {formlabel for='ornithine' __text='Ornithine' mandatorysym='1'}
            {formdropdownlist group='strain' id='ornithine' mandatory=true readOnly=false __title='Enter the ornithine reaction for the strain' items=$reaction cssClass='required' selectedValue=$ornithine}
        </div>
        
        <div class="z-formrow">
            {formlabel for='motility' __text='Motility' mandatorysym='1'}
            {formdropdownlist group='strain' id='motility' mandatory=true readOnly=false __title='Enter the motility reaction for the strain' items=$reaction cssClass='required' selectedValue=$motility}
        </div>
        
        <div class="z-formrow">
            {formlabel for='lactose' __text='Lactose' mandatorysym='1'}
            {formdropdownlist group='strain' id='lactose' mandatory=true readOnly=false __title='Enter the lactose reaction for the strain' items=$reaction cssClass='required' selectedValue=$lactose}
        </div>
    </fieldset>
    
    
    {* include possible submit actions *}
    <div class="z-buttons z-formbuttons">
        {if $mode eq 'edit'}
            {formbutton id='btnEdit' commandName='edit' __text='Update' class='z-bt-edit'}
            {formbutton id='btnDelete' commandName='delete' __text='Delete' class='z-bt-delete'}
        {elseif $mode eq 'create'}
            {formbutton id='btnEdit' commandName='edit' __text='Create' class='z-bt-edit'}
        {/if} 
        {formbutton id='btnCancel' commandName='cancel' __text='Cancel' class='z-bt-cancel'}
    </div>
{/form}

</div>
{adminfooter}

<script type="text/javascript">
// <![CDATA[
    Zikula.UI.Tooltips($$('.tooltips'));
// ]]>
</script>

{* {zdebug}*}
