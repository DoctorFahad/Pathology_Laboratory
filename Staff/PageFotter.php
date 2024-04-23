            <!-- Footer Area -->
              
        </div>
    </div>

    <!-- ======================================
    ********* Page Wrapper Area End ***********
    ======================================= -->

    <!-- Must needed plugins to the run this Template -->
    <script src="../Content/Admin/js/jquery.min.js"></script>
    <script src="../Content/Admin/js/bootstrap.bundle.min.js"></script>
    <script src="../Content/Admin/js/default-assets/setting.js"></script>
    <script src="../Content/Admin/js/default-assets/scrool-bar.js"></script>
    <script src="../Content/Admin/js/todo-list.js"></script>

    <!-- Active JS -->
    <script src="../Content/Admin/js/default-assets/active.js"></script>

    <div class="modal fade" id="ChangePassword" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #343a40;">
                            <h4 class="modal-title text-white">Change Password</h4>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="ChangePasswordForm">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <b>Old </b><span id="lblOldPass" style="color:red">*</span>
                                        <input type="password" name="txtOldPass" class="form-control" id="txtOldPass"
                                            placeholder="Old Password" />
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <b>New </b><span id="lblNewPass" style="color:red">*</span>
                                        <input type="password" name="txtNewPass" id="txtNewPass" class="form-control"
                                            placeholder="New Password" />
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <b>Confirm</b><span id="lblConfirmPass" style="color:red">*</span>
                                        <input type="password" name="txtConfirmPass" id="txtConfirmPass"
                                            class="form-control" placeholder="Confirm Password" />
                                    </div>
                                    <div class="col-md-12 form-group mt-2">
                                        <button type="button" class="btn btn-primary" id="btnChangePass"
                                            name="btnChangePass">Save</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<script>
    $(document).ready(function() {
        $("#btnChangePass").click(function() {

            var Cnt = 0;

            Cnt = IsEmpty("txtOldPass", "lblOldPass", Cnt);
            Cnt = IsEmpty("txtNewPass", "lblNewPass", Cnt);
            Cnt = IsEmpty("txtConfirmPass", "lblConfirmPass", Cnt);

            var New = $("#txtNewPass").val();
            var Confirm = $("#txtConfirmPass").val();

            if (New != "" && Confirm != "") {
                if (New == Confirm) {
                    $("#lblConfirmPass").text("*");
                } else {
                    Cnt++;
                    $("#lblConfirmPass").text("*Password are not Match");
                }
            }

            if (Cnt == 0) {
                $("#btnChangePass").html("<i class='fas fa-spinner fa-pulse'></i>&nbsp; Wait....");
                $("#btnChangePass").prop("disabled", true);

                var jsonData = {
                    "StaffId": getCookie("StaffId"),
                    "newPass": $("#txtNewPass").val(),
                    "oldPass": $("#txtOldPass").val()
                };

                $.ajax({
                    url: "../Controllers/StaffController.php?Choice=updatePasswd",
                    type: "POST",
                    data: JSON.stringify(jsonData),
                    contentType: "app/json"
                }).done(function(data) {
                    console.log(data);
                    if (data.trim() == "Updated") {
                        alert('Password Successfully Change');
                        $('#ChangePasswordForm')[0].reset();
                    } else {
                        $("#lblOldPass").text("Old Password is Incorrect");
                        alert("Old Password is Incorrect");
                    } 
                    $("#btnChangePass").html("Save");
                    $("#btnChangePass").prop("disabled", false);
                });
            }
        });
    });
</script>

    <div class="modal" id="StaffProfileModel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="text-center">Staff Profile</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <b>Full Name</b><span class='error' id='lblProfileFullName'></span>
                                <input type="text" class="form-control" name="txtProfileFullName" id="txtProfileFullName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>User Name</b><span class='error' id='lblProfileUserName'></span>
                                <input type="text" class="form-control" name="txtProfileUserName" id="txtProfileUserName">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Address</b><span class='error' id='lblProfileAddress'></span>
                                <input type="text" class="form-control" name="txtProfileAddress" id="txtProfileAddress">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>ContactNo</b><span class='error' id='lblProfileCno'></span>
                                <input type="text" class="form-control" name="txtProfileCno" id="txtProfileCno">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Gender</b><span class='error' id='lblProfileGender'></span>
                                <input type="text" class="form-control" name="txtProfileGender" id="txtProfileGender">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DOB</b><span class='error' id='lblProfileDOB'></span>
                                <input type="date" class="form-control" name="txtProfileDOB" id="txtProfileDOB">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>DOJ</b><span class='error' id='lblProfileDOJ'></span>
                                <input type="date" class="form-control" name="txtProfileDOJ" id="txtProfileDOJ">
                            </div>
                            <div class="col-md-6 mb-2">
                                <b>Email</b><span class='error' id='lblProfileEmail'></span>
                                <input type="text" class="form-control" name="txtProfileEmail" id="txtProfileEmail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" id="btnChangeProfile">Change Profile</button>
                <button type="reset" onclick="cancle()" class="btn btn-danger" id="btnCANCLE"
                    data-bs-dismiss="modal">CANCLE</button>
            </div>
        </div>
    </div>
</div>
<script>
function GetOnlyStaff() {
    $.ajax({
        url: "../Controllers/StaffController.php?Choice=GetOnlyStaff",
        type: "POST",
        data: JSON.stringify({
            "Id": getCookie("StaffId")
        }),
        contentType: "app/json",
        success: function(data) {
            data = JSON.parse(data);
            $("#txtProfileFullName").val(data.FullName);
            $("#txtProfileUserName").val(data.UserName);
            $("#txtProfileCno").val(data.ContactNo);
            $("#txtProfileEmail").val(data.Email);
            $("#txtProfileAddress").val(data.Address);
            $("#txtProfileGender").val(data.Gender);
            $("#txtProfileDOB").val(data.DOB);
            $("#txtProfileDOJ").val(data.DOJ);
            $("#btnChangeProfile").html("Change Profile")
        }
    });
}
GetOnlyStaff();
$(document).ready(function(){
    $("#btnChangeProfile").click(function(){
        var Cnt = 0;
        Cnt = IsEmpty("txtProfileFullName", "lblFullName", Cnt);
        Cnt = IsEmpty("txtProfileUserName", "lblUserName", Cnt);
        Cnt = IsEmpty("txtProfileEmail", "lblEmail", Cnt);
        Cnt = IsEmpty("txtProfileCno", "lblCno", Cnt);
        Cnt = IsEmpty("txtProfileAddress", "lblProfileAddress", Cnt);
        Cnt = IsEmpty("txtProfileGender", "lblProfileGender", Cnt);
        Cnt = IsEmpty("txtProfileDOB", "lblProfileDOB", Cnt);
        Cnt = IsEmpty("txtProfileDOJ", "lblProfileDOJ", Cnt);
        
        if (Cnt == 0)
        {
            insertDate();
        }
    });
});

async function insertDate() {

    var JsonData = {
        "StaffId": getCookie("StaffId"),
        "FullName": $("#txtProfileFullName").val(),
        "ContactNo": $("#txtProfileCno").val(),
        "Email": $("#txtProfileEmail").val(),
        "UserName": $("#txtProfileUserName").val(),
        "Address": $("#txtProfileAddress").val(),
        "Gender": $("#txtProfileGender").val(),
        "DOB": $("#txtProfileDOB").val(),
        "DOJ": $("#txtProfileDOJ").val()
    };

    $.ajax({
        url: "../Controllers/StaffController.php?Choice=UpdateStaffDetail",
        type: "POST",
        contentType: "app/json",
        data: JSON.stringify(JsonData),
        success: function(res) {
            alert(res);
            setCookie("StaffFullName", $("#txtProfileFullName").val());
            window.location.href = "";
        }
    });

}
</script>
    
    <div id="toast-container" class="toast-container">
        <div id="toast-message" class="toast-message"></div>
    </div>
</body>


<!-- Mirrored from demo.riktheme.com/fojota/side-menu/elegant-icons.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jan 2024 11:15:33 GMT -->
</html>