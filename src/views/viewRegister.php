<?php $this->_t = 'Register'?>
<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="users&auth=register" method="POST">
            <input type="text" placeholder="Username *" name="username" value="<?php if(isset($_POST['username']))echo $_POST['username']?>">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']?>
            </span>

            <input type="text" placeholder="E-mail *" name="email" value="<?php if(isset($_POST['email']))echo $_POST['email']?>">
            <span class="invalidFeedback">
                <?php echo $data['emailError']?>
            </span>

            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']?>
            </span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']?>
            </span>
            
            <button id="submit" type="submit" value="submit">Register</button>

            <p class="options">Already registered ?<a href="users&auth=login"> Sign in !</a></p>
        </form>
    </div>
</div> 