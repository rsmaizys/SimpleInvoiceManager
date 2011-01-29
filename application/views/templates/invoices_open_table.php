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
            echo '<td><img src="assets/images/status/'.$invoice['id_status'].'.jpg" alt="'.$invoice['id_status'].'" /></td>';
            echo '<td>'.$invoice['cost'].'</td>';
            echo '<td>'.$invoice['subject'].'</td>';
            echo '<td>'.$invoice['date'].'</td>';
            echo '<td>'.$invoice['id_client'].'</td>';
            echo '<td>
                      <a href="'.site_url('invoice/close').'/'.$invoice['id_invoice'].'">Close</a>
                      <a href="'.site_url('invoice/edit').'/'.$invoice['id_invoice'].'">Edit</a>
                      <a href="'.site_url('invoice/delete').'/'.$invoice['id_invoice'].'">Delete</a>
                  </td>';
            echo '</tr>';
        }
    }
    else
    {
        echo '<tr><td>There are no Invoices yet.</td></tr>';
    }
    ?>
</table>