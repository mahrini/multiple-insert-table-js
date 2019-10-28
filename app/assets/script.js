function add()
{   
    let table = document.getElementById('table'),
        newRow = table.insertRow(table.length),
        cell1 = newRow.insertCell(0),
        cell2 = newRow.insertCell(1),
        cell3 = newRow.insertCell(2),
        cell4 = newRow.insertCell(3),
        cell5 = newRow.insertCell(4),
        cell6 = newRow.insertCell(5),
        barang = $('#barang :selected').text(),
        harga = document.getElementById('harga').value,
        qty = document.getElementById('qty').value;
    
    idBrg = document.getElementById('barang').value;


    let button = document.createElement('button');
    button.type="Submit";
    button.innerHTML = "[-]Remove";
    button.setAttribute('onclick', 'remove(this)');
    button.setAttribute('class', 'btn btn-danger');
    
    let nomor = document.getElementById('table').getElementsByTagName("tr").length;
    
    total = qty * harga;
    cell1.innerHTML = nomor-1;
    cell2.innerHTML = barang;
    cell3.innerHTML = qty;
    cell4.innerHTML = harga;
    cell5.innerHTML = total;
    cell6.appendChild(button);
    // Subtotal
    let subTotal = $('#table td:nth-child(5)').map(function(){
        return parseInt($(this).text());
    }).get();
    // Get Subtotal
    let hasil = (a,b) => a+b;
    let jumlah = subTotal.reduce(hasil);
    // Reset
    $('#harga').val('');
    $('#qty').val('');
    $('#subtotal').val(jumlah);
}
$('#save').click(function() {
    let data = $('table tr:gt(0)').map(function() {
        return {
            idBarang:idBrg,
            qty:$(this.cells[2]).text(),
            harga:$(this.cells[3]).text(),
        };
    }).get();
    r = JSON.stringify(data);
    document.getElementById('text').value = r;
});

function remove(r)
{
    let i = r.parentNode.parentNode.rowIndex;
    document.getElementById('table').deleteRow(i);
}