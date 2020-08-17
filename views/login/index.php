 <div id="container">
        <div id="image">
           <div class="left-side">
               <div class="letter">
                  <p class="know">
                     <?=Polyglot::translate('Proverb')?></p>
               </div>
            </div>
        </div>
        <div class="imgmobile">
            <img src="source/login/img/authentication.svg" alt="">
        </div>
        <div id="form">
            <form id="form_" action="login/checkLogin" method="post">
                <h1 id="logintxt"><?=Polyglot::translate('LogIn')?></h1>
                <label class="formlbl"><?=Polyglot::translate('Username')?></label><br>
                <input type="text" class='user' name="user" required="" title="Bu  meydanca bos goyulmaly dal" id="user"><br>
                <label class="formlbl"><?=Polyglot::translate('Password')?></label><br>
                <input type="password" class='user' name="password " required id="password"><br>
               <div class="remember-line">
                  <input type="checkbox" class="check" name="remember">
                  <label class="remember"><?=Polyglot::translate('RememberMe')?></label>
                  <a href="forgotpassword" class="forgot"><?=Polyglot::translate('ForgotPassword')?></a><br>
               </div>
                <input type="submit" value="<?=Polyglot::translate('LogIn')?>" class='loginbtn'><br>
                <div class="incorrect" style="display:none;color:red;">Incorrect username/email or password</div>
               <div class="sign-up">
                <label class="txtlogin"><?=Polyglot::translate('NotAccount')?></label><br>
                <a href="signup" class="sign"><?=Polyglot::translate('SignUp')?></a>
               </div>
            </form>
        </div>
    </div>
