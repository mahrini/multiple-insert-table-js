// Untuk pada saat mengisi form akan otomatis menjadi format rupiah 
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

// Mengubah Format angka menjadi rupiah ( bukan pada form )
function rupiah(number)
{
    let reverse = number.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp.' + ribuan;
}

// fungsi ini yang di panggil ketika menekan tombol tambah

function add()
{   
    /* 
        new Row = itu adalah baris dari table
        cell1 = untuk mengetahui ada berapa banyak kolom ada dan 
        yang kita pake
    */
    let table = document.getElementById('table'),
        newRow = table.insertRow(table.length),
        cell1 = newRow.insertCell(0),
        cell2 = newRow.insertCell(1),
        cell3 = newRow.insertCell(2),
        cell4 = newRow.insertCell(3),
        cell5 = newRow.insertCell(4),
        cell6 = newRow.insertCell(5),
        
        // Mengambil Value dari setiap form yan di isi

        barang = $('#barang :selected').text(),
        harga = document.getElementById('harga').value,
        qty = document.getElementById('qty').value;
    
        // Mengambil ID Barang utk di POST ke Database
    idBrg = document.getElementById('barang').value;

    // Membuat button baru yaitu button remove pada saat menambahkan record baru
    let button = document.createElement('button');
    button.type="Submit";
    button.innerHTML = "[-]Remove";
    // Ini Merupakan Atribut2 dari button tersebut
    button.setAttribute('onclick', "return confirm('Ya?')?remove(this):'';"); // disini kita memanggil fungsi remove yang ada dibawah
    button.setAttribute('class', 'btn btn-danger');
    button.setAttribute('id', 'hapus');
    
    // mengambil banyak nya row yang ada di dalam table 
    // Untuk dijadikan sebagia nomer urut
    let nomor = table.getElementsByTagName("tr").length;
    cell1.innerHTML = nomor-1;
    cell2.innerHTML = barang;
    cell3.innerHTML = qty;
    cell4.innerHTML = harga;
    harga = harga.replace(/\D/g, ''); //Hanya Mengambil Angkanya saja
    
    // convert string to int 

    total = qty * parseInt(harga); //lalu di conver ke interger karena data yang td masih berupa string
    cell5.innerHTML = rupiah(total) ;
    cell6.appendChild(button);
    // Subtotal untuk mendapatkan sub total
    // Mengambil column ke 5 beserta isi2 nya lalu di tampung menjadi satu
    subTotal = $('#table td:nth-child(5)').map(function(){
        st = $(this).text();
        st = st.replace(/\D/g, '');
        return parseInt(st);
    }).get();
    // Lalu hasil dari yan di tampung tadi di jumlahkan
    hasil = (a,b) => a+b;
    jumlah = subTotal.reduce(hasil);
    // Reset value ketika tambah barang baru
    $('#harga').val('');
    $('#qty').val('');
    // Mengisi value dari subTotal
    $('#subtotal').val(rupiah(jumlah));
}
/* 
    Ketika tombol save di click
    maka kita akan mengambil nilai dari
    table dari baris pertama,yang kita ambil hanya
    idBarang,qty,dan harga
    lalu semua itu dijadikan format json. 
*/
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
    document.getElementById('text').value = r; // data json tadi di passing ke form hidden yang ada di tampilan
});
function remove(r)
{   
    // Sama seperti diatas ini merupakan perhitungan
    // cmn ini perhitungan ketika tombol remove di tekan

    let i = r.parentNode.parentNode.rowIndex;
    document.getElementById('table').deleteRow(i);
    subTotal = $('#table td:nth-child(5)').map(function(){
        st = $(this).text();
        st = st.replace(/\D/g, '');
        return parseInt(st);
    }).get();

    // Get Subtotal
    let no = document.getElementById('table').getElementsByTagName('tr').length;
    // Menghitung baris dari table
    // Ketika barisnya kurang dari 2
    // karena 1 bari itu adalah header nya
    // maka set subtotal nya menjadi RP.0
    if(no < 2) {
        $('#subtotal').val("Rp.0");    
    }
    // untuk mengabaikan error yan ada
    // karena disini terdapat TypeError
    // Jadi diabaikan dengan menggunakan try & catch
    try {
        hasil = (a,b) => a+b;
        jumlah = subTotal.reduce(hasil);
        $('#subtotal').val(rupiah(jumlah));
    } catch(e) {
                
    }
    // Reset
    
}