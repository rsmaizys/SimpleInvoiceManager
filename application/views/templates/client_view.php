<table>
    <thead>
        <td>ID</td>
        <td>Client name</td>
        <td>Current amount</td>
        <td>Total income</td> 
        <td>Action</td>
    </thead>
    <?php
    if($client)
    {
        echo '<tr>';
        echo '<td>'.$client['id_client'].'</td>';
        echo '<td>'.$client['name'].'</td>';
        echo '<td>'.$client['ongoing'].'</td>';
        echo '<td>'.$client['income'].'</td>';
        echo '<td><a href="'.site_url('client/delete').'/'.$client['id_client'].'" alt="Delete">Delete</a></td>';
        echo '</tr>';
        echo '<div id="client_'.$client['id_client'].'">
                <form action="'.site_url('client/addcomment/'.$client['id_client']).'" method="post">

                </form>
              </div>';
    }
    ?>
</table>

<br />
<h3> Comments about client </h3>
<br />
<table>
    <thead>
        <td>ID</td>
        <td>Date</td>
        <td>Comment</td>
        <td>Actions</td>
    </thead>
    <?php
    if($client['comments'])
    {
        foreach($client['comments'] as $comment)
        {
            echo '<tr>';
            echo '<td>'.$comment['id_client_comment'].'</td>';
            echo '<td>'.$comment['date_posted'].'</td>';
            echo '<td>'.$comment['comment'].'</td>';
            echo '<td><a href="'.site_url('client/delete_comment').'/'.$comment['id_client_comment'].'/'.$client['id_client'].'" alt="Delete">Delete</a></td>';
            echo '</tr>';
        }
    }
    ?>
</table>

<br />
<h3> Add new comment </h3>
<br />

<form action="<?php site_url('client/addcomment/'); ?>" method="post">
    <input type="hidden" name="id_client" value="<?php $client['id_client']; ?>" />
    <textarea id="comment_<?php echo $client['id_client']; ?>" name="comment_<?php echo $client['id_client']; ?>" class="quick_comment"></textarea><br />
    <input style="margin-left:300px;" onclick="addComment(<?php echo $client['id_client']; ?>, true);" id="comment_form_<?php echo $client['id_client']; ?>" type="button" name="submit_client_comment" value="Submit"  />
</form>