<form action="{{action('WaterMarkController@createImage')}}" method="post" enctype="multipart/form-data">
@csrf
<input type="file" name="image">

<input type="submit">
</form>

