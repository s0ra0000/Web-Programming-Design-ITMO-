const data = [
	{
		"name": "Astra Glenn",
		"phone": "(831) 408-3751",
		"email": "nullam.scelerisque.neque@protonmail.couk"
	},
	{
		"name": "Melvin Fletcher",
		"phone": "(646) 384-7334",
		"email": "cras.interdum@aol.ca"
	},
	{
		"name": "Noelle Butler",
		"phone": "(878) 230-4564",
		"email": "dignissim.lacus@hotmail.edu"
	},
	{
		"name": "Kirestin Vega",
		"phone": "1-364-930-6583",
		"email": "morbi.sit.amet@aol.org"
	},
    {
		"name": "Raya Everett",
		"phone": "(788) 551-6324",
		"email": "ac.arcu@protonmail.edu"
	},
]

console.log(data[1])
var last_id = 0;
function getRandomNumber(){
    return Math.floor(Math.random()*5);
}

function data_generator(num){
    return data[num]
}
function id_generator(){
    last_id = last_id + 1
    return last_id;
}
function delete_id_checker(id){
  
    return isnum = /^\d+$/.test(id.trim());
}
function get_delete_id(){
    var input = document.querySelector("input").value;
    if(delete_id_checker(input)){
        return input;
    }
    else{
        return null;
    }
}

function enable_buttons(){
    document.getElementById("add_row").disabled = false;
    document.getElementById("delete_row").disabled = false;
}
function create_row(c1,c2,c3,c4,header){
    var row = document.createElement("tr");
    row.setAttribute("id",c1);
    if(header){
        var column_1 = document.createElement("th");
        var column_2 = document.createElement("th");
        var column_3 = document.createElement("th");
        var column_4 = document.createElement("th");
    }else{
        var column_1 = document.createElement("td");
        var column_2 = document.createElement("td");
        var column_3 = document.createElement("td");
        var column_4 = document.createElement("td");
    }
    column_1.appendChild(document.createTextNode(c1));
    column_2.appendChild(document.createTextNode(c2));
    column_3.appendChild(document.createTextNode(c3));
    column_4.appendChild(document.createTextNode(c4));
    row.appendChild(column_1);
    row.appendChild(column_2);
    row.appendChild(column_3);
    row.appendChild(column_4);
    return row;
}
function add_row(){
    const table = document.getElementById("table");
    const person = data_generator(getRandomNumber());
    const id = id_generator();
    const row = create_row(id, person.name, person.phone, person.email, false);
    table.appendChild(row);
}
function delete_row(){
    const id = get_delete_id();
    console.log(id)
    if(id===null){
        alert("no id");
    }else{
        var row = document.getElementById(id);
        try{
            row.remove(id);
        }catch{
            alert("wrong id")
        }
    }
    
}
function table_exists(){
    var table = document.getElementById("table");
    if(table === null){
        return false;
    } else{
        return true;
    }
}

function create_table(){
    if(!table_exists()){
        var table_container = document.getElementById("table-container");
        var table = document.createElement("table");
        table.setAttribute('id','table');
        table.appendChild(create_row("id","name","phone","email",true));
        table_container.append(table);
        enable_buttons();
    } else{
        alert("table is already created")
    }
    
}
document.getElementById("create_table").addEventListener("click",create_table);
document.getElementById("add_row").addEventListener("click",add_row);
document.getElementById("delete_row").addEventListener("click",delete_row);

















