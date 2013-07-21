{* purpose of this template: build the Form to serach for matching strains *}
{ajaxheader modname='StrainID2' ui=true}
<h3>{gt text='Search for Strain'}</h3>

{insert name="getstatusmsg"}
{modulelinks type='User'}
<div class="strainid-strain strainid-edit">
    <div class="z-admin-content-pagetitle">
        {icon type=edit size='small' alt=$templateTitle}
        <h3>{gt text="Search for a Strain"}</h3>
    </div>
    {form cssClass='z-form'}
    {* add validation summary and a <div> element for styling the form *}
    {formsetinitialfocus inputId='indole'}
    <fieldset>
        <legend>{gt text='Content'}</legend>

        <div class="z-formrow">
            {formlabel for='indole' __text='Indole' mandatorysym='1'}
            {formdropdownlist group='strain' id='indole' mandatory=true readOnly=false __title='Enter the indole reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='methylred' __text='Methyl Red' mandatorysym='1'}
            {formdropdownlist group='strain' id='methylred' mandatory=true readOnly=false __title='Enter the methyl red reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='voguesproskauer' __text='Vogues Proskauer' mandatorysym='1'}
            {formdropdownlist group='strain' id='voguesproskauer' mandatory=true readOnly=false __title='Enter the vogues proskauer reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='simmonscitrate' __text='Simmons Citrate' mandatorysym='1'}
            {formdropdownlist group='strain' id='simmonscitrate' mandatory=true readOnly=false __title='Enter the simmons citrate reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='h2s' __text='H2s' mandatorysym='1'}
            {formdropdownlist group='strain' id='h2s' mandatory=true readOnly=false __title='Enter the hydrogensulfide reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='phenylalanine' __text='Phenylalanine' mandatorysym='1'}
            {formdropdownlist group='strain' id='phenylalanine' mandatory=true readOnly=false __title='Enter the phenylalanine reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='lysine' __text='Lysine' mandatorysym='1'}
            {formdropdownlist group='strain' id='lysine' mandatory=true readOnly=false __title='Enter the lysine reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='ornithine' __text='Ornithine' mandatorysym='1'}
            {formdropdownlist group='strain' id='ornithine' mandatory=true readOnly=false __title='Enter the ornithine reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='motility' __text='Motility' mandatorysym='1'}
            {formdropdownlist group='strain' id='motility' mandatory=true readOnly=false __title='Enter the motility reaction for the strain' items=$reaction cssClass='required'}
        </div>

        <div class="z-formrow">
            {formlabel for='lactose' __text='Lactose' mandatorysym='1'}
            {formdropdownlist group='strain' id='lactose' mandatory=true readOnly=false __title='Enter the lactose reaction for the strain' items=$reaction cssClass='required'}
        </div>
    </fieldset>
</div>
            
            {* include possible submit actions *}
    <div class="z-buttons z-formbuttons">
        {formbutton id='btnSearch' commandName='search' __text='Search' class='z-bt-edit'}
        {formbutton id='btnCancel' commandName='cancel' __text='Cancel' class='z-bt-cancel'}
    </div>
{/form}
{$strain_table}