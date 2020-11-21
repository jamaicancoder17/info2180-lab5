window.onload = function(){
    var button = document.querySelector("#lookup");
    var button1 = document.querySelector("#lookup1");
    var httpRequest;

    button.addEventListener('click',function(element){
        element.preventDefault();

        httpRequest = new XMLHttpRequest();
        var url = "world.php";
        var country = document.querySelector("#country").value;
        console.log(country);
        httpRequest.onreadystatechange = loadList;
        httpRequest.open('GET',url+"?country="+country+"&context=country",true);
        httpRequest.send();

    });

    button1.addEventListener('click',function(element){
        element.preventDefault();

        httpRequest = new XMLHttpRequest();
        var url = "world.php";
        var country = document.querySelector("#country").value;
        console.log(country);
        httpRequest.onreadystatechange = loadList;
        httpRequest.open('GET', url+"?country="+country+"&context=city",true);
        httpRequest.send();
    });

    function loadList(){
        if(httpRequest.readyState === XMLHttpRequest.DONE){
            if(httpRequest.status === 200){
                var response = httpRequest.responseText;
                console.log("here");
                console.log(response);
                var div = document.querySelector("#result");
                div.innerHTML = response;
            }
            else{
                alert("There was a problem with the request");
            }
        }
    }
};