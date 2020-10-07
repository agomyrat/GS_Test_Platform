<div style="top: -50px; opacity: 0;" class="alert error">
      <i class="fa fa-times"></i>
    </div>

    <form id="form" action='profile/myProfile' method='post' enctype="multipart/form-data">
      <div class="container">
        <div class="left">
          <div class="width">
            <div class="image">
              <img id="output" src="uploads/profile.jpg" alt="" />
              <div class="oval">
                <i class="fa fa-image"></i>
                <input type="file" id="image" class="editImage" />
              </div>
            </div>
          </div>

          <div class="wrapper">
            <div class="block">
              <label>Firstname*</label
              ><i class="fa fa-globe" title="Siz bu " id="firstname"></i><br />
              <input
                class="data"
                type="text"
                name="firstname "
                id="input 1"
                tabindex=" 1 "
                value="<?=$user->data['FIRST_NAME']?>"
              /><br />
            </div>
            <div class="block">
              <label for=" ">Surname*</label
              ><i class="fa fa-globe" id=" lastname " title=" Siz bu "></i
              ><br />
              <input
                class="data"
                type="text"
                name="surname"
                id="input 2"
                tabindex=" 2 "
                value="<?=$user->data['SURNAME']?>"
              /><br />
            </div>
            <div class="block">
              <label for=" ">Username*</label
              ><i class="fa fa-globe" id="username" title="Siz bu"></i><br />
              <input
                class="data"
                type="text"
                name="username"
                id="input 3"
                tabindex="3"
                value="<?=$user->data['USER_NAME']?>"
              /><br />
            </div>
            <!-- <div class=" block">
                        <label for=" ">Password*</label><i class="fa fa-globe " id=" password "
                            title=" Siz bu "></i><br>
                        <input class="data" type=" password " name=" " id="input" tabindex=" 4 " required><br>
                    </div> -->
            <div class="long_block">
              <label for=" ">Email*</label><br />
              <input
                class="data"
                type=" email "
                name="email"
                id="input 4"
                class="long"
                tabindex=" 5 "
                value="<?=$user->data['E_MAIL']?>"
                disabled
              /><br />
            </div>
            <div class="block">
              <label for=" ">Phone number*</label
              ><i class="fa fa-globe" id=" phoneNumber " title=" Siz bu "></i
              ><br />
              <input
                class="data"
                type="tel"
                name="tel"
                id="input 5"
                tabindex=" 6 "
                value="<?=$user->data['PHONE_NUMBER']?>"
              /><br />
            </div>
            <div class="block">
              <label for=" ">Gender</label
              ><i class="fa fa-globe" id="gender" title="Siz bu"></i><br />
              <select
                class="data"
                name="gender"
                id="add 1"
                class="border"
                tabindex=" 7 "
              >
                <option value="1"  <?php if($user->data['GENDER'] == 1){echo 'selected';} ?>>Male</option>
                <option value="2" <?php if($user->data['GENDER'] == 2){echo 'selected';} ?>>Female</option>
              </select>
            </div>
            <div class="block">
              <label for="">Country*</label
              ><i class="fa fa-globe" id="globe" title="Siz bu"></i>
              <br />
              <select
                class="data"
                class="countryborder"
                name="country"
                id="add 2"
                tabindex=" 8 "
                value="<?=$user->data['COUNTRY']?>"
              >
                <option value="Afganistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option> </select
              ><br />
            </div>
            <div class="block">
              <label for=" ">City</label
              ><i class="fa fa-globe" id="city" title="Siz bu"></i>
              <br />
              <input
                class="data"
                type="text"
                name="city"
                id="input 6"
                tabindex=" 9 "
                value="<?=$user->data['CITY']?>"
              /><br />
            </div>
          </div>
        </div>
        <div class="right">
          <div class="wrap">
            <div class="block">
              <label for=" ">Language</label
              ><i class="fa fa-globe" id="lang" title=" Siz bu "></i><br />
              <select class="data" id="add lang" name="lang" class="border">
                <option value="TM" <?php if($user->data['LANGUAGE'] == 'TM'){echo 'selected';} ?>>Turkmen</option>
                <option value="RU" <?php if($user->data['LANGUAGE'] == 'RU'){echo 'selected';} ?>>Russian</option>
                <option value="EN" <?php if($user->data['LANGUAGE'] == 'EN'){echo 'selected';} ?>>English</option>
              </select>
            </div>
            <div class="block">
              <label for=" ">Birthdate</label
              ><i class="fa fa-globe" id="birth" title=" Siz bu "></i><br />
              <input
                class="data"
                type= "date"
                name="birthDate"
                id=" 7"
                tabindex="11"
                value="<?=$user->data['BIRTH_DATE']?>"
              /><br />
            </div>
            <div class="block">
              <label for=" ">Status*</label
              ><i class="fa fa-globe" id="status" title=" Siz bu "></i><br />
              <select
                class="data"
                name="status"
                id="add 3"
                class="border"
                tabindex=" 12 "
                required
              >
                <option value="1" <?php if($user->data['STATUS'] == 1){echo 'selected';} ?>>Teacher</option>
                <option value="2" <?php if($user->data['STATUS'] == 2){echo 'selected';} ?>>Student</option>
              </select>
            </div>
            <div class="block">
              <label for=" ">Job</label
              ><i class="fa fa-globe" id="job" title=" Siz bu "></i><br />
              <input
                class="data"
                type="text"
                name="job"
                id="input 8"
                tabindex=" 13 "
                value="<?=$user->data['JOB']?>"
              /><br />
            </div>
            <div class="long_block">
              <label for=" ">GMT</label
              ><i class="fa fa-globe" id="time" title=" Siz bu "></i><br />
              <select
                class="data"
                name="time"
                id="add 4"
                class="border"
                tabindex=" 15 "
                required
              >
              </select>
            </div>
            <br />
            <div class="long_block" style="margin-top: 20px;">
              <label for=" ">Biography</label
              ><i class="fa fa-globe" id="bio" title=" Siz bu "></i><br />
              <textarea
                class="data"
                name="bio"
                tabindex="16"
                id="textarea"
              > <?=$user->data['BIO']?></textarea>
              <div class="btns">
                <span id="password">Change password</span>
                <button type="submit" class="btn">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <div class="password-modal-wrapper">
      <div class="password-modal">
        <h4>Change password</h4>
        <form id="passwordForm">
          <div class="input">
            <label for="oldPass">Old Password</label>
            <input
              type="password"
              placeholder="Enter old password"
              name="oldPass"
              id="oldPass"
            />
            <i class="fa fa-eye" id="oldPassView"></i>
          </div>
          <div class="input">
            <label for="newPass">New Password</label>
            <div>
              <input
                type="password"
                placeholder="Enter new password"
                name="newPass"
                id="newPass"
              />
              <i class="fa fa-eye" id="newPassView"></i>
            </div>
          </div>
          <div id="errors">
            <span class="error" id="passError" style="display: none;">
              <i class="fa fa-exclamation-circle"></i
            ></span>
          </div>

          <button type="submit">Change</button>
        </form>
      </div>
    </div>