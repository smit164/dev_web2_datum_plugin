<style type="text/css">
    .modal-dialog{
        width: 60%;
    }
    .hide_S{
        display: none;
    }
</style>
<div class="datum_login_popupbox datum_documnetvault_popup">
    <h2><?php  _e("Document Vault",'datum'); ?></h2>
    <div class="datum_login_content">
        <div class="">
            <span><input type="checkbox" id="check_all" class="k-checkbox" value="Check All"><?php  _e("Check All",'datum'); ?></span>
            <div id="treeview-kendo" class="treeview oepl_tree_div"></div>
        </div>
        <div class="datum_right_alignment">
            <button class="datum_btn_primary btn-lg" id="save" type="button"><?php  _e("Download",'datum'); ?></button>
        </div>
    </div>
</div>
<script type="text/javascript">
	$("#treeview-kendo").kendoTreeView({
        dataSource: [{
            id: 1, text: "My Documents", expanded: true, spriteCssClass: "rootfolder", items: [
                {
                    id: 2, text: "Kendo UI Project", expanded: true, spriteCssClass: "folder", items: [
                        { id: 3, text: "about.html", spriteCssClass: "html" },
                        { id: 4, text: "index.html", spriteCssClass: "html" },
                        { id: 5, text: "logo.png", spriteCssClass: "image" }
                    ]
                },
                {
                    id: 6, text: "Reports", expanded: true, spriteCssClass: "folder", items: [
                        { id: 7, text: "February.pdf", spriteCssClass: "pdf" },
                        { id: 8, text: "March.pdf", spriteCssClass: "pdf" },
                        { id: 9, text: "April.pdf", spriteCssClass: "pdf" }
                    ]
                }
            ]
        }],
        checkboxes: {
            checkChildren: true
        },
    });
</script>