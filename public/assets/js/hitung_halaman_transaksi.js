  var id=1;
  //id ini hanya berpengaruh pada menghapus kontener inputan alias tag P..


  function addMoreInput(){
    var tekape=document.getElementById('tekape');//getElementById ambil form utama sebagai tempat muncul
    
    //KONTENER UNTUK INPUTAN
    var container = document.createElement('div');
    container.className='form-group row';
    container.id='row'+id;
    //#row1..dst
    var containerId='#row'+id;

    //Input-KETERANGAN
    var divKeterangan = document.createElement('div');
    divKeterangan.className="col-lg-5";
    var inputKeterangan = document.createElement('input');
    inputKeterangan.type='text';
    inputKeterangan.placeholder='nama akun';
    inputKeterangan.name='keterangan[]';
    inputKeterangan.className='form-control';
    divKeterangan.appendChild(inputKeterangan);

    
    //Input-NOREF
    var divNoref = document.createElement('div');
    divNoref.className="col-lg-1";
    var inputNoref = document.createElement('input');
    inputNoref.type='text';
    inputNoref.placeholder='Ref';
    inputNoref.name='no_ref[]';
    inputNoref.className='form-control';
    divNoref.appendChild(inputNoref);


    
    //Input-NOMINAL
    var divNominal = document.createElement('div');
    divNominal.className="col-lg-3";
    var inputNominal = document.createElement('input');
    inputNominal.type='text';
    inputNominal.placeholder='masukan nominal';
    inputNominal.name='nominal[]';
    inputNominal.className='form-control nominal';
    divNominal.appendChild(inputNominal);


    //Select-JENIS
    var divJenis = document.createElement('div');
    divJenis.className="col-lg-2";
    var selectJenis = document.createElement('select');
    selectJenis.className='form-control jenis';
    selectJenis.name='jenis[]';
      var debit = document.createElement('option');
      debit.value='Debit';
      debit.innerHTML="Debit";
      var kredit = document.createElement('option');
      kredit.value='Kredit';
      kredit.innerHTML="Kredit";
    selectJenis.appendChild(debit);
    selectJenis.appendChild(kredit);
    divJenis.appendChild(selectJenis);
    

    //BTNHAPUS
    var divHapus = document.createElement('div');
    divHapus.className="col-lg-1";
    var btnHapus = document.createElement('button');
    btnHapus.type='button';
    btnHapus.className='btn btn-danger btn-rounded btn-sm';
    btnHapus.innerHTML='x';
    btnHapus.onclick= function () {
      hapusElemen(containerId);
      return false;
    };
    btnHapus.id='roww'+id;
    divHapus.appendChild(btnHapus);
    
    //Masukan
    container.appendChild(divKeterangan);
    container.appendChild(divNoref);
    container.appendChild(divNominal);
    container.appendChild(divJenis);
    container.appendChild(divHapus);
    tekape.append(container);//jquery


    id = id + 1;


  }
  


  function hapusElemen(containerId) {
   $(containerId).remove();
 } 




 // function cek(){
 //  var nominal=document.getElementsByClassName("nominal");

 //    nominal[0].value;
 // }

 // menambahkan array
 // debit.push(isiaray);

 function cek(){

  var debit = 0;
  var kredit= 0;  
  jenis=document.getElementsByClassName('jenis');
  nominal=document.getElementsByClassName('nominal');

  for (var i = 0; i < jenis.length; i++) {
    if (jenis[i].value=="Debit") {
      debit=parseInt(debit)+parseInt(nominal[i].value);
    } 
    else if (jenis[i].value=="Kredit") {
      kredit=parseInt(kredit)+parseInt(nominal[i].value);  
    }
  }
  // console.log(debit);
  // console.log(kredit);

  if (debit==kredit) {
    // console.log(true);
    // return true;
    document.getElementById('depeForm').submit();
  } else {
    // console.log(false);
    // return false;
    alert("Besar nominal Debit dan Kredit belum sesuai");
    // var alertnya=document.getElementById('tekapeAlert');
  }

}

