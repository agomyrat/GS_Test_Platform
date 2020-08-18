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
                id="input"
                tabindex=" 1 "
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
                id="input"
                tabindex=" 2 "
              /><br />
            </div>
            <div class="block">
              <label for=" ">Username*</label
              ><i class="fa fa-globe" id="username" title="Siz bu"></i><br />
              <input
                class="data"
                type="text"
                name="username"
                id="input"
                tabindex="3"
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
                id="input"
                class="long"
                tabindex=" 5 "
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
                id="input"
                tabindex=" 6 "
              /><br />
            </div>
            <div class="block">
              <label for=" ">Gender</label
              ><i class="fa fa-globe" id="gender" title="Siz bu"></i><br />
              <select
                class="data"
                name="gender"
                id="add"
                class="border"
                tabindex=" 7 "
              >
                <option value="male">Male</option>
                <option value="female">Female</option>
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
                id="add"
                tabindex=" 8 "
              >
                <option value="Afganistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option> </select
              ><br />
            </div>
            <div class="block">
              <label for=" ">City</label
              ><i class="fa fa-globe" id="city" ttitle="Siz bu"></i>
              <br />
              <input
                class="data"
                type="text"
                name="city"
                id="input"
                tabindex=" 9 "
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
                <option value=" Turkmen ">Turkmen</option>
                <option value=" Russian ">Russian</option>
                <option value=" English ">English</option>
              </select>
            </div>
            <div class="block">
              <label for=" ">Birthdate</label
              ><i class="fa fa-globe" id="birth" title=" Siz bu "></i><br />
              <input
                class="data"
                type= "date"
                name="birthDate"
                id="input"
                tabindex="11"
              /><br />
            </div>
            <div class="block">
              <label for=" ">Status*</label
              ><i class="fa fa-globe" id="status" title=" Siz bu "></i><br />
              <select
                class="data"
                name="status"
                id="add"
                class="border"
                tabindex=" 12 "
                required
              >
                <option value="Teacher">Teacher</option>
                <option value="Student">Student</option>
              </select>
            </div>
            <div class="block">
              <label for=" ">Job</label
              ><i class="fa fa-globe" id="job" title=" Siz bu "></i><br />
              <input
                class="data"
                type="text"
                name="job"
                id="input"
                tabindex=" 13 "
              /><br />
            </div>
            <div class="long_block">
              <label for=" ">GMT</label
              ><i class="fa fa-globe" id="time" title=" Siz bu "></i><br />
              <select
                class="data"
                name="time"
                id="add"
                class="border"
                tabindex=" 15 "
                required
              >
                <option value=" -12:00 "
                  >(GMT -12:00) Eniwetok, Kwajalein</option
                >
                <option value=" -11:00 "
                  >(GMT -11:00) Midway Island, Samoa</option
                >
                <option value=" -10:00 ">(GMT -10:00) Hawaii</option>
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
              ></textarea>
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
        <form method="post">
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