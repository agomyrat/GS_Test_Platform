<div id="container">    
        <div id="image"> 
            <img src="<?=URL?>source/new_password/img/Security On-amico 1.svg" alt="">  
        </div>
        <div class="imgmobile">
            <img src="<?=URL?>source/new_password/img/Login-bro 1.svg" alt="">
        </div>
        <div id="form">
            <form id="_form" action="<?=URL?>login" method="post">
                <h1 id="txt"> <?=Polyglot::translate('New Password')?></h1>
                
                <label class="formlbl"><?=Polyglot::translate('Enter new Password')?></label><br>
                <input type="password" class='user' name="password" required><br> <label class="formlbl"> <?=Polyglot::translate('Confirm Password')?></label><br>
                <input type="password" class='user' name="confirm_password" required><br>
                <div class="no_match" style="display:none;color:red;"><?=Polyglot::translate("DoesntMatch"); ?></div>
                <input type="hidden" class='user' name="verify_code" value="<?=$verify_code?>">
                <input type="submit" value=" <?=Polyglot::translate('Save')?>" class='savebtn'><br>
                
            </form>
        </div>
</div>