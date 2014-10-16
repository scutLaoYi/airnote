<div class="well well-lg">
    <h2>View and edit a note</h2>
</div>
<form role="form" name="input" action="/notes/edit" method="POST">
    <div class="form-group">
    <input type="hidden" name="id" value="<?php echo $this->current_note->id;?>">
    <label for="form_title">title:</label>
    <input type="text" class="form-control" id="form_title" name="title" value="<?php echo $this->current_note->title;?>">
    <label for="form_content">content:</label>
    <textarea class="form-control" id="form_content" name="content" ><?php echo $this->current_note->content;?>
    </textarea>
    <label for="form_tag_select">tag:</label>
    <select class="form-control" name="tag_id">
    <?php 
    foreach ($this->tags as $tag){
        if($tag->id == $this->current_note->tag_id){
            print "<option value=\"{$tag->id}\" selected=\"selected\">$tag->name</option>";
        }
        else
        {
            print "<option value=\"{$tag->id}\">$tag->name</option>";
        }
    }
?>
    </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button> 
</form>
<form role="form" name="delete" action="/notes/delete/<?php echo $this->current_note->id; ?>" method="POST">
    <div class="form-group"></div>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
