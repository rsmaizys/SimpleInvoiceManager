<div id="add_invoice_form">
<form action="" method="POST">
    <input type="text" name="cost" class="addnewinput" onclick="this.value=(this.value=='Cost')?'':this.value;" onblur="this.value = (this.value=='')?'Cost':this.value;"  value="Cost" />
    <input type="text" name="subject" class="addnewinput"  onclick="this.value=(this.value=='Subject')?'':this.value;" onblur="this.value = (this.value=='')?'Subject':this.value;"  value="Subject" />
    <select id="client" name="id_client">
        <option value="0" selected="selected">-- Client --</option>
        <?php
        if(is_array($clients))
            foreach($clients as $client)
                echo '<option value="'.$client['id_client'].'">'.$client['name'].'</option>';
        ?>
    </select>
    <input type="submit" id="submit_invoice" name="submit_invoice" value="Create Invoice" class="addnewbutton" />
</form>
</div>
<a href="<?php echo site_url('client'); ?>">Add Client</a> | 
<a href="<?php echo site_url('client'); ?>">Clients</a>
<br /><br />

<div id="open_invoices_table">
<?php $this->load->view('templates/invoices_open_table'); ?>
</div>
<br />
<!-- Cloed Invoices
<table>
    <thead>
        <td>ID</td>
        <td>Status</td>
        <td>Cost</td>
        <td>Subject</td>
        <td>Date</td>
        <td>Client</td>
        <td>Actions</td>
    </thead>
    <?php
    if(is_array($invoices))
    {
        foreach($invoices as $invoice)
        {
            echo '<tr>';
            echo '<td>'.$invoice['id_invoice'].'</td>';
            echo '<td><img src="assets/images/status/'.$invoice['status'].'.jpg" alt="'.$invoice['status'].'" /></td>';
            echo '<td>'.$invoice['cost'].'</td>';
            echo '<td>'.$invoice['subject'].'</td>';
            echo '<td>'.$invoice['date'].'</td>';
            echo '<td><a href="'.site_url('/client/view/'.$invoice['id_client']).'">'.$invoice['client'].'</a></td>';
            echo '<td>
                      <a href="'.site_url('invoice/close').'/'.$invoice['id_invoice'].'">Close</a>
                      <a href="'.site_url('invoice/edit').'/'.$invoice['id_invoice'].'">Edit</a>
                      <a href="'.site_url('invoice/delete').'">Delete</a>
                  </td>';
            echo '</tr>';
        }
    }

    ?>
</table>
-->