
<div class="container-fluid">

<div class="list-group">
    <form role="form" name="new" action="/notes/add" method="POST">
        <div class="form-group"></div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>

<div class="row">

    <!--Container for notes-->
    <div class="col-md-9">
        <?php foreach ($this->notes as $note) {?>
        <div class="panel panel-info">
            <div class="panel-heading">
                <a href="/notes/edit/<?php echo $note->id?>"><h4><?php echo $note->title;?></h4></a>
            </div>
            <div class="panel-body">
                <?php echo $note->content;?>
            </div>
        </div>
        <?php } ?>
    </div>

    <!--The selector of tag-->
    <div class="col-md-3">

        <ul class="nav nav-stacked" role="tablist" >
            <li role="presentation"<?php if ($this->current_tag == 0) {echo ' class="active"';}?>><a href="/notes/index/">All</a></li>
        <?php
            foreach ($this->tags as $tag) {
                ?>
            <li role="presentation"<?php if ($this->current_tag == $tag->id) {echo ' class="active"';}?>><a href="/notes/index/<?php echo $tag->id;?>"><?php echo $tag->name;?></a></li>
            <?php
            }
        ?>
        </ul>
    </div>
</div>
</div>
