<div class="well well-lg">
<h2>All tags</h2>
</div>
<div class="list-group">
    <form role="form" name="new" action="/tags/add" method="POST">
        <div class="form-group"></div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<div class="list-group">
<?php foreach ($this->tags as $tag) {?>
    <a class="list-group-item" href="/tags/edit/<?php echo $tag->id?>"><?php echo $tag->name;?></a>
<?php } ?>
</div>


