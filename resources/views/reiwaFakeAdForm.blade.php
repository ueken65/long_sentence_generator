<form action="{{action('ReiwaFakeAdController@createImage')}}" method="post">
@csrf
<textarea name="message"></textarea>
<input type="file" name="image">
<input type="submit" value="Confirm">
</form>
