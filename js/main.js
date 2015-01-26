function logout(){
        $.post('/ajax/loginout',function(json){
            if(json.result==0){
                window.location.href =  window.location.href;
            }
        });
}