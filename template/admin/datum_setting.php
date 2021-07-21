<style type="text/css">
            /* Style the tab */
    div.tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    div.tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }
    /* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #ddd;
    }
    /* Create an active/current tablink class */
    div.tab button.active {
        background-color: #ccc;
    }
    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    /* New styles */
    input[type=text] {
        padding: 0 8px;
        line-height: 2;
        min-height: 30px;
        box-shadow: 0 0 0 transparent;
        border-radius: 4px;
        border: 1px solid #7e8993;
        background-color: #fff;
        color: #32373c;
    }
    input[type=text]:focus {
        border-color: #007cba;
        box-shadow: 0 0 0 1px #007cba;
        outline: 2px solid transparent;
    }
</style>
<div class="wrap">
    <nav class="nav-tab-wrapper woo-nav-tab-wrapper">
        <a href="http://localhost/wordpress/demo/wp-admin/admin.php?page=dm-settings&amp;tab=general" class="nav-tab nav-tab-active">Integration</a>
        <a href="http://localhost/wordpress/demo/wp-admin/admin.php?page=dm-settings&amp;tab=products" class="nav-tab ">Advanced</a>
    </nav>
    <h2><?= __('Datum API Key','datum') ?></h2>
    <form method="post" action="" >
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row" valign="top"><?= __('Datum API Key', 'datum') ?></th>
                    <td><input type="text" name="datum_api_key" value="<?= get_option('datum_api_key' ,''); ?>"></td>
                </tr>
                <tr>
                    <th>
                        <button type="submit" value="save" name="datum_settings" class="button button-primary button-large"><?= __('Save' ,'datum') ?></button>
                    </th>
                </tr>
            </tbody>
        </table>
    </form>
</div>