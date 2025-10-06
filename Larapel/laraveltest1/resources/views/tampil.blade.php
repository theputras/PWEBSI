<?php
echo $isix;
?>
<h1>
{{ $isix }}
</h1>
<h1>
{{ $isiy }}
</h1>
<h1>
@foreach ($isiz as $xx)
{{$xx}}<br>
@endforeach
</h1>

<h1>
@foreach ($isik as $xxx)
{{$xxx}}<br>
@endforeach
</h1>
{{$isik["mobile"]}}