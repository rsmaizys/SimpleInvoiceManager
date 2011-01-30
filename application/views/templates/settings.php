<form action="<?php echo site_url('settings/update'); ?>" method="post">
    <table>
        <thead>
            <td>Setting</td>
            <td>Value</td>
            <td>Description</td>
        </thead>
        <tfoot>
            <td>&nbsp;</td>
            <td><input type="submit" id="submit_settings_update" name="submit_settings_update" value="Submit" /></td>
            <td>&nbsp;</td>
        </tfoot>
        <?php foreach($settings as $setting) { ?>
        <tr>
            <td><?php echo $setting['name']; ?></td>
            <td><input type="text" name="<?php echo $setting['id_setting']; ?>"  value="<?php echo $setting['value']; ?>" /></td>
            <td><?php echo $setting['description']; ?></td>
        </tr>
        <?php } ?>
    </table>
</form>