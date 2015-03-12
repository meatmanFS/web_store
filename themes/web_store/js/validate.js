$(document).ready(function(){
   var jVal_comm = {
        "check_email" : function() {
                var email = $(".f_email").val();
                var patt_email = /^.+@.+[.].{2,}$/i;

                if(!patt_email.test(email))  
                {
                    jVal_comm.errors = true;
                    $(".f_email").parent().parent().addClass("has-error");
                }
                
        },	
        "check_name" :function () {
                var patt_name = /^[A-zА-я .]{3,}$/i;
                var name = $(".f_name").val();
                
                if(!patt_name.test(name))  
                {
                    jVal_comm.errors = true;
                    $(".f_name").parent().parent().addClass("has-error");
                }
        },
        "sendIt" : function (){
                if(!jVal_comm.errors) {
                    $("#orderForm").submit();
            }
        }
    };
    
    $(".btn-primary").click(function(event){
        event.preventDefault();
        jVal_comm.errors = false;
        jVal_comm.check_name();
        jVal_comm.check_email();
        jVal_comm.sendIt();
        if(jVal_comm.errors) {
        return false;
        }
    });
    $(".f_name").keyup(function (){ 
        $(this).parent().parent().removeClass("has-error");
        jVal_comm.errors = false;
        jVal_comm.check_name();   
    });
    $(".f_email").keyup(function (){ 
        $(this).parent().parent().removeClass("has-error");
        jVal_comm.errors = false;
        jVal_comm.check_email();   
    });
});


