document.addEventListener('DOMContentLoaded',function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobilemenu = document.querySelector('.mobile-menu');

    mobilemenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }

    
    
    // navegacion.classList.toggle('mostrar'); Este codigo es lo mismo pero mas corto
}

function darkMode(){
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);
    
    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-Mode');
    } else {
        document.body.classList.remove('dark-Mode');
    }

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-Mode');
        } else {
            document.body.classList.remove('dark-Mode');
        }  
    })


    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-Mode');
    })
}