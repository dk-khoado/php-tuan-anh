@extends('masterForm')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Create Account</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/register" onsubmit="return checkPassword()">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="small mb-1" for="inputEmailAddress">username</label>
                        <input class="form-control py-4" id="inputEmailAddress" type="text" required name="username" aria-describedby="emailHelp" placeholder="Enter email address" />
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="inputPassword">Password</label>
                                <input class="form-control py-4" required id="inputPassword" type="password" name="password" placeholder="Enter password" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                <input class="form-control py-4" required id="inputConfirmPassword" type="password" placeholder="Confirm password" />
                            </div>
                        </div>
                    </div>
                    <div class="small" id="error"></div>
                    <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block" type="submit">Create Account</button></div>
                </form>
            </div>
            <div class="card-footer text-center">
                <div class="small"><a href="/login">Have an account? Go to login</a></div>
            </div>
        </div>
    </div>
</div>
<script>
    function checkPassword(){
        if($("#inputPassword").val() ==$("#inputConfirmPassword").val()){
           
            return true
        }
        $("#error").html("mật khẩu không trùng")
        return false
    }
</script>
@endsection