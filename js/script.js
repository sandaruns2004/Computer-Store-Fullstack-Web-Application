function changeform() {
    var signinform = document.getElementById("signinbox");
    var signupform = document.getElementById("signupbox");

    signinform.classList.toggle("d-none");
    signupform.classList.toggle("d-none");

    var x = signinform.classList;

    if (x == "col-lg-6 offset-lg-3 col-12 d-none") {
        document.title = "Computer Store | SignUp";
    } else {
        document.title = "Computer Store | SignIn";
    }

    document.getElementById("msgdiv1").className = "d-none";
    document.getElementById("msgdiv2").className = "d-none";
}

function signup() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var uname = document.getElementById("uname");
    var email = document.getElementById("email");
    var password = document.getElementById("pwd");
    var cpassword = document.getElementById("cpwd");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData;

    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("u", uname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("cp", cpassword.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = r.responseText;
            if (resp == "Registration Successful.") {
                document.getElementById("msgdiv1").className = "d-block";
                document.getElementById("msg1").innerHTML = "Please wait ..........";
                document.getElementById("msg1").className = "alert alert-warning";
                continueregister();
            } else {
                document.getElementById("msgdiv1").className = "d-block";
                document.getElementById("msg1").innerHTML = resp;
            }
        }
    }

    r.open("POST", "signupprocess.php", true);
    r.send(form);
}

function signin() {
    var uname = document.getElementById("uname2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var form = new FormData;

    form.append("u", uname.value);
    form.append("p", password.value);
    form.append("rm", rememberme.checked);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = r.responseText;
            if (resp == "success") {
                window.location = "home.php";
            } else {
                document.getElementById("msgdiv2").className = "d-block";
                document.getElementById("msg2").innerHTML = resp;
                document.getElementById("msg2").className = "alert alert-danger";
            }
        }
    }

    r.open("POST", "signinprocess.php", true);
    r.send(form);
}

var modal;

function forgotpassword() {
    var fpm = document.getElementById("fpmodal");
    modal = new bootstrap.Modal(fpm);
    modal.show();
}

function showpassword1() {
    var np = document.getElementById("np");
    if (np.type == "password") {
        np.type = "text";
        document.getElementById("npb").innerHTML = "Hide";
    } else {
        np.type = "password";
        document.getElementById("npb").innerHTML = "Show";
    }
}

function showpassword2() {
    var rp = document.getElementById("rp");
    if (rp.type == "password") {
        rp.type = "text";
        document.getElementById("rpb").innerHTML = "Hide";
    } else {
        rp.type = "password";
        document.getElementById("rpb").innerHTML = "Show";
    }
}

var staticmail;

function sendmailforgotpassword() {

    document.getElementById("msg3").innerHTML = "Please wait ......";
    document.getElementById("msg3").className = "alert alert-warning";
    document.getElementById("msgdiv3").className = "d-block";

    staticmail = document.getElementById("mailforpassword");

    var form = new FormData;
    form.append("m", staticmail.value);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = r.responseText;
            if (resp == "success") {
                document.getElementById("msg3").innerHTML = "Email Sent Successfully. Please check your Email.";
                document.getElementById("msg3").className = "alert alert-success";
                document.getElementById("msgdiv3").className = "d-block";
            } else {
                document.getElementById("msg3").innerHTML = resp;
                document.getElementById("msg3").className = "alert alert-danger";
                document.getElementById("msgdiv3").className = "d-block";
            }
        }
    }

    r.open("POST", "sendemailforgotpasswordprocess.php", true);
    r.send(form);
}


function resetpassword() {
    var np = document.getElementById("np");
    var rp = document.getElementById("rp");
    var code = document.getElementById("code");
    staticmail;

    var form = new FormData;
    form.append("np", np.value);
    form.append("rp", rp.value);
    form.append("c", code.value);
    form.append("m", staticmail.value);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = r.responseText;
            if (resp == "success") {
                modal.hide();
                document.getElementById("msgdiv3").className = "d-none";
                document.getElementById("mailforpassword").value = "";
                document.getElementById("np").value = "";
                document.getElementById("rp").value = "";
                document.getElementById("code").value = "";
            } else {
                document.getElementById("msg3").innerHTML = resp;
                document.getElementById("msg3").className = "alert alert-danger";
                document.getElementById("msgdiv3").className = "d-block";
            }
        }
    }

    r.open("POST", "resetpasswordprocess.php", true);
    r.send(form);
}

var registermodal;
function continueregister() {
    var email = document.getElementById("email");

    var form = new FormData;
    form.append("e", email.value);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var resp = r.responseText;
            if (resp == "success") {
                var fpr = document.getElementById("fpregister");
                registermodal = new bootstrap.Modal(fpr);
                registermodal.show();
                document.getElementById("msg1").className = "d-none";
            } else {
                document.getElementById("msgdiv1").className = "d-block";
                document.getElementById("msg1").className = "alert alert-danger";
                document.getElementById("msg1").innerHTML = resp;
            }
        }
    }

    r.open("POST", "sendemailtoverifyprocess.php", true);
    r.send(form);


}

function register() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var uname = document.getElementById("uname");
    var email = document.getElementById("email");
    var password = document.getElementById("pwd");
    var cpassword = document.getElementById("cpwd");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");
    var code = document.getElementById("verifycode");

    var form = new FormData;

    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("u", uname.value);
    form.append("e", email.value);
    form.append("p", password.value);
    form.append("cp", cpassword.value);
    form.append("m", mobile.value);
    form.append("g", gender.value);
    form.append("code", code.value);

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var resp = r.responseText;
            if (resp == "success") {
                registermodal.hide();
                document.getElementById("msgdiv1").className = "d-block";
                document.getElementById("msg1").innerHTML = resp;
                document.getElementById("msg1").className = "alert alert-success";
                changeform();
            } else {
                document.getElementById("msgdiv4").className = "d-block";
                document.getElementById("msg4").className = "alert alert-danger";
                document.getElementById("msg4").innerHTML = resp;
            }
        }
    }

    r.open("POST", "registerverifyemailprocess.php", true);
    r.send(form);
}

function signout() {
    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var resp = r.responseText;
            if (resp == "success") {
                window.location = "index.php";
            }
        }
    }

    r.open("GET", "signoutprocess.php", true);
    r.send();
}

function changeprofileimage() {
    var image = document.getElementById("imagepicker");

    image.onchange = function () {
        var file = image.files[0];
        var url = window.URL.createObjectURL(file);

        document.getElementById("profileimage").src = url;
    }
}

function selectdistrict() {
    var province = document.getElementById("province").value;

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("district").innerHTML = resp;
        }
    }

    r.open("GET", "changedistrictprocess.php?p=" + province, true);
    r.send();
}

function selectcity() {
    var district = document.getElementById("district").value;

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("city").innerHTML = resp;
        }
    }

    r.open("GET", "changecityprocess.php?d=" + district, true);
    r.send();
}

function getpcode() {
    var city = document.getElementById("city").value;

    var r = new XMLHttpRequest;

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("postalcode").value = resp;
        }
    }

    r.open("GET", "getpcodeprocess.php?c=" + city, true);
    r.send();
}

function updateprofile() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var mobile = document.getElementById("mobile");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var city = document.getElementById("city");
    var image = document.getElementById("imagepicker");

    var form = new FormData;
    form.append("f", fname.value);
    form.append("l", lname.value);
    form.append("m", mobile.value);
    form.append("l1", line1.value);
    form.append("l2", line2.value);
    form.append("c", city.value);
    form.append("i", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            alert(resp);
        }
    }

    r.open("POST", "updateprofileprocess.php", true);
    r.send(form);
}

function displayextraproductdetails() {
    var category_id = document.getElementById("category").value;

    if (category_id == 1 || category_id == 2) {
        document.getElementById("computerspecification").className = "row mt-4";
    } else {
        document.getElementById("computerspecification").className = "row mt-4 d-none";
    }
}

function addproductimages() {
    var image_picker = document.getElementById("imageuploader");

    image_picker.onchange = function () {
        var file_count = image_picker.files.length;

        if (file_count <= 4 || file_count <= 0) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                document.getElementById("i" + x).src = window.URL.createObjectURL(file);
            }
        } else {
            alert(file_count + " files selected. You can upload only 4 or less than 4 files.");
        }
    }
}

function addproduct() {
    var category = document.getElementById("category").value;
    var processor = document.getElementById("processor").value;
    var gpu = document.getElementById("gpu").value;
    var ram = document.getElementById("ram").value;
    var title = document.getElementById("title").value;
    var brand = document.getElementById("brand").value;
    var price = document.getElementById("price").value;
    var deleveryfee = document.getElementById("deleveryfee").value;
    var qty = document.getElementById("qty").value;
    var condition = 0;
    if (document.getElementById("b").checked) {
        condition = 1;
    } else if (document.getElementById("u").checked) {
        condition = 2;
    }
    var color = document.getElementById("color").value;
    var description = document.getElementById("description").value;
    var image_picker = document.getElementById("imageuploader");

    var form = new FormData;
    form.append("c", category);
    form.append("p", processor);
    form.append("g", gpu);
    form.append("r", ram);
    form.append("t", title);
    form.append("b", brand);
    form.append("pr", price);
    form.append("df", deleveryfee);
    form.append("q", qty);
    form.append("co", condition);
    form.append("cl", color);
    form.append("d", description);

    for (var x = 0; x < image_picker.files.length; x++) {
        form.append("i" + x, image_picker.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            alert(resp);
        }
    }

    r.open("POST", "addproductprocess.php", true);
    r.send(form);
}

var colorpickermodal;

function addcolors() {
    var fpm = document.getElementById("colorchange");
    colorpickermodal = new bootstrap.Modal(fpm);
    colorpickermodal.show();

    document.getElementById("msgdiv1").className = "d-none";
    var colorname = document.getElementById("colorname");
    var colorcode = document.getElementById("colorcode");

    colorname.value = "";
    colorcode.value = "";
}

function addcolor() {
    var colorname = document.getElementById("colorname");
    var colorcode = document.getElementById("colorcode");

    var form = new FormData();

    form.append("cn", colorname.value);
    form.append("cc", colorcode.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Color Added Successfully") {
                document.getElementById("msg1").innerHTML = "Color Added Successfully.";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgdiv1").className = "d-block";
            } else {
                document.getElementById("msg1").innerHTML = resp;
                document.getElementById("msg1").className = "alert alert-danger";
                document.getElementById("msgdiv1").className = "d-block";
            }
            getcolorstoform();
        }
    }

    r.open("POST", "addcolorprocess.php", true);
    r.send(form);
}

function getcolorstoform() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("color").innerHTML = resp;
        }
    }

    r.open("GET", "getcolorstoformprocess.php", true);
    r.send();
}

function showcolor() {
    var x = document.getElementById("color").value;
    document.getElementById("mycolor").value = x;
}

function basicsearch(x) {
    var keyword = document.getElementById("searchbox").value;
    var category = document.getElementById("category").value;

    if (keyword == "" && category == 0) {
        swal("Warning!", "Please enter a keyword or select a category.", "warning");
    } else {
        window.location.href = "advancedsearchproducts.php?k=" + keyword + "&c=" + category + "&p=" + x;
    }

}

function addtowishlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Added") {
                document.getElementById("wishlisticon" + id).className = "fa-solid fa-heart";
                document.getElementById("wishlisticon" + id).style.color = "red";
                document.getElementById("wishlistbtn" + id).title = "Remove from Wishlist";
            } else if (resp == "Removed") {
                document.getElementById("wishlisticon" + id).className = "fa-regular fa-heart";
                document.getElementById("wishlisticon" + id).style.color = null;
                document.getElementById("wishlistbtn" + id).title = "Add to Wishlist";
            }
            checkwishlistcount();
        }
    }

    r.open("GET", "addtowishlistprocess.php?id=" + id, true);
    r.send();
}

function removefromwishlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Removed") {
                window.location.reload();
            }
            checkwishlistcount();
        }
    }

    r.open("GET", "removefromwishlistprocess.php?id=" + id, true);
    r.send();
}

function checkwishlistcount() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "No Products found.") {
                document.getElementById("watchlistheadericon").className = "bi bi-heart";
                document.getElementById("watchlistitemsheader").innerHTML = resp;
            } else {
                document.getElementById("watchlistheadericon").className = "bi bi-heart-fill";
                document.getElementById("watchlistitemsheader").innerHTML = resp;
            }
        }
    }

    r.open("GET", "checkwishlistcountprocess.php", true);
    r.send();
}

function watchlistsearch() {
    var keyword = document.getElementById("watchlist_search").value;

    if (keyword == "") {
        swal("Warning!", "Please enter a keyword.", "warning");
    } else {
        window.location.href = "watchlist.php?wk=" + keyword;
    }
}

function sortwatchlist(type, keyword) {

    var form = new FormData();
    form.append("t", type);
    form.append("wk", keyword);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("watchlist_results").innerHTML = resp;
        }
    }

    r.open("POST", "sortwatchlistprocess.php", true);
    r.send(form);

}

function sortproduct(keyword, type, sort, page) {

    var minprice = document.getElementById("minprice").innerHTML;
    var maxprice = document.getElementById("maxprice").innerHTML;

    var qty1;
    var qty2;
    var qty3;

    if (document.getElementById("qty1").checked) {
        qty1 = 1;
    } else {
        qty1 = 0;
    }
    if (document.getElementById("qty2").checked) {
        qty2 = 1;
    } else {
        qty2 = 0;
    }
    if (document.getElementById("qty3").checked) {
        qty3 = 1;
    } else {
        qty3 = 0;
    }

    var available;
    var outofstock;

    if (document.getElementById("stockavailable").checked) {
        available = 1;
    } else {
        available = 0;
    }
    if (document.getElementById("stockoutofstock").checked) {
        outofstock = 1;
    } else {
        outofstock = 0;
    }

    var brandnew;
    var used;

    if (document.getElementById("brandnew").checked) {
        brandnew = 1;
    } else {
        brandnew = 0;
    }
    if (document.getElementById("used").checked) {
        used = 1;
    } else {
        used = 0;
    }
    if (type == 1 || type == 2) {
        var processor_count = document.getElementById("processor_count").innerHTML;
        var gpu_count = document.getElementById("gpu_count").innerHTML;
        var ram_count = 7;

        var processor_count_int = parseInt(processor_count);
        var gpu_count_int = parseInt(gpu_count);

        var processor;
        for (let x = 1; x < processor_count_int + 1; x++) {
            if (document.getElementById("processor" + x).checked == true) {
                processor = x;
            }
        }
        if (processor == undefined) {
            processor = 0;
        }

        var gpu;
        for (let x = 1; x < gpu_count_int + 1; x++) {
            if (document.getElementById("gpu" + x).checked == true) {
                gpu = x;
            }
        }
        if (gpu == undefined) {
            gpu = 0;
        }

        var ram;
        for (let x = 1; x < ram_count + 1; x++) {
            if (document.getElementById("ram" + x).checked == true) {
                ram = x;
            }
        }
        if (ram == undefined) {
            ram = 0;
        }
    }

    var brand_count = document.getElementById("brand_count").innerHTML;
    var brand_count_int = parseInt(brand_count);
    var brand;
    for (let x = 1; x < brand_count_int + 1; x++) {
        if (document.getElementById("brand" + x).checked == true) {
            brand = x;
        }
    }
    if (brand == undefined) {
        brand = 0;
    }

    changebrandbackground(brand, brand_count_int);

    var form = new FormData();
    form.append("keyword", keyword);
    form.append("type", type);
    form.append("minprice", minprice);
    form.append("maxprice", maxprice);
    form.append("qty1", qty1);
    form.append("qty2", qty2);
    form.append("qty3", qty3);
    form.append("available", available);
    form.append("outofstock", outofstock);
    form.append("brandnew", brandnew);
    form.append("used", used);
    if (type == "1" || type == "2") {
        form.append("processor", processor);
        form.append("gpu", gpu);
        form.append("ram", ram);
    }
    form.append("brand", brand);
    form.append("sort", sort);
    form.append("page", page);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            // alert(resp);
            document.getElementById("search_results").innerHTML = resp;
        }
    }

    r.open("POST", "sortproductprocess.php", true);
    r.send(form);

}

function changebrandbackground(brand, brand_count_int) {
    for (let x = 1; x < brand_count_int + 1; x++) {
        if (x == brand) {
            document.getElementById("brandimg" + x).style.backgroundColor = "#a1c4fd";
        } else {
            document.getElementById("brandimg" + x).style.backgroundColor = null;
        }
    }
}

function addtocart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Added") {
                document.getElementById("carticon" + id).className = "fa-solid fa-cart-shopping";
                document.getElementById("carticon" + id).style.color = "black";
                document.getElementById("cart" + id).title = "Update Cart Quantity";
            }
            checkcartcount();
            swal("Good job!", resp, "success");
        }
    }

    r.open("GET", "addtocartprocess.php?id=" + id, true);
    r.send();
}

function removefromcart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Deleted") {
                window.location.reload();
            }
            checkcartcount();
        }
    }

    r.open("GET", "removefromcartprocess.php?id=" + id, true);
    r.send();
}

function checkcartcount() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "No Products found.") {
                document.getElementById("cartheadericon").className = "bi bi-cart";
                document.getElementById("cartitemsheader").innerHTML = resp;
            } else {
                document.getElementById("cartheadericon").className = "bi bi-cart-fill";
                document.getElementById("cartitemsheader").innerHTML = resp;
            }
        }
    }

    r.open("GET", "checkcartprocess.php", true);
    r.send();
}

function checkqty(qty, item, price, id) {
    var input = document.getElementById("qty_input" + item);

    if (input.value <= 0) {
        input.value = 1;
    } else if (input.value > qty) {
        input.value = qty;
    }

    var qty_insert = parseInt(input.value);
    var price_insert = parseInt(price);
    var netprice = qty_insert * price_insert;

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("id", id);
    form.append("qty", qty_insert);
    form.append("price", price_insert);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Cart updated successfully.") {
                document.getElementById("netprice" + item).innerHTML = "Rs." + netprice + ".00";
                checksummery();
            } else {
                alert(resp);
            }
        }
    }

    r.open("POST", "updateproductqtyandpriceprocess.php", true);
    r.send(form);
}

function qty_inc(qty, item, price, id) {
    var input = document.getElementById("qty_input" + item);

    if (input.value < qty) {
        var new_val = parseInt(input.value) + 1;
        input.value = new_val;
    } else {
        input.value = qty;
    }

    var qty_insert = parseInt(input.value);
    var price_insert = parseInt(price);
    var netprice = qty_insert * price_insert;

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("id", id);
    form.append("qty", qty_insert);
    form.append("price", price_insert);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Cart updated successfully.") {
                document.getElementById("netprice" + item).innerHTML = "Rs." + netprice + ".00";
                checksummery();
            } else {
                alert(resp);
            }
        }
    }

    r.open("POST", "updateproductqtyandpriceprocess.php", true);
    r.send(form);
}

function qty_dec(qty, item, price, id) {
    var input = document.getElementById("qty_input" + item);

    if (input.value > 1) {
        var new_val = parseInt(input.value) - 1;
        input.value = new_val;
    } else {
        input.value = 1;
    }

    var qty_insert = parseInt(input.value);
    var price_insert = parseInt(price);
    var netprice = qty_insert * price_insert;

    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("id", id);
    form.append("qty", qty_insert);
    form.append("price", price_insert);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Cart updated successfully.") {
                document.getElementById("netprice" + item).innerHTML = "Rs." + netprice + ".00";
                checksummery();
            } else {
                alert(resp);
            }
        }
    }

    r.open("POST", "updateproductqtyandpriceprocess.php", true);
    r.send(form);
}

function checksummery() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            // alert(resp);
            document.getElementById("cart_summery").innerHTML = resp;
        }
    }

    r.open("POST", "checksummeryprocess.php", true);
    r.send();
}


var updatemodal;
function updateproductmodal(id) {
    var um = document.getElementById("updatemodal" + id);
    updatemodal = new bootstrap.Modal(um);
    updatemodal.show();
}

function updateimages(id) {
    var image_picker = document.getElementById("imageupdate" + id);

    image_picker.onchange = function () {
        var file_count = image_picker.files.length;

        if (file_count <= 4 || file_count <= 0) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                document.getElementById("i" + x + id).src = window.URL.createObjectURL(file);
            }
        } else {
            alert(file_count + " files selected. You can upload only 4 or less than 4 files.");
        }
    }
}

function updateproduct(id) {
    var title = document.getElementById("title" + id);
    var qty = document.getElementById("qty" + id);
    var description = document.getElementById("description" + id);
    var images = document.getElementById("imageupdate" + id);

    var form = new FormData();
    form.append("id", id);
    form.append("t", title.value);
    form.append("q", qty.value);
    form.append("d", description.value);

    var count = images.files.length;
    alert(count);

    for (var x = 0; x < count; x++) {
        form.append("images" + x, images.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            alert(resp);
        }
    }

    r.open("POST", "updateproductprocess.php", true);
    r.send(form);

}

function searchmyproducts(pageno) {
    var txt = document.getElementById("searchbox");
    var cat_id = document.getElementById("categoryupdate");

    var form = new FormData();
    form.append("txt", txt.value);
    form.append("cat_id", cat_id.value);
    form.append("pageno", pageno);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            // alert(resp);
            document.getElementById("search_results").innerHTML = resp;
        }
    }

    r.open("POST", "searchmyproductsprocess.php", true);
    r.send(form);
}

function changemyproductspages(page) {
    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("page", page);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            // alert(resp);
            document.getElementById("search_results").innerHTML = resp;
        }
    }

    r.open("POST", "changemyproductspageprocess.php", true);
    r.send(form);
}

function opensingleproduct(id, title) {
    window.location.href = "singleproductview.php?id=" + id + "&t=" + title;
}

function qtycheck(qty, price) {
    var input = document.getElementById("qty_box");

    if (input.value <= 0) {
        input.value = 1;
    } else if (input.value > qty) {
        input.value = qty;
    }

    var qty = parseInt(input.value);
    var netprice = parseInt(qty * price);
    document.getElementById("netprice").innerHTML = "Net Price : Rs." + netprice + ".00";
}

function inc_qty(qty, price) {
    var input = document.getElementById("qty_box");

    if (input.value < qty) {
        var new_val = parseInt(input.value) + 1;
        input.value = new_val;
    } else {
        input.value = qty;
    }

    var qty = parseInt(input.value);
    var netprice = parseInt(qty * price);
    document.getElementById("netprice").innerHTML = "Net Price : Rs." + netprice + ".00";
}

function dec_qty(price) {
    var input = document.getElementById("qty_box");

    if (input.value > 1) {
        var new_val = parseInt(input.value) - 1;
        input.value = new_val;
    } else {
        input.value = 1;
    }

    var qty = parseInt(input.value);
    var netprice = parseInt(qty * price);
    document.getElementById("netprice").innerHTML = "Net Price : Rs." + netprice + ".00";
}

function loadproductimages(x) {
    var sample_img = document.getElementById("img" + x).src;
    var main_img = document.getElementById("mainimg");

    main_img.src = sample_img;
}

function paycartitems() {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            var obj = JSON.parse(resp);

            var mail = obj["mail"];
            var amount = obj["amount"];

            if (resp == "Empty Cart") {
                alert("Your cart is empty. Please add products.");
            } else if (resp == "No Address Found") {
                alert("No address found. Please add or select an address.");
                window.location.href = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    alert("Payment completed. OrderID:" + orderId);
                    saveInvoice(orderId);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/cart.php",     // Important
                    "cancel_url": "http://localhost/eshop/cart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": obj["currency"],
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["umail"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                payhere.startPayment(payment);
            }
        }
    }

    r.open("POST", "paycartitemsprocess.php", true);
    r.send();
}

function saveInvoice(orderId) {
    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("oid", orderId);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "OK") {
                window.location = "invoice.php?id=" + orderId;
            }
        }
    }

    r.open("POST", "saveinvoiceprocess.php", true);
    r.send(form);
}

function printinvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("document").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function addtowishlistfromsingleview(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            window.location.reload();
            checkwishlistcount();
        }
    }

    r.open("GET", "addtowishlistprocess.php?id=" + id, true);
    r.send();
}

function addtocartfromsingleview(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            window.location.reload();
            checkcartcount();
            swal("Good job!", resp, "success");
        }
    }

    r.open("GET", "addtocartprocess.php?id=" + id, true);
    r.send();
}

function paysingleproduct(id) {
    var qty = document.getElementById("qty_box").value;

    var intqty = parseInt(qty);

    var r = new XMLHttpRequest();
    var form = new FormData();
    form.append("id", id);
    form.append("qty", intqty);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            var obj = JSON.parse(resp);
            var mail = obj["mail"];
            var amount = obj["amount"];

            if (resp == "No Address Found") {
                alert("No address found. Please add or select an address.");
                window.location.href = "userProfile.php";
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer

                    alert("Payment completed. OrderID:" + orderId);
                    saveSingleInvoice(orderId, id, intqty);
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": obj["mid"],    // Replace your Merchant ID
                    "return_url": "http://localhost/eshop/cart.php",     // Important
                    "cancel_url": "http://localhost/eshop/cart.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": obj["amount"] + ".00",
                    "currency": obj["currency"],
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["umail"],
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked

                payhere.startPayment(payment);
            }
        }
    }

    r.open("POST", "paysingleproductprocess.php", true);
    r.send(form);
}

function saveSingleInvoice(orderId, id, intqty) {
    var r = new XMLHttpRequest();

    var form = new FormData();
    form.append("oid", orderId);
    form.append("pid", id);
    form.append("qty", intqty);

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "OK") {
                window.location = "invoice.php?id=" + orderId;
            }
        }
    }

    r.open("POST", "savesingleinvoiceprocess.php", true);
    r.send(form);
}

var starnumber;
function fillfeedbackstars(starno) {
    if (starno == 1) {
        document.getElementById("star1").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star2").className = "bi bi-star text-warning fs-5";
        document.getElementById("star3").className = "bi bi-star text-warning fs-5";
        document.getElementById("star4").className = "bi bi-star text-warning fs-5";
        document.getElementById("star5").className = "bi bi-star text-warning fs-5";
        starnumber = 1;
    } else if (starno == 2) {
        document.getElementById("star1").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star2").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star3").className = "bi bi-star text-warning fs-5";
        document.getElementById("star4").className = "bi bi-star text-warning fs-5";
        document.getElementById("star5").className = "bi bi-star text-warning fs-5";
        starnumber = 2;
    } else if (starno == 3) {
        document.getElementById("star1").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star2").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star3").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star4").className = "bi bi-star text-warning fs-5";
        document.getElementById("star5").className = "bi bi-star text-warning fs-5";
        starnumber = 3;
    } else if (starno == 4) {
        document.getElementById("star1").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star2").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star3").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star4").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star5").className = "bi bi-star text-warning fs-5";
        starnumber = 4;
    } else if (starno == 5) {
        document.getElementById("star1").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star2").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star3").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star4").className = "bi bi-star-fill text-warning fs-5";
        document.getElementById("star5").className = "bi bi-star-fill text-warning fs-5";
        starnumber = 5;
    } else {
        starnumber == 0;
    }
}

function addfeedback(id) {
    if (starnumber == undefined) {
        starnumber = 0;
    }
    var star = starnumber;
    var msg = document.getElementById("review").value;

    var form = new FormData();
    form.append("id", id);
    form.append("star", star);
    form.append("msg", msg);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Feedback submitted successfully") {
                alert("Thank you for your feedback!");
                window.location.reload();
            } else {
                alert(resp);
            }
        }
    }

    r.open("POST", "addfeedbackprocess.php", true);
    r.send(form);

}

function searchusers() {
    var txt = document.getElementById("email_input").value;

    var form = new FormData();
    form.append("txt", txt);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            document.getElementById("users_data").innerHTML = resp;
        }
    }

    r.open("POST", "searchusersprocess.php", true);
    r.send(form);
}

function changeuserstatus(id) {
    var form = new FormData();
    form.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Something Went Wrong.") {
                alert(resp);
            } else if (resp == "User Deactivated Successfully.") {
                document.getElementById("statustype" + id).innerHTML = "Deactive"
            } else if (resp == "User Reactivated Successfully.") {
                document.getElementById("statustype" + id).innerHTML = "Active"
            }
        }
    }

    r.open("POST", "changeuserstatusprocess.php", true);
    r.send(form);
}

function searchinvoices() {
    var from = document.getElementById("fromDate");
    var to = document.getElementById("toDate");

    var form = new FormData();
    form.append("from", from.value);
    form.append("to", to.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "") {
                document.getElementById("invoices_results").innerHTML = "<h4 class='text-center mt-5'>No billing history found.</h4>";
            } else {
                document.getElementById("invoices_results").innerHTML = resp;
            }
        }
    }

    r.open("POST", "searchinvoicesprocess.php", true);
    r.send(form);
}

var contactm;
function contactus() {
    var contact_modal = document.getElementById("contactusModal");
    contactm = new bootstrap.Modal(contact_modal);
    contactm.show();
}

function sendmsg(id) {
    var name = document.getElementById("namecontactus").value;
    var email = document.getElementById("emailcontactus").value;
    var msg = document.getElementById("messagecontactus").value;

    var form = new FormData();
    form.append("id", id);
    form.append("name", name);
    form.append("email", email);
    form.append("msg", msg);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var resp = r.responseText;
            if (resp == "Your message has been sent successfully") {
                swal("Success!", resp, "success");
                document.getElementById("messagecontactus").innerHTML = " ";
                contactm.hide();
            } else {
                swal("Warning!", resp, "warning");
            }
        }
    }

    r.open("POST", "sendmessageprocess.php", true);
    r.send(form);
}

var seemsg;

function seemessages(id) {
    var seemessages = document.getElementById("seemessages" + id);
    seemsg = new bootstrap.Modal(seemessages);
    seemsg.show();
}