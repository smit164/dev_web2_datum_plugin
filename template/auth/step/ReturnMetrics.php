<?php
global $criteria;
$acquisitionCriteriaType = [];
if( getDMUserAcquisitionCriteriaType() != "") {
    $acquisitionCriteriaType = getDMUserAcquisitionCriteriaType();
}
$acquisitionCriteriaType = json_decode(json_encode($acquisitionCriteriaType), true);
?>
<div class="datum_col_4">
    <div class="datum_form_group">
        <label class="datum_label">Preferred Return Metrics</label>
        <div class="datum_acquisition-box">
            <?php 
                foreach ($criteria->data->ReturnMetrics->get_acquisition_criteria_type as $key => $value) {
                ?>
                <div class="datum_custom_checkbox">
                    <input <?php if(in_array($value->Id, $acquisitionCriteriaType)) { echo "checked"; } ?> type="checkbox" class="custom-control-input" Id="checkbox_pm_<?php echo $value->Id; ?>" value="<?php echo $value->Id; ?>" name="ReturnMetrics[]">
                    <label class="custom-control-label" for="checkbox_pm_<?php echo $value->Id; ?>"><?php echo $value->Name; ?></label>
                </div>
                <?php }
            ?>
        </div>
    </div>
</div>