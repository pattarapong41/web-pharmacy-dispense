const pathName = window.location.pathname;
const pageName = pathName.split("/").pop();

if (pageName === "web.php") {
    document.querySelector(".dispense").classList.add("activeLink");
}
if (pageName === "data_dis_seh.php") {
    document.querySelector(".dispense").classList.add("activeLink");
}


if (pageName === "email_user_form.php") {
   document.querySelector(".mydata").classList.add("activeLink");
}
if (pageName === "data_user.php") {
    document.querySelector(".mydata").classList.add("activeLink");
}
