const accordions = document.getElementsByClassName("has-submenu");
const adminSlideoutButton = document.getElementById("admin-slideout-button");

adminSlideoutButton.onclick = function() {
    this.classList.toggle("is-active");
    document.getElementById("admin-side-menu").classList.toggle("is-active");
};

for (let i = 0; i < accordions.length; i++) {
    if (accordions[i].classList.contains("is-active")) {
        const submenu = accordions[i].nextElementSibling;
        submenu.style.maxHeight = submenu.scrollHeight + "px";
        submenu.style.marginTop = "0.75em";
        submenu.style.marginBottom = "0.75em";
    }
    accordions[i].onclick = function() {
        this.classList.toggle("is-active");

        const submenu = this.nextElementSibling;

        if (submenu.style.maxHeight) {
            // menu is open
            submenu.style.maxHeight = null;
            submenu.style.marginTop = null;
            submenu.style.marginBottom = null;
        } else {
            submenu.style.maxHeight = submenu.scrollHeight + "px";
            submenu.style.marginTop = "0.75em";
            submenu.style.marginBottom = "0.75em";
        }
    };
}

$("#show").click(function() {
    $(".modal").addClass("is-active");
    console.log("i was clicked");
});

$(".modal-close").click(function() {
    $(".modal").removeClass("is-active");
});

navLinks = document.querySelector(".navNarrow");
narrowLinks = document.querySelector(".narrowLinks");

navLinks.addEventListener("click", toggle);

function toggle() {
    narrowLinks.classList.toggle("hidden");
}

// drag js code
import interact from "interactjs";

interact(".draggable").draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of it's parent
    modifiers: [
        interact.modifiers.restrictRect({
            restriction: "parent",
            endOnly: true
        })
    ],
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: dragMoveListener,
    // call this function on every dragend event
    onend: function(event) {
        var textEl = event.target.querySelector("p");

        textEl &&
            (textEl.textContent =
                "moved a distance of " +
                Math.sqrt(
                    (Math.pow(event.pageX - event.x0, 2) +
                        Math.pow(event.pageY - event.y0, 2)) |
                        0
                ).toFixed(2) +
                "px");
    }
});

function dragMoveListener(event) {
    var target = event.target;
    // keep the dragged position in the data-x/data-y attributes
    var x = (parseFloat(target.getAttribute("data-x")) || 0) + event.dx;
    var y = (parseFloat(target.getAttribute("data-y")) || 0) + event.dy;

    // translate the element
    target.style.webkitTransform = target.style.transform =
        "translate(" + x + "px, " + y + "px)";

    // update the posiion attributes
    target.setAttribute("data-x", x);
    target.setAttribute("data-y", y);
}

// this is used later in the resizing and gesture demos
// window.dragMoveListener = dragMoveListener
