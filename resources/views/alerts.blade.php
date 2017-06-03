{{-- si se recibe algun mensaje se desplegaran --}}
@if(Session::has('message-error'))
	<div class="alert alert-danger alert-dismissible" id="error-alert">
		<button type="buttom" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Error! </strong>{{ Session::get('message-error') }} {{--  se imprime el mensaje --}}
	</div>
	<script> 
		setTimeout("$('.alert').hide(1500);",5000); 
	</script>
@endif
@if(Session::has('message-success'))
	<div class="alert alert-success alert-dismissible" id="error-alert">
		<button type="buttom" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Éxito! </strong>{{ Session::get('message-success') }}
	</div>
	<script> 
		setTimeout("$('.alert').hide(1500);",5000); 
	</script>
@endif