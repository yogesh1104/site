</div><br><br>
        
    <footer class="text-center" id="footer">&copy; Copyright 2015 Music Gym</footer>
        
    <script>
        function updateQuantity(){
            var quantityString = '';
            quantityString+=$('#quantity').val();
            $('#qty_prev').val(quantityString);
            
        }
        
        function get_child_options(selected){
            if(typeof selected === 'undefined'){
                var selected = '';
            }
            
            var parentID = $('#parent').val();
            $.ajax({
                url: '/site/admin/parsers/child_categories.php',
                type: 'POST',
                data: {parentID: parentID, selected: selected},
                success: function(data){
                    $('#child').html(data);
                },
                error: function(){alert("Something went wrong with the child options.")},
            });
        }
        $('select[name="parent"]').change(function(){
            get_child_options();
        });
    </script>
    </body> 
</html>