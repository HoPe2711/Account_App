function clear(selector){
    let divItems = document.querySelectorAll(selector);

    for (let i = 0; i < divItems.length; i++){
        let other_item = divItems[i];
        other_item.classList.remove('item-select');
        other_item.classList.add('unselect');
    }
}


function selectItem(item){
    clear('#menu-left .item .func');
    item.childNodes[3].classList.remove('unselect');
    item.childNodes[3].classList.add('item-select');
}


function selectFunc(item){
    clear("#menu-right .block .func");

    if (item.id === 'change-password'){
        openPopUp('password-pop-up');
    }

    item.classList.remove('unselect');
    item.classList.add('item-select');
}


function openPopUp(id){
    let pop_up = document.getElementById(id);
    pop_up.style.display = "block";
}


function closePopUp(id){
    let pop_up = document.getElementById(id);
    pop_up.style.display = "none";
}


function closeClickOutside(mouse_event, id){
    let pop_up = document.getElementById(id);

    if (mouse_event.target === pop_up){
        pop_up.style.display = "none";
    }
}


window.addEventListener("click", (mouse_event) => {
    closeClickOutside(mouse_event, "profile-pop-up");
    closeClickOutside(mouse_event, "password-pop-up");
});


function setAvatar(){
    let input_image = document.getElementById('avatar-image');
    input_image.click();
    input_image.addEventListener('change', () => {
        document.getElementById('profile-avatar-form').submit();
    });
}


function changePassword(){
    event.preventDefault();
    let current_password = document.getElementsByName("current_password")[0].value;
    let new_password = document.getElementsByName("new_password")[0].value;
    let retype_new_password = document.getElementsByName("retype_new_password")[0].value;
    let force_logout = document.getElementsByName('force_logout')[0].value;

    $.ajax({
        url: "/profile/change-password",
        type: "POST",
        data: {
            current_password: current_password,
            new_password: new_password,
            retype_new_password: retype_new_password,
            force_logout: force_logout
        },
        cache:false,
        success: (messege) => {
            if (messege === 'login'){
                window.location.replace('/login');
            }

            if (messege === 'profile'){
                window.location.replace('/profile');
            }

            document.getElementById('notify-error').textContent = messege;
            document.getElementById('notify-error').style.display = 'block';
            document.getElementById('password-pop-up-container').style.height = '480px';
        }
    });
}

