<div class="container-fluid">

<div class="row">
<div class="col-md-3">
</div>
<div class="col-md-6">
<div class="panel panel-primary">
<div class="panel-heading">
    Login
</div>
<div class="panel-body">
<form role="form" name="input" action="/user/login" method="POST">
    <div class="input-group">
    <span class="input-group-addon">Username</span>
    <input type="text" class="form-control" id="username" name="username" placeholder="Tell me who you are">
    </div>
    <br/>
    <div class="input-group">
    <span class="input-group-addon">Password</span>
    <input type="password" class="form-control" id="password" name="password" placeholder="Tell me your password">
    </div>
    <br/>
    <div class="input-group">
    <span class="input-group-addon">Auth</span>
    <input type="text" class="form-control" id="password" name="two_fa_code" placeholder="Tell me your two step auth">
    </div>
    <br/>
    <button type="submit" class="btn btn-default">Login</button> 
</form>
</div>
</div>
</div>
<div class="col-md-3">
</div>
</div>
</div>
