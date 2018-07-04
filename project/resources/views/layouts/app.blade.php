
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@include('partials.styles')
	@yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('partials.header')
		@include('partials.sidebar')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@yield('modal')
		@include('partials.footer')
	</div>
	@include('partials.scripts')
	@yield('script')
	<script>
	var ajaxCall=function(){
		console.log("entro");
		$.ajax({
            type: 'POST',
            url:'/isacepted',
            data: {
            '_token':"{{ csrf_token() }}",
        	},
            success: function(data) {
            	console.log(data);
            	$('#Menu_Noti').html(data.html);
            	if(data.size > 0){
            		$('#count_Notificaction').text(data.size.toString());
            	}
            	else
            	{
            		$('#count_Notificaction').text("");
            	}

            },
		    error: function (result) {
		        
		    }
        });
     }
    interval = setInterval(ajaxCall,5000);

	function stopfunction(){
		clearInterval(interval);
	};


	function viewNotification(id){
		console.log(id);
		$.ajax({
            type: 'POST',
            url: "/updateNotificaction",
            data: {
                '_token':"{{ csrf_token() }}",
                'notification_id':id
            },
            success: function(data) {
            	console.log(data);

        		    $('#modalinfo .modal-body #parrafo').text(data.info);
        			$('#modalinfo').modal('show');
            },
		    error: function (result) {
		        $('#modalinfo .modal-body #parrafo').text("Existieron algunos errores.");
        		$('#modalinfo').modal('show');
		    }
        });
	};

	$.ajax({
        type: 'POST',
        url:'/hitos_month',
        data: {
        '_token':"{{ csrf_token() }}",
    	},
        success: function(data) {
        	console.log(data);
        	if(data > 0){
        		$("#aviso").show();
        	}
        },
	    error: function (result) {
	        
	    }
    });

    $.ajax({
        type: 'POST',
        url:'/reuniones_month',
        data: {
        '_token':"{{ csrf_token() }}",
    	},
        success: function(data) {
        	console.log(data);
        	if(data > 0){
        		$("#aviso2").show();
        	}
        },
	    error: function (result) {
	        
	    }
    });
	</script>

	</script>
	<!-- Modal -->
	<div class="modal fade" id="modalinfo" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><span class="glyphicon glyphicon-info-sign"></span><b>Información</b></h4>
				</div>
				<div class="modal-body">
					<p id="parrafo"></p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>

		</div>
	</div>
</body>
</html>
