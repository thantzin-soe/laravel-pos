<form method="POST" action="{{ route('add.to.cart') }}">
	@csrf
	<input type="hidden" name="id" value="{{ $product->id }}">
	<input type="hidden" name="name" value="{{ $product->name }}">
	<input type="hidden" name="quantity" value="1">
	<input type="hidden" name="price" value="{{ $product->selling_price }}">

	<button type="submit" style="font-size: 20px; color: #000">
		<i class="fas fa-plus-square"></i>
	</button>
</form>
