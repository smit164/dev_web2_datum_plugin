<?php
global $criteria;
$acquisitionCriteriaSubType = [];
if( getDMUserAcquisitionCriteriaSubType() != "") {
    $acquisitionCriteriaSubType = getDMUserAcquisitionCriteriaSubType();
}
?>
<div class="datum_col_4">
    <div class="datum_form_group">
        <label class="datum_label">Preferred Property Type</label>
        <div class="datum_acquisition-box">
            <ul class="datum_checkbox-accordian">
                <?php 
                    foreach ($criteria->data->ContactPrefferedPropertyType->PrefferedPropertyType->get_acquisition_criteria_type as $key => $value) {
                        $acquisitionCriteriaSubType = json_decode(json_encode($acquisitionCriteriaSubType), true);
                        $relationTypeCount = count($acquisitionCriteriaSubType[$value->Id]);
                        $subTypeCount = count($value->get_acquisition_criteria_sub_type);
                    ?>
                    <li class="datum_accordian-card">
                        <div class="datum_accordian-card-header">
                            <div class="datum_custom_checkbox">
                                <input <?php if($subTypeCount == $relationTypeCount) { echo "checked"; } ?> type="checkbox" class="custom-control-input re_property" id="checkbox_re<?php echo $value->Id; ?>" value="<?php echo $value->Id; ?>" name="PropetyType[type][]">
                                <label class="custom-control-label" for="checkbox_re<?php echo $value->Id; ?>"><?php echo $value->Name; ?></label>
                            </div>
                            <?php
                            if(!empty($value->get_acquisition_criteria_sub_type)){ ?>
                                <span>+</span>
                                <div class="answer">
                                    <div class="datum_accordian-card-body">
                                        <?php
                                        foreach ($value->get_acquisition_criteria_sub_type as $k => $v) {
                                        ?>
                                        <div class="datum_custom_checkbox">
                                            <input <?php if(in_array($v->Id, $acquisitionCriteriaSubType[$value->Id])) { echo "checked"; } ?> class="custom-control-input re_property_sub" type="checkbox" value="<?php echo $v->Id ?>" name="PropetyType[sub_type][<?php echo $value->Id; ?>][]" id="reg_<?php echo $v->Id ?>">
                                            <label for="reg_<?php echo $v->Id ?>"><?php echo $v->Name ?></label>
                                        </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            <?php }
                            ?> 
                        </div>
                    </li>
                    <?php }
                ?>
            </ul>
        </div>
    </div>
</div>