let lightmode = localStorage.getItem('lightmode');

function enableLightmode(){
    document.body.classList.add('lightmode');
    localStorage.setItem('lightmode', 'active');
}
function disableLightmode(){
    document.body.classList.remove('lightmode');
    localStorage.setItem('lightmode', null);
}

if(lightmode === "active"){enableLightmode()};

const themeSwitches = document.querySelectorAll('.theme-switch');

themeSwitches.forEach(btn => {
    btn.addEventListener("click", () => {
        lightmode = localStorage.getItem('lightmode');
        lightmode !== "active" ? enableLightmode() : disableLightmode();
    });
});