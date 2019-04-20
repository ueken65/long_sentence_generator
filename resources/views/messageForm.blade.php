<form action="{{action('ImageGenerateController@createImage')}}" method="post">
@csrf
<textarea name="message"></textarea>

<input type="submit" value="Confirm">
</form>
