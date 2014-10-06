<div class="container">
    <h2>All tags:</h2>

    <div class="list-group">
    <?php foreach ($this->tags as $tag) {?>
        <a class="list-group-item" href="./edit?id=<?php echo $tag->id?>"><?php echo $tag->name;?></a>
    <?php } ?>
    </div>

</div>

