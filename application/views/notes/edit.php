<div class="container">

<div class="row">

<div class="col-md-2">
</div>

<div class="col-md-8">
<div class="panel panel-primary">
<div class="panel-heading">
    Edit
</div>
<div class="panel-body">
<form role="form" name="input" action="/notes/edit" method="POST">
    <input type="hidden" name="id" value="<?php echo $this->current_note->id;?>">

    <div class="input-group">
    <span class="input-group-addon">title</span>
    <input type="text" class="form-control" id="form_title" name="title" value="<?php echo $this->current_note->title;?>">
    </div>

    <br/>
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
    <br/>
    <textarea class="form-control" id="form_content" name="content" rows="9" ><?php echo $this->current_note->content;?></textarea>
    <br/>

    <button type="submit" class="btn btn-default">Save</button> 
</form>
<form role="form" name="delete" action="/notes/delete/<?php echo $this->current_note->id; ?>" method="POST">
    <div class="form-group"></div>
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
</div>
</div>
</div>

<div class="col-md-2">
</div>

</div>
</div>
