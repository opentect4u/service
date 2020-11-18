
var coll = document.getElementsByClassName("collapsible");

var i;

for (i = 0; i < coll.length; i++) {

    coll[i].addEventListener("click", function() {

        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.display === "block") {

            content.style.display = "none";

        } else {

            content.style.display = "block";
        }

    });
}

/*document.getElementById("loutbtn").onclick = function() {

    location.href = "../logout.php";

}

document.getElementById("dashbtn").onclick = function() {

    location.href = "http://localhost/SIMS/post/dashboard.php";

}*/
