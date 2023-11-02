const pathName = window.location.pathname;
const pageName = pathName.split("/").pop();

if (pageName === "admin_index.php") {
   document.querySelector(".home").classList.add("activeLink");
   document.querySelector(".HOME").classList.add("activeLink2");
}
if (pageName === "admin_data_index.php") {
    document.querySelector(".home").classList.add("activeLink");
}


if (pageName === "search_dispense.php") {
    document.querySelector(".dispense").classList.add("activeLink");
}
if (pageName === "data_dispense.php") {
    document.querySelector(".dispense").classList.add("activeLink");
}


if (pageName === "email_admin_form.php") {
    document.querySelector(".mydata").classList.add("activeLink");
}
if (pageName === "data_admin.php") {
    document.querySelector(".mydata").classList.add("activeLink");
}