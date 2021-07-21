<?php
global $criteria;
$exchange_status = '';
if(getDMUserExchangeStatusId() !="") {
    $exchange_status = getDMUserExchangeStatusId();
}
$exchangeStatusMasterData = $criteria->data->ExchangeStatus;
?>
<div class="datum_row">
    <div class="datum_col_12">
        <div class="datum_form_group">
            <label class="datum_label">1031 Exchange Status <span>*</span></label>
            <div class="datum_row">
                <?php foreach ($exchangeStatusMasterData as $key => $value ) {
                    ?>
                    <div class="datum_custom_radio">
                        <input <?php if($exchange_status == $key) { echo "checked"; } ?> type="radio" class="datum_custom_control_input" id="ex_<?php echo $key;  ?>" name="exchange_status" value="<?php echo $key; ?>">
                        <label class="custom-control-label" for="ex_<?php echo $key;  ?>"><?php echo $value; ?></label>
                    </div>

                    <?php
                } ?>
                <span class="js-error error" id="exchange_status_check"> </span>
<!--                <div class="datum_custom_radio">-->
<!--                    <input --><?php //if($exchange_status == 'Private') { echo "checked"; } ?><!-- type="radio" class="datum_custom_control_input" id="customRadio7" name="exchange_status" value="Private">-->
<!--                    <label class="custom-control-label" for="customRadio7">In an Exchange</label>-->
<!--                </div>-->
<!--                <div class="datum_custom_radio">-->
<!--                    <input --><?php //if($exchange_status == 'Institutional') { echo "checked"; } ?><!-- type="radio" class="datum_custom_control_input" id="customRadio8" name="exchange_status" value="Institutional">-->
<!--                    <label class="custom-control-label" for="customRadio8">Not in an Exchange</label>-->
<!--                </div>-->
<!--                <div class="datum_custom_radio">-->
<!--                    <input --><?php //if($exchange_status == 'Both') { echo "checked"; } ?><!-- type="radio" class="datum_custom_control_input" id="customRadio9" name="exchange_status" value="Both">-->
<!--                    <label class="custom-control-label" for="customRadio9">Exchange Upcoming</label>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>