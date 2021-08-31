var xmlHttp;

function deleteUser(userId) {
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp === null) {
        alert('Browser ne podržava xmlHttpRequest!');
        return;
    }   
    var url = 'brisanjeKorisnika.php';
    url = url + '?userId=' + userId;
    url = url + '&sid=' + Math.random();
    
    xmlHttp.onreadystatechange = obradaPromeneStanjaBrisanje;
    xmlHttp.open('GET', url, true);
    xmlHttp.send(null);
}

function obradaPromeneStanjaBrisanje() {
    if(xmlHttp.readyState === 4) {
        if(xmlHttp.responseText === 'Ok') {
            alert('Uspešno izbrisan korisnik. Osvežite stranicu!');
        }
    } 
}

function updateUser(userId) {
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp === null) {
        alert('Browser ne podržava xmlHttpRequest!');
        return;
    }
    
    var url = 'izmeniKorisnikaForma.php';
    url = url + '?userId=' + userId;
    url = url + '&sid=' + Math.random();
    
    xmlHttp.onreadystatechange = obradaPromeneStanjaIzmena;
    xmlHttp.open('GET', url, true);
    xmlHttp.send(null);
}

function obradaPromeneStanjaIzmena() {
    if(xmlHttp.readyState === 4) {
        document.getElementById('edit').innerHTML = xmlHttp.responseText;
        window.scroll(0, 500);
    }
}

function GetXmlHttpObject() {
    var xmlHttp = null;

    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }catch (e){
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject('Msxml2.XMLHTTP');
        }catch (e) {
            xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
    }

    return xmlHttp;
}

function skloniFormu() {
    document.getElementById('edit').innerHTML = '<a class="logout" href="admin.php">Vrati se</a>';
}

function sortProduct() {
    var radioButtons = document.getElementsByName('radioSort');
    var sort = getCheckedValue(radioButtons);
    
    var productTable = document.getElementById('product-table');
  
    xmlHttp = GetXmlHttpObject(); 
    if(xmlHttp === null) {
        alert('Browser ne podržava xmlHttpRequest!');
        return;
    }
    
    var url = 'sortProizvoda.php';
    url = url + '?sort=' + sort;
    url = url + '&sid=' + Math.random();
    
    xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState === 4) {
            productTable.innerHTML = xmlHttp.responseText;
        }
    };

    xmlHttp.open('GET', url, true);
    xmlHttp.send(null);
}

function getCheckedValue(radioObj) {
    if(!radioObj)
        return '';

    var radioLength = radioObj.length;

    if(radioLength == undefined)
        if(radioObj.checked)
            return radioObj.value;
        else
            return '';

    for(var i = 0; i < radioLength; i++) {
        if(radioObj[i].checked) {
            return radioObj[i].value;
        }
    }

    return '';
}

function searchProduct(){
    var searchText = document.getElementById('searchText').value;
    var productTable = document.getElementById('product-table');
  
    xmlHttp = GetXmlHttpObject(); 
    if(xmlHttp === null) {
        alert('Browser ne podržava xmlHttpRequest!');
        return;
    }
    
    var url = 'pretragaProizvoda.php';
    url = url + '?searchText=' + searchText;
    url = url + '&sid=' + Math.random();
    
    xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState === 4) {
            productTable.innerHTML = xmlHttp.responseText;
        }
    };

    xmlHttp.open('GET', url, true);
    xmlHttp.send(null);
}

function vote(productId) {
    xmlHttp = GetXmlHttpObject();
    if(xmlHttp === null) {
        alert('Browser ne podržava xmlHttpRequest!');
        return;
    }

    var url = 'glas.php';
    url = url + '?productId=' + productId;
    url = url + '&sid=' + Math.random();
    
    xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState === 4) {
            alert('Uspešno registrovan glas. Osvežite stranicu!');
        }
    };

    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);   
}
