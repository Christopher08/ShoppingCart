<h3 style=background: #012169;border:thin solid;>Chris Taylor &copy; <?php echo date("Y")?></h3>


</div>
    <!-- /container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	$('.add_to_cart').on('submit', function(){
		var id = $(this).closest('tr').find('.product-id').text();
		var name = $(this).closest('tr').find('.product-name').text();
		var quantity = $(this).closest('tr').find('.quantity').val();
		console.log(id);
		console.log(name);
		console.log(quantity);
			if(quantity != 0){
				window.location.href = "add_to_cart.php?id=" + id + "&name=" + name + "&quantity=" + quantity; //+ "&page=1";
			return false;
		}
	});
	
	$('.update_quantity').on('submit', function(){
		
		var id = $(this).closest('tr').find('.product-id').val();
		var name = $(this).closest('tr').find('.product-name').text();
		var quantity = $(this).closest('tr').find('.update-quantity').val();
		console.log(id);
		console.log(name);
		console.log(quantity);
		window.location.href = "update_quantity.php?id=" + id + "&name=" + name + "&quantity=" + quantity;
		return false;
	});
});
</script>

<p>You'll never see this muppet!</p>

</body>
</html>
