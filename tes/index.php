
    <label>nama</label>
    <input type="text" name="nama" id="nama">
    <label>email</label>
    <input type="text" name="email" id="email">
    <button onclick="add();" type="submit">x</button>
<table id="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
    <tr>
        <td>abc</td>
        <td>abc@gmail.com</td>
        <td><button class="remove" onclick="remove(this);">Remove</button></td>
    </tr>
    <tr>
        <td>xyz</td>
        <td>xyz@gmail.com</td>
        <td><button class="remove" onclick="remove(this);">Remove</button></td>
    </tr>    
    <tr>
        <td>xyz</td>
        <td>xyz@gmail.com</td>
        <td><button class="remove" onclick="remove(this);">Remove</button></td>

    </tr>
    <form action="read.php" method="POST">
    <input type="text" id="result" name="result">   
    <button type="submit">Simpan Data</button>
    </form> 
</table>
<button id="show">click here</button>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
// GET value
function add(){
    var table = document.getElementById('table'),
        newRow = table.insertRow(table.length),
        cell1 = newRow.insertCell(0),
        cell2 = newRow.insertCell(1),
        cell3 = newRow.insertCell(2),
        name  = document.getElementById('nama').value,
        email = document.getElementById('email').value;
    let button = document.createElement('button');
    button.type ="submit";
    button.innerHTML ="Remove";
    button.setAttribute('onclick', 'remove(this);')
    cell1.innerHTML = name;
    cell2.innerHTML = email;
    cell3.appendChild(button); 
}
// to JSOn
$('#show').click(function() {
    
    var data = $('table tr:gt(0)').map(function() {
        return {
            name:  $(this.cells[0]).text(),
            email: $(this.cells[1]).text(),
        };
    }).get();
    x = JSON.stringify(data);
    console.log(x);
    $('#result').val(x);
});
function remove(r){
    let i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(i);
}
</script>
