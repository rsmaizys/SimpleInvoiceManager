<form action="<?php echo site_url('invoice/update'); ?>" method="post">
    <input type="hidden" name="id_invoice" value="<?php echo $invoice['id_invoice']; ?>" />
    <!---<input type="hidden" name="id_status" value="<?php echo $invoice['id_status']; ?>" />--->
<table>
    <thead>
        <td>Variable</td>
        <td>Value</td>
    </thead>
    <tr>
        <td>Subject:</td>
        <td><input type="text" name="subject" value="<?php echo $invoice['subject']; ?>" /></td>
    </tr>
    <tr>
        <td>Cost:</td>
        <td><input type="text" name="cost" value="<?php echo $invoice['cost']; ?>" /></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php echo $status; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a style="font-style: italic;" href="'.site_url('invoice/close').'/'.$invoice['id_invoice'].'">Close</a>
        </td>
    </tr>
    <tr>
        <td>Client Name</td>
        <td>
            <select name="id_client">
        <?php
        if(is_array($clients))
        {
            foreach($clients as $client) 
            {
                $selected = '';
                if($client['id_client'] == $invoice['id_client'])
                    $selected = 'selected="selected"';
                echo '<option value="'.$client['id_client'].'" '.$selected.'>'.$client['name'].'</option>';
            }
        }
        ?>
            </select>
        </td>
    </tr>
    <tr>
        <td><a style="font-style: italic;" href="'.site_url('invoice/delete').'/'.$invoice['id_invoice'].'">Delete</a></td>
        <td><input type="submit" name="submit_invoice_edit" value="Update" /></td>
    </tr>
</table>
</form>
<div style="clear:both;"></div>