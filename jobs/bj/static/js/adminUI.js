// 'use strict';

window.Admin = {}

Admin.init = function(){
    var comment_txt = document.getElementsByClassName('post-description');

    for (var i = 0; i < comment_txt.length; i++) {
        comment_txt[i].onclick = function(){
            Admin.renderTemplate(this);
        }
    }


}

Admin.renderTemplate = function(elem){
    if(elem.show)
        return false;

    var admin_box = document.createElement('div');
    admin_box.className = 'admin_box';

    var ta = document.createElement('textarea');
    ta.className = 'admin change_comment';
    ta.innerHTML = toMarkdown(elem.innerHTML.trim());
    admin_box.appendChild(ta);

    var sv = document.createElement('button');
    sv.className = 'admin save_changes';
    sv.innerHTML = 'Сохранить изменения';
    sv.addEventListener(
        'click',
        () => {
            var id = elem.parentNode.parentNode.dataset.id
            Admin.sendData(id, ta.value);
        },
        false
    );
    admin_box.appendChild(sv);

    elem.innerHTML = '';
    elem.show = 1;
    elem.appendChild(admin_box);
}

Admin.Query = function(url, data, callback){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == XMLHttpRequest.DONE) { // 200 | 4
            callback(xhr.responseText);
        }
    }
    xhr.send(JSON.stringify(data));
}

Admin.sendData = function(id, txt) {
    if(txt.length <= 3) {
        alert('> 3');
        return false;
    }
    var data = {
        cmd: 'update',
        id: id,
        txt: txt
    }

    if(this.validData(data)) {
        Admin.Query('/AdminAjax', data, function(res){
            try {
                var result = JSON.parse(res);
                console.log(result)
                if(!result.status) alert(result.info);
                else window.location.reload();
            }catch(e){
                console.log(e);
                alert('khhmmm...');
            }
        })
    } else {
        alert('ERROR: Data valid!');
    }

}

Admin.validData = function(data){
    var flag = 1;
    var patterns = {
        id: /^\d+$/,
        txt: /.*/
    }
    for(var key in patterns) {
        if(!patterns[key].test(data[key])) flag = 0;
    }
    return flag;
}

Admin.acceptReview = function(e){
    var wrap = e.parentNode;

    var data = {
        cmd: 'acceptReview',
        rid: wrap.dataset.id
    }
    Admin.Query('/AdminAjax', data, function(res){
        try {
            var result = JSON.parse(res);
            console.log(result)
            if(!result.status) alert(result.info);
            else wrap.style.display = 'none';
        }catch(e){
            console.log(e);
            alert('khhmmm...');
        }
    });

}
