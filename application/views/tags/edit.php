    <div class="well well-lg">
        <h2>Edit tag</h2>
    </div>
    <form role="form" name="input" action="/tags/edit" method="POST">
        <div class="form-group">
        <label for="input_text">New name:</label>
        <input type="text" class="form-control" id="input_text" name="tag_name" placeholder="New name" value="<?php echo $this->current_tag->name;?>">
        <input type="hidden" value="<?php echo $this->current_tag->id;?>" name="tag_id">
        </div>
        <button type="submit" class="btn btn-default">Submit</button> 
    </form>
    <form role="form" name="delete" action="/tags/deleteTag/<?php echo $this->current_tag->id; ?>" method="POST">
        <div class="form-group"></div>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>


