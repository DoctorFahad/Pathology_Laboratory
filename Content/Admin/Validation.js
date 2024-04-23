function SplitValue(Value, No_of_Word) {
    var ValueArray = Value.split(" ");
    var Len = Value.trim().split(/\s+/).length;
    var ValueLabel = "";

    var Count = 0;
    for (i = 0; i < Len; i++) {
        if (Count == No_of_Word) {
            ValueLabel = ValueLabel + '<br />';
            Count = 1;
        }

        ValueLabel = ValueLabel + ' ' + ValueArray[i];
        Count++;
    }
    return ValueLabel;
}

function IsEmpty(txtName, lblName, Cnt) {
    if ($("#" + txtName).val() == "") {
        Cnt++;
        $("#" + lblName).text("*Required");
        $("#" + txtName).css("border-color", "red");
    }
    else {
        $("#" + lblName).text("*");
        $("#" + txtName).css("border-color", "gray");
    }
    return Cnt;
}

function CheckContactNo(txtName, lblName, Cnt) {
    var Value = $("#" + txtName).val();
    if (Value != "") {

        var regx = /^\d{10}$/;
        if (regx.test(Value)) {
            $("#" + lblName).text("*");
        }
        else
        {
            Cnt++;
            $("#" + lblName).text("*10 Digits Only");
        }
    }
    return Cnt;
}

function CheckVehicleNo(txtName, lblName, Cnt) {
    var Value = $("#" + txtName).val();
    if (Value != "") {

        var regx = /^[A-Z]{2}\s[0-9]{2}\s[A-Z]{2}\s[0-9]{4}$/;
        if (regx.test(Value)) {
            $("#" + lblName).text("*");
        }
        else
        {
            Cnt++;
            $("#" + lblName).text("*Invalid");
        }
    }
    return Cnt;
}

function CheckChasesNo(txtName, lblName, Cnt) {
    var Value = $("#" + txtName).val();
    if (Value != "") {

        var regx = /^[A-HJ-NPR-Z0-9]{17}$/;
        if (regx.test(Value)) {
            $("#" + lblName).text("*");
        }
        else
        {
            Cnt++;
            $("#" + lblName).text("*Invalid");
        }
    }
    return Cnt;
}

function checkCurrency(txtName, lblName, Cnt) {
    var Value = $("#" + txtName).val();
    if (Value != "")
    {
        var reg = /^\d{0,4}(\.\d{0,2})?$/;
        if (reg.test(Value))
        {
            $("#" + lblName).text("*");
        }
        else
        {
            $("#" + lblName).text("*Invalid");
        }
    }
    return Cnt;
}

function ValidateAadhaar(txtName, lblName, Cnt) {


    var Value = $("#" + txtName).val();

    if (Value != "") {
        var expr = /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/;
        if (expr.test(Value)) {
            $("#" + lblName).text("");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid Aadhaar Number");
        }
    }
    return Cnt;
}

function CheckLength(txtName, lblName, Length, Cnt) {
    var Value = $("#" + txtName).val();

    if (Value != "") {
        if (Value.length <= Length) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Not More then " + Length);
        }
    }

    return Cnt;
}

function CheckPercentage(txtName, lblName, Cnt) {
    var Value = $("#" + txtName).val();
    if (Value != "") {
        if (parseInt(Value) <= 100) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Not More then 100");
        }
    }

    return Cnt;
}



function EmailValidation(txtName, lblName, Cnt) {

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var Email = $("#" + txtName).val();

    if (Email != "") {
        if (Email.match(mailformat)) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid Email");
        }
    }
    return Cnt;
}

function CheckPassword(txtName, lblName, Cnt) {
    var paswd = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
    var Password = $("#" + txtName).val();

    if (Password != "") {
        if (Password.match(paswd)) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*More then 7 characters which contain at least one Digit and Special Character");
        }
    }
    return Cnt;
}

function CheckPan(txtName, lblName, Cnt) {
    var PanExp = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
    var PanNo = $("#" + txtName).val();

    if (PanNo != "") {
        if (PanNo.match(PanExp)) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid Pan No.");
        }
    }
    return Cnt;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode >= 48 && charCode <= 57) {
        return true;
    }
    return false;
}

function isFlotingKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46 || (charCode >= 48 && charCode <= 57)) {
        return true;
    }
    return false;
}

function CheckGST(txtName, lblName, Cnt) {
    var GSTExp = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
    var GSTNo = $("#" + txtName).val();

    if (GSTNo != "") {
        if (GSTNo.match(GSTExp)) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid GST No.");
        }
    }
    return Cnt;
}


function CheckIFSC(txtName, lblName, Cnt) {
    var IFSCExp = /^[A-Z]{4}0[A-Z0-9]{6}$/;
    var IFSC = $("#" + txtName).val();

    if (IFSC != "") {
        if (IFSC.trim().match(IFSCExp) != null) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid IFSC");
        }
    }
    return Cnt;
}

function CheckBankAccNo(txtName, lblName, Cnt) {
    let regex = new RegExp(/^[0-9]{9,18}$/);
    var AccountNo = $("#" + txtName).val();

    if (AccountNo != "") {
        if (regex.test(AccountNo)) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Invalid Bank Account No.");
        }
    }
    return Cnt;
}

function CheckPastDate(txtName, lblName, Cnt) {

    var Dt = $("#" + txtName).val();
    if (Dt != "") {
        var myDate = new Date(Dt);
        var today = new Date();
        if (myDate <= today) {
            Cnt++;
            $("#" + lblName).text("*Past Date Not Allowed");
        }
        else {
            $("#" + lblName).text("*");
        }
    }

    return Cnt;
}


function CheckFutureDate(txtName, lblName, Cnt) {

    var Dt = $("#" + txtName).val();
    if (Dt != "") {
        var myDate = new Date(Dt);
        var today = new Date();
        if (myDate >= today) {
            Cnt++;
            $("#" + lblName).text("*Future Date Not Allowed");
        }
        else {
            $("#" + lblName).text("*");
        }
    }
    return Cnt;
}

function FileValidtion(FupName, lblName, Cnt) {
    var FileInput = document.getElementById(FupName);

    if (!FileInput.files[0]) {
        Cnt++;
        $("#" + lblName).text("*Required");
    }
    else {
        $("#" + lblName).text("*");
    }

    return Cnt;
}

function setData(Value) {
    var Dt = new Date(Value);
    var Day = Dt.getDate();
    var Month = Dt.getMonth() + 1;
    var Year = Dt.getFullYear();

    if (Day < 10) {
        Day = "0" + Day;
    }

    if (Month < 10) {
        Month = "0" + Month;
    }

    return Day + "-" + Month + "-" + Year;

}

function setInputData(Value) {
    var Dt = new Date(Value);
    var Day = Dt.getDate();
    var Month = Dt.getMonth() + 1;
    var Year = Dt.getFullYear();

    if (Day < 10) {
        Day = "0" + Day;
    }

    if (Month < 10) {
        Month = "0" + Month;
    }

    return Year + "-" + Month + "-" + Day;

}

function setYearMonth(Value) {
    var Dt = new Date(Value);
    var Day = Dt.getDate();
    var Month = Dt.getMonth() + 1;
    var Year = Dt.getFullYear();

    if (Day < 10) {
        Day = "0" + Day;
    }

    if (Month < 10) {
        Month = "0" + Month;
    }

    return Month + "/" + Year.toString().substr(-2);;

}

function setTime(Value) {
    var Dt = new Date(Value);
    var Hour = Dt.getHours();
    var Minute = Dt.getMinutes();
    if (Hour < 10) {
        Hour = "0" + Hour;
    }

    if (Minute < 10) {
        Minute = "0" + Minute;
    }
    return Hour + ":" + Minute;
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function isImageFile(FupName, lblName, Cnt) {
    var myfile = $("#" + FupName).val();
    if (myfile != "") {
        var ext = myfile.split('.').pop();
        if (ext == "png" || ext == "jpg" || ext == "jpeg") {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Only Image File");
        }
    }
    return Cnt;
}





function isPDFFile(FupName, lblName, Cnt) {
    var myfile = $("#" + FupName).val();
    if (myfile != "") {
        var ext = myfile.split('.').pop();
        if (ext == "pdf") {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Only PDF File");
        }
    }
    return Cnt;
}

function checkFileSize(FileName, lblName, FileSizeLimit, SizeIn, Cnt) {
    var inp = document.getElementById(FileName);

    if (inp.files[0]) {
        var size = (inp.files[0].size / 1024); //Byte to KB
        if (SizeIn == "MB") {
            size = (size / 1024);
        }

        if (size < FileSizeLimit) {
            $("#" + lblName).text("*");
        }
        else {
            Cnt++;
            $("#" + lblName).text("*Not More Then " + FileSizeLimit + " " + SizeIn);
        }
    }
    return Cnt;
}

function validateIndianLicenseNumber(txtlicenseNo, lblLicenseNo, Cnt) {
    var Value = $("#" + txtlicenseNo).val();

    if(Value != ""){
        var pattern = /^([A-Z]{2})(\d{2}|\d{3})[a-zA-Z]{0,1}(\d{4})(\d{7})$/;

        if (pattern.test(Value)) {
            $("#" + lblLicenseNo).text("*");
        } 
        else {
            Cnt++;
            $("#" + lblLicenseNo).text("*Invalid License Number");
        }
    }
    return Cnt;  
}

