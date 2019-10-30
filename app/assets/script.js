function remove(r)
{
    let i = r.parentNode.parentNode.rowIndex;
    document.getElementById('table').deleteRow(i);
}
$('#hapus').click(function() {
    return confirm("Yakin ?");
})

// Rupiah

var rp = document.getElementById('harga');
		rp.addEventListener('keyup', function(e){

            rp.value = formatRupiah(this.value, 'Rp. ');
		}); 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rp     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			if(ribuan){
				separator = sisa ? '.' : '';
				rp += separator + ribuan.join('.');
			}
 
			rp = split[1] != undefined ? rp + ',' + split[1] : rp;
			return prefix == undefined ? rp : (rp ? 'Rp. ' + rp : '');
		}
function rupiah(number)
{
    let reverse = number.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp.' + ribuan;
}
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
    button.setAttribute('onclick', "return confirm('Ya?')?remove(this):'';");
    button.setAttribute('class', 'btn btn-danger');
    button.setAttribute('id', 'hapus');
    
    let nomor = document.getElementById('table').getElementsByTagName("tr").length;
    cell1.innerHTML = nomor-1;
    cell2.innerHTML = barang;
    cell3.innerHTML = qty;
    cell4.innerHTML = harga;
    harga = harga.replace(/\D/g, '');
    
    // convert string to int 

    total = qty * parseInt(harga);
    cell5.innerHTML = rupiah(total) ;
    cell6.appendChild(button);
    // Subtotal
    subTotal = $('#table td:nth-child(5)').map(function(){
        st = $(this).text();
        st = st.replace(/\D/g, '');
        return parseInt(st);
    }).get();
    // Get Subtotal
    hasil = (a,b) => a+b;
    jumlah = subTotal.reduce(hasil);
    // Reset
    $('#harga').val('');
    $('#qty').val('');
    
    $('#subtotal').val(rupiah(jumlah));
}
$('#save').click(function() {
    let data = $('table tr:gt(0)').map(function() {
        // Harga / Brg
        let harga = $(this.cells[3]).text();
        harga = harga.replace(/\D/g, '');
        hargaBrg = parseInt(harga);
        
        return {
            idBarang:idBrg,
            qty:$(this.cells[2]).text(),
            harga:hargaBrg,
        };
    }).get();
    r = JSON.stringify(data);
    document.getElementById('text').value = r;
});