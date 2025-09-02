document.addEventListener("DOMContentLoaded", function () {
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

/*main.addEventListener("click", function () {
    main.classList.remove("active");
})*/


})