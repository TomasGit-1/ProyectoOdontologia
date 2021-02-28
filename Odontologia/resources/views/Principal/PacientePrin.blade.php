<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Paciente Principal</title>
    @include('link')
</head>
<body class="bg-light">
	<div class="container-fluid col-11">
		@include('Principal.menu')
	    <div class="panel panel-default bg-transparent shadow p-2 mb-2">
			@include('Principal.opMenu')
        </div>
	</div>
<div class="container-fluid">
</div>
@include('linkScrip')
</body>
</html>

