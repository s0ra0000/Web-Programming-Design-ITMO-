console.log("wtf");
let xhr = new XMLHttpRequest();
function create(){
    let data_text = document.getElementById("text").value;
    let data_deadline = document.getElementById("deadline").value;
    let data_color = document.getElementById("color").value;
    const data = {
        text : data_text,
        deadline : data_deadline,
        color : data_color
    };
    console.log(data);
    xhr.open('POST','create.php',true);
    xhr.onload  = function() {
        if (this.readyState === 4 && this.status === 200) {
            let id = this.responseText;
            window.location.href = 'index.html?id='+id ;
        }
    }
    xhr.send(JSON.stringify(data));
}

function read(){
    xhr.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.responseText);
            write_table(data);
        }
    };
    xhr.open("POST","list.php",true);
    xhr.send(JSON.stringify({}));
}

function update(){
    let data_text = document.getElementById("text").value;
    let data_deadline = document.getElementById("deadline").value;
    let data_color = document.getElementById("color").value;
    let data_id = document.getElementById("id").value;
    const data = {
        id : data_id,
        text : data_text,
        deadline : data_deadline,
        color : data_color
    };
    console.log(data);
    xhr.open('POST','update.php',true);
    xhr.onload  = function() {
        if (this.readyState === 4 && this.status === 200) {
            let id = this.responseText;
            window.location.href = 'index.html?id='+id ;
        }
    }
    xhr.send(JSON.stringify(data));
}

function delete_list(){
    let url = window.location.href;
    let data = parseURLParams(url);
    let data_id = data['id'][0];
    const json = {
        id: data_id
    }
    xhr.open('POST','delete.php',true);
    xhr.onload = function(){
        if(this.readyState === 4 && this.status === 200){
            window.location.href = 'list.html';
        }
    }
    xhr.send(JSON.stringify(json));
    window.location.href = 'list.html';
}
function back_link(){
    let url = window.location.href;
    let data = parseURLParams(url);
    let data_id = data['id'][0];
    let link = document.getElementById('dlt-btn');
    link.href = 'index.html?id='+data_id;
}

function write_table(data){
    let tbody = document.getElementById("tbody");
    for (let i = 0; i < data.length; i++) {
        let row = tbody.appendChild(document.createElement("tr"));
        let id_column = row.appendChild(document.createElement("td"));
        let text_column = row.appendChild(document.createElement("td"));
        let deadline_column = row.appendChild(document.createElement("td"));
        let update_row = row.appendChild(document.createElement("td"));
        let delete_row = row.appendChild(document.createElement("td"));
        let link_text = text_column.appendChild(document.createElement("a"))
        let text = link_text.appendChild(document.createElement("p"));
        let link_update = update_row.appendChild(document.createElement("a"));
        let link_delete = delete_row.appendChild(document.createElement("a"));
        let update_btn = link_update.appendChild(document.createElement("button"));
        let delete_btn = link_delete.appendChild(document.createElement("button"));
        update_btn.innerText = 'update';
        delete_btn.innerText = 'delete';
        update_btn.classList.add("update-btn");
        delete_btn.classList.add("delete-btn");
        text.innerText = data[i].text;
        link_text.href = 'index.html?id='+data[i].id;
        link_update.href = 'update.html?id='+data[i].id;
        link_delete.href = 'delete.html?id='+data[i].id;
        id_column.innerText = data[i].id;
        deadline_column.innerText = data[i].deadline;
        row.setAttribute("style",'border-color:'+data[i].color);

    }
}
function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}
function update_list(){
    back_link();
    let url = window.location.href;
    let data = parseURLParams(url);
    let id = data['id'][0];
    let get_url = 'update.php?id='+id;
    xhr.open('GET',get_url,true);
    xhr.onload = function(){
        if(this.readyState === 4 && this.status === 200){
            let data = JSON.parse(this.responseText)
            let text = document.getElementById('text');
            let deadline = document.getElementById('deadline');
            let color = document.getElementById('color');
            let hidden_id = document.getElementById('id');
            hidden_id.value = id;
            text.value = data['text'];
            deadline.value = data['deadline'];
            color.value = data['color'];

            // text.innerText=data['text'];
            // deadline.innerText=data['deadline'];
            console.log(data);
        }
    }
    xhr.send(JSON.stringify({}));
}

function read_list(){
    let url = window.location.href;
    let data = parseURLParams(url);
    let id = null;
    let content = document.getElementById("content");
    console.log(data);
    if(data !== undefined){
        id = data['id'][0];
        let get_url = 'index.php?id='+id;
        xhr.open('GET',get_url,true);
        xhr.onload = function(){
            if(this.readyState === 4 && this.status === 200){
                let data = JSON.parse(this.responseText)
                let text = document.getElementById('text');
                let deadline = document.getElementById('deadline');
                let link_update = document.createElement('a');
                let link_delete = document.createElement('a');
                let update_btn = document.createElement('button');
                let delete_btn = document.createElement('button');
                console.log("aa"+text)
                update_btn.classList.add('update-btn');
                delete_btn.classList.add('delete-btn');
                link_update.href = 'update.html?id='+id;
                link_delete.href = 'delete.html?id='+id;
                update_btn.innerText = 'update';
                delete_btn.innerText = 'delete';
                link_update.appendChild(update_btn);
                link_delete.appendChild(delete_btn);
                content.appendChild(link_update);
                content.appendChild(link_delete);
                text.innerText=data['text'];
                deadline.innerText=data['deadline'];
                content.setAttribute("style","border:4px dotted "+data['color']);
                console.log(data);
            }
        }
        xhr.send(JSON.stringify({}));
    }
    if(id === null){
        content.remove();
    }
    console.log(id);
}
