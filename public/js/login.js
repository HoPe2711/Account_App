function closePopUp(){
    let pop_up = document.getElementById("login-pop-up");
    pop_up.style.display = "none";
}


window.addEventListener("click", (mouse_event) => {
    let pop_up = document.getElementById("login-pop-up");

    if (mouse_event.target === pop_up){
        pop_up.style.display = "none";
    }
});