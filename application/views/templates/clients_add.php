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
            echo '<td><a href="'.site_url('/client/view/'.$client['id_client']).'">'.$client['name'].'</a></td>';
            echo '<td>
                      <a id="button_show_'.$client['id_client'].'" onclick="showCommentForm('.$client['id_client'].');" href="#" alt="Add comment">Add comment</a>
                      <a id="button_hide_'.$client['id_client'].'" onclick="hideCommentForm('.$client['id_client'].');" href="#" alt="Hide" style="display:none;">Hide Form</a>    
                      | <a href="'.site_url('client/delete').'/'.$client['id_client'].'" alt="Delete">Delete</a>
                  </td>';            
            echo '</tr>';
            echo '<tr id="client_'.$client['id_client'].'" style="display:none;"><td colspan="3"><div>
                    <form action="'.site_url('client/addcomment/').'" method="post">
                        <input type="hidden" name="id_client" value="'.$client['id_client'].'" />
                        <textarea id="comment_'.$client['id_client'].'" name="comment_'.$client['id_client'].'" class="quick_comment"></textarea><br />
                        <input onclick="addComment('.$client['id_client'].');" id="comment_form_'.$client['id_client'].'" type="button" name="submit_client_comment" value="Submit"  />
                    </form>
                  </div></td></tr>';            
        }
    }
    ?>
</table>