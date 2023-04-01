console.log("wtf");

function create(){
    let data_text = document.getElementById("name");
    let data_deadline = document.getElementById("deadline");
    let data_color = document.getElementById("color");
    const data = {
        text : data_text,
        deadline : data_deadline,
        color : data_color
    };
    let xhr = new XMLHttpRequest();
    xhr.open("POST","create.php",true);
    xhr.setRequestHeader("Content-type","application/json;charset=UTF-8\"");
    // xmlhttp.onreadystatechange = function(){
    //     if(this.readyState === 4 ||this.status===200){
    //         console.log(this.responseText);
    //     }
    // };
    xhr.send(data);
}
function read(){
    console.log("come on")
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        let row;
        if (this.readyState == 4 && this.status == 200) {
            let data = JSON.parse(xhr.response);
            let tbody = document.getElementById("tbody");
            for (let i = 0; i < data.length; i++) {
                row = tbody.appendChild(document.createElement("tr"));
                let id = row.appendChild(document.createElement("td"));


                newRow = '<tr>';
                newRow += '<td>' + data[i].id + '</td>';
                newRow += '<td>' + data[i].text + '</td>';
                newRow += '<td>' + data[i].deadline + '</td>';
                newRow += '</tr>';
                tbody.append(newRow)
            }

            tbody.append(newRow)
            console.log(newRow);
        }
    };
    xhr.open("POST","list.php",true);
    xhr.send(JSON.stringify({}));
}

function read_list(){

}
