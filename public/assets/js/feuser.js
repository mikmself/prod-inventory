// Select 2
$("#selectuser").select2({width:'100%'});
$("#selectruang").select2({width:'100%'});
$("#selectbarang").select2({width:'100%'});

// tambah barang fisik
let barangfisik = document.querySelectorAll(".itembarang");
function refreshbarang(){
    barangfisik = document.querySelectorAll(".itembarang");
    let formtambah = document.getElementById("formtambah");
    let itemterpilih = document.getElementById("itemterpilih");
    barangfisik.forEach(el => {
        el.addEventListener("click",(e)=>{
            el.style.display = "none";
            let id = el.id;
            let input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("value", id);
            input.setAttribute("name", "id_barang_fisik[]");
            input.setAttribute("id", "input"+id);
            formtambah.prepend(input);
            let div = document.createElement("div");
            div.className = "item";
            div.setAttribute("id","div"+id);
            let p = document.createElement("p");
            p.textContent = el.textContent;
            let span = document.createElement("span");
            span.className = "closebarang";
            span.setAttribute("id","span"+id);
            let img = document.createElement("img");
            img.setAttribute("src","/assets/icons/close.png");
            span.appendChild(img);
            div.appendChild(p);
            div.appendChild(span);
            div.style.border = "1px solid #0087FE";
            itemterpilih.prepend(div);
            refresh();
        })
    });
    let closebarang = document.querySelectorAll(".closebarang");
    function refresh(){
        closebarang = document.querySelectorAll(".closebarang");
        closebarang.forEach(el => {
            el.addEventListener("click",() => {
                let lastidspan = el.id;
                idspan = lastidspan.replace('span', '');
                let idiv = "div"+idspan;
                let divterpilih = document.getElementById(idiv);
                try {
                    divterpilih.remove();
                } catch (error) {

                }
                let listbarang = document.getElementById(idspan);
                listbarang.style.display = "block";
                let idinput = "input"+idspan;
                let inputbarang = document.getElementById(idinput);
                try {
                    inputbarang.remove();
                } catch (error) {

                }
            })
        });
    }
}

try {
    // Select 2 barang on change
    let formplus = document.getElementById("formtambah");
    $("#selectbarang").on("change",function(e){
        let inputidbarang = document.getElementById("inputidbarang");
        if(inputidbarang != undefined){
            inputidbarang.remove();
        }
        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "id_barang");
        input.setAttribute("id", "inputidbarang");
        input.setAttribute("value", this.value);
        try {
            formplus.prepend(input);
        } catch (error) {
            console.log("form tidak ditemukan")
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url : '/operasi/getspesifikbarangfisik',
            data : 'idbarang='+this.value,
            success : function(response){
                $('#itemsbarangfisik').html(response);
                refreshbarang()
            }
        })
    });
} catch (error) {
    console.log("select barang tidak diperlukan");
}


$.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type : 'GET',
    url : 'http://bpinvservice.bakaranproject.com/user/nonauth/indexbarang',
    data : [],
    success : function(response){
        let datamentah = response.data;
        let data = datamentah.filter( element => element.id_kategori == 2)
        data.forEach(element => {
            // create element
            let div = document.createElement('div');
            div.classList = "item";
            if(element.stok < 1){
                div.classList.add('disabled-item');
            }
            div.id = `bhp${element.id}`;

            let img = document.createElement('img');
            img.src = "/assets/icons/itembarang.png";
            img.classList = "img";

            let divkanan = document.createElement('div');
            divkanan.classList = "kanan";

            let pnama = document.createElement('p');
            pnama.classList = "nama";
            pnama.textContent = `${element.nama}`;

            let pdesc = document.createElement('p');
            pdesc.classList = "desc";
            pdesc.textContent = " Tersisa"

            let span = document.createElement('span');
            span.classList = "sisa";
            span.textContent = `${element.stok}`;

            // append
            pdesc.prepend(span);
            divkanan.appendChild(pnama);
            divkanan.appendChild(pdesc);
            div.appendChild(img);
            div.appendChild(divkanan);

            let divdata = document.getElementById('databarang');
            try {
                divdata.appendChild(div)
            } catch (error) {
                
            }
        });

        // Live search
        let searchbarang = document.getElementById('searchbarang');
        try {
            searchbarang.addEventListener('keyup',(e)=>{
                let input, filter, divitem, p, txtValue;
                input = document.getElementById('searchbarang');
                filter = input.value.toUpperCase();
                divitem = document.querySelectorAll(".habispakai .item");
                for (let i = 0; i < divitem.length; i++) {
                    p = divitem[i].getElementsByClassName('nama')[0];
                    txtValue = p.innerText;
                    if(txtValue.toUpperCase().indexOf(filter) > -1){
                        divitem[i].style.display = "";
                    }else{
                        divitem[i].style.display = "none";
                    }
                }
            });
        } catch (error) {
            
        }

        // Tambah barang habis pakai
        let habispakai = document.querySelectorAll(".habispakai .item");
        let bhpterpilih = document.getElementById("bhpterpilih");
        let formtambahbhp = document.getElementById("formtambahbhp");
        let dataangka = 1;
        habispakai.forEach(el => {
            let idhp = el.id;
            let idbarang = idhp.replace('bhp', '');
            let nama = document.querySelector(`#${el.id} .kanan .nama`).textContent;
            let desc = document.querySelector(`#${el.id} .kanan .desc`).textContent;
            let sisa = document.querySelector(`#${el.id} .kanan .desc .sisa`).textContent;
            el.addEventListener("click",()=>{
                if(sisa < 1){

                }else{
                    let inputid = document.createElement("input");
                    inputid.setAttribute("name","id_barang[]");
                    inputid.setAttribute("value",idbarang);
                    inputid.setAttribute("id","inputid"+idbarang);
                    inputid.setAttribute("type","hidden");
                    let inputjumlah = document.createElement("input");
                    inputjumlah.setAttribute("name","jumlah[]");
                    inputjumlah.setAttribute("id","inputjumlah"+idbarang);
                    inputjumlah.setAttribute("type","hidden");
                    inputjumlah.setAttribute("value",1);
                    formtambahbhp.prepend(inputjumlah);
                    formtambahbhp.prepend(inputid);

                    el.style.display = "none";

                    let div = document.createElement("div");
                    div.className = "item";
                    div.id = "itembhpterpilih" + idhp;
                    div.setAttribute('data-angka',dataangka);

                    let divkanan = document.createElement("div");
                    divkanan.className = "kanan";

                    let pnama = document.createElement("p");
                    pnama.className = "nama";
                    pnama.textContent = nama;
                    divkanan.appendChild(pnama);

                    let pdesc = document.createElement("p");
                    pdesc.className = "desc";
                    pdesc.textContent = desc;
                    divkanan.appendChild(pdesc);

                    div.appendChild(divkanan);

                    let divcounter = document.createElement("div");
                    divcounter.className = "counter";

                    let btnmin = document.createElement("button");
                    btnmin.className = "minus";
                    btnmin.textContent = "-";
                    divcounter.appendChild(btnmin);

                    let inputangka = document.createElement("input");
                    inputangka.className = "angka";
                    inputangka.value = 1;
                    divcounter.appendChild(inputangka);

                    let btnplus = document.createElement("button");
                    btnplus.className = "plus";
                    btnplus.textContent = "+";
                    divcounter.appendChild(btnplus);
                    div.appendChild(divcounter);

                    let pclose = document.createElement("p");
                    pclose.className = "close";
                    pclose.textContent = "X";
                    div.appendChild(pclose);

                    bhpterpilih.prepend(div);

                    dataangka++;
                    refreshbhp();
                }
            });
        });
        // Item barang habis pakai terpilih
        let angkatambahan = 1;
        function refreshbhp(){
            let itembhpterpilih = document.querySelectorAll("#bhpterpilih .item");
            itembhpterpilih.forEach(element => {
                let bhpid = element.id;
                let closebhp = document.querySelector(`#${bhpid} .close`);
                let idmentah = bhpid.replace("itembhpterpilihbhp","");

                closebhp.addEventListener("click",()=>{
                    let inputbarang = document.getElementById("inputid"+idmentah);
                    let inputjumlah = document.getElementById("inputjumlah"+idmentah);
                    try {
                        inputbarang.remove();
                        inputjumlah.remove();
                    } catch (error) {

                    }

                    element.remove();
                    let idpilihan = bhpid.replace('itembhpterpilih', '');
                    let pilihan = document.getElementById(idpilihan);
                    pilihan.style.display = "flex";
                });
                let angkainputan = document.querySelector(`#${bhpid} .counter input.angka`);
                let inputanjumlah = document.getElementById("inputjumlah"+idmentah);

                angkainputan.addEventListener("input",function(e){
                    inputanjumlah.value = e.target.value;
                })
                let itemspesifik = document.getElementById(bhpid);
                console.log(`dataset angka : ${itemspesifik.dataset.angka}`);
                console.log(`angka tambahan : ${angkatambahan}`);
                if(itemspesifik.dataset.angka == angkatambahan){
                    let btnmin = document.querySelector(`#${bhpid} .counter .minus`);
                    btnmin.addEventListener("click",()=>{
                        if(angkainputan.value>1){
                            let hasilmin = angkainputan.value - 1;
                            angkainputan.value = hasilmin;
                            inputanjumlah.value = hasilmin;
                        }
                    });
                    let btnplus = document.querySelector(`#${bhpid} .counter .plus`);
                    btnplus.addEventListener("click",()=>{
                        let hasilplus = parseInt(angkainputan.value) + 1;
                        angkainputan.value = hasilplus;
                        inputanjumlah.value = hasilplus;
                    });
                }
            });
            angkatambahan++;
        }

    }
})
