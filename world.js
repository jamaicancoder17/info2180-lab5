window.onload = function(){
    var button = document.querySelector("#lookup");
    var httpRequest;
    console.log("here");
    button.addEventListener('click',function(element){
        element.preventDefault();

        httpRequest = new XMLHttpRequest();
        var url = "world.php";
        var country = document.querySelector("#country").value;
        console.log(country);
        httpRequest.onreadystatechange = loadList;
        httpRequest.open('GET',url+"?country="+country,true);
        httpRequest.send();

    });

    function loadList(){
        if(httpRequest.readyState === XMLHttpRequest.DONE){
            if(httpRequest.status === 200){
                var response = httpRequest.responseText;
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