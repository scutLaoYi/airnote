    <form role="form" name="input" action="/tags/edit" method="POST">
        <div class="input-group">
        <span class="input-group-addon">name</span>
        <input type="text" class="form-control" id="input_text" name="tag_name" placeholder="New name" value="<?php echo $this->current_tag->name;?>">
        </div>
        <input type="hidden" value="<?php echo $this->current_tag->id;?>" name="tag_id">
        <br/>
        <button type="submit" class="btn btn-default">Save</button> 
    </form>
    <form role="form" name="delete" action="/tags/deleteTag/<?php echo $this->current_tag->id; ?>" method="POST">
        <div class="form-group"></div>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>


