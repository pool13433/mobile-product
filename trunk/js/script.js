/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    // http://wenzhixin.net.cn/p/bootstrap-table/docs/index.html
    $('.dataTable').bootstrapTable({
        /*method: 'get',
         url: 'data2.json',
         cache: false,
         height: 400,*/
        striped: true,
        pagination: true,
        pageSize: 10,
        pageList: [10, 25, 50, 100, 200],
        search: true,
        showColumns: true,
        showRefresh: true,
        minimumCountColumns: 2,
        clickToSelect: true,
        // extension export 
        /*showExport : true, 
         exportTypes : ['json', 'xml', 'csv', 'txt', 'sql', 'excel'],
         showFilter : true,
         flat : true,*/
    });
    // ########### datepicker ##########
    var today = new Date();
    var current = today.toLocaleFormat('DD/MM/YYYY');
    // set current date
    var datepicker = $('#datetext').datepicker("setDate", current);
    datepicker.datepicker({
        autoclose: true,
        format: "dd/mm/yyyy",
    });
    datepicker.off('focus');
    $('#datebtn').click(function() {
        datepicker.datepicker('show');
    });
    // ########### datepicker ##########
});
function notify(type, msg, delay) {
    /* var messages = [
     ['bottom-right', 'info', 'Gah this is awesome.'],
     ['top-right', 'success', 'I love Nijiko, he is my creator.'],
     ['bottom-left', 'warning', 'Soda is bad.'],
     ['top-right', 'danger', "I'm sorry dave, I'm afraid I can't let you do that."],
     ['bottom-right', 'info', "There are only three rules."],
     ['top-right', 'inverse', 'Do you hear me now?'],
     ['bottom-left', 'blackgloss', 'You should fork this!']
     ];*/
    $('.top-left').notify({
        message: {text: msg}
    }).show();
}
function showNotification(nType, nTitle, nText, nDelay) {
    /*
     * https://github.com/sciactive/pnotify
     * 
     * Configuration Defaults / Options
     title: false - The notice's title.
     title_escape: false - Whether to escape the content of the title. (Not allow HTML.)
     text: false - The notice's text.
     text_escape: false - Whether to escape the content of the text. (Not allow HTML.)
     styling: "bootstrap3" - What styling classes to use. (Can be either jqueryui, bootstrap2, bootstrap3, fontawesome, or a custom style object. See the source for the properties in a style object.)
     addclass: "" - Additional classes to be added to the notice. (For custom styling.)
     cornerclass: "" - Class to be added to the notice for corner styling.
     auto_display: true - Display the notice when it is created. Turn this off to add notifications to the history without displaying them.
     width: "300px" - Width of the notice.
     min_height: "16px" - Minimum height of the notice. It will expand to fit content.
     type: "notice" - Type of the notice. "notice", "info", "success", or "error".
     icon: true - Set icon to true to use the default icon for the selected style/type, false for no icon, or a string for your own icon class.
     animation: "fade" - The animation to use when displaying and hiding the notice. "none", "show", "fade", and "slide" are built in to jQuery. Others require jQuery UI. Use an object with effect_in and effect_out to use different effects.
     animate_speed: "slow" - Speed at which the notice animates in and out. "slow", "def" or "normal", "fast" or number of milliseconds.
     position_animate_speed: 500 - Specify a specific duration of position animation.
     opacity: 1 - Opacity of the notice.
     shadow: true - Display a drop shadow.
     hide: true - After a delay, remove the notice.
     delay: 8000 - Delay in milliseconds before the notice is removed.
     mouse_reset: true - Reset the hide timer if the mouse moves over the notice.
     remove: true - Remove the notice's elements from the DOM after it is removed.
     insert_brs: true - Change new lines to br tags.
     stack: {"dir1": "down", "dir2": "left", "push": "bottom", "spacing1": 25, "spacing2": 25, context: $("body")} - The stack on which the notices will be placed. Also controls the direction the notices stack.
     */
    var opts = {
        styling: "bootstrap3",
        delay: 1000 * nDelay,
        history: true,
        type: nType,
        title: nTitle,
        text: nText,
        shadow: true,
        icon: 'glyphicon glyphicon-bell', //'<i class="glyphicon glyphicon-trash"></i>',
        animation: 'slide',
        animate_speed: 'fast',
        addclass: "stack-topright",
        desktop: {
            //desktop: true
        },
        nonblock: {
            //nonblock: true,
            //nonblock_opacity: .2,
        },
        buttons: {
            closer: true, //- Provide a button for the user to manually close the notice.
            closer_hover: true, //- Only show the closer button on hover.
            sticker: true, //- Provide a button for the user to manually stick the notice.
            sticker_hover: true, //- Only show the sticker button on hover.
            labels: {close: "Close", stick: "Stick"}, //- Lets you change the displayed text, facilitating internationalization.
        },
        confirm: {
            confirm: false,
        }
    };
    new PNotify(opts);
}
function redirectDelay(url, timer) {
    setTimeout(function() {
        window.location.href = url; //will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function reloadDelay(timer) {
    setTimeout(function() {
        window.location.reload();//will redirect to your blog page (an ex: blog.html)
    }, (timer * 1000)); //will call the function after 2 secs.
}
function goUrl(url) {
    window.location.href = url; //will redirect to your blog page (an ex: blog.html)
}
function print_properties_in_object(object) {
    var output = '';
    for (var property in object) {
        output += property + ': ' + object[property] + '; ';
    }
    return output;
}
function login() {
    var username = $('#input-username').val();
    var password = $('#input-password').val();
    $.ajax({
        url: './action/person.php?method=login',
        data: {
            username: username,
            password: password
        },
        type: 'post',
        dataType: 'json',
        success: function(data) {
            if (data.status == 'success') {
                var cookie = $('#cookie').val();
                setCookie('username', username, 365);
                setCookie('password', password, 365);

                showNotification('success', data.title, data.msg, 3);
                redirectDelay(data.url, 2);
            } else {
                showNotification('danger', data.title, data.msg, 3);
            }
        }
    });
}
function logout() {
    var conf = confirm('ยืนยันการออกจากระบบ ใช่ [OK] || ไม่ใช่ [Cancle]');
    if (conf) {
        $.post('../action/person.php?method=logout', {}, function() {
            redirectDelay('../index.php', 1);
        });
        return true;
    }
    return false;
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
        user = prompt("Please enter your name:", "");
        if (user != "" && user != null) {
            setCookie("username", user, 365);
        }
    }
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}
function post_form(formid, url) {
    $.ajax({
        url: url,
        data: $('#' + formid).serialize(),
        type: 'post',
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
            showNotification(data.status, data.title, data.msg, 2);
            if (data.status == 'success') {
                redirectDelay(data.url, 2);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('jqXHR : ' + jqXHR + ' \ntextStatus : ' + textStatus + ' \nerrorThrown : ' + errorThrown);
        }
    });
}
function delete_data(id, url) {
    var conf = confirm('ยืนยันการลบข้อมูล รหัส ' + id + 'ใช่[OK] || ไม่ใช่[CANCLE]');
    if (conf) {
        $.ajax({
            url: url,
            data: {id: id},
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.status == 'success') {
                    showNotification('success', data.title, data.msg, 3);
                    reloadDelay(2);
                } else {
                    showNotification('danger', data.title, data.msg, 3);
                }
            }
        });
        return true;
    }
    return false;
}


