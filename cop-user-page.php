<form id="cop-update-form">
    <table class="form-table">
        <tbody>

    <?php
        $options = cop_get_options();
        foreach($options as $option):
    ?>

            <tr cop-label="<?= $option->label; ?>" cop-id="<?= $option->id; ?>" >
                <th class="text-right" scope="row">
                    <label for="cop-<?= $option->name; ?>"><?= $option->label; ?>:</label>
                </th>
                <td>
                    <input name="<?= $option->name; ?>" type="text" id="cop-<?= $option->name; ?>" aria-describedby="tagline-description" value="<?= $option->value; ?>" class="regular-text">
                </td>
            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>

    <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save Changes'); ?>"></p>


    <?php require(COP_PLUGIN_DIR.'/cop-err-msg.php'); ?>
</form>
