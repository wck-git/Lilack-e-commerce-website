let myButtonContainer = document.getElementById("backToTopContainer");

window.addEventListener("scroll", function(){
    if (document.body.scrollTop > 100) {
        myButtonContainer.style.display = "flex";
        myButtonContainer.style.flexDirection = "column";
        myButtonContainer.style.justifyContent = "center";
        myButtonContainer.style.alignItems = "center";
        } 
    else {
        myButtonContainer.style.display = "none";
    }
})

function backToTopFunction() {
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0; 
}