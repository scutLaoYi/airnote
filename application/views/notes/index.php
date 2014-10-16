<div class="well well-lg">
<h2>All notes</h2>
</div>
<div class="list-group">
    <form role="form" name="new" action="/notes/add" method="POST">
        <div class="form-group"></div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li <?php if ($this->current_tag == 0) {echo ' class="active"';}?>><a href="/notes/index/">All</a></li>
<?php
    foreach ($this->tags as $tag) {
        ?>
    <li<?php if ($this->current_tag == $tag->id) {echo ' class="active"';}?>><a href="/notes/index/<?php echo $tag->id;?>"><?php echo $tag->name;?></a></li>
    <?php
    }
?>
</ul>

<div class="list-group">
<?php foreach ($this->notes as $note) {?>
    <a class="list-group-item" href="/notes/edit/<?php echo $note->id?>"><?php echo $note->title;?></a>
<?php } ?>
</div>


