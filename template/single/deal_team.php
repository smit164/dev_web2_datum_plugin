<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion datum will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $single_property;
function formatPhoneNumber($phoneNumber) {
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);
    if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);
        $phoneNumber = $areaCode.'-'.$nextThree.'-'.$lastFour;
    }
    return $phoneNumber;
}
?>
<div class="datum_deskdevice_6 datum_lp_15">
    <div class="datum_deal_team_section">
        <h2 class="datum_headline">Deal Team</h2>
        <div class="datum_row">
                <?php
                foreach (getDMPropertyAgentsList() as $key => $value) {
                ?>
                    <div class="datum_deskdevice_6 datum_rp_15">
                        <div class="datum_teamMember_box">
                            <a href="<?php echo home_url() ?>/agent/<?php echo $value->Username ?>">
                                <img src="<?php echo $value->ProfileImage; ?>" alt="<?php echo $value->FirstName.' '.$value->LastName; ?>" loading="lazy">
                            </a>
                            <div class="datum_team_content">
                                <h4><a href="<?php echo home_url() ?>/agent/<?php echo $value->Username ?>"><?php echo $value->FirstName.' '.$value->LastName; ?></a></h4>
                                <p class="datum_agent_designation"><?php echo $value->Title ?></p>
                                <a href="tel:+<?php echo $value->WorkPhone ?>"><?php echo formatPhoneNumber($value->WorkPhone); ?></a>
                                <a href="mailto:<?php echo $value->Email ?>" class="datum-mail-link"><?php echo $value->Email ?></a>
                                <p>CA RE Lic. <?php echo $value->CorporateLicense; ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>
</div>