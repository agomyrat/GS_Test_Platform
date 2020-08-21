<div class="wrapper">
        <div id="image">
            <div class="header">
               <a href="#">testSpace</a>
            </div>
            <div class="left-side">
               <img src="source/forgot_password/img/Forgot password-bro 1.svg" alt="">
            </div>
        </div>
        <div class="imgmobile">
            <img src="source/forgot_password/img/Group 3.svg" alt="">
        </div>
        <div id="form">
            <form action="#">
                <h1 id="sendtxt"><?=Polyglot::translate('ForgotPassword')?></h1>
                <p class="text"><?=Polyglot::translate('Instruction')?></p><br>
                <label class="formlbl"><?=Polyglot::translate('Email')?></label><br>
                <input type="text" class='user' name="username" required=" " title="Bu  meydanca bos goyulmaly dal"><br>
                <input type="submit" value="<?=Polyglot::translate('Send')?>" class='sendbtn'><br>
            </form>
        </div>
    </div>