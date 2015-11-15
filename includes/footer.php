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
        
        function updateCart(mode,edit_id){
            var data = {"mode": mode, "edit_id": edit_id};
            $.ajax({
                url: '/site/admin/parsers/update_cart.php',
                method: "post",
                data: data,
                success: function(){location.reload()},
                error: function(){alert("Something went wrong with updating the cart");
            },
            
            });
        }
        
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
               
        function addToCart(){
         $('#modal_errors').html("");
         var quantity = $('#quantity').val();
         var available = $('#available').val();
         var error = '';
         var data = $('#add_product_form').serialize();
         if(quantity == '' || quantity == 0){
          error += '<p class="text-danger text-center">Please choose a quantity</p>';
          $('#modal_errors').html(error);
             return;
         }else if(quantity>available){
            error += '<p class="text-danger text-center">There are only '+available+' available products</p>';
            $('#modal_errors').html(error);
             return;
         }else{
            $.ajax({
                url:'/site/admin/parsers/add_cart.php',
                method: 'post',
                data: data,
                success: function(){
                    location.reload();
                },
                error: function(){alert("Something went wrong with processing cart information")}
            });
         }
        }
    </script>    
    </body> 
</html>