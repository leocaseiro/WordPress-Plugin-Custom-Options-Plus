<p>
    <form enctype="multipart/form-data" id="import-form">

        <h3><?= __('Import/Export Settings', COP_PLUGIN_NAME); ?></h3>

        <input type="hidden" name="action" value="cop_import">
        <p>
            <input id="truncate_import" type="checkbox" name="truncate_import" value="1" />
            <label><?= __('click here to clear table before import new data', COP_PLUGIN_NAME); ?></label>
        </p>

        <label for="cop-import">
            <a href="#" class="button-primary fake-button"><?php _e('Import'); ?></a>
        </label>

        <input type="file" name="file_import" id="cop-import" class="button-primary hidden" value="<?php _e('Import'); ?>" />

    </form>
    <button name id="cop-export" class="button-primary"><?php _e('Export'); ?></button>
</p>
