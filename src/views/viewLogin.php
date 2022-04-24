<?php $this->_t = 'Login'?>
<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="users&auth=login" method="POST">
            <input type="text" placeholder="Username *" name="username" value="<?php if(isset($_POST['username']))echo $_POST['username']?>">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']?>
            </span>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']?>
            </span>
            
            <button class="submit-btn" id="submit" type="submit" value="submit">Login</button>

            <p class="options">Not Registered yet ?<a href="users&auth=register"> Create an account !</a></p>
        </form>
    </div>
</div> 
