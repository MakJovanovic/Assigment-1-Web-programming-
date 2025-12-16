var NavbarService = {

    init: function() {
        this.updateNavbar();
    },

    updateNavbar: function() {
        var token = localStorage.getItem("user_token");
        var role = null;
        
        if (token) {
            var payload = Utils.parseJwt(token);
            if (payload && payload.user) {
                role = payload.user.role;
            }
        }

        var html = '';
        html += '<li class="nav-item"><a href="#page1" class="nav-link" id="1">Home</a></li>';
        
        if (!token) {
            html += '<li class="nav-item"><a href="#page4" class="nav-link" id="4">Login</a></li>';
            html += '<li class="nav-item"><a href="#page5" class="nav-link" id="5">Register</a></li>';
        }

        html += '<li class="nav-item"><a href="#page2" class="nav-link" id="2">Shop</a></li>';
        html += '<li class="nav-item"><a href="#page3" class="nav-link" id="3">Cart</a></li>';
        html += '<li class="nav-item"><a href="#page6" class="nav-link" id="6">Contact Us</a></li>';

        if (role === 'admin') {
            html += '<li class="nav-item"><a href="#page7" class="nav-link" id="7">Admin</a></li>';
        }

        if (role === 'user') {
            html += '<li class="nav-item"><a href="#user" class="nav-link">My Profile</a></li>';
        }

        if (token) {
            html += '<li class="nav-item"><button class="nav-btn" onclick="UserService.logout()" style="background:none; border:none; color:white; font-size:1.2rem; font-weight:bold; text-transform:uppercase; cursor:pointer; padding:12px 20px; font-family:inherit;">LOGOUT</button></li>';
        }

        $('.navbar-nav').html(html);
        
      
        if (typeof js_navbar === 'function') {
            var currentNav = localStorage.getItem("nav");
            if (currentNav) {
                js_navbar(currentNav);
            }
        }
    },
    
    refreshOnLogin: function() {
        this.updateNavbar();
    },
    
    refreshOnLogout: function() {
        this.updateNavbar();
    }
};

window.NavbarService = NavbarService;

$(document).ready(function() {
    NavbarService.init();
});