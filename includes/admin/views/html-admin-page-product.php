<?php
/**
 * Admin View: Page - Product
 *
 * @package WooCommerce\Admin
 * @var string $view
 * @var object $addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
	<h1 id="add-new-user">Add New Project</h1>
	<div id="createuser">
		<form method="post" name="createproject" id="createproject" class="validate" novalidate="novalidate">
			<input name="action" type="hidden" value="createproject">
			<table class="form-table" role="presentation">
				<tbody>
					<tr class="form-field form-required">
						<th scope="row"><label for="user_login">Projrct Name <span class="description">(required)</span></label></th>
						<td><input name="project[name]" type="text" id="user_login" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60"></td>
					</tr>
					<tr class="form-field form-required">
						<th scope="row"><label for="user_login">Client Id <span class="description">(required)</span></label></th>
						<td>
							<select name="project[client_id]">
								<option> Select Option</option>
								<?php
								$blogusers = get_users( array( 'role__in' => array( 'client') ) );
								foreach ($blogusers as $key => $value) { 
									
									?>
									  <option value="<?php echo $value->data->ID ?>"><?php echo $value->data->user_nicename ?></option>
								<?php }
								?>
							</select>
					</tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" name="createuser" id="createusersub" class="button button-primary" value="Add New Project"></p>
		</form>
	</div>
</div>