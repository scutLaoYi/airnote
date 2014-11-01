<form role="form" name="input" action="/notes/add" method="POST">
    <div class="input-group">
    <span class="input-group-addon">title</span>
    <input type="text" class="form-control" id="form_title" name="title">
    </div>

    <br/>
    <select class="form-control" name="tag_id">
    <?php 
    foreach ($this->tags as $tag){
        ?>
            <option value="<?php echo $tag->id;?>"><?php echo $tag->name;?></option>
            <?php
    }
?>
    </select>

    <br/>
    <textarea class="form-control" id="form_content" name="content" rows="9"></textarea>
    <br/>
    <button type="submit" class="btn btn-default">Submit</button> 
</form>
