function login() {
    var x1 = document.getElementById("js1");
    var x2 = document.getElementById("js2");
    if (x1.style.display === "none" & x2.style.display === "block") {
        x1.style.display = "block";
        x2.style.display = "none";
    } else {
        x1.style.display = "none";
        x2.style.display = "block";
    }
}