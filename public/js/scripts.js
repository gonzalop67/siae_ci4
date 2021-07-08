$(document).ready(function () {
    var menu = $('ul.nav-sidebar').find('a.active').parents('li.has-treeview');
    menu.addClass('menu-open');
    menu.children('a').addClass('active');
});