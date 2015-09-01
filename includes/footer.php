</div><br><br>
        
    <footer class="text-center" id="footer">&copy; Copyright 2015 Music Gym</footer>
        
    
        
    <script>
        $(window).scroll(function(){
            var vscroll = $(this).scrollTop();
            $('#logotext').css({
                "transform": "translate(0px, "+vscroll/2+"px)"   
            });
            
            $('#back').css({
                "transform": "translate("+vscroll/5+"px, -"+vscroll/12+"px)"   
            });
            
            $('#fore').css({
                "transform": "translate(0px, -"+vscroll/2+"px)"   
            });
        });
        
        function detailsmodal(id){
           var data = {"id" : id};
           $.ajax({
             url : '/site/includes/detailsmodal.php',
             method : "post",
             data : data,
             success: function(data){
               $('body').append(data);
               $('#details-modal').modal('toggle');
             },
             error: function(){
               alert("Something went wrong!");
             }
            });
            }
    </script>    
    </body> 
</html>