(function() {
  
  var Menu = (function() {
    var burger = document.querySelector('.burger');
    var menu = document.querySelector('.menu');
    var menuList = document.querySelector('.menulist');
    var brand = document.querySelector('.menubrand');
    var menuItems = document.querySelectorAll('.menuitem');
    
    var active = false;
    
    var toggleMenu = function() {
      if (!active) {
        menu.classList.add('menu--active');
        menuList.classList.add('menulist--active');
        brand.classList.add('menubrand--active');
        burger.classList.add('burger--close');
        for (var i = 0, ii = menuItems.length; i < ii; i++) {
          menuItems[i].classList.add('menuitem--active');
        }
        
        active = true;
      } else {
        menu.classList.remove('menu--active');
        menuList.classList.remove('menulist--active');
        brand.classList.remove('menubrand--active');
        burger.classList.remove('burger--close');
        for (var i = 0, ii = menuItems.length; i < ii; i++) {
          menuItems[i].classList.remove('menuitem--active');
        }
        
        active = false;
      }
    };
    
    var bindActions = function() {
      burger.addEventListener('click', toggleMenu, false);
    };
    
    var init = function() {
      bindActions();
    };
    
    return {
      init: init
    };
    
  }());
  
  Menu.init();
  
}());



var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
var type = connection.type;

function updateConnectionStatus() {
  console.log("Connection type is change from " + type + " to " + connection.type);
}

connection.addEventListener('typechange', updateConnectionStatus);