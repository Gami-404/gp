/**
 * Created by Mahmoud on 9/3/2017.
 */
(function () {

    var preload=document.getElementById("preload");
    var loaging=0;
    var id=setInterval(frame,64);


    function frame() {
        if (loaging==100)
        {
            clearInterval(id);
            window.open("login.php","_self");
        }else {
            loaging =loaging + 1;
            if (loaging==90)
            {
                preload.style.animation="fadeout 1s ease";
            }
        }
    }

})();







/*start getCategories to droDwon list*/
/*var getCategories=1;

$.ajax({
    type:'GET',
    url:'http://localhost/PinceauStore/Controllers/categoryController.php',
    data:{getCategories:getCategories},
    dataType: 'JSON',
    success:function(html){
        var len = html.length;
        // alert(len+"");


        //we will fill the table
        for(var i=0; i<len; i++){
            var id = html[i].id;
            var name = html[i].name;

            $("#category").append("<option  data-tokens='"+name+"' value='"+id+"'>"+name+"</option>");



        }

    }
    ,
    error: function () {
        $('#msg').html("<div class='alert alert-dismissible alert-danger'  ><span class='text-danger' style='color: #fff'><i class='glyphicon glyphicon-exclamation-sign'></i> Error in recieving categories dropDown  response. </span></div>");

    }
});*/
/*end getCategories to droDwon list*/