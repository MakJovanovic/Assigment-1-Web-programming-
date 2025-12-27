
$(document).ready(function() {
    const themeSwitcher = document.getElementById('theme-switcher');
    themeSwitcher.addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
    });
    var app = $.spapp({
        defaultView: "#page4",
        templateDir: "./pages/"
    });
    var currentCSS = null;
    function loadCSS(url) {
        if (currentCSS) {
            document.head.removeChild(currentCSS);
        }
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = url;
        document.head.appendChild(link);
        currentCSS = link;
    }
    
    
    function loadJS(url, callback) {
        const script = document.createElement('script');
        script.src = url;
        script.onload = callback;
        document.body.appendChild(script);
    }

    app.route({
        view: "page1",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/main.css');
            loadJS('./Assets/Js/main.js', function() {
                console.log('test1');
            });
            js_navbar("1");
            console.log("About page ready!");
        }
    });
    app.route({
        view: "page2",
        onReady: function() {
            console.log("test312");
            loadCSS('./Assets/Css/Shop.css');
            loadJS('./Assets/Js/shop.js', function() {
                console.log('test1231');
            });
            js_navbar("2");
            console.log("About page ready!");
            window.shopServiceProducts.init();
        }
    });
    
    app.route({
        view: "page3",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/cart.css');
            loadJS('./Assets/Js/cart.js');
            js_cart();
            js_navbar("3");
            console.log("About page ready!");
            window.cartServiceProducts.init();
        }
    });
    
    app.route({
        view: "page4",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/login.css');
            js_navbar("4");
        }
    });

     app.route({
        view: "page5",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/register.css');
            js_navbar("5")
        }
    });

    app.route({
        view: "page6",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/contact.css');
            loadJS('./Assets/Js/contact.js', function() 
            
            {
                console.log('About JS loaded');
            });
            js_navbar("6");
            contact_form();
        }
    });

      app.route({
        view: "page7",
        onReady: function() {
            console.log("About page created!");
            loadCSS('./Assets/Css/admin.css');
            loadJS('./Assets/Js/admin.js', function() 
            
            {
                console.log('About JS loaded');
            });
            js_navbar("7");
            contact_form(); 
            window.adminServiceProducts.init();
        }
    });
    app.run();
});

const pg=["1","2","3","4","5","6","7"];

function js_navbar(id){

    localStorage.setItem("nav", id);

    let now=document.getElementById(id);

    for(let i=0; i<pg.length; i++){
        if (pg[i]!=id){
        
        let pg_id = document.getElementById(pg[i]);
        pg_id.style.color="";

        pg_id.addEventListener("mouseout", function(){pg_id.style.color="white";});
        pg_id.addEventListener("click", function(){pg_id.style.colorr="orange";});
        pg_id.addEventListener("mouseover", function(){pg_id.style.color="rgb(255, 238, 0)";});
        }
    }
    now.style.color="rgb(255, 238, 0)";
    now.addEventListener("mouseout", function(){now.style.color="rgb(255, 238, 0)";});
    now.addEventListener("click", function(){now.style.color="rgb(255, 238, 0)";});
    now.addEventListener("mouseover", function(){now.style.color="rgb(255, 238, 0)";});
}