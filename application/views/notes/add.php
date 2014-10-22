<div class="well well-lg">
    <h2>Add a new note</h2>
</div>
<form role="form" name="input" action="/notes/add" method="POST">
    <div class="form-group">
    <label for="form_title">title:</label>
    <input type="text" class="form-control" id="form_title" name="title">
    <label for="form_content">content:</label>
    <textarea class="form-control" id="form_content" name="content">
    </textarea>
    <label for="form_tag_select">tag:</label>
    <select class="form-control" name="tag_id">
    <?php 
    foreach ($this->tags as $tag){
        ?>
            <option value="<?php echo $tag->id;?>"><?php echo $tag->name;?></option>
            <?php
    }
?>
    </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button> 
</form>
