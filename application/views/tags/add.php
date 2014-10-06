<div class="container">
<?php

    if (isset($this->success))
{
    if ($this->success) {
        ?>
            <div class="alert alert-success" role="alert"><p>New tag saved.</p></div>
            <?php
    }
    else {
        ?>
            <div class="alert alert-danger" role="alert"><p>Something wrong when creating new tag.</p></div>
            <?php
    }
}

?>


    <div class="well well-lg">
        <h2>Add a new tag</h2>
    </div>
    <form class="navbar-form navbar-left" role="search" name="input" action="./add" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="new_tag_name">
        </div>
        <button type="submit" class="btn btn-default">Submit</button> 
    </form>
</div>
