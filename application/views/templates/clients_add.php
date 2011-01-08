<form action="<?php echo site_url('client/add'); ?>" method="POST">
<table>
    <tr>
        <td>Client name:</td>
        <td><input type="text" name="client_name" /></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit_clients" /></td>
    </tr>
</table>
</form>
<br /><br />
<table>
    <thead>
        <td>ID</td>
        <td>Client name</td>
        <td>Action</td>
    </thead>
    <?php
    if($clients)
    {
        foreach($clients as $client)
        {
            echo '<tr>';
            echo '<td>'.$client['id_client'].'</td>';
            echo '<td>'.$client['name'].'</td>';
            echo '<td><a href="'.site_url('client/delete').'/'.$client['id_client'].'" alt="Delete">Delete</a></td>';
            echo '</tr>';
        }
    }
    ?>
</table>