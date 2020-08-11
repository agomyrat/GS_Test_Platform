 <div id="container">
        <div id="image">
           <div class="left-side">
               <h5 class="name">
                  <a href="welcome">testSpace</a>
               </h5>
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
            <form action="login/checkLogin" method="post">
                <h1 id="logintxt"><?=Polyglot::translate('LogIn')?></h1>
                <label class="formlbl"><?=Polyglot::translate('Username')?></label><br>
                <input type="text" class='user' name="user" required="" title="Bu  meydanca bos goyulmaly dal"><br>
                <label class="formlbl"><?=Polyglot::translate('Password')?></label><br>
                <input type="password" class='user' name="password " required><br>
               <div class="remember-line">
                  <input type="checkbox" class="check">
                  <label class="remember"><?=Polyglot::translate('RememberMe')?></label>
                  <a href="forgotpassword" class="forgot"><?=Polyglot::translate('ForgotPassword')?></a><br>
               </div>
                <input type="submit" value="Login" class='loginbtn'><br>
               <div class="sign-up">
                <label class="txtlogin"><?=Polyglot::translate('NotAccount')?></label><br>
                <a href="signup" class="sign"><?=Polyglot::translate('SignUp')?></a>
               </div>
            </form>
        </div>
    </div>