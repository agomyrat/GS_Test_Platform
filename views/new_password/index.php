<div id="container">    
        <div id="image"> 
            <img src="source/new_password/img/Security On-amico 1.svg" alt="">  
        </div>
        <div class="imgmobile">
            <img src="source/new_password/img/Login-bro 1.svg" alt="">
        </div>
        <div id="form">
            <form action="#">
                <h1 id="txt"> <?=Polyglot::translate('New Password')?></h1>
                
                <label class="formlbl"><?=Polyglot::translate('Enter new Password')?></label><br>
                <input type="password" class='user' name="password " required><br> <label class="formlbl"> <?=Polyglot::translate('Confirm Password')?></label><br>
                <input type="password" class='user' name="password " required><br>
               
                <input type="submit" value=" <?=Polyglot::translate('Save')?>" class='savebtn'><br>
                
            </form>
        </div>
</div>