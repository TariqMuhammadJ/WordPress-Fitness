document.addEventListener("DOMContentLoaded", function () {
   
    const popup = document.getElementById("popup");
    const popupClose = document.querySelector(".popup-close");
    const gotIt = document.querySelector(".btn-primary");

    letclicked = getCookie("clicked");
    if(letclicked){
        
    }
    else{
        popup.classList.add("active");
        
    }

    popupClose.addEventListener("click", function() {
        popup.classList.remove("active");
        document.cookie = "clicked=true";

    })

    gotIt.addEventListener("click", function(){
        popup.classList.remove("active");
        document.cookie = "clicked=true";
    })


    const menu = document.querySelector(".material-icons.menu-toggle");
    const main = document.querySelector(".top_main");
    menu.addEventListener("click", function ()  {
    main.classList.add("active");
    if(main.querySelector(".material-icons.menu-close")){
        
    }
    else{
        main.insertAdjacentHTML("afterbegin", '<i class="material-icons menu-close">close</i>');
        create(".material-icons.menu-close");
    }


    
});

function create($class){
    const closebutton = document.querySelector($class);
    closebutton.addEventListener("click", function () {
        main.classList.remove("active");
        closebutton.remove();

    })

}

function getCookie(name) {
  const cookies = document.cookie.split("; ");
  for (let cookie of cookies) {
    const [key, value] = cookie.split("=");
    if (key === name) return value;
  }
  return null;
}


/*main.addEventListener("click", function () {
    main.classList.remove("active");
})*/


})